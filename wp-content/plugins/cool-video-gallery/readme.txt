=== Cool Video Gallery ===
Contributors: Praveen Rajan
Tags: video gallery,playlist,embed,tinymce,videos,gallery,media,player,flash player,flash-player,skins,flash player skins,admin,post,pages,pictures,widgets,picture,video,cool-video-gallery,cool video gallery,ffmpeg,showcase,shadowbox,preview image,upload,flv,mp4,mov,mp3,H.264
Requires at least: 3.0.1
Tested up to: 3.1.1
Stable tag: 1.4

Cool Video Gallery is a Video Gallery plugin for WordPress with option to upload videos and manage them in multiple galleries. 

== Description ==

Cool Video Gallery is a Video Gallery plugin for WordPress with option to upload videos, manage them in multiple galleries and automatic preview image generation for uploaded videos.
Option also provided to upload images for video previews. Supports '.flv', '.mp4', '.mov' and '.mp3' video files presently. 

Support Forum Link:
<a href="http://wordpress.org/tags/cool-video-gallery?forum_id=10">Support Forum</a> 

= Features =
* Supports H.264 (.mp4, .mov), FLV (.flv) and MP3 (.mp3) files.
* Upload videos and manage videos in different galleries.
* Multiple video upload feature available.
* Automatic generation of preview images for videos using FFMPEG installed in webserver.
* Manual upload feature to upload preview image for videos if FFMPEG is not installed.
* Bulk deletion of videos/galleries.
* Option to add title/description for galleries.
* Playback feature for videos uploaded in a popup.
* Option to set width/height, zoom-crop, quality of preview images uploaded and other features available.
* Video player options like skin selection, default volume setting, autoplay feature and many other features available.
* Widgets for Slideshow and Showcase feature available.
* Shortcode feature integration for gallery/video with posts/pages. 
* Feature to scan gallery folders for newly added videos through FTP. 
* Feature to sort videos in a gallery.
* Play all videos in a gallery with navigation enabled in shadowbox popup. 
* Plugin Uninstall feature enabled.
* Google XML Video Sitemap generation feature integrated.
* Option to show single videos in page/post content using embed feature.
* Embed code available for each video embedded. 
* Feature to show embed playlist of a complete gallery.
* TinyMCE integration implemented.
* Option to limit the no. of videos in widgets/showcase/slideshow added.


If you find this plugin useful please provide your valuable ratings.

= Note =
* Video Player used by this plugin is <a href="http://www.longtailvideo.com/players" target="_blank">JW Player</a>. Addons that enhance the features of video player can be found at their repository.
* <a href="http://www.shadowbox-js.com/" target="_blank">Shadowbox</a> is another addon used by this plugin. <a href="http://www.shadowbox-js.com/#license" target="_blank">Commercial licenses</a> are available for those who would like to use this on a commercial website.  

= Check out my other plugin =
* <a href="http://wordpress.org/extend/plugins/attachment-file-icons">Attachment File Icons (AF Icons)</a> - A plugin to display file type icons adjacent to files added to pages/posts/widgets. Feature to upload icons for different file types provided.

== Installation ==

1. Upload `cool-video-gallery` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress.
3. Add a gallery and upload some videos from the admin panel.
4. Use either `CVG Slideshow` or `CVG Showcase` widget to play slideshow of uploaded videos in a gallery. 
5. Go to your post/page and use TinyMCE button for adding videos to page/post content.
6. Inorder to use slideshow and showcase in custom templates created use the function `cvgShowCaseWidget(gid, limit)` and `cvgSlideShowWidget(gid, limit)` (where gid is gallery id and limit is the limit for videos).

== Screenshots ==

1. Screenshot Admin Section - Add Galleries
2. Screenshot Admin Section - Upload Videos 
3. Screenshot Admin Section - Gallery Details
4. Screenshot Admin Section - Sort Videos in Gallery
5. Screenshot Admin Section - Gallery Settings
6. Screenshot Admin Section - Player Settings

== Changelog ==

= 1.4 =
* Embed feature added single video and playlist.
* TinyMCE integration implemented.
* Fix for preview image manipulations.
* Option to limit the no. of videos.

= 1.3 =
* '.mov' and '.mp3' media file supports added.
* Added patch for thumbnail generation.
* Added uninstall option for plugin.
* Added fix for plugin upgrade issue.

= 1.2 =
* Added feature to sort videos in a gallery
* Navigation feature enabled in shadowbox popup to move acrosss videos in current gallery selected.
* Issue with 'jpeg/jpg' extension thumbnail fixed. '.png' image files currently accepted for thumbnail images.

= 1.1 =
* Added feature to scan video gallery folder and add newly added videos through FTP access.
* Shortcode feature added to support video gallery in post/page content.

= 1.0 =
* Initial version