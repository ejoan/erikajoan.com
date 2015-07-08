<?php
/**
* Add Scripts
*
* Add JS and CSS to the main theme and to admin
*
* @package	Artiss-YouTube-Embed
*/

// Switch on shortcodes in widgets, if requested

if ( !is_admin() ) {
	$options = get_option( 'youtube_embed_general' );
	if ( $options[ 'widgets' ] == 1 ) { add_filter( 'widget_text', 'do_shortcode', SHORTCODE_PRIORITY ); }
}

/**
* Plugin initialisation
*
* Loads the plugin's translated strings and the plugins' JavaScript
*
* @since	2.5.5
*/

function aye_plugin_init() {

	$language_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages/';

	load_plugin_textdomain( 'youtube-embed', false, $language_dir );

}

add_action( 'init', 'aye_plugin_init' );

/**
* Add scripts to theme
*
* Add styles and scripts to the main theme
*
* @since		2.4
*/

function aye_main_scripts() {

	wp_register_style( 'aye_dynamic', plugins_url( '/youtube-embed/css/aye-main.min.css' ) );

	wp_enqueue_style( 'aye_dynamic' );

}

add_action( 'wp_enqueue_scripts', 'aye_main_scripts' );

/**
* Add CSS to admin
*
* Add stylesheets to the admin screens
*
* @since	2.0
*/

function aye_admin_css() {

	global $wp_version;
	if ( ( float ) $wp_version >= 3.2 ) { $version = ''; } else { $version = '-3.1'; }

	wp_enqueue_style( 'tinymce_button', plugins_url() . '/youtube-embed/css/aye-admin' . $version . '.min.css' );

}

add_action( 'admin_print_styles', 'aye_admin_css' );
?>