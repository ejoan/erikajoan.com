<?php
/**
* Admin Bar
*
* Set up Admin Bar links
*
* @package	Artiss-YouTube-Embed
*/

/**
* Add option to Admin Bar (WP 3.1 - 3.3)
*
* Add link to YouTube Embed profile options to Admin Bar. This will only appear
* if the user can edit plugins
* With help from http://technerdia.com/1140_wordpress-admin-bar.html
*
* @uses     aye_set_general_default     Set default options
*
* @since	2.0
*/

function aye_admin_bar_render_3_1() {

	global $wp_version;

	if ( current_user_can( 'delete_plugins' ) && ( ( float ) $wp_version >= 3.1 ) && ( ( float ) $wp_version < 3.3 ) )  {

		$options = aye_set_general_defaults();

		if ( $options[ 'admin_bar' ] != '' ) {

			global $wp_admin_bar;
			$wp_admin_bar -> add_menu( array(
				'parent' => 'appearance',
				'id' => 'aye-options',
				'title' => __( 'YouTube Embed', 'youtube-embed' ),
				'href' => admin_url( 'admin.php?page=aye-profile-options' ),
				'meta' => false ) );
		}
	}
}

add_action( 'wp_before_admin_bar_render', 'aye_admin_bar_render_3_1' );

/**
* Add option to Admin Bar (WP 3.3+)
*
* Add link to YouTube Embed profile options to Admin Bar.
* With help from http://technerdia.com/1140_wordpress-admin-bar.html
*
* @uses     aye_set_general_default     Set default options
*
* @since	2.5
*/

function aye_admin_bar_render_3_3( $meta = TRUE ) {

	global $wp_version;

	if ( ( float ) $wp_version >= 3.3 ) {

		$options = aye_set_general_defaults();

		$profile_access = $options[ 'profile_access' ];
		$list_access = $options[ 'list_access' ];

		if ( $options[ 'admin_bar' ] != '' ) {

			global $wp_admin_bar;

			if ( !is_user_logged_in() ) { return; }
			if ( !is_admin_bar_showing() ) { return; }

			$wp_admin_bar -> add_menu( array(
				'id' => 'aye-menu',
				'title' => __( 'YouTube Embed', 'youtube-embed' ) ) );

			if ( function_exists( 'wp_readme_parser' ) ) {
				$wp_admin_bar -> add_menu( array(
					'parent' => 'aye-menu',
					'id' => 'aye-readme',
					'title' => __( 'Instructions', 'youtube-embed' ),
					'href' => admin_url( 'admin.php?page=aye-support-instructions' ),
					'meta' => array( 'target' => '_blank' ) ) );
			}

			if ( current_user_can( 'delete_plugins' ) ) {
				$wp_admin_bar -> add_menu( array(
					'parent' => 'aye-menu',
					'id' => 'aye-options',
					'title' => __( 'Options', 'youtube-embed' ),
					'href' => admin_url( 'admin.php?page=aye-general-options' ),
					'meta' => array( 'target' => '_blank' ) ) );
			}

			if ( current_user_can( $profile_access ) ) {
				$wp_admin_bar -> add_menu( array(
					'parent' => 'aye-menu',
					'id' => 'aye-profile',
					'title' => __( 'Profiles', 'youtube-embed' ),
					'href' => admin_url( 'admin.php?page=aye-profile-options' ),
					'meta' => array( 'target' => '_blank' ) ) );
			}

			if ( current_user_can( $list_access ) ) {
				$wp_admin_bar -> add_menu( array(
					'parent' => 'aye-menu',
					'id' => 'aye-lists',
					'title' => __( 'Lists', 'youtube-embed' ),
					'href' => admin_url( 'admin.php?page=aye-list-options' ),
					'meta' => array( 'target' => '_blank' ) ) );
			}
		}
	}
}

add_action( 'admin_bar_menu', 'aye_admin_bar_render_3_3', 40 );
?>