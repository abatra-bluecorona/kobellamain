<?php
/**
 * navigation A
 */

// Exit if accessed directly.
defined("ABSPATH") || exit();

if (function_exists('rds_template')) {
    $get_rds_template_data_array = RDS_TEMPLATE_DATA;
}

$nav_class = "d-lg-block";
$template = basename(get_page_template());

if (
    $template == "rds-landing.php" &&
    (!isset($get_rds_template_data_array["page_templates"]["landing_page"]["announcement_and_nav_toggle"]) || 
    empty($get_rds_template_data_array["page_templates"]["landing_page"]["announcement_and_nav_toggle"]))
) {
    $nav_class = "d-lg-none";
}
?>
<div class="nav_container_desktop nav_container_desktop_a d-none hide-on-touch <?php echo esc_attr($nav_class); ?>">
    <div class="">
        <div class="">
            <div class="pl-0 text-right pt-1">
                <nav class="navbar navbar-expand-lg navbar-dark m-auto px-0 pb-0 pt-2 w-100">
                    <div id="navbarSupportedContentDesktop" class="navbar-collapse collapse" style="">
                        <?php
                        $args = [
                            "menu" => "main-menu",
                            "depth" => 3,
                            "theme_location" => "primary",
                            "container" => false,
                            "container_class" => "collapse navbar-collapse",
                            "container_id" => "navbarSupportedContentDesktop",
                            "menu_class" => "navbar-nav my-auto ms-auto flex-wrap justify-content-end",
                            "fallback_cb" => "Bluecorona_WP_Bootstrap_Navwalker::fallback",
                            "walker" => new Bluecorona_WP_Bootstrap_Navwalker(),
                        ];
                        wp_nav_menu($args);
                        ?>
                    </div>
                    <div id="navbar-icon" class="nav_icon input-group-text bg-transparent border-0 h-56 text-center m_w_45 rounded-0 focus-outline-0 cursor-pointer">
                        <i class="icon-magnifying-glass2 true_black text_15 line_height_18 mx-auto"></i>
                    </div>
                </nav>
                <div id="form_show">
                    <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" class="form_position input-group search d-inline-flex align-items-center error-search-box" style="display: none;">
                  
                        <div class="d-flex input_nav align-items-center">
                            <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="form-control nav_bg rounded-0 empty-search error-search bc_font_alt_1 bc_text_semibold border-0 ps-2 text_10 line_height_28" placeholder="Enter To Search">
                     
                                   <button id="searchsubmit" aria-label="magnifying glass" type="submit" class="input-group-text bg-transparent p-0 border-0  text-center m_w_45 rounded-0 focus-outline-0 cursor-pointer"><i class="icon-chevron-right1 d-flex align-items-center pe-2 text_light text_10 line_height_28"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function() {
  jQuery('#navbar-icon').click(function() {
    // Toggle the visibility of the form with fade-in and fade-out effects
    jQuery('#form_show').fadeToggle(500, function() {
      if (jQuery('#form_show').is(':visible')) {
        // Focus on the input field when the form is displayed
        jQuery('#s').focus();
      }
    });
  });
});
</script>