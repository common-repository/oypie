<?php
/*
Plugin Name: OYPie
Plugin URI: http://sanderonlinemedia.nl/oypie;
Description: De plugin om je OYPO album in je WordPress in te laden!
Version: 1.2.7
Author: SanderOnline Media / Sander Dijkstra
Author URI: http://sander-dijkstra.nl/
License: Commercial use
*/

// Load shortcodes and widget
require_once("shortcode.php");

//Only Admin zone
// Add options page
add_action( 'admin_menu', 'oypie_menu' );

function oypie_menu() {
//    if (current_user_can( 'author' )){
    add_menu_page("", "OYPie", 'publish_posts', "oypie", "oypie_help_page",'dashicons-camera', 76 );
    add_submenu_page("oypie", "OYPie - Help", "Informatie", 'edit_theme_options', "oypie_help", "oypie_help_page");

    add_submenu_page("oypie", "OYPie - Albumgenerator", "Albumgenerator", 'publish_posts', "oypie_album", "oypie_album_page");
    add_submenu_page("oypie", "OYPie - Prijslijstgenerator", "Prijslijstgenerator", 'publish_posts', "oypie_price", "oypie_price_page");
//    Only admin may change preference and view update information
//    if (current_user_can( 'administrator' )){
        add_submenu_page("oypie", "OYPie - Voorkeuren", "Voorkeuren", 'edit_theme_options', "oypie_preference", "oypie_preference_page");
//    }
    remove_submenu_page( 'oypie', 'oypie' );
//    }
}

// Admin Pages
function oypie_price_page() {
    require_once("pages/price.php");
    }

function oypie_help_page() {
    require_once("pages/help.php");
    }

function oypie_album_page() {
    require_once("pages/album.php");
}
function oypie_preference_page() {
    require_once("pages/preference.php");
}

// MCE Button
add_action('admin_head', 'oypie_add_button');

function oypie_add_button() {
    global $typenow;
    if ( !current_user_can('author') && !current_user_can('edit_pages') ) {
    return;
    }
    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "oypie_add_tinymce_plugin");
        add_filter('mce_buttons', 'oypie_register_my_tc_button');
    }
}

function oypie_add_tinymce_plugin($plugin_array) {
    $plugin_array['oypie_tc_button'] = plugins_url( 'js/text-button.js', __FILE__ );
    return $plugin_array;
}

function oypie_register_my_tc_button($buttons) {
   array_push($buttons, "oypie_tc_button");
   return $buttons;
}

// Admin Menu
    add_action( 'admin_bar_menu', 'oypie_admin', 900 );
    function oypie_admin($wp_admin_bar)
    {
        $args = array(
            'id'     => 'social_media',
            'title'    =>    'OYPO Dashboard',
            'href'        =>    'https://www.oypo.nl/content.asp?path=eanbaokb',
            'meta' => array('target' => '_blank')
        );
        $wp_admin_bar->add_node( $args );
    }

add_action( 'admin_enqueue_scripts', 'oypie_admin_styles' );
      function oypie_admin_styles() {
        wp_enqueue_style( 'oypie-tc', plugin_dir_url( __FILE__ ) . '/css/btn.css', false, '1.0.0' );
        wp_enqueue_style( 'oypie-admin', plugin_dir_url( __FILE__ ) . '/css/admin.css', false, '1.0.0' );
      }


add_action( 'wp_enqueue_script', 'oypie_styles');
function oypie_styles(){
    wp_enqueue_script('jquery');
}
