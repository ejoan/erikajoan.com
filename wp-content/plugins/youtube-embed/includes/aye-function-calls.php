<?php
/**
* Function Calls
*
* Various function calls that the user may call directly
*
* @package	Artiss-YouTube-Embed
*/

/**
* Embed a YouTube video
*
* Write out XHTML to embed a YouTube video
*
* @since	2.0
*
* @uses		aye_get_parameters			Extract parameters from input
* @uses		aye_get_embed_type			Work out the correct embed type to use
* @uses		aye_set_autohide				Set correct autohide parameter
* @uses		aye_generate_youtube_code	Generate the YouTube code
*
* @param    string	$content	YouTube video ID
* @param 	string	$paras		List of parameters
* @param	string	$style		Optional CSS
*/

function youtube_video_embed( $content, $paras = '', $style = '' ) {
	$width = aye_get_parameters( $paras, 'width' );
	$height = aye_get_parameters( $paras, 'height' );
	$fullscreen = aye_get_parameters( $paras, 'fullscreen' );
	$related = aye_get_parameters( $paras, 'related' );
	$autoplay = aye_get_parameters( $paras, 'autoplay' );
	$loop = aye_get_parameters( $paras, 'loop' );
	$start = aye_get_parameters( $paras, 'start' );
	$info = aye_get_parameters( $paras, 'info' );
	$annotation = aye_get_parameters( $paras, 'annotation' );
	$cc = aye_get_parameters( $paras, 'cc' );
	$link = aye_get_parameters( $paras, 'link' );
	$react = aye_get_parameters( $paras, 'react' );
	$stop = aye_get_parameters( $paras, 'stop' );
	$sweetspot = aye_get_parameters( $paras, 'sweetspot' );
	$embedplus = aye_get_parameters( $paras, 'embedplus' );
	$disablekb = aye_get_parameters( $paras, 'disablekb' );
	$ratio = aye_get_parameters( $paras, 'ratio' );
	$autohide = aye_get_parameters( $paras, 'autohide' );
	$controls = aye_get_parameters( $paras, 'controls' );
	$type = aye_get_parameters( $paras, 'type' );
	$profile = aye_get_parameters( $paras, 'profile' );
	$list = aye_get_parameters( $paras, 'list' );
	$audio = aye_get_parameters( $paras, 'audio' );
	$template = aye_get_parameters( $paras, 'template' );
	$hd = aye_get_parameters( $paras, 'hd' );
	$color = aye_get_parameters( $paras, 'color' );
	$theme = aye_get_parameters( $paras, 'theme' );
	$https = aye_get_parameters( $paras, 'ssl' );
	$dynamic = aye_get_parameters( $paras, 'dynamic' );
	$search = aye_get_parameters( $paras, 'search' );
	$user = aye_get_parameters( $paras, 'user' );

	// Get Embed type
	$type = aye_get_embed_type( $type, $embedplus );

	// Set up Autohide parameter
	$autohide = aye_set_autohide( $autohide );

	echo aye_generate_youtube_code( $content, $type, $width, $height, aye_convert( $fullscreen ), aye_convert( $related ), aye_convert( $autoplay ), aye_convert( $loop ), $start, aye_convert( $info ), aye_convert_3( $annotation ), aye_convert( $cc ), $style, aye_convert( $link ), aye_convert( $react ), $stop, aye_convert( $sweetspot ), aye_convert( $disablekb ), $ratio, $autohide, $controls, $profile, $list, aye_convert( $audio ), $template, aye_convert( $hd ), $color, $theme, aye_convert( $https ), aye_convert( $dynamic ), aye_convert( $search ), aye_convert( $user ) );
	return;
}

/**
* Display a video thumbnail
*
* Display a thumbnail of a video
*
* @since	2.0
*
* @uses		aye_get_parameters			Extract parameters from a string
* @uses		aye_generate_thumbnail_code	Get the thumbnail code
*
* @param    string		$content		YouTube video ID
* @param    string		$paras			Parameters
* @param    string		$style			CSS information
* @param    string		$alt			Alt text
* @parm     string      $nolink         Whether to add a link or not
*/

function youtube_thumb_embed( $content, $paras = '', $style = '', $alt = '', $nolink = '' ) {

	$class = aye_get_parameters( $paras, 'class' );
	$rel = aye_get_parameters( $paras, 'rel' );
	$target = aye_get_parameters( $paras, 'target' );
	$width = aye_get_parameters( $paras, 'width' );
	$height = aye_get_parameters( $paras, 'height' );
	$version = aye_get_parameters( $paras, 'version' );

	echo aye_generate_thumbnail_code( $content, $style, $class, $rel, $target, $width, $height, $alt, $version, $nolink );

	return;
}

/**
* Return video short URL
*
* Return a short URL for the YouTube video
*
* @since	2.0
*
* @uses		aye_generate_shorturl_code	Display an error
*
* @param    string		$id				YouTube video ID
* @return	string						Download URL
*/

function youtube_short_url( $id ) {
	return aye_generate_shorturl_code( $id );
}

/**
* Get video download URL
*
* Return a URL for the video so that it can be downloaded
*
* @since	2.0
*
* @uses		aye_generate_download_code	Get the download URL
*
* @param    string		$id				YouTube video ID
* @return	string						Download URL
*/

function get_video_download( $id ) {
	return aye_generate_download_code( $id );
}

/**
* Get XML transcript
*
* Return XML formatted YouTube transcript
*
* @since	2.0
*
* @uses		aye_error					Output an error
* @uses		aye_extract_id				Extract a video ID
* @uses		aye_get_file					Get a file
* @uses		aye_validate_id				Check the video ID is valid
*
* @param    string		$id				YouTube video ID
* @return	string						Transcript file in XML format
*/

function get_youtube_transcript_xml ( $id ) {

	// Extract the ID if a full URL has been specified
	$id = aye_extract_id( $id );

	// Check what type of video it is and whether it's valid
	$embed_type = aye_validate_id( $id );
	if ( $embed_type != 'v' ) {
		if ( strlen( $embed_type ) > 1 ) {
			echo aye_error( $embed_type );
		} else {
			echo aye_error( sprintf( __( 'The YouTube ID of %s is invalid.', 'youtube-embed' ), $id ) );
		}
		return;
	}

	// Get transcript file
	$filename = 'http://video.google.com/timedtext?lang=en&v=' . $id;
	$xml = aye_get_file( $filename );

	// Check success and return appropriate output
	if ( $xml[ 'rc' ] > 0 ) {
		echo aye_error( sprintf( __( 'Could not fetch the transcript file %s.', 'youtube-embed' ), $id ) );
		return;
	} else {
		return $xml;
	}
}

/**
* Get transcript
*
* Return XHTML formatted YouTube transcript
*
* @since	2.0
*
* @uses		aye_generate_generatE_transcript		Generate the transcript output
*
* @param    string		$id						YouTube video ID
* @return	string								Transcript file in XHTML format
*/

function get_youtube_transcript( $id ) {
	return aye_generate_transcript( $id );
}

/**
* Get Video Name
*
* Function to return the name of a YouTube video
*
* @since	2.0
*
* @uses		aye_extract_id				Extract the video ID
* @uses		aye_validate_id				Get the name and video type
* @uses		aye_error					Return an error
*
* @param    string		$id				Video ID
* @return   string						Video name
*/

function get_youtube_name( $id ) {

	// Extract the ID if a full URL has been specified
	$id = aye_extract_id( $id );

	// Check what type of video it is and whether it's valid
	$return = aye_validate_id( $id, true );
	$embed_type = $return[ 'type' ];
	if ( strlen( $embed_type ) > 1 ) {
		echo aye_error( $embed_type );
	} else {
		echo aye_error( sprintf( __ ( 'The YouTube ID of %s is invalid.', 'youtube-embed' ), $id ) );
	}

	// Return the video title
	return $return['title'];
}
?>