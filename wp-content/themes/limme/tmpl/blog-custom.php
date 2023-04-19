<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The blog template file
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */

$blog_class = $sidebar_wrap = $limme_layout = '';
$limme_sidebar_hidden = false;
$limme_sidebar = 'right';
$blog_wrap_class = 'col-xl-9 col-lg-8 col-md-12 col-xs-12';

if ( function_exists( 'FW' ) ) {

	$limme_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'blog-layout' );
	$limme_sidebar = fw_get_db_settings_option( 'blog_list_sidebar' );

	$limme_sidebar_custom = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'sidebar-layout' );
	if ( $limme_sidebar_custom != 'default') $limme_sidebar = $limme_sidebar_custom;

	if ( $limme_sidebar == 'hidden' OR $limme_sidebar == 'disabled' ) $limme_sidebar_hidden = true;

	$blog_wrap_class = 'col-xl-9 col-lg-8 col-md-12 col-xs-12 ';

	if ( $limme_sidebar == 'left' ) {

	
	}

	$blog_class = '';
	if ( $limme_layout == 'two-cols' OR $limme_layout == 'three-cols' ) {

		$blog_class = 'masonry';
		if ( $limme_sidebar_hidden ) $blog_wrap_class = 'col-lg-12 col-xs-12';
	}
		else {

		if ( $limme_sidebar_hidden ) $blog_wrap_class = 'col-xl-9 col-lg-10 col-md-12 col-xs-12';	
	}

	if ( $limme_layout == 'classic' ) {

		$sidebar_wrap = 'with-sidebar';
	}
		else {

		$sidebar_wrap = '';
	}
}

get_header(); ?>
<div class="inner-page margin-default">
	<div class="row lte-sidebar-position-<?php echo esc_attr($limme_sidebar); ?><?php if ( $limme_sidebar_hidden ) echo 'centered'; else echo esc_attr($sidebar_wrap); ?>">
        <div class="<?php echo esc_attr( $blog_wrap_class ); ?> lte-blog-wrap" >
            <div class="blog blog-block layout-<?php echo esc_attr($limme_layout); ?>">
				<?php

				if ( get_query_var( 'paged' ) ) {

					$paged = get_query_var( 'paged' );

				} elseif ( get_query_var( 'page' ) ) {

					$paged = get_query_var( 'page' );
					
				} else {

					$paged = 1;
				}

				if (isset($_GET['s'])) {

					$wp_query = new WP_Query( array(
						's'		=> esc_sql( $_GET['s'] ),
						'paged' => (int) $paged,
					) );
				}
					else {

					$wp_query = new WP_Query( array(
						'post_type' => 'post',
						'paged' => (int) $paged,
					) );
				}

            	echo '<div class="row '.esc_attr($blog_class).'">';
				if ( $wp_query->have_posts() ) :

					while ( $wp_query->have_posts() ) : the_post();

						if ( !function_exists( 'FW' ) ) {

							get_template_part( 'tmpl/content-post-one-col', $wp_query->get_post_format() );
						}
							else {

							set_query_var( 'limme_layout', $limme_layout );

							if ($limme_layout == 'three-cols') {

								get_template_part( 'tmpl/content-post-three-cols', $wp_query->get_post_format() );
							}
								else
							if ($limme_layout == 'two-cols') {

								get_template_part( 'tmpl/content-post-two-cols', $wp_query->get_post_format() );
							}
								else {

								set_query_var( 'lte_display_excerpt', true );
								get_template_part( 'tmpl/content-post-one-col', $wp_query->get_post_format() );
							}
						}

						endwhile;

					else :
						// If no content, include the "No posts found" template.
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
	    <?php
	    if ( !$limme_sidebar_hidden ) {

            if ( $limme_sidebar == 'left' ) {

            	get_sidebar( 'left' );
            }
            	else  {

            	get_sidebar();
            }
	    }
	    ?>
	</div>
</div>
<?php

get_footer();
