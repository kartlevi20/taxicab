<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Services List
 */

$header = get_the_title();
$subheader = fw_get_db_post_option(get_The_ID(), 'subheader');
$icons = fw_get_db_post_option(get_The_ID(), 'items');
$large = get_query_var( 'limme-services-large' );

$item_cats = wp_get_post_terms( get_the_ID(), 'services-category' );

if ( !empty($item_cats) ) {

	$item_cat = $item_cats[0]->name;
}

$link = fw_get_db_post_option(get_The_ID(), 'link');

if ( empty($link) ) {

    $link = get_the_permalink();
}       

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('lte-services-grid-item'); ?>>
 	<a href="<?php echo esc_url( $link ); ?>" class="lte-image">
		<?php the_post_thumbnail('limme-services'); ?>
		<span class="lte-photo-overlay"></span>
	</a>
    <div class="lte-description">
        <a href="<?php echo esc_url( $link ); ?>" class="lte-header">
            <h5 class="lte-header"><?php echo wp_kses_post($header); ?></h5>
        </a>
        <?php
            if ( !empty($subheader)) {

                echo '<h6 class="lte-subheader">'. esc_html($subheader).'</h6>';
            }
        ?>        
    </div>
</article>
