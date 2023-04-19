<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The sidebar containing the main widget area
 */

if ( limme_is_wc('woocommerce') || limme_is_wc('shop') || limme_is_wc('product') ) : ?>
			<?php 
				$limme_sidebar = limme_get_wc_sidebar_pos();
			?>
			<?php if ( is_active_sidebar( 'sidebar-wc' ) AND !empty( $limme_sidebar ) ): ?>
			<?php if ( $limme_sidebar == 'left' ): ?>
			<div class="col-xl-3 col-lg-4 col-md-12 col-xs-12 div-sidebar" >
			<?php else: ?>
			<div class="col-xl-3 col-lg-4 col-md-12 col-xs-12 div-sidebar" >
			<?php endif; ?>
				<div id="content-sidebar" class="content-sidebar woocommerce-sidebar widget-area" role="complementary">
					<span class="lte-sidebar-close"></span>
					<?php dynamic_sidebar( 'sidebar-wc' ); ?>
				</div>
				<span class="lte-sidebar-filter"></span>
				<span class="lte-sidebar-overlay"></span>
			</div>
			<?php endif; ?>
		</div>
	</div>
<?php elseif ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-xs-12 div-sidebar" >
		<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
			<span class="lte-sidebar-close"></span>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
		<span class="lte-sidebar-filter"></span>
		<span class="lte-sidebar-overlay"></span>		
	</div>
<?php endif; ?>
