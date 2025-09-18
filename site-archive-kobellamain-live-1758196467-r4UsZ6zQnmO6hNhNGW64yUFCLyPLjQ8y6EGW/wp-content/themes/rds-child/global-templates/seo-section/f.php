<?php
/*function get_elementor_template_id_by_title($template_title) {
    $args = array(
        'post_type' => 'elementor_library',
        'post_status' => 'publish',
        'posts_per_page' => 1, 
        'title' => $template_title 
    );
    $templates = get_posts($args);
    if ($templates) {
        return $templates[0]->ID;
    }
    return false; 
}

$template_id = get_elementor_template_id_by_title('About Us Page Template');*/

$post_id = get_the_ID();
$meta = get_post_meta($post_id);

if (isset($meta['_elementor_template_type']) && isset($meta['_elementor_edit_mode'])) {
    if (isset($meta['_elementor_data'])) {
        $elementorData = $meta['_elementor_data'][0];
        $array_data = json_decode($elementorData, true);
        $template_id = $array_data[0]['elements'][0]['elements'][0]['settings']['template_id'];

        if ($template_id == 40758) {
            $image_placeholder_image = get_exist_image_url('seo-section','seo-img-left');
                        $image_placeholder_image2x = get_exist_image_url('seo-section','seo-img-left@2x');
                        $image_placeholder_image3x = get_exist_image_url('seo-section','seo-img-left@3x');

                        /*if (@getimagesize($image_placeholder_image) === false) {
                            $image_placeholder_image = get_stylesheet_directory_uri() . '/img/seo-section/seo-img.webp';
                            $image_placeholder_image2x = get_stylesheet_directory_uri() . '/img/seo-section/seo-img@2x.webp';
                            $image_placeholder_image3x = get_stylesheet_directory_uri() . '/img/seo-section/seo-img@3x.webp';
                        }

                        $m_image_placeholder_image = get_stylesheet_directory_uri() . '/img/about-page/m-seo-img-left.webp';
                        $m_image_placeholder_image2x = get_stylesheet_directory_uri() . '/img/about-page/m-seo-img-left@2x.webp';
                        $m_image_placeholder_image3x = get_stylesheet_directory_uri() . '/img/about-page/m-seo-img-left@3x.webp';

                        if (@getimagesize($m_image_placeholder_image) === false) {
                            $m_image_placeholder_image = get_stylesheet_directory_uri() . '/img/seo-section/seo-img.webp';
                            $m_image_placeholder_image2x = get_stylesheet_directory_uri() . '/img/seo-section/seo-img@2x.webp';
                            $m_image_placeholder_image3x = get_stylesheet_directory_uri() . '/img/seo-section/seo-img@3x.webp';
                        }*/
            $image_src = 'https://rdspagbuilddev.wpengine.com/wp-content/themes/rds-child/img/about-page/seo-img-left.webp';
            $a = '<img src="'. $image_placeholder_image.'" srcset="'. $image_placeholder_image.' ?> 1x, '. $image_placeholder_image2x.' 2x, '. $image_placeholder_image3x.' 3x" class="img-fluid float-lg-start me-lg-5 pb-lg-0 pb-4 d-lg-inline-block d-none" width="540" height="534" alt="Homepage Image">
            <img src="'. $image_placeholder_image.'" srcset="'. $image_placeholder_image.' ?> 1x, '. $image_placeholder_image2x.' 2x, '. $image_placeholder_image3x.' 3x"  class="img-fluid float-lg-start me-lg-5 pb-lg-0 pb-4 d-inline-block d-lg-none" width="540" height="534" alt="Homepage Image">';
                           
            // $a = '<img fetchpriority="high" decoding="async" src="' . $image_src . '" srcset="' . $image_src . ' 1x, ' . $image_src . '@2x.webp 2x, ' . $image_src . '@3x.webp 3x" class="img-fluid float-lg-end ms-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">';

        } 
    }
}


// Output $a and $b variables for inspection
// echo '<pre>';
// echo 'Value of $a: ' . htmlspecialchars($a) . '<br>';
// echo '</pre>';


/*$elementorData = $meta['_elementor_data'];

foreach ($elementorData as $data) {
    $array_data = json_decode($data, true);
    $template_id = $array_data[0]['elements'][0]['elements'][0]['settings']['template_id'];
    
}*/
?>
<div class="d-block ">
    <div class="container-fluid py-lg-0 py-0 pt-4 pt-lg-3 text-start  seosection-var-e">
        <div class="container pt-lg-3 py-3">
            <div class="row py-lg-0">
                <div class="col-lg-12 px-0 bc_homepage seosection-bc text-md-left">
                    <?php 
                    if (empty($a)) {

                        $postId = $_GET['post'];
                        if ($postId == 40758) {
                            ?>
                            <img src="<?php echo get_exist_image_url('seo-section','seo-img-left'); ?>" srcset="<?php echo get_exist_image_url('seo-section','seo-img-left'); ?> 1x, <?php echo get_exist_image_url('seo-section','seo-img-left@2x'); ?> 2x, <?php echo get_exist_image_url('seo-section','seo-img-left@3x'); ?> 55555" class="img-fluid float-lg-start me-lg-5 pb-lg-0 pb-4" width="540" height="534" alt="Homepage Image">
                         <?php  
                        }else{
                            ?>
                            <img src="<?php echo get_exist_image_url('seo-section','seo-img-left'); ?>" srcset="<?php echo get_exist_image_url('seo-section','seo-img-left'); ?> 1x, <?php echo get_exist_image_url('seo-section','seo-img-left@2x'); ?> 2x, <?php echo get_exist_image_url('seo-section','seo-img-left@3x'); ?> 3x" class="img-fluid float-lg-start me-lg-5 pb-lg-0 pb-4 d-lg-block d-none" width="540" height="576" alt="Homepage Image">
                            <img src="<?php echo get_exist_image_url('seo-section','m-seo-img-left'); ?>" srcset="<?php echo get_exist_image_url('seo-section','m-seo-img-left'); ?> 1x, <?php echo get_exist_image_url('seo-section','m-seo-img-left@2x'); ?> 2x, <?php echo get_exist_image_url('seo-section','m-seo-img-left@3x'); ?> 3x" class="img-fluid float-lg-start me-lg-5 pb-lg-0 pb-4 d-lg-none d-block w-100" width="350" height="278" alt="Homepage Image">
                            

                        <?php
                        
                        }
                    }else{
                    echo $a;
                }
                     ?>
                     
                    
                     <h2 class="text-lg-start text-start text_normal text_32 sm_text_22 sm_line_height_27 line_height_37 text_bold"><?php echo $args['page_templates']['homepage']['seo_section']['heading']; ?></h2> 
                    <h3 class="pb-lg-4 text-lg-start text-start text_bold text_36 line_height_41 sm_text_26 sm_line_height_31"><?php echo $args['page_templates']['homepage']['seo_section']['subheading']; ?> </h3>
                                        <p ><?php echo $args['page_templates']['homepage']['seo_section']['before_read_more_content']; ?></p>
 <div class="collapse bg-transparent border-0" id="read_more">
            
        </div>

                </div>
            </div>
        </div>
    </div>
</div> 