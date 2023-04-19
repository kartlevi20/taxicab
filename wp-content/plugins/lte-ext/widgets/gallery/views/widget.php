<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_widget
 * @var string $after_widget
 */

echo wp_kses_post( $before_widget );

if ( !empty($params['title']) )  {

	echo wp_kses_post( $before_title ) . esc_html( apply_filters( 'widget_title', $params['title'] ) ) . wp_kses_post( $after_title );
}

if ( empty($params['limit']) ) {

	$params['limit'] = 6;
}

$wp_query = new WP_Query( array(
	'post_type' => 'gallery',
	'posts_per_page'	=>	$params['limit'],
) );

echo '<div class="lte-widget-gallery">';

if ( $wp_query->have_posts() ) {
	while ( $wp_query->have_posts() ) {

		$wp_query->the_post();

		?>
			<article class="lte-item">
				<a href="<?php esc_url( the_permalink() ); ?>" class="lte-photo"><?php echo the_post_thumbnail( 'limme-gallery-grid' ); ?></a>
			</article>
		<?php
	}
}

echo '</div>';

echo wp_kses_post( $after_widget );

?>