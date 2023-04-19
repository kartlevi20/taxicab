<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

	do_action('limme_content_open');	

	$header_class = limme_get_pageheader_class();
	$pageheader_layout = limme_get_pageheader_layout();
	$pageheader_class = limme_get_pageheader_parallax_class();
?>
	<div class="lte-header-wrapper <?php echo esc_attr($header_class .' lte-pageheader-'. $pageheader_layout); ?>">
	<?php
		get_template_part( 'tmpl/navbar' );

		if ( $pageheader_layout != 'disabled' AND $pageheader_layout != 'narrow' ) : ?>
		<header class="<?php echo esc_attr($pageheader_class); ?>">
		    <div class="container">
		    	<?php	
			    	limme_the_h1();			
					limme_the_breadcrumbs();
				?>
		    </div>
			<?php
				limme_the_tagline_header_short();
				limme_the_social_header();
			?>
		</header>
		<?php endif; ?>
	</div>