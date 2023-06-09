<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The template for displaying posts in the Gallery post format
 */

$limme_params['grid'] = get_query_var( 'limme_gallery_grid' );

?>
<?php if ( isset( $limme_params['grid'] ) && $limme_params['grid'] === 4 ) : ?><div class="col-lg-3 col-md-4 col-sm-6 col-ms-6 matchHeight"><?php endif; ?>
<?php if ( isset( $limme_params['grid'] ) && $limme_params['grid'] === 3 ) : ?><div class="col-lg-4 col-md-4 col-sm-6 col-ms-6 matchHeight"><?php endif; ?>
<?php if ( ! isset( $limme_params['grid'] ) || $limme_params['grid'] === 2 ) : ?><div class="col-lg-6 col-md-6 col-sm-6 col-ms-6 matchHeight"><?php endif; ?>

	<article class="item ">

		<a href="<?php esc_url( the_permalink() ); ?>" class="photo"><?php echo the_post_thumbnail( 'limme-gallery' ); ?><span class="lte-border-top"></span><span class="lte-border-bottom"></span></a>
		<div class="descr">
			<a href="<?php esc_url( the_permalink() ); ?>"><h5 class="header"><?php the_title(); ?></h5></a>
		</div>
	</article>
</div>
