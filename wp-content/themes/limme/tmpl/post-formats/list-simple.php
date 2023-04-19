<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The default template for displaying standard post format
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 

        $post_format = get_post_format();
        if ( $post_format == 'video' ) {

            $limme_photo_class = 'lte-photo swipebox';

            echo '<div class="lte-wrapper">';
                echo '<a href="'.esc_url(limme_find_http(get_the_content())).'" class="'.esc_attr($limme_photo_class).'">';

                    the_post_thumbnail('full');
                    
                    echo '<span class="lte-icon-video"></span>';

                echo '</a>';
            echo '</div>';
        }
            else
        if ( !empty( $gallery_files ) AND function_exists('lte_swiper_get_the_container') ) {

            $atts['swiper_arrows'] = 'sides-tiny';
            $atts['swiper_autoplay'] = fw_get_db_settings_option( 'blog_gallery_autoplay' );
        
            echo lte_swiper_get_the_container('lte-post-gallery', $atts, '', ' id="lte-slide-'.get_the_ID().'" ');
            echo '<div class="swiper-wrapper">';

            foreach ( $gallery_files as $item ) {

                echo '<a href="'.esc_url(get_the_permalink()).'" class="swiper-slide">';
                    the_post_thumbnail('full');
                echo '</a>';
            }

            echo '</div>
            </div>
            </div>';
        }
            else
        if ( has_post_thumbnail() ) {

            $limme_photo_class = 'lte-photo';
            $limme_layout = get_query_var( 'limme_layout' );
            $display_excerpt = 'hidden';

            $limme_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_The_ID()), 'full' );

            if ($limme_image_src[2] > $limme_image_src[1]) $limme_photo_class .= ' vertical';
            
            echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($limme_photo_class).'">';

                if ( empty($limme_layout) OR $limme_layout == 'classic'  ) {

                    the_post_thumbnail('full');
                    $display_excerpt = 'visible';
                }
                    else
                if ( $limme_layout == 'two-cols'  ) {           

                    the_post_thumbnail();
                }
                    else {

                    $sizes_hooks = array( 'limme-blog', 'limme-blog-full' );
                    $sizes_media = array( '1199px' => 'limme-blog' );

                    limme_the_img_srcset( get_post_thumbnail_id(), $sizes_hooks, $sizes_media );
                }

                echo '<span class="lte-photo-overlay"></span>';

            echo '</a>';
        }
    ?>
    <div class="lte-description">
        <a href="<?php esc_url( the_permalink() ); ?>" class="lte-header"><h3><?php the_title(); ?></h3></a>
    </div>     
</article>