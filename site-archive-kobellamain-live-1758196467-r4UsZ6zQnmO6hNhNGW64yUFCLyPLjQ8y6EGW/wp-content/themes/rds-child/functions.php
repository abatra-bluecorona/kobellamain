<?php
/**
 * Polaris RDS Child Theme functions and definitions
 *
 * @package polarischild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
require ABSPATH . '/version_control/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// if ($_SERVER['SERVER_NAME'] !== 'localhost') { 

// $myUpdateChecker = PucFactory::buildUpdateChecker(
//     RDS_CHILD_THEME_REPO,
//     __FILE__,
//     'polaris-rds-child'
// );
 // Optional, if you want to check updates from a specific branch
// $myUpdateChecker->setBranch(GIT_BRANCH);

// $myUpdateChecker->setAuthentication(GIT_AUTHENTICATION); 
// }
// Optional, if your repository is private
/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'rds-child-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ), 'all' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'rds-child-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'polaris-rds-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @param string $current_mod The current value of the theme_mod.
 * @return string
 */
function understrap_default_bootstrap_version( $current_mod ) {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );


/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );
/**
 * enqueue rds font awesomw style for showing fontss.
 */

 $child_theme_path = get_stylesheet_directory() . '/img/font-awesome/style.css';
 $parent_theme_path = get_template_directory() . '/img/font-awesome/style.css';
 
 if (file_exists($child_theme_path)) {
	 $filepath = $child_theme_path;
	 $urlpath = get_stylesheet_directory_uri() . '/img/font-awesome/style.css';
 } elseif (file_exists($parent_theme_path)) {
	 $filepath = $parent_theme_path;
	 $urlpath = get_template_directory_uri() . '/img/font-awesome/style.css';
 } else {
	 $filepath = false;
 }
 
 if ($filepath) {
	 add_action('init', 'rds_font_awesome_style');
	 function rds_font_awesome_style() {
		 global $urlpath; // Make $urlpath available inside the function
		 wp_register_style('rds-font-awesome', $urlpath, false);
		 wp_enqueue_style('rds-font-awesome');
	 }
 }


 add_action('wp_head', 'rds_custom_font_family_script');
function rds_custom_font_family_script() {
    ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;900&display=swap?<?php echo time(); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap?<?php echo time(); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap?<?php echo time(); ?>">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Source+Sans+Pro:wght@300;400;600;700&display=swap?<?php echo time(); ?>">

    <?php
}
function custom_rewrite_rules() {
    // Remove "/blog/" from "category" taxonomy URLs
    add_filter( 'term_link', function( $link, $term, $taxonomy ) {
        if ( $taxonomy == 'category' && strpos( $link, '/blog/' ) !== false ) {
            $link = str_replace( '/blog/', '/', $link );
        }
        return $link;
    }, 10, 3 );

// Add custom rewrite rule to remove "/blog/" from "category" taxonomy URLs
add_rewrite_rule(
    '^category/(.+?)/?$',
    'index.php?category_name=$matches[1]',
    'top'
);
}