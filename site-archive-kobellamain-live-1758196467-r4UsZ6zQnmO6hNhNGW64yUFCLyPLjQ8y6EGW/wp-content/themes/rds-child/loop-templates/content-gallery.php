<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */
// Exit if accessed directly.
// Exit if accessed directly.
defined('ABSPATH') || exit;

    // Get the gallery images of the current post
    $gallery_img = get_post_meta(get_the_ID(), 'gallery_images', true);
    $gallery_img_arr = json_decode($gallery_img);
    


    // Get the featured image URL of the current post
    $featured_image_id = get_post_thumbnail_id();
    $feat_image_url = wp_get_attachment_url($featured_image_id);
    $alt = get_post_meta($featured_image_id, '_wp_attachment_image_alt', true);
    $post_title = get_the_title();
?>

<div class="col-lg-4 col-md-6 pb-30 268 lightbox">
    <div class="gallery_link ">
        <div class="rounded-0 border-10 position-relative">
            <img class="m-auto d-block w-100 h-auto img-border" src="<?php echo $feat_image_url; ?>" width="325" height="325" alt="<?php echo $alt; ?>">
        
            <div class="overlay position-absolute h-100 w-100 d-flex align-items-center justify-content-center">
                <div class="text position-absolute text-center">
                    <i class="true_white icon-magnifying-glass1 text_50 line_height_24 mx-auto" data-bs-toggle="modal" data-bs-target="#gallery_1-<?php echo get_the_ID(); ?>"></i>
                </div>
            </div>
        </div>
    </div>
    <h3><?php echo $post_title; ?></h3>

<div id="Gallery-lightBox">
    <div class="modal gallery_modal" id="gallery_1-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl border-0 modal-dialog-centered" role="document">
            <div class="modal-content  border-0 text-center bg-transparent">
                <div class="modal-body border-0 bg-transparent text-center p-0">
                    
                <div class="swiper swiper-container swiper_custom">
                        <div class="swiper-wrapper">
                        <?php foreach ($gallery_img_arr as $img_obj) {
                                // Get the attachment ID using the image URL
                                $attachment_id = attachment_url_to_postid($img_obj->image);

                                // Get the alt text for the current gallery image
                                $gallery_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                            ?>
                                
                                <div class="swiper-slide d-inline-block abc p-lg-5  px-4 py-5">
                                    <div class="d-inline-block position-relative border-25">
                                        <button type="button" class="close m-0 bg-transparent p-0  p-alt position-absolute mr-n0 border-0" data-bs-dismiss="modal" aria-label="Close" style="outline: none;opacity: 1; top: -59px;z-index: 99;    width: 2rem; right: -59px;">
                                            <i class=" icon-xmark1 text_30  true_white line_height_26"></i>
                                        </button> 
                                        <img class="d-block img-fluid mx-auto" src="<?php echo $img_obj->image; ?>" alt="<?php echo esc_attr($gallery_alt); ?>">
                                        <div class="swiper-button-next swiper-button-next-lightbox-gallery color_tertiary_bg">
                                            <i class="p-alt icon-chevron-right1  text_20   line_height_24"></i>
                                        </div>
                                        <div class="swiper-button-prev swiper-button-prev-lightbox-gallery color_tertiary_bg">
                                            <i class="p-alt icon-chevron-left1  text_20   line_height_24"></i>
                                        </div> 
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

    
    <style>
          div#Gallery-lightBox .modal-xl div.swiper_custom img {
    max-height: 80vh;
    width: 100%;
  }
  div.gallery_modal {
    z-index: 9999999;
    background: rgba(0, 0, 0, 0.75);
    overflow: hidden;
}
    </style>
    

