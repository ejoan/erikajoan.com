<?php
/*
Plugin Name: Artiss YouTube Embed
Plugin URI: http://www.artiss.co.uk/youtube-embed
Description: Embed YouTube Videos in WordPress
Version: 2.6.2
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

/**
* YouTube Embed
*
* Main code - include various functions
*
* @package	Artiss-YouTube-Embed
* @since	2.0
*/

define( 'youtube_embed_version', '2.6.2' );

$functions_dir = WP_PLUGIN_DIR . '/youtube-embed/includes/';

// Include all the various functions

include_once( $functions_dir . 'aye-add-scripts.php' );     				// Add various scripts

include_once( $functions_dir . 'aye-shared-functions.php' );				// Shared routines

include_once( $functions_dir . 'aye-set-defaults.php' );					// Set default options

include_once( $functions_dir . 'aye-add-to-admin-bar.php' );				// Add link to the admin bar

include_once( $functions_dir . 'aye-function-calls.php' );					// Function calls

include_once( $functions_dir . 'aye-generate-embed-code.php' );				// Generate YouTube embed code

include_once( $functions_dir . 'aye-generate-download-code.php' );			// Generate download URLs

include_once( $functions_dir . 'aye-generate-shorturl-code.php' );			// Generate short URLs

include_once( $functions_dir . 'aye-generate-thumbnail-code.php' );			// Generate thumbnail code

include_once( $functions_dir . 'aye-generate-transcript-code.php' );		// Generate transcripts

if ( is_admin() ) {

	if ( !function_exists( 'artiss_plugin_ads' ) ) {

		include_once( $functions_dir . 'artiss-plugin-ads.php' );           // Option screen ads

	}

	include_once( $functions_dir . 'aye-admin-config.php' );				// Administration configuration

	include_once( $functions_dir . 'aye-add-mce-button.php' );				// Editor button

} else {

	include_once( $functions_dir . 'aye-update-post-content.php' );			// Process post content

	include_once( $functions_dir . 'aye-shortcodes.php' );					// Shortcodes

	include_once( $functions_dir . 'aye-deprecated.php' );					// Deprecated options
}

include_once($functions_dir . 'aye-generate-widgets.php');                  // Generate widgets

?>