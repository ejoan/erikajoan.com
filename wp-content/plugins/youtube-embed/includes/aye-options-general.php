<?php
/**
* General Options Page
*
* Screen for generic options
*
* @package	Artiss-YouTube-Embed
* @since	2.0
*/

?>
<div class="wrap" style="width: 1010px;">
<div class="icon32"><img src="<?php echo plugins_url(); ?>/youtube-embed/images/screen_icon.png" alt="" title="" height="32px" width="32px"/><br /></div>
<h2><?php _e( 'Artiss YouTube Embed Options', 'youtube-embed' ); ?></h2>

<?php

// If options have been updated on screen, update the database

if ( ( !empty( $_POST ) ) && ( check_admin_referer( 'youtube-embed-general', 'youtube_embed_general_nonce' ) ) ) {

	$options[ 'donated' ] = $_POST[ 'youtube_embed_donated' ];
	$options[ 'editor_button' ] = $_POST[ 'youtube_embed_editor_button' ];
	$options[ 'admin_bar' ]	= $_POST[ 'youtube_embed_admin_bar' ];
	$options[ 'profile_no' ] = $_POST[ 'youtube_embed_profile_no' ];

	// If the number of profiles is less than zero, put it to 0

	if ( $options[ 'profile_no' ] < 0 ) { $options[ 'profile_no' ] = 0; }

	$options[ 'list_no' ] = $_POST[ 'youtube_embed_list_no' ];

	// If the number of lists is less than 1, put it to 1

	if ( $options[ 'list_no' ] < 1 ) { $options[ 'list_no' ] = 1; }

	$options[ 'embed_cache' ] = $_POST[ 'youtube_embed_embed_cache' ];
	$options[ 'info_cache' ] = $_POST[ 'youtube_embed_info_cache' ];
	$options[ 'transcript_cache' ] = $_POST[ 'youtube_embed_transcript_cache' ];
	$options[ 'fetch_title' ] = $_POST[ 'youtube_embed_fetch_title' ];
	$options[ 'alt_profile' ] = $_POST[ 'youtube_embed_alt_profile' ];
	$options[ 'alt_profile2' ] = $_POST[ 'youtube_embed_alt_profile2' ];
	$options[ 'bracket' ] = $_POST[ 'youtube_embed_bracket' ];
	$options[ 'alt' ] = $_POST[ 'youtube_embed_alt' ];
	$options[ 'other_profile' ] = $_POST[ 'youtube_embed_other_profile' ];
	$options[ 'comments' ] = $_POST[ 'youtube_embed_comments' ];
	$options[ 'comments_profile' ] = $_POST[ 'youtube_embed_comments_profile' ];
	$options[ 'metadata' ] = $_POST[ 'youtube_embed_metadata' ];
	$options[ 'feed' ] = $_POST[ 'youtube_embed_feed' ];
	$options[ 'api' ] = $_POST[ 'youtube_embed_api' ];
	$options[ 'error_message' ] = str_replace( '\"', '"', $_POST[ 'youtube_embed_error_message' ] );
	$options[ 'thumbnail' ] = $_POST[ 'youtube_embed_thumbnail' ];
	$options[ 'privacy' ] = $_POST[ 'youtube_embed_privacy' ];
	$options[ 'frameborder' ] = $_POST[ 'youtube_embed_frameborder' ];
	$options[ 'widgets' ] = $_POST[ 'youtube_embed_widgets' ];
	$options[ 'profile_access' ] = $_POST[ 'youtube_embed_profile_access' ];
	$options[ 'list_access' ] = $_POST[ 'youtube_embed_list_access' ];

	// Update the options

	update_option( 'youtube_embed_general', $options );
	$update_message = __( 'Settings Saved.', 'youtube-embed' );

	// Update the alternative shortcodes

	$shortcode[ 1 ] = $_POST[ 'youtube_embed_shortcode' ];
	$shortcode[ 1 ] = trim( $shortcode[ 1 ], '[]' );

	$shortcode[ 2 ] = $_POST[ 'youtube_embed_shortcode2' ];
	$shortcode[ 2 ] = trim( $shortcode[ 2 ], '[]' );

	update_option( 'youtube_embed_shortcode', $shortcode );

	// Update the editor button shortcode, including the cookie

	update_option( 'youtube_embed_editor_sc', $_POST[ 'youtube_embed_editor_sc' ] );

	$expiry = 2147483647; // January 2038 (maximum value to avoid the integer overflow of the 2038 bug)
	setcookie( 'aye_mce_shortcode', $_POST[ 'youtube_embed_editor_sc' ], $expiry, aye_get_cookie_path() );

	// If the option to clear the cache has been ticked run an SQL to clear them down

	if ( !empty( $_POST[ 'youtube_embed_clear_cache' ] ) ) {
		global $wpdb;
		$wpdb -> query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%ye_video_%' OR option_name LIKE '_transient_%ye_type_%' OR option_name LIKE '_transient_%ye_title_%'" );
		$update_message .= ' ' . __( 'Cache cleared.', 'youtube-embed' );
	}

	echo '<div class="updated fade"><p><strong>' . $update_message . "</strong></p></div>\n";
}

// Get options

$options = aye_set_general_defaults();
$shortcode = aye_set_shortcode_option();
$url = aye_set_url_option();
$editor_sc = aye_set_editor_sc();

// Display ads

if ( $options[ 'donated'] != 1 ) { artiss_plugin_ads( 'youtube-embed', 990 ); }
?>

<div class="updated fade"><p>Have you voted for which features of YouTube Embed you'd like to retain in version 3? <a href="http://www.artiss.co.uk/youtube-embed/youtube-embed-features-vote" target="_new">Click here</a> to vote!</p></div>

<p><?php _e( 'These are the general settings for Artiss YouTube Embed. Please select <a href="admin.php?page=aye-profile-options">Profiles</a> for default embedding settings.', 'youtube-embed' ); ?></p>

<form method="post" action="<?php echo get_bloginfo( 'wpurl' ).'/wp-admin/admin.php?page=aye-general-options' ?>">

<table class="form-table">

<tr>
<th scope="row"><?php _e( 'Remove Adverts', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_donated" value="1"<?php if ( $options[ 'donated' ] == "1" ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( "If you've <a href=\"http://www.artiss.co.uk/donate\">donated</a>, tick here to remove the adverts from these administration screens", 'youtube-embed' ); ?></span></td>
</tr>

</table></br>

<span class="yt_heading"><?php _e( 'Embedding', 'youtube-embed' ); ?></span>

<table class="form-table">
<tr>
<th scope="row"><?php _e( 'Add Metadata', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_metadata" value="1"<?php if ( $options[ 'metadata' ] == "1" ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( 'Allow rich metadata to be added to code. <a href="http://www.artiss.co.uk/youtube-embed/further-help#ye-metadata">Learn more</a>', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Comment Embedding', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_comments" value="1"<?php if ( $options[ 'comments' ] == "1" ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( 'Allow YouTube URLs in comments - will display as embedded videos. <a href="http://www.artiss.co.uk/youtube-embed/further-help#ye-comments">Learn more</a>', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'Profile to use', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_comments_profile">
<?php aye_generate_profile_list( $options[ 'comments_profile' ], $options[ 'profile_no' ] ) ?>
</select></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Feed', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_feed">
<option value="t"<?php if ( $options[ 'feed' ] == "t" ) { echo " selected='selected'"; } ?>><?php _e ( 'Text link', 'youtube-embed' ); ?></option>
<option value="v"<?php if ( $options[ 'feed' ] == "v" ) { echo " selected='selected'"; } ?>><?php _e ( 'Thumbnail', 'youtube-embed' ); ?></option>
<option value="b"<?php if ( $options[ 'feed' ] == "b" ) { echo " selected='selected'"; } ?>><?php _e ( 'Thumbnail &amp; Text Link', 'youtube-embed' ); ?></option>
</select>&nbsp;<span class="description"><?php _e( 'Videos cannot be embedded in feeds. Select how you wish them to be shown instead', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'Thumbnail to use', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_thumbnail">
<option value="default"<?php if ( $options[ 'thumbnail' ] == "default" ) { echo " selected='selected'"; } ?>><?php _e ( 'Default', 'youtube-embed' ); ?></option>
<option value="hqdefault"<?php if ( $options[ 'thumbnail' ] == "hqdefault" ) { echo " selected='selected'"; } ?>><?php _e ( 'Default (HQ)', 'youtube-embed' ); ?></option>
<option value="1"<?php if ( $options[ 'thumbnail' ] == "1" ) { echo " selected='selected'"; } ?>><?php _e ( 'Start', 'youtube-embed' ); ?></option>
<option value="2"<?php if ( $options[ 'thumbnail' ] == "2" ) { echo " selected='selected'"; } ?>><?php _e ( 'Middle', 'youtube-embed' ); ?></option>
<option value="3"<?php if ( $options[ 'thumbnail' ] == "3" ) { echo " selected='selected'"; } ?>><?php _e ( 'End', 'youtube-embed' ); ?></option>
</select>&nbsp;<span class="description"><?php _e( 'Which thumbnail to use', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Allow shortcodes in widgets', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_widgets" value="1"<?php if ( $options[ 'widgets' ] == "1" ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( 'Allow shortcodes to be used in widgets - this will apply to <strong>all</strong> widgets', 'youtube-embed' ); ?></span></td>
</tr>
</table>

<br/><span class="yt_heading"><?php _e( 'Alternative Shortcodes', 'youtube-embed' ); ?></span><br/><br/><?php _e( 'Specify up to 2 alternative shortcodes to compliment the standard <code>youtube</code> shortcode. <strong>NB: These should be specified without the surrounding square brackets.</strong>', 'youtube-embed' ); ?>

<table class="form-table">
<tr>
<th scope="row"><?php _e( 'Alternative Shortcode 1', 'youtube-embed' ); ?></th>
<td><input type="text" size="30" name="youtube_embed_shortcode" value="<?php echo $shortcode[ 1 ]; ?>"/></td>
</tr>

<tr>
<th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'Profile to use', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_alt_profile">
<?php aye_generate_profile_list( $options[ 'alt_profile' ], $options[ 'profile_no' ] ) ?>
</select></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Alternative Shortcode 2', 'youtube-embed' ); ?></th>
<td><input type="text" size="30" name="youtube_embed_shortcode2" value="<?php echo $shortcode[ 2 ]; ?>"/></td>
</tr>

<tr>
<th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'Profile to use', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_alt_profile2">
<?php aye_generate_profile_list( $options[ 'alt_profile2' ], $options[ 'profile_no' ] ) ?>
</select></td>
</tr>
</table>

<br/><span class="yt_heading"><?php _e( 'Migration', 'youtube-embed' ); ?></span><br/><br/><?php _e( 'Switch on compatibility with other embedding plugins. For more details on migrating from another plugin, please <a href="http://www.artiss.co.uk/youtube-embed/compatibility">click here</a>.', 'youtube-embed' ); ?>

<table class="form-table">
<tr>
<th scope="row"><?php _e( 'Bracket Embedding', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_bracket" value="1"<?php if ( $options[ 'bracket' ] == "1" ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( 'Allow embedding using URLs within brackets. Activating impacts performance', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Alternative Embedding', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_alt" value="1"<?php if ( $options[ 'alt' ] == "1" ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( 'Allow all other types of embedding. Activating impacts performance', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'Profile to use', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_other_profile">
<?php aye_generate_profile_list( $options[ 'other_profile' ], $options[ 'profile_no' ] ) ?>
</select>&nbsp;<span class="description"><?php _e( 'For above 2 options', 'youtube-embed' ); ?></span></td>
</tr>
</table>

<br/><span class="yt_heading"><?php _e( 'Admin Options', 'youtube-embed' ); ?></span>

<table class="form-table">
<tr>
<th scope="row"><?php _e( 'Show Editor Button', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_editor_button" value="1"<?php if ( $options[ 'editor_button' ] == "1" ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( 'Show the YouTube button on the post editor', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Editor Button Shortcode', 'youtube-embed' ); ?></th>
<td><input type="text" size="20" name="youtube_embed_editor_sc" value="<?php echo $editor_sc; ?>"/>&nbsp;<span class="description"><?php _e( 'Shortcode for editor button to use.', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Add to Admin Bar', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_admin_bar" value="1"<?php if ( $options[ 'admin_bar' ] == "1" ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( 'Add link to options screen to Admin Bar', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Profiles Screen Access', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_profile_access">
<option value="delete_plugins"<?php if ( $options[ 'profile_access' ] == "delete_plugins" ) { echo " selected='selected'"; } ?>><?php _e ( 'Administrator', 'youtube-embed' ); ?></option>
<option value="edit_pages"<?php if ( $options[ 'profile_access' ] == "edit_pages" ) { echo " selected='selected'"; } ?>><?php _e ( 'Editor', 'youtube-embed' ); ?></option>
<option value="publish_posts"<?php if ( $options[ 'profile_access' ] == "publish_posts" ) { echo " selected='selected'"; } ?>><?php _e ( 'Author', 'youtube-embed' ); ?></option>
<option value="edit_posts"<?php if ( $options[ 'profile_access' ] == "edit_posts" ) { echo " selected='selected'"; } ?>><?php _e ( 'Contributor', 'youtube-embed' ); ?></option>
</select>&nbsp;<span class="description"><?php _e( 'Specify the user access required for the profiles screen', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Lists Screen Access', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_list_access">
<option value="delete_plugins"<?php if ( $options[ 'list_access' ] == "delete_plugins" ) { echo " selected='selected'"; } ?>><?php _e ( 'Administrator', 'youtube-embed' ); ?></option>
<option value="edit_pages"<?php if ( $options[ 'list_access' ] == "edit_pages" ) { echo " selected='selected'"; } ?>><?php _e ( 'Editor', 'youtube-embed' ); ?></option>
<option value="publish_posts"<?php if ( $options[ 'list_access' ] == "publish_posts" ) { echo " selected='selected'"; } ?>><?php _e ( 'Author', 'youtube-embed' ); ?></option>
<option value="edit_posts"<?php if ( $options[ 'list_access' ] == "edit_posts" ) { echo " selected='selected'"; } ?>><?php _e ( 'Contributor', 'youtube-embed' ); ?></option>
</select>&nbsp;<span class="description"><?php _e( 'Specify the user access required for the lists screen', 'youtube-embed' ); ?></span></td>
</tr>
</table>

<br/><span class="yt_heading"><?php _e( 'Profile &amp; List Sizes', 'youtube-embed' ); ?></span>

<table class="form-table">
<tr>
<th scope="row"><?php _e( 'Number of Profiles', 'youtube-embed' ); ?></th>
<td><input type="text" size="2" maxlength="2" name="youtube_embed_profile_no" value="<?php echo $options[ 'profile_no' ]; ?>"/>&nbsp;<span class="description"><?php _e( 'Maximum number of profiles', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Number of Lists', 'youtube-embed' ); ?></th>
<td><input type="text" size="2" maxlength="2" name="youtube_embed_list_no" value="<?php echo $options[ 'list_no' ]; ?>"/>&nbsp;<span class="description"><?php _e( 'Maximum number of lists', 'youtube-embed' ); ?></span></td>
</tr>
</table>

<br/><span class="yt_heading"><?php _e( 'Performance', 'youtube-embed' ); ?></span>

<table class="form-table">
<tr>
<th scope="row"><?php _e( 'Embed Cache', 'youtube-embed' ); ?></th>
<td><input type="text" size="3" maxlength="3" name="youtube_embed_embed_cache" value="<?php echo $options[ 'embed_cache' ]; ?>"/>&nbsp;<span class="description"><?php _e( 'How many hours to retain embed output. 0 to switch off', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Video Information Cache', 'youtube-embed' ); ?></th>
<td><input type="text" size="3" maxlength="3" name="youtube_embed_info_cache" value="<?php echo $options[ 'info_cache' ]; ?>"/>&nbsp;<span class="description"><?php _e( 'How many hours to retain video information, including it\'s validity.  0 to switch off', 'youtube-embed' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Transcript Cache', 'youtube-embed' ); ?></th>
<td><input type="text" size="3" maxlength="3" name="youtube_embed_transcript_cache" value="<?php echo $options[ 'transcript_cache' ]; ?>"/>&nbsp;<span class="description"><?php _e( 'How many hours to store transcripts for in cache. 0 to switch off', 'youtube-embed' ); ?></span></td>
</tr></table>

<?php
global $wpdb;
$video_cache = $wpdb -> get_var( "SELECT COUNT(*) FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_%ye_video_%'" );
$type_cache = $wpdb -> get_var( "SELECT COUNT(*) FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_%ye_type_%'" );
$title_cache = $wpdb -> get_var( "SELECT COUNT(*) FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_%ye_title_%'" );

echo '<p>' . __( 'You currently have cache for', 'youtube_embed' ) . ' ' . number_format( $video_cache ) . ' video' . ( $video_cache <> 1 ? 's' : '' ) . ', ' . number_format( $type_cache ) . ' video type' . ( $type_cache <> 1 ? 's' : '' ) . ' ' . __( 'and', 'youtube_embed' ) . ' ' . number_format( $title_cache ) . ' title' . ( $title_cache <> 1 ? 's' : '' ) . ".</p>\n";
?>

<table class="form-table"><tr>
<th scope="row"><?php _e( 'Clear Cache', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_clear_cache" value="1">&nbsp;<span class="description"><?php _e( 'Select this option to remove all YouTube Embed cache.', 'youtube-embed' ); ?></span></td>
</tr></table>

<br/><span class="yt_heading"><?php _e( 'YouTube API', 'youtube-embed' ); ?></span>

<p><?php _e( 'The YouTube API is used to validate video IDs and to determine if it is a video or playlist.', 'youtube-embed' ); ?></p>

<table class="form-table">
<tr>
<th scope="row"><?php _e( 'API State', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_api">
<option value="0"<?php if ( $options[ 'api' ] == "0" ) { echo " selected='selected'"; } ?>><?php _e ( 'API should not be used', 'youtube-embed' ); ?></option>
<option value="1"<?php if ( $options[ 'api' ] == "1" ) { echo " selected='selected'"; } ?>><?php _e ( 'HTTP API used and errors are reported', 'youtube-embed' ); ?></option>
<option value="2"<?php if ( $options[ 'api' ] == "2" ) { echo " selected='selected'"; } ?>><?php _e ( 'HTTPS API used and errors are reported', 'youtube-embed' ); ?></option>
<option value="3"<?php if ( $options[ 'api' ] == "3" ) { echo " selected='selected'"; } ?>><?php _e ( 'HTTP API used and no errors are reported', 'youtube-embed' ); ?></option>
<option value="4"<?php if ( $options[ 'api' ] == "4" ) { echo " selected='selected'"; } ?>><?php _e ( 'HTTPS API used and no errors are reported', 'youtube-embed' ); ?></option>
</select></td>
</tr>
</table>

<br/><span class="yt_heading"><?php _e( 'Error Reporting', 'youtube-embed' ); ?></span>

<p><?php _e( 'Playback errors are within the XHTML source code as comments - parameter errors and other types are displayed on the post output.', 'youtube-embed' ); ?></p>

<table class="form-table"><tr>
<th scope="row"><?php _e( 'Video Playback Error Message', 'youtube-embed' ); ?></th>
<td><input type="text" size="60" name="youtube_embed_error_message" value="<?php echo htmlspecialchars( $options[ 'error_message' ] ); ?>"/>&nbsp;<span class="description"><?php _e( 'This is the message that will be shown on the post', 'youtube-embed' ); ?></span></td>
</tr></table>

<br/><span class="yt_heading"><?php _e( 'Security', 'youtube-embed' ); ?></span>

<table class="form-table"><tr>

<tr>
<th scope="row"><?php _e( 'Privacy-Enhanced Mode', 'youtube-embed' ); ?></th>
<td><select name="youtube_embed_privacy">
<option value="0"<?php if ( $options[ 'privacy' ] == "0" ) { echo " selected='selected'"; } ?>><?php _e ( 'Cookies should always be stored', 'youtube-embed' ); ?></option>
<option value="1"<?php if ( $options[ 'privacy' ] == "1" ) { echo " selected='selected'"; } ?>><?php _e ( 'Cookies should never be stored', 'youtube-embed' ); ?></option>
<option value="2"<?php if ( $options[ 'privacy' ] == "2" ) { echo " selected='selected'"; } ?>><?php _e ( "Cookies should be stored based on user's Do Not Track setting", 'youtube-embed' ); ?></option>
</select>&nbsp;<span class="description"><?php _e( 'Read more about <a href="http://donottrack.us/">Do Not Track</a>', 'youtube-embed' ); ?></span></td>
</tr></table>

<br/><span class="yt_heading"><?php _e( 'Compatibility', 'youtube-embed' ); ?></span>

<table class="form-table"><tr>
<th scope="row"><?php _e( 'Allow Frame Border on IFRAME', 'youtube-embed' ); ?></th>
<td><input type="checkbox" name="youtube_embed_frameborder" value="1"<?php if ( $options[ 'frameborder' ] == '1' ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( 'FRAMEBORDER is not HTML5 compliant', 'youtube-embed' ); ?></span></td>
</tr></table>

<?php wp_nonce_field( 'youtube-embed-general','youtube_embed_general_nonce', true, true ); ?>

<p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Settings', 'youtube-embed' ); ?>"/></p>

</form>

</div>