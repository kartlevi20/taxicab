<?php
/**
 * The Rental template file
 *
 */

get_header();


if ( empty($layout) ) {

	$layout = 'car';
}

?>
<div class="inner-page margin-default lte-rental-sc lte-rental-archive">
	<?php
		get_template_part( 'tmpl/rental-form' );
	?>

        <div class="">
			<?php

			if ( get_query_var( 'paged' ) ) {

				$paged = get_query_var( 'paged' );

			} elseif ( get_query_var( 'page' ) ) {

				$paged = get_query_var( 'page' );
				
			} else {

				$paged = 1;
			}

			$q = array();
			if ( !empty($_GET['s-brand']) ) {

				$q[] = array(
		            'taxonomy' => 'rental-brand',
		            'field' => 'term_id',
		            'terms' => array((int)($_GET['s-brand']))
		        );
			}

			if ( !empty($_GET['s-cats']) ) {

				$scats = explode(',', $_GET['s-cats']);

				$q[] = array(
		            'taxonomy' => 'rental-category',
		            'field' => 'term_id',
		            'terms' => $scats
		        );
			}

			if ( !empty($_GET['s-tags']) ) {

				$q[] = array(
		            'taxonomy' => 'rental-post_tag',
		            'field' => 'term_id',
		            'terms' => array((int)($_GET['s-tags']))
		        );
			}

			$tax_query = array();
			if ( !empty( $q ) ) {

				$tax_query['tax_query'] = array(
	        		'relation' => 'AND',
			        $q,
				);
			}

			$wp_query = new WP_Query( array(
				'post_type' => 'rental',
				'paged' => (int) $paged,
			) + $tax_query);

		    echo '<div class="lte-rental-list row centered lte-layout-'.esc_attr($layout).'">';

				if ( $wp_query->have_posts() ) :

					while ( $wp_query->have_posts() ) :

						the_post();

						$args = fw_get_db_post_option(get_The_ID());

						$price = (int)(str_replace(array('$',' '), '', $args['price_full']));

						if ( !empty($_GET['price-from']) AND (int)($price) < $_GET['price-from'] ) continue;
						if ( !empty($_GET['price-to']) AND (int)($price) > $_GET['price-to'] ) continue;

						get_template_part( 'tmpl/content-rental' );
					endwhile;

				else :
	
					get_template_part( 'tmpl/content', 'none' );

				endif;

			echo '</div>';
			?>
        </div>
		<?php
		if ( have_posts() ) {

			limme_paging_nav();
		}
        ?>	        
    </div>
</div>
<?php

get_footer();
