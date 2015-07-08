<?php
/**
* Generate Download Code
*
* Create code to allow a YouTube video to be downloaded
*
* @package	Artiss-YouTube-Embed
* @since	2.0
*
* @uses		aye_extract_id				Extract an ID from a string
* @uses		aye_validate_id				Confirm the type of video
* @uses		aye_error					Display an error
*
* @param    string	$id					YouTube video ID
* @param 	string	$target				Link target
* @param 	string	$nofollow			Use rel="nofollow" ?
* @param 	string	$text				Text to add link to
* @return	string						URL
*/

function aye_generate_download_code( $id ) {

	if ( $id == '' ) { return aye_error( __ ( 'No YouTube ID was found.', 'youtube-embed' ) ); }

	// Extract the ID if a full URL has been specified
	$id = aye_extract_id( $id );

	// Check what type of video it is and whether it's valid
	$embed_type = aye_validate_id( $id );
	if ( $embed_type != 'v' ) {
		if ( strlen( $embed_type ) > 1 ) {
			return aye_error( $embed_type );
		} else {
			return aye_error( sprintf( __( 'The YouTube ID of %s is invalid.', 'youtube-embed' ), $id ) );
		}
	}

	// Create the link
	return 'http://deturl.com/www.youtube.com/watch?' . $embed_type . '=' . $id;
}
?>