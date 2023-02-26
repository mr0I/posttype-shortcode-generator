<?php

/**
 * Plugin Name: Custom Post-Type Shortcode
 * Plugin URI: http://localhost
 * Description:
 * Version: 1.0.0
 * Author: ZeroOne
 * Author URI: https://github.com/tuderiewsc
 * Text Domain: cpt_shortcode
 * Domain Path: /l10n
 */
defined('ABSPATH') or die('No script kiddies please!');
define('CPTS_ROOTDIR', plugin_dir_path(__FILE__));
define('CPTS_INC', CPTS_ROOTDIR . 'includes/');
define('CPTS_ADMIN', CPTS_ROOTDIR . 'admin/');
define('CPTS_ADMIN_TEMPLATE_DIR', CPTS_ADMIN . 'templates/');
define('CPTS_ADMIN_JS', plugin_dir_url(__FILE__) . 'admin/assets/js/');
define('CPTS_ADMIN_CSS', plugin_dir_url(__FILE__) . 'admin/assets/css/');
define('CPTS_STATIC', plugin_dir_url(__FILE__) . 'site/static/');
define('CPTS_CSS', plugin_dir_url(__FILE__) . 'site/static/css/');

add_action('plugins_loaded', function () {
    load_plugin_textdomain('cpt_shortcode', false, basename(CPTS_ROOTDIR) . '/l10n/');
});


add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('select2-script', CPTS_ADMIN_JS . 'select2.min.js', array(), '4.1.0');
    wp_enqueue_script('vanillaSelectBox-script', CPTS_ADMIN_JS . 'vanillaSelectBox.js', array(), '0.78');
    wp_enqueue_script('rsc-admin-script', CPTS_ADMIN_JS . 'admin_scripts.js', array('jquery'), '1.0.0');
    wp_localize_script('rsc-admin-script', 'CPTS_ADMIN_Ajax', array(
        'AJAXURL' => admin_url('admin-ajax.php'),
        'SECURITY' => wp_create_nonce('OwpCojMcdGJ-k-o'),
        'REQUEST_TIMEOUT' => 30000,
        'SELECT_POST_LIST_TEXT' => __('Select Post...', 'cpt_shortcode'),
        'SUCCESS_COPY_TO_CLIP' => __('The text copied to clipboard successfully :D', 'cpt_shortcode'),
        'Selected_Post_Types_TEXT' => __('Select Your Post Types', 'cpt_shortcode')
    ));

    wp_enqueue_style('select2-css', CPTS_ADMIN_CSS . 'select2.min.css', null);
    wp_enqueue_style('vanillaSelectBox-css', CPTS_ADMIN_CSS . 'vanillaSelectBox.css', null);
    wp_enqueue_style('rsc-admin-styles', CPTS_ADMIN_CSS . 'admin_styles.css', '1.0.0');
});
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('rsc-styles', CPTS_CSS . 'main.css', '1.0.0');
});
/** Init & Includes */
include(CPTS_ROOTDIR . 'base_functions.php');
register_activation_hook(__FILE__, 'CPTS_activate_function');
register_deactivation_hook(__FILE__, 'CPTS_deactivate_function');
include(CPTS_INC . 'shortcodes.php');
if (is_admin()) {
    include(CPTS_ADMIN . 'sp_shortcode_metabox.php');
    include(CPTS_ADMIN . 'ajax_requests.php');
    include(CPTS_ADMIN . 'admin_process.php');
}
