<?php
/**
* Shortcodes
*
* Define the various shortcodes
*
* @package	Artiss-YouTube-Embed
* @since	2.0
*/

/**
* Default Video shortcode
*
* Main [youtube] shortcode to display video
*
* @since	2.0
*
* @uses		aye_video_shortcode			Action the shortcode parameters
*
* @param    string		$paras			Shortcode parameters
* @param	string		$content		Shortcode content
* @return   string						YouTube embed code
*/

function aye_video_shortcode_default( $paras = '', $content = '' ) {
	return do_shortcode( aye_video_shortcode( $paras, $content ) );
}

add_shortcode( 'youtube', 'aye_video_shortcode_default' );

/**
* Alternative Video shortcode 1
*
* 1st alternative shortcode to display video
*
* @since	2.0
*
* @uses		aye_video_shortcode			Action the shortcode parameters
*
* @param    string		$paras			Shortcode parameters
* @param	string		$content		Shortcode content
* @return   string						YouTube embed code
*/

function aye_video_shortcode_alt1( $paras = '', $content = '' ) {
	return do_shortcode( aye_video_shortcode( $paras, $content, '', 1 ) );
}
$shortcode = aye_set_shortcode_option();
if ( $shortcode[ 1 ] != '' ) { add_shortcode( $shortcode[ 1 ], 'aye_video_shortcode_alt1' ); }

/**
* Alternative Video shortcode 2
*
* 2nd alternative shortcode to display video
*
* @since	2.0
*
* @uses		aye_video_shortcode			Action the shortcode parameters
*
* @param    string		$paras			Shortcode parameters
* @param	string		$content		Shortcode content
* @return   string						YouTube embed code
*/

function aye_video_shortcode_alt2( $paras = '', $content = '' ) {
	return do_shortcode( aye_video_shortcode( $paras, $content, '', 2 ) );
}
if ( $shortcode[ 2 ] != '' ) { add_shortcode( $shortcode[ 2 ], 'aye_video_shortcode_alt2' ); }

/**
* Video shortcode
*
* Use shortcode parameters to embed a YouTube video or playlist
*
* @since	2.0
*
* @uses		aye_get_embed_type			Get the embed type
* @uses		aye_set_autohide			Get the autohide parameter
* @uses     aye_set_general_defaults    Set default options
* @uses		aye_generate_youtube_code	Generate the embed code
*
* @param    string		$paras			Shortcode parameters
* @param	string		$content		Shortcode content
* @param	string		$alt_shortcode	The number of the alternative shortcode used
* @return   string						YouTube embed code
*/

function aye_video_shortcode( $paras = '', $content = '', $callback = '', $alt_shortcode = '' ) {

	extract( shortcode_atts( array( 'type' => '', 'width' => '', 'height' => '', 'fullscreen' => '', 'related' => '', 'autoplay' => '', 'loop' => '', 'start' => '', 'info' => '', 'annotation' => '', 'cc' => '', 'style' => '', 'link' => '', 'react' => '', 'stop' => '', 'sweetspot' => '', 'disablekb' => '', 'ratio' => '', 'autohide' => '', 'controls' => '', 'profile' => '', 'embedplus' => '', 'audio' => '', 'id' => '', 'url' => '', 'rel' => '', 'fs' => '', 	'cc_load_policy' => '', 'iv_load_policy' => '', 'showinfo' => '', 'youtubeurl' => '', 'template' => '', 'list' => '', 'hd' => '', 'color' => '', 'theme' => '', 'ssl' => '', 'height' => '', 'width' => '', 'dynamic' => '', 'h' => '', 'w' => '', 'search' => '', 'user' => '' ), $paras ) );

	// If no profile specified and an alternative shortcode used, get that shortcodes default profile

	if ( ( $profile == '' ) && ( $alt_shortcode != '' ) ) {

		// Profile is now blank or 2

		if ( $alt_shortcode == '1' ) { $alt_shortcode = ''; }

		// Get general options

		$options = aye_set_general_defaults();
		$profile = $options[ 'alt_profile' . $alt_shortcode ];
	}

	// If an alternative field is set, use it

	if ( ( $id != '' ) && ( $content == '' ) ) { $content = $id; }
	if ( ( $url != '' ) && ( $content == '' ) ) { $content = $url; }
	if ( ( $youtubeurl != '' ) && ( $content == '' ) ) { $content = $youtubeurl; }

	if ( ( $h != '' ) && ( $height == '' ) ) { $height = $h; }
	if ( ( $w != '' ) && ( $width == '' ) ) { $width = $w; }

	if ( ( $rel != '' ) && ( $related == '' ) ) { $related = $rel;}
	if ( ( $fs != '' ) && ( $fullscreen == '' ) ) { $fullscreen = $fs;}
	if ( ( $cc_load_policy != '' ) && ( $cc == '' ) ) { $cc = $cc_load_policy;}
	if ( ( $iv_load_policy != '' ) && ( $annotation == '' ) ) { $annotation = $iv_load_policy;}
	if ( ( $showinfo != '' ) && ( $info == '' ) ) { $info = $showinfo;}

	// If ID was not passed in the content and the first parameter is set, assume that to be the ID

	if ( ( $content == '' ) && ( $paras[ 0 ] != '' ) ) {
		$content = $paras[ 0 ];
		if  ( (substr( $content, 0, 1 ) == ":" ) or ( substr( $content, 0, 1 ) == "=" ) ) { $content = substr( $content, 1 ); }
		if ( $paras[ 1 ] != '' ) { $width = $paras[ 1 ]; }
		if ( $paras[ 2 ] != '' ) { $height = $paras[ 2 ]; }
	}

	// Get Embed type

	$type = aye_get_embed_type( $type, $embedplus );

	// Set up Autohide parameter

	$autohide = aye_set_autohide( $autohide );

	// Create YouTube code

	$youtube_code = aye_generate_youtube_code( $content, $type, $width, $height, aye_convert( $fullscreen ), aye_convert( $related ), aye_convert( $autoplay ), aye_convert( $loop ), $start, aye_convert( $info ), aye_convert_3( $annotation ), aye_convert( $cc ), $style, aye_convert( $link ), aye_convert( $react ), $stop, aye_convert( $sweetspot ), aye_convert( $disablekb ), $ratio, $autohide, $controls, $profile, $list, aye_convert( $audio ), $template, aye_convert( $hd ), $color, $theme, aye_convert( $ssl ), aye_convert( $dynamic ), aye_convert( $search ), aye_convert( $user ) );

	return do_shortcode( $youtube_code );
}

/**
* Return a thumbnail URL
*
* Shortcode to return the URL for a thumbnail
*
* @since	2.0
*
* @uses		aye_generate_thumbnail_code	Generate the thumbnail code
*
* @param    string		$paras			Shortcode parameters
* @param	string		$content		Shortcode content
* @return   string						YouTube thumbnail code
*/

function aye_thumbnail_sc( $paras = '', $content = '' ) {
	extract( shortcode_atts( array( 'style' => '', 'class' => '', 'rel' => '', 'target' => '', 'width' => '', 'height' => '', 'alt' => '', 'version' => '', 'nolink' => '' ), $paras ) );
	return do_shortcode( aye_generate_thumbnail_code( $content, $style, $class, $rel, $target, $width, $height, $alt, $version, $nolink ) );
}

add_shortcode( 'youtube_thumb', 'aye_thumbnail_sc' );

/**
* Short URL shortcode
*
* Generate a short URL for a YouTube video
*
* @since	2.0
*
* @uses		aye_generate_shorturl_code   Generate the code
*
* @param    string		$paras			Shortcode parameters
* @param	string		$content		Shortcode content
* @return   string						YouTube short URL code
*/

function aye_shorturl_sc( $paras = '', $content = '' ) {
	extract( shortcode_atts( array( 'id' => '' ), $paras ) );
	return do_shortcode( aye_generate_shorturl_code( $id ) );
}

add_shortcode( 'youtube_url', 'aye_shorturl_sc' );

/**
* Download shortcode
*
* Generate a short URL for a YouTube video
*
* @since	2.0
*
* @uses		aye_generate_download_code	Generate the download code
*
* @param    string		$paras			Shortcode parameters
* @param	string		$content		Shortcode content
* @return   string						YouTube download link
*/

function aye_video_download( $paras = '', $content = '' ) {

	extract( shortcode_atts( array( 'id' => '', 'target' => '', 'nofollow' => '' ), $paras ) );

	// Return the URL

	$link = aye_generate_download_code( $id );

	// Now add the HTML to the URL (assuming it's not an error)

	if ( substr( $link, 0, 2 ) != '<p' ) {
		$link = '<a href="' . $link . '"';
		if ( $target != '' ) { $link .= ' target="' . $target . '"'; }
		if ( strtolower( $nofollow ) != 'no' ) { $link .= ' rel="nofollow"'; }
		$link .= '>' . $content . '</a>';
	}

	return do_shortcode( $link );
}

add_shortcode( 'download_video', 'aye_video_download' );

/**
* Transcript Shortcode
*
* Shortcode to return YouTube transcripts
*
* @since	2.0
*
* @uses		aye_generate_transcript		Generate the transcript
*
* @param    string		$paras			Shortcode parameters
* @param	string		$content		Shortcode content
* @return   string						Transcript XHTML
*/

function aye_transcript_sc( $paras = '', $content = '' ) {
	return do_shortcode( aye_generate_transcript( $content ) );
}

add_shortcode( 'transcript', 'aye_transcript_sc' );

/**
* Video Name Shortcode
*
* Shortcode to return the name of a YouTube video
*
* @since	2.0
*
* @uses		aye_extract_id				Extract the video ID
* @uses		aye_validate_id				Get the name and video type
* @uses		aye_error					Return an error
*
* @param    string		$paras			Shortcode parameters
* @param	string		$content		Shortcode content
* @return   string						Video name
*/

function aye_video_name_shortcode( $paras = '', $content = '' ) {

	// Extract the ID if a full URL has been specified

	$id = aye_extract_id( $content );

	// Check what type of video it is and whether it's valid

	$return = aye_validate_id( $id, true );
	if ( !$return[ 'type' ] ) { return aye_error( sprintf( __( 'The YouTube ID of %s is invalid.', 'youtube-embed' ), $id ) ); }
	if ( strlen( $return[ 'type' ] ) != 1 ) { return aye_error( $return[ 'type' ] ); }

	// Return the video title

	return do_shortcode( $return['title'] );
}

add_shortcode( 'youtube_name', 'aye_video_name_shortcode' );
?>