<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The Template for displaying sections preview
 * Peview uses full-width page without any elements
 */

add_filter('limme_navbar_layout', function() { return 'disabled'; } );
add_filter('limme_pageheader_layout', function() { return 'disabled'; } );
add_filter('limme_footer_cols_num', function() { return 0; } );
add_filter('limme_copyright_layout', function() { return 'disabled'; } );

remove_action( 'limme_wrapper_open', 'limme_wrapper_open' );
remove_action( 'limme_wrapper_close', 'limme_wrapper_close' );

get_header();

?>
<div class="lte-text-page lte-topbar-block">
	<?php
	while ( have_posts() ) : 

		the_post();

		get_template_part( 'tmpl/content', 'page' );

	endwhile;
	?>
</div>
<?php

get_footer();