<?php
/**
* Generate video short URL
*
* Create a short URL to a YouTube video
*
* @package	Artiss-YouTube-Embed
* @since	2.0
*
* @uses		aye_extract_id				Extract an ID from a string
* @uses		aye_validate_id				Confirm the type of video
* @uses		aye_error					Display an error
*
* @param    string	$id					YouTube video ID
* @return	string	$youtube_code		Code
*/

function aye_generate_shorturl_code( $id ) {

	// Check that an ID has been specified
	if ( $id == '' ) {
		return aye_error( __( 'No video ID has been supplied', 'youtube-embed' ) );
	} else {

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

		return 'http://youtu.be/' . $id;
	}
}
?>