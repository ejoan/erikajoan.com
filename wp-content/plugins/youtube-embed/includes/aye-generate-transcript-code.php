<?php
/**
* Create Transcript
*
* All functions relating to creating YouTube transcripts
*
* @package	Artiss-YouTube-Embed
* @since	2.0
*/

/**
* Get YouTube Transcript
*
* Generate re-encoded YouTube transcript
*
* @since	2.0
*
* @uses     aye_extract_id              Extract the ID
* @uses		aye_get_file			    Get a file
* @uses     aye_set_general_defaults    Set default options
* @uses     aye_validate_id             Validate the ID
*
* @param	string	$id			        Video ID
* @return	string	$output		        Transcript output
*/

function aye_generate_transcript( $id ) {

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

	// Get general options
	$general = aye_set_general_defaults();

	// Check to see if cache is available
	if ( $general[ 'transcript_cache' ] != 0 ) {
		$cache_key = 'aye_transcript_'.$id;
		$output = get_transient( $cache_key );
		if ( $output !== false) { return $output; }
	}

	// Get transcript file
	$return = aye_get_file( 'http://video.google.com/timedtext?lang=en&v=' . $id );
	$xml = $return[ 'file' ];
	$output = '';

	// If transcript file exists, strip and output
	if ( $return[ 'rc' ] == 0 ) {
		$output = "<!-- YouTube Embed v" . youtube_embed_version . " | http://www.artiss.co.uk/youtube-embed -->\n";
		$pos = 0;
		$eof = false;

		while ( !$eof ) {
			$text_start = strpos( $xml, '<text ',$pos );
			if ( $text_start !== false ) {

				// Extract the start time
				$start_start = strpos( $xml, 'start="', $text_start ) + 7;
				$start_end = strpos( $xml, '"', $start_start ) - 1;
				$start = substr( $xml, $start_start, $start_end - $start_start + 1 );

				// Convert time format
				$start = str_pad( floor( $start ), 3, '0', STR_PAD_LEFT );
				$start = substr( $start, 0, -2 ) . ':' . substr( $start, -2, 2 );

				// Now extract the text
				$text_start = strpos( $xml, '>', $text_start ) + 1;
				$text_end = strpos( $xml, '</text>', $text_start ) - 1;
				$text = substr( $xml, $text_start, $text_end - $text_start + 1 );

				// Now return the output
				$output .= "<div class=\"Transcript\"><span class=\"TranscriptTime\">" . $start . "</span> <span class=\"TranscriptText\">" . htmlspecialchars_decode( $text ) . "</span></div>\n";
				$pos = $text_end + 7;
			} else {
				$eof = true;
			}
		}
		$output .= "<!-- End of YouTube Embed code -->\n";
	}

	// Save the cache
	if ( $general[ 'transcript_cache' ] != 0 ) { set_transient( $cache_key, $output, 3600 * $general[ 'transcript_cache' ] );	}

	return $output;
}
?>