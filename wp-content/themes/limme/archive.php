<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */

$limme_sidebar_hidden = false;
$limme_layout = 'classic';
$blog_class = '';

if ( function_exists('FW') ) {

	$limme_layout = fw_get_db_settings_option( 'blog_layout' );

	if ( $limme_layout != 'classic' ) {

		$blog_class = 'masonry';
	}
}

if ( !limme_check_active_sidebar() ) {

	$limme_sidebar_hidden = true;	
}

get_header();

?>
<div class="inner-page margin-default">
	<div class="row centered">
        <div class="col-xl-8 col-lg-8 col-md-12 lte-blog-wrap">
            <div class="blog blog-block layout-<?php echo esc_attr($limme_layout); ?>">
				<?php

				if ( $wp_query->have_posts() ) :

	            	echo '<div class="row '.esc_attr($blog_class).'">';
					while ( $wp_query->have_posts() ) : the_post();

						// Showing classic blog without framework
						if ( !function_exists( 'FW' ) ) {

							set_query_var( 'lte_display_excerpt', true );
							get_template_part( 'tmpl/content-post-one-col' );
						}
							else {

							set_query_var( 'limme_layout', $limme_layout );

							if ($limme_layout == 'three-cols') {

								get_template_part( 'tmpl/content-post-three-cols' );
							}
								else
							if ($limme_layout == 'two-cols') {

								get_template_part( 'tmpl/content-post-two-cols' );
							}
								else {

								set_query_var( 'lte_display_excerpt', true );
								get_template_part( 'tmpl/content-post-one-col' );
							}
						}

					endwhile;
					echo '</div>';
				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'tmpl/content', 'none' );

				endif;

				?>
				<?php
				if ( have_posts() ) {

					limme_paging_nav();
				}
	            ?>
	        </div>
	    </div>
	    <?php
	    if ( !$limme_sidebar_hidden ) {

            	get_sidebar();
	    }
	    ?>
	</div>
</div>
<?php

get_footer();

