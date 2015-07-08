=== Artiss YouTube Embed ===
Contributors: dartiss
Donate link: http://artiss.co.uk/donate
Tags: admin, annotations, artiss, automatic, editor, embed, embedding, embedplus, flash, flv, google, hd, height, iframe, manage, media, plugin, page, play, playlist, post, profile, responsive, search, sidebar, simple, smart, url, user, valid, video, widget, width, xhtml, youtube, youtuber
Requires at least: 2.9
Tested up to: 3.4.2
Stable tag: 2.6.2

A simple to use method of embedding YouTube videos into your posts and pages but with powerful features for those that need them.

== Description ==

**I'm looking at potentially removing some of the existing features to keep the plugin streamlined - please [vote](http://www.artiss.co.uk/youtube-embed/youtube-embed-features-vote "YouTube Embed Features Vote") on what you'd like me to keep and what you'd be happy for me to jettison!**

Artiss YouTube Embed (formally YouTube Embed) is an incredibly simple, yet powerful, method of embedding YouTube videos into your WordPress site. Options include:

* XHTML and HTML5 compliant - works with all the latest browsers
* Multiple embedding methods available - OBJECT, IFRAME, CHROMELESS and EmbedPlus
* Dynamic video sizing for responsive sites
* Allow users to add videos to comments
* Build your own playlists and play them back however you want
* Automatically generate playlists based on user name or search text
* Create multiple profiles - use them for different videos to get the exact style that you want
* Google compatible metadata is added to the video output - great for SEO!
* Code is cached for maximum performance
* Using a different YouTube plugin? Documentation and tools are provided to help you migrate to Artiss YouTube Embed
* Fully internationalized ready for translations. **If you would like to add a translation to his plugin then please [contact me](http://artiss.co.uk/contact "Contact")**
* Support for Do Not Track
* And much, much more!

It has all the features of other similar plugins - Smart YouTube, for instance. In fact if there's a feature in another YouTube embedding plugin that this doesn't have, let me know - I haven't come across it!

To add a video to a post or page simply use the shortcode `[youtube]video[/youtube]`, where `video` is the ID or URL of the video. Alternatively, you can add one (or more) widgets to your sidebar.

Within the administration area of your blog you will find a new menu named `YouTube` (see screenshot 1). Click on the `Options` sub-menu to set a number of general options. Alternatively click on the `Profiles` sub-menu to set the default options which define the output of your videos - any videos you display (unless overridden by parameters - more on that later) will use the settings from the Profiles screen.

The above should get you started - for more information and advanced options please read the "Other Notes" tab. This also includes details on how to migrate from another embedding plugin to Artiss YouTube Embed.

Although this document contains a lot of information more is available from a series of linked pages, plus as much information as possible is provided on the various administration pages. Whilst on the administration pages, click on the "Help" button in the top right for some useful tips and links. If anything isn't covered and you're unsure of what it does please ask [on the forum](http://www.artiss.co.uk/forum "WordPress Plugins Forum").

Not yet convinced? [See the feature comparison](https://spreadsheets.google.com/spreadsheet/pub?hl=en_GB&hl=en_GB&key=0AqxzQNe7e-NwdF80eUZuNjdtS1J1bWM4VERFVUN6ZHc&single=true&gid=4&output=html "YouTube Embed : Comparison") between this and the top 10 alternative plugins for embedding YouTube videos.

**For help with this plugin, or simply to comment or get in touch, please read the appropriate section in "Other Notes" for details. This plugin, and all support, is supplied for free, but [donations](http://artiss.co.uk/donate "Donate") are always welcome.**

== Advanced embedding options ==

A basic shortcode will embed your video using your default profile settings. However, you may wish to override some of these options on a video-by-video basis - this is done via parameters added to the shortcode.

e.g. `[youtube width=300 height=200]Z_sCoHGIpU0[/youtube]`

Which options are available depends upon the embedding type you're using - you can specify any of them but, depending on the type, they may be ignored. There are 3 types - OBJECT, IFRAME and EmbedPlus. IFRAME is the current YouTube default and will use HTML 5, if available - this makes it ideal for maximum compatibility. However, HTML5 has a number of features that's not available with the standard Flash player.

The following parameters work with all embed types:

* **audio** - yes or no, this will hide the video and display just the toolbar (ideal for audio only playback) if switched on
* **autoplay** - yes or no, should the video automatically start playing?
* **dynamic** - whether to use dynamic sizing or not. When switched on the video will resize when your site does (i.e. responsive). If a video width is supplied this will be the maximum width, otherwise full width will be assumed. Height is ignored and will be worked out automatically.
* **height** - the video height, in pixels
* **list** - if you've specified your own list, use this to select the way the videos should be output. Should be `random` (display videos in a random order), `single` (show just one video, randomly picked from the list) or `order` (show each video in the original order - this is the default)
* **profile** - specify a different default profile (see section on Profiles for further details)
* **ratio** - allows you to define a window ratio - specify just a height or width and the ratio will calculate the missing dimension. Uses the format x:x, e.g. 4:3, 16:9
* **ssl** - Use SSL or not? Basically, if set on the URL will be HTTPS rather than HTTP.
* **start** - a number of seconds from where to start the video playing
* **style** - apply CSS elements directly to the video output
* **template** - specify a template (see section on Templates for further details)
* **type** - which embedding type to use, this can be `embedplus`, `iframe`, `object` or `chromeless`
* **width** - the video width, in pixels

The following parameters will not work with EmbedPlus:

* **autohide** - 0, 1 or 2, this parameter indicates whether the video controls will automatically hide after a video begins playing. The default behaviour, a value of 2, is for the video progress bar to fade out while the player controls (play button, volume control, etc.) remain visible. If this parameter is set to 0, the video progress bar and the video player controls will be visible throughout the video. If this parameter is set to 1, then the video progress bar and the player controls will slide out of view a couple of seconds after the video starts playing. They will only reappear if the user moves her mouse over the video player or presses a key on her keyboard.
* **color** - white or red, the colour of the progress bar (see the FAQ about having a white progress bar with the light theme)
* **controls** - 0, 1 or 2, this decides whether the controls should display and when the Flash will load. A value of 0 will not show the controls but 1 or 2 will. A value of 2 will load Flash once the user initiates playback - otherwise it's loaded straight away.
* **https** - yes or no, whether to use HTTPS for the video
* **info** - yes or no, show video information. If displaying a playlist this will show video thumbnails
* **loop** - yes or no, whether to start the video again once it ends
* **related** - yes or no, show related videos
* **theme** - dark or light, display player controls (like a 'play' button or volume control) within a dark or light control bar

The following parameters will not work with EmbedPlus or if IFRAME uses HTML5:

* **annotation** - yes or no, this determines if annotations are shown
* **cc** - yes or no, decided whether closed captions (subtitles) are displayed
* **disablekb** - yes or no, disable keyboard controls
* **fullscreen** - yes or no, this will add the fullscreen button to the toolbar. This also works with EmbedPlus.
* **link** - yes or no, link video to YouTube
* **search** - yes or no, create a playlist based on a search word. The search word should be specified instead of a video ID. See "Automatically Generate Playlists" option for more details
* **user** - yes or no, create a playlist based on a user's uploads. The search word should be specified instead of a video ID. See "Automatically Generate Playlists" option for more details

The following parameters will not work if IFRAME uses HTML5:

* **stop** - this stops the video at a specific time, given in seconds

The following parameters are only for use with EmbedPlus:

* **hd** - play the video in HD quality, if available
* **react** - yes or no, this specified whether you wish to show the Real-time Reactions button
* **sweetspot** - yes or no, this will find sweet spots for the next/prev buttons

== Alternative Shortcodes ==

Within administration, selecting `Options` from the `YouTube` menu will provide a list of general options. One section is named `Alternative Shortcodes` and allows you to specify 1 or 2 additional shortcodes - these will work exactly the same as the standard shortcode of `[youtube]`.

There are 2 reasons why you might want to do this...

1. If migrating from another plugin, it may use a different shortcode - more details can be found in the section named "Migration"
2. If another plugin uses the same shortcode (e.g. Jetpack) this will allow you to specify and use an alternative

Each of the new shortcodes can also have their own default profile assigned to them (see the Profiles section for more details on this).

== Function Call ==

As well as a shortcode you can also use a PHP function call to display a video (e.g. in a sidebar). The function is named `youtube_video_embed` and has 2 parameters - the first is the video ID (or URL) and the second is a list of display parameters. The display parameters are the same as those used in the shortcode but are separated by an ampersand.

e.g. `youtube_video_embed( 'Z_sCoHGIpU0', 'width=300&height=200' )`

== Widgets ==

Sidebar widgets can be easily added. In Administration simply click on the `Widgets` option under the `Appearance` menu. `YouTube Embed` will be one of the listed widgets. Drag it to the appropriate sidebar on the right hand side and then choose your video options - any that aren't specified are taken from your default profile.

If you wish to display an automatically generated playlist based on user name or search term, simply change the "ID Type" appropriately and then specify the name or search word(s) where the video ID would normally be entered.

And that's it! You can use unlimited widgets, so you can add different videos to different sidebars.

== Playlists ==

YouTube allows users to create their own playlists - collections of videos that can be played in sequence.

Before version 2 of Artiss YouTube Embed, separate shortcodes and function calls had to be used to specify these. However, now you can simply specify their ID or URL with the standard methods.

e.g. `[youtube]095393D5B42B2266[/youtube]`

Playlists cannot be used along with the EmbedPlus embedding method.

A better alternative to playlists is the build-in lists function in Artiss YouTube Embed - see the Lists section for further details.

== Templates ==

Both in the profile and as a parameter you can specify a template. This allows you to define any CSS that you wish to "wrap" around the YouTube output.

The template consists simply of any HTML that you wish but with `%video%` where you wish the video to appear.

e.g. `<div align="center">%video%</div>`

Be wary that when adding template via a parameter that any HTML included may cause your video to have `<pre>` tags wrapped around it. The easiest way to check and fix this is to view any post in the HTML editor and remove any PRE tags that have been added.

== Profiles ==

You've probably already had a look at the default profile, accessible by selecting `Profiles` from the `YouTube` administration menu option. Here you can specify the default option which will apply to any embedded video.

However, in the top right hand corner is a drop-down box and a button marked `Change profile`. Simply select an alternative profile and click the button and you can then edit the options for this alternative profile. You can even name it as well.

To use this profile, simply use the parameter `profile=` followed by the profile name or number. The options for this profile will then be used.

This could be useful, for instance, for having a separate profile for different parts of your site - posts, sidebar, etc - or for different video types (e.g. widescreen).

By default you have 5 extra profiles - if you wish to have more (or less) this number can be changed from the `Options` sub-menu.

== Lists ==

Although this plugin will play standard YouTube playlists their playback options are limited. Instead you can create your own video lists. Under the `YouTube` administration menu is a sub-menu named `Lists`. Select this and you will be shown a screen where you can type in a list of video IDs (or URLS). You can also provide a name for the list.

When saving the list each video is validated.

As with profiles you can select the list from a drop down in the top right-hand corner. You can also change the number of lists from the `Options` sub-menu too.

To use a list, simply specify the list name or number instead of a video ID.

e.g. `[youtube]List 1[/youtube]`

There is also a parameter, named `list`, that lets you modify the playback of the list. You can either play each in turn, play them randomly, or have just one played (but picked randomly).

== Transcripts ==

Some YouTube videos include transcripts - this is a text output of the speech from the video with timings added. These are available in XML format and can, via a function call or shortcode, be displayed in your post.

The shortcode `transcript` will display the transcript in your post along with the start time for each line. Simply supply the video ID as a parameter.

e.g. `[transcript]MSPsrhCPt-0[/transcript]`

If no transcript exists, nothing will be output.

For style purposes, the `SPAN` around the time has a class of `TranscriptTime`, the `SPAN` around the text has a class of `TranscriptText` and the `DIV` around the whole transcript output has a class of `Transcript`.

If you wish to use a PHP function call to get the transcript, then you would use the format `get_youtube_transcript( ID )`, where ID is the video ID.

In all of these cases, the original XML format has been changed to a readable output. If, though, you'd like to return the original XML format, then you can use the call `get_youtube_transcript_xml( ID )`.

== Automatically Generate Playlists ==

YouTube now includes options to automatically generate playlists based upon a user name or a search name.

To use, simply use the `user` or `search` parameter to switch the appropriate option on. Then, instead of a video ID or URL, you should specify either the user name or search word(s).

== Migration ==

Within administration, selecting `Options` from the `YouTube` menu will provide a list of general options. One section is named `Migration`. There are 2 boxes that can be ticked to activate 2 different types of alternative embedding - these have been provided to allow easy migration from other similar plugins. You can also assign a specific profile to these migrated options.

The first option, `Bracket Embedding`, allows YouTube IDs to be assigned within brackets - similar to shortcodes but without the actual shortcode name. e.g. `[http://www.youtube.com/watch?v=Z_sCoHGIpU0]`.

The second option, `Alternative Embedding`, activates a short of other alternative embedding methods.

In both cases, activating these will impact performance so should only be used if absolutely necessary.

[Read more details](http://www.artiss.co.uk/youtube-embed/compatibility "Artiss YouTube Embed Compatibility") on which options to select for which plugin.

== Further options ==

**Thumbnails**

Artiss YouTube embed also has the ability to return a thumbnail of a video (sorry, this doesn't work with playlists). There are two methods you can use for this - a shortcode or a function call.

Use the function call `youtube_thumb_embed( 'id', 'paras', '', 'alt', 'nolink' )` to add a thumbnail to any part of your theme.

Like the video embed equivalent, the `id` is the video ID and `alt` is the alternative text for the thumbnail image (optional). `nolink`, if set to `true`, will output the thumbnail without a link to the YouTube video, allowing you to add your own.

The parameters are different, however, but, again, are separated by ampersand.

The parameters are as follows...

* **rel** - specify a REL override, e.g. rel="nofollow"
* **target** - specify a TARGET override, e.g. target="_blank"
* **width** - this specifies the width of the thumbnail image
* **height** - this specifies the height of the thumbnail image
* **version** - which version of the thumbnail to use. This can be `default`, `hq` (for a high quality version of the default image), `start`, `middle` or `end`. The latter 3 indicate where from the video the thumbnails are taken from

e.g. `youtube_thumb_embed( 'id', 'rel=nofollow&target=_blank', '', 'Demo Video' )`

To use the shortcode method, insert `[youtube_thumb]id[/youtube_thumb]` into a post or page to create a thumbnail of the relevant video ID which, once clicked, will open up the appropriate YouTube page.

Like the function call above, you can specify a number of parameters. They are the same as detailed above but with the addition of one further parameter...

* **alt** - specify some `ALT` text for the thumbnail image

e.g. `[youtube_thumb target="_blank" alt="Demo video"]id[/youtube_thumb]`

This overrides the `TARGET` and `ALT` elements of the thumbnail.

You can also use `nolink` as a parameter with the shortcode, which works in the same way as with the function call.

**Video name**

You can retrieve the name of a video via 1 of 2 methods.

You can call the PHP function `get_youtube_name`, passing it to the video URL or ID - this will return the name of the video.

e.g. `echo get_youtube_name( 'Z_sCoHGIpU0' );`

Alternatively, you can use the shortcode `[youtube_name]`, again passing the video URL or ID. The video name will be displayed.

e.g. `[youtube_name]Z_sCoHGIpU0[/youtube_name]`

**Shortened URL**

You may return a short URL for any YouTube video by way of either a function call or a shortcode.

For a function call add `youtube_short_url( 'id' )` to your code to return a URL (note that this is not written out, but returned as a value), where `id` is the video ID.

e.g. `<a href="<?php echo youtube_short_url( 'Z_sCoHGIpU0' ); ?>"Click here for video</a>`

This will create a link to a video using the short URL standard.

To use the shortcode method simply insert `[youtube_url id=xx]` anywhere within a post to return a shortened URL. `xx` is the ID of the video.

**Download URL**

If you wish your users to be able to download a YouTube video or playlist then you can do this via either a shortcode of PHP function call.

The function call is named `get_video_download` and has one parameter - the video ID. It will return the download link URL.

e.g. `<a href="<?php echo get_video_download( 'Z_sCoHGIpU0' ); ?>">Download the video</a>`

Alternatively, you can use the shortcode `download_video`. The content to link is specified between the open and close shortcode tags and there are 3 parameters...

* **id** - The ID of the video or playlist. This is required.
* **target** - The target of the link (e.g. `_blank`). This is optional.
* **nofollow** - yes or no, use this to specify whether a `nofollow` tag should be added to the link. This is optional and by default it will be included.

e.g. `[download_video id="Z_sCoHGIpU0" target="_blank"]Download the video[/download_video]`

**Caching**

Caches are used to improve plugin performance. Under the `YouTube` administration menu is a sub-menu named `Options`. Select this and find the section named `Performance`. From here there are 3 cache options...

1. Embed Cache - this is how long to store the resulting cache code. It will update if you change any parameters so, theoretically, shouldn't need to change. It defaults to 24 hours.
2. Video Information Cache - video IDs are checked with YouTube to ensure that they're valid. This option lets you to specify how often this should be checked. This defaults to 1 hour.
3. Transcript Cache - how long to store transcripts. Defaults to 24 hours.

In all cases putting the cache to 0 will switch off caching for that option.

**Further Embedding Options**

Under the `YouTube` administration menu is a sub-menu named `Options`. Select this and find the section named `Embedding`. There are 3 options here...

1. Add Metadata - by default, RDFa metadata is added to video output. This can be switched on or off as required (see the FAQs for more information about metadata usage).
2. Comment Embedding - tick this to allow YouTube URLs added to comments to be converted to embedded videos.
3. Feed - videos will not appear in feeds so use this option to decide whether you want them to be converted to links and/or thumbnails.

In the case of URL and Comment embedding a profile can be selected.

== Licence ==

This WordPress plugin is licensed under the [GPLv2 (or later)](http://wordpress.org/about/gpl/ "GNU General Public License").

== Support ==

All of my plugins are supported via [my website](http://www.artiss.co.uk "Artiss.co.uk").

Please feel free to visit the site for plugin updates and development news - either visit the site regularly or [follow me on Twitter](http://www.twitter.com/artiss_tech "Artiss.co.uk on Twitter") (@artiss_tech).

For problems, suggestions or enhancements for this plugin, there is [a dedicated page](http://www.artiss.co.uk/youtube-embed "Artiss YouTube Embed") and [a forum](http://www.artiss.co.uk/forum "WordPress Plugins Forum"). The dedicated page will also list any known issues and planned enhancements.

**This plugin, and all support, is supplied for free, but [donations](http://artiss.co.uk/donate "Donate") are always welcome.**

== Reviews & Mentions ==

[Your YouTube Plugin is fantastic…it just saved my life on this site. Thank you!](https://twitter.com/AaronWatters/status/237957701605404672?uid=16257815&iid=am-130280753913455685118891763&nid=4+248 "Twitter - Aaron Watters") - Sonic Clamp.

[New Technology Finds The Most Buzzed-About Parts Of Videos](http://www.socialtimes.com/2011/03/new-technology-finds-the-most-buzzed-about-parts-of-videos-interview/ "New Technology Finds The Most Buzzed-About Parts Of Videos") - SocialTimes.

[Andesch tips on WordPress plugins!](http://andershagstrom.se/andesch-tipsar-om-wordpress-plugins/ "Andesch tipsar om WordPress-plugins!") - Anders.

[Critical Mass](http://www.bikinginmemphis.com/2011/03/26/critical-mass/ "Critical Mass") - Biking in Memphis.

[Embedding YouTube Videos In Your WordPress Theme](http://frogenyozurt.com/2011/04/embedding-youtube-videos-in-your-wordpress-theme/ "Embedding YouTube Videos In Your WordPress Theme") - FrogenYozurt.Com.

== Installation ==

1. Upload the entire `youtube-embed` folder to your wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. If you're updating from version 2.0.1 or before, please read the FAQ on backwards compatibility.
4. That's it, you're done - you just need to add the shortcode wherever you need.

== Frequently Asked Questions ==

= How do I find the ID of a YouTube video? =

If you play a YouTube video, look at the URL - it will probably look something like this - `http://www.youtube.com/watch?v=L5Y4qzc_JTg`.

The video ID is the list of letters and numbers after `v=`, in this case `L5Y4qzc_JTg`.

= Why can't I change the player colour as I used to? =

Artiss YouTube Embed is now using the latest version of the YouTube Player, named AS3. This does not allow for the player colour to be modified, and a few other options are now missing as well.

Equally, some options are not supported depending on whether you use the IFRAME or OBJECT embedding method.

[Read more about which options are supported](http://www.artiss.co.uk/youtube-embed/further-help#ye-api "API Support").

= How do I add a border to the video =

The border option is no longer available with the YouTube player. However, you can use the `style` option to mimic it. Simply add a style of `border: 10px solid #b1b1b1`.

= When trying to display a video it says "An error occurred accessing the YouTube API" =

This has been reported by a number of users - for some reason some people are unable to access the YouTube API, which is used by this plugin to determine the video type and whether it's valid or not. If you are one of them then simply go to the `Options` screen within the `YouTube Embed` administration menu and, near the bottom, there is an option to stop reporting API errors.

If you switch off API errors then the plugin will simply assume all IDs are valid and work out the type from the ID length (which is not set, so if this changes in future it may cause problems!).

I have requested further information on why these errors may be occurring from the YouTube forum but, as yet, I've had no response. [Click here](http://groups.google.com/group/youtube-api-gdata/browse_thread/thread/764f2f2a3b5863f8?hl=en "YouTube APIs Developer Forum") if you wish to track the request.

= I've upgraded from an earlier version of Artiss YouTube Embed and one of the functions / shortcodes / parameters that I used is no longer documented =

Code created for previous versions of the plugin should still work - however, the functions will not be documented to deter people from using them in the future.

= So if I upgrade to this from an earlier version is it compatible? =

It should be, yes, but with one exception.

If you have upgraded from version 2.0.1 or before and used the `style` parameter then it may cause some problems. This is because the `style` parameter now affects the CSS of the video. Before, it added a DIV "wrapper" around the video and applied the styles to this.

Therefore, if you used the `style` parameter to centre a video this probably doesn't now work. However, you can do this now by using the `template` parameter instead - please read the section on that for further help.

However, with the change to the way the `style` works you can now apply more direct styling to the video - e.g. adding a border.

= Is the generated code standards compliant? =

In all cases, yes. However, it depends on which options you choose as to which DOCTYPE it will validate to.

IFRAME does not work with XHTML so will only validate as XHTML transitional (this includes if you use IFRAME as the fallback to EmbedPlus).

If you include Metadata then you must use the XHTML Strict + RDFa DOCTYPE - in this case it validates.

If you don't include Metadata then it will also validate as HTML5 compliant.

The [W3C Markup Validation Service](http://validator.w3.org/ "W3C Markup Validation Service") was used to test the above.

You can [read more about this here](http://www.artiss.co.uk/youtube-embed/further-help#ye-standards "Standards Compliance").

= Which browsers does the output work on? =

It uses standard OBJECT and IFRAME coding - this, along with the above standards compliance, means that the output should work on most browsers.

= The video output is overlapping or stuttering =

If you go into the Profile screen in Administration there is a "Window Mode" option. This defines how Flash output interacts with any other around it. "Window" is the default and gives good performance but may cause overlapping. If overlapping is causing an issue try "Opaque".

= No video is showing =

If you find no video is showing but there's no error either check the source code of the page. Can you find the text "<!--YouTube Error: bad URL entered-->" in the page? If so, you have Jetpack installed and that is displaying the video instead.

There are two ways around this.

First, you could disable all the shortcodes in Jetpack - Jetpack allows you to deactivate certain "modules" of the plugin and, if you can live without the other extra shortcodes, deactivating the shortcodes part will restore functionality back to YouTube Embed

Alternatively, you can use a secondary shortcode - [youtube_video]. Use this instead of [youtube] and YouTube Embed will render the results without a problem

This second suggestion will work for any plugin that may use the same shortcode.

= There used to be an option to allow the plugin to work with YouTube URLs. Where did it go? =

WordPress will, by default, convert YouTube URLs to videos using a very basic default configuration. Earlier versions of this plugin had an option to override this so this plugin would output the results instead (giving you full control of the output). Unfortunately, it stopped working and I do not have enough knowledge on the required WordPress code to work out how to fix it. Rather than leave broken code in place I have removed it.

If you wish to have full control over your YouTube output I would suggest placing all YouTube URLs within [youtube] shortcodes.

= My OPTIONS table seems to be full of cache entries for YouTube Embed =

Cache issues with past versions of the plugin may mean that cache entries have been left behind. The Options menu in YouTube Embed administration now has an additional option in the performance section named "Clear Cache". Simply tick this box and click on the "Save Settings" button to clear out any cache.

Next to the option it will display how many videos have cache in the database. If this is vastly more than the number of videos on your site it may be necessary to clear the cache down. If you find you keep having to do this please [let me know](http://www.artiss.co.uk/forum "WordPress Plugins Forum").

Please note - clearing the cache will not just remove any redundant cache as there is no way to identify what is required and what is not. It will therefore remove all cache related to YouTube Embed, therefore having a temporary performance impact on your site as displayed videos are generated and cached again.

= Is this plugin compatible with Turn Off The Lights? =

If you display the video responsively then it doesn't work with [Turn Off The Lights](http://www.stefanvd.net/project/turnoffthelights.htm "Turn Off The Lights"). Switch this option off and it will.

I've raised this with the developer of Turn Off The Lights and he is going to implement a change in the future to improve compatibility with responsive video.

= Which version of PHP does this plugin work with? =

It has been syntax checked as PHP 4. However, this does not guarantee PHP 4 compatibility and the minimum for WordPress is now PHP 5.2.4.

Although I attempt to keep with PHP 4 compatibility there are no guarantees of this.

== Screenshots ==

1. Artiss YouTube Embed in the administration menu
2. The main options screen
3. The profiles screen
4. The lists screen - videos have been added and validated. The drop-down help is also shown
5. The default widget options
6. The default visual editor options with the YouTube Embed button

== Changelog ==

= 2.6.2 =
* Bug: Fixed bug in uninstall routine
* Enhancement: Replaced user of print_r in cache key generator with serialize, as this can cause problems with some hosting configurations

= 2.6.1 =
* Bug: Fixed minimised script that adds editor button
* Bug: Updated broken advert links
* Bug: Fixed link in admin bar when using WP 3.1 - 3.3
* Bug: Removed un-necessary cookie update that was causing errors in some situations
* Maintenance: Updated WP 3.3+ admin bar options to correctly reflect permissions, naming and ordering of equivalent admin menu

= 2.6 =
* Bug: Fixed a bug that means videos have zero width on new installations until the default profile is updated (thanks to Aidan from [Noise Republic](http://www.noiserepublic.co.uk "Noise Republic") for reporting that)
* Bug: Corrected URLs pointing to help screens at artiss.co.uk
* Bug: Resolved issue where translated IDs were not corrected if included in a URL (thanks to kchayka for reporting that)
* Bug: Fixed problem where video ID is not found in full URL if not specified first (thanks to christopherw for reporting that)
* Bug: Modest branding profile switch wasn't doing anything - the option was hard-coded on. Now corrected
* Bug: User defined error message now decodes correctly (thanks to kchayka for reporting that)
* Bug: No longer caches the video output if a random playlist has been selected
* Maintenance: Updated advertisement engine code
* Maintenance: Renamed README menu to Instructions
* Maintenance: Assorted on-screen wording improvements
* Maintenance: Removed title option as it's un-supported
* Maintenance: Updated the uninstall routine
* Maintenance: Cleaned code and updated translation files
* Enhancement: Added Do Not Track compatibility. Once active, if user has Do Not Track in use then cookies will not be stored
* Enhancement: New option to specify the shortcode that the editor button uses. A cookie is used to store this
* Enhancement: New option to switch on shortcodes in widgets. This will allow all shortcodes in widgets, though, not just those for this plugin
* Enhancement: Reviewed and updated access right to admin screen. Added option to choose what level has access to profiles and/or lists screen
* Enhancement: Many functions were only activated if user was not in Administration screens. However, using AJAX on your site triggers the administration flag and, hence, the functions would not work. Changed this
* Enhancement: Added option to modify access to Profile and Lists screen
* Enhancement: Improved the cache clearing option and statistics
* Enhancement: Reflected on profile screen that modest branding now works with HTML5 player
* Enhancement: Added option to thumbnail output to suppress the link, so that you can add your own
* Enhancement: Updated "Controls" option to support new third parameter and update definitions. Ensured backwards compatibility with old parameter options

= 2.5.6 =
* Maintenance: Restricted access to Options and Profiles screen to administrators
* Bug: Fixed bug which caused errors to be generated on new installations of plugin
* Enhancement: Set a default width if the `content_width` global variable is set to zero

= 2.5.5 =
* Maintenance: Updated sponsorship - now includes option to switch off if user has donated
* Maintenance: Updated options screen to reflect the fact that the `related` and `color` parameters are now supported by the HTML5 player
* Maintenance: Updated options screen to show that the `info` parameter, if used alongside a playlist will show thumbnails of the videos
* Maintenance: Removed redundant GA code, which was never used
* Maintenance: Combined scripts
* Bug: Fixed internationalisation
* Bug: Fixed output of video information on the Lists option screen
* Bug: Modified cache key so that length does not exceed MySQL field maximum
* Bug: Added close anchor for media meta - causes unclosed anchor under IE9 (thanks to Marcel Bootsman for identifying this)
* Bug: Responsive video was not working on a demonstration video in Profile screen

= 2.5.4 =
* Bug: Fixed bug that prevented some fields in options screens to not save

= 2.5.3 =
* Bug: Fixed further issues with the widget code (thanks to Rose-Anne Constantineau for reporting it and helping me test the result)
* Maintenance: Improved some of the internationalisation texts
* Maintenance: Neatened up some of the code output

= 2.5.2 =
* Bug: Fixed a bug where widgets weren't showing single videos (thanks to Josh Callaghan for reporting this)

= 2.5.1 =
* Bug: Fixed a bug with Admin Bar when using WP 3.1 - 3.3 (thanks to Carl D'Halluin for finding this)

= 2.5 =
* Maintenance: Updated code to work with new playlist options
* Maintenance: Removed embedded URL option due to issues with existing code (see FAQ for details)
* Maintenance: Added further FAQs based on common forum queries
* Maintenance: Wording on options screens changed to better identify differences between players
* Maintenance: Added advertisement to profile screen
* Maintenance: Modified demonstration video and made sponsorship request more visible
* Maintenance: Changes the YouTube admin screen icon
* Enhancement: Download link now uses deturl.com
* Enhancement: Admin Bar link improved in WP 3.3 onwards
* Enhancement: New user upload and search features added
* Enhancement: Now supports ability to specify the time to stop video playback
* Enhancement: Default windowing mode changed to improve performance
* Enhancement: FRAMEBORDER is switchable for the purpose of HTML5 compatibility
* Enhancement: Added internationalisation
* Enhancement: README in admin menu now shows the corresponding README for the version of the plugin you have installed, rather than the latest one
* Enhancement: Added option to admin screen to clear video cache (see FAQ for details)
* Enhancement: Allow recursive shortcodes - that is, shortcodes within the YouTube shortcode
* Bug: Fixed bug in retrieving the video title
* Bug: Resolved various debug messages
* Bug: Fixed bug in MCE button JavaScript

= 2.4.1 =
* Maintenance: Removed dashboard widget

= 2.4 =
* Maintenance: Re-sequenced the changelog in the README
* Maintenance: Removed drop shadow option
* Maintenance: Re-design of widgets, reducing number of parameters down to make it easier to use - use profiles to modify missing parameters
* Maintenance: Updated YouTube icons
* Enhancement: Added frameborder="0" to IFRAME code
* Enhancement: Added Privacy-Enhanced mode. Doesn't work with Chromeless player.
* Enhancement: Added `title` option, so you can name the video
* Enhancement: Added `ssl` option, allowing you to override whether HTTP or HTTPS is used for the video
* Enhancement: Added `dynamic` option (and matching Profile switch) to allow users to request dynamically resizing video (responsive). Additional option to allow specified width to be maximum
* Enhancement: Made `modestbranding` a switchable option (switchable in profile options but not on video-by-video basis) due to issues with Apple devices
* Enhancement: Improved matching of URL embedded into post
* Enhancement: If you have the [README Parser plugin](http://wordpress.org/extend/plugins/wp-readme-parser/ "README Parser") installed then a new sub-menu will display the README instructions
* Enhancement: Use WP 3.3 Feature Pointer to highlight new menu when plugin is activated
* Bug: Ensure `showinfo` parameter is set correctly
* Bug: If width or height is missing from Profile screen then fill it in based on widescreen format. Otherwise, causes video to break
* Bug: Video information was being fetched from caching even if option selected to switch it off. Fixed!

= 2.3.1 =
* Maintenance: Removed the sponsorship

= 2.3 =
* Enhancement: Editor button will add text between shortcodes if no URL or ID is specified
* Enhancement: Square brackets are stripped from alternative shortcodes on option screen - text added to warn against this too
* Enhancement: Added Chromeless player option
* Enhancement: Increased maximum output length of profile and list names to 30 characters
* Bug: Fixed incorrect listing of long profile or list names
* Bug: Fixed INCLUDE bug in widgets.php

= 2.2 =
* Maintenance: Updated dashboard widget to latest version
* Maintenance: Added advertising banners to options screen - these can be turned off if you donate
* Enhancement: Replace WP_PLUGIN_URL with plugins_url()
* Enhancement: Added H and W as alternative shortcode parameters to HEIGHT and WIDTH
* Enhancement: Editor button should appear for anyone from editor role upwards
* Enhancement: Removed maximum length from profile and list names. However, only first 20 characters will appear in lists

= 2.1 =
* Enhancement: New option to switch API options (where HTTP or HTTPS, display messages or not or even switch off)
* Enhancement: Output video playback errors as XHTML comments. Output to post a generic message which can be changed in the options
* Enhancement: Video information is shown in lists screen when first entering (no need to press Save button to display)
* Enhancement: Added new `color` parameter, which allows you to specify the colour of the progress bar
* Enhancement: Added new `theme` parameter, allowing you to specify if the player is dark or light skinned
* Enhancement: Added new `https` parameter, allowing you to use HTTPS instead of HTTP for the video display
* Enhancement: Added new `version` parameter to thumbnails, allowing different versions (including a high resolution one) to be displayed
* Enhancement: Added new administration option to allow the thumbnail used in RSS feeds to be specified
* Enhancement: Log the current plugin version into the database. This may be of use in future upgrades to detect which version the user is upgrading from
* Bug: Fixed video title no longer being fetched since 2.0.3 (because of using v2 of API)
* Bug: Fixed some error output - due to changes made in an earlier release some errors would not display

= 2.0.4 =
* Enhancement: Removed HTTPS access to gdata API - will add a switchable option for this in a later release

= 2.0.3 =
* Enhancement: Decode any passed `template` parameters, as WP may have encoded the content first
* Enhancement: Improved file handling
* Enhancement: Now using HTTPS and version 2 of YouTube gdata API
* Enhancement: New general option to switch off reporting of API errors - will simply accept ID and work out type
* Maintenance: Added details to the README to cover issues with `style` backwards compatibility and YouTube API

= 2.0.2 =
* Enhancement: Strip tags from video ID, in case any have crept in
* Enhancement: Tidied some of the widget controls
* Enhancement: You can now specify YouTube short URLs as video IDs
* Bug: Removed reference to jscolor.js script, which isn't used
* Bug: Video IDs beginning with numbers are being confused with list numbers
* Bug: Corrected problem with random single videos being picked from a list
* Bug: Fixed problem with list where one video was being ignored and another repeated
* Bug: Modified widget code to allow for all states to be allowable. Defaults updated
* Bug: YouTube documentation states that if you don't specify the fullscreen parameter it will default to off. It doesn't. Corrected in the code

= 2.0.1 =
* Enhancement: Changed cache key encoding so that it was compatible with PHP 4
* Enhancement: Added autoplay option to EmbedPlus
* Enhancement: Re-instated `style` option, allowing you to apply a direct set of CSS elements to the output - a requirement if you wish to add a border to the video, for instance
* Maintenance: Updated screens and documentation to show the `start` parameter works with EmbedPlus
* Bug: Fixed incorrect caching of options - was only changing if override parameters were modified
* Bug: Video Information Cache will no longer reset to zero if the Embed cache is greater
* Bug: Added random ID to EmbedPlus output to resolve a bug that can affect IE users

= 2.0 =
* Maintenance: Renamed to Artiss YouTube Embed from YouTube Embed
* Maintenance: Major re-write, using new coding standards
* Maintenance: AS3 player is now used, AS2 has been retired
* Maintenance: Compliancy and browser checked - XHTML and HTML5 compliant and works in all the latest browsers
* Maintenance: README completely re-written, contextual help added to admin screens and links to further information
* Enhancement: New administration screens, introducing multiple profiles and playlists
* Enhancement: Both OBJECT and IFRAME versions can be selected
* Enhancement: Migration options added, allowing compatibility with other similar plugins
* Enhancement: Can now specify full video URL as well as video ID
* Enhancement: No need to use separate shortcode for playlists, as they are automatically detected. Video IDs are also now validated
* Enhancement: Options to allow YouTube URLs not within shortcodes to be accepted, as well as in comments
* Enhancement: RDFa metadata added to code output
* Enhancement: Caching of code and ID checking to improve performance
* Enhancement: Templating system replaces CSS specification
* Enhancement: Improved editor button and link added to admin bar
* Enhancement: Many, many more changes - too many to list!

= 1.5 =
* Enhancement: Added clone of 'youtube' shortcode, called 'youtube_video'
* Enhancement: Editor now has YouTube button, which inserts the YouTube shortcode (this can be switched off in the options screen)
* Enhancement: Added new option to disable keyboard controls
* Enhancement: Added option to supply a ratio, in case height or width are not supplied - the missing parameter will then be calculated
* Enhancement: Option to create a download link (for video and playlist) using function call or shortcode
* Enhancement: You can now change on the options screen which set of parameters the demonstration video uses (i.e. "normal" or EmbedPlus). This allows you to try your options on a different video type without switching to it.

= 1.4.2 =
* Enhancement: Added keyboard disable option
* Bug: Fixed bug which meant that people upgrading from previous versions may not be able to display video until they've been to the options screen and re-saved their default options

= 1.4.1 =
* Enhancement: HD option is available with EmbedPlus - updated the admin and widget screen to reflect this

= 1.4 =
* Maintenance: Tidied up code
* Enhancement: Now supports multiple widgets - widget code completely re-written
* Enhancement: Support for EmbedPlus added
* Enhancement: Added option to suppress links back to YouTube
* Enhancement: Added functions and shortcodes for returning and outputting available transcripts

= 1.3.1 =
* Enhancement: New widget option to specify title

= 1.3 =
* Enhancement: Added transparency option so that videos won't cover up layers

= 1.2 =
* Enhancement: Minor changes to the XHTML code to prevent warnings from certain validators

= 1.1 =
* Maintenance: Updated test video on options screen, as previous one had been removed
* Maintenance: Confirmed WP 3.0 compatibility
* Enhancement: Resulting XHTML code is better formatted, with comments identifying code location

= 1.0 =
* Initial release

== Upgrade Notice ==

= 2.6.2 =
* Update to fix an uninstaller bug and a problem that may affect some hosts

= 2.6.1 =
* Update to fix some bugs introduced in 2.6

= 2.6 =
* Upgrade to implement numerous bug fixes and enhancements

= 2.5.6 =
* Upgrade to fix critical bug for new installations

= 2.5.5 =
* Upgrade for various bug fixes and maintenance updates

= 2.5.4 =
* Upgrade to fix an issue with options not updating

= 2.5.3 =
* Upgrade to fix issues with widgets

= 2.5.2 =
* Upgrade if you use widgets to display videos

= 2.5.1 =
* Upgrade if you are using a WordPress version before 3.3

= 2.5 =
* Upgrade to add a number of new features (including automatic generation of playlists based on user name or search term) and fix some bugs

= 2.4.1 =
* Upgrade to remove the dashboard widget

= 2.4 =
* Numerous improvements, including new option for responsive video output

= 2.3.1 =
* Upgrade to remove the sponsorship

= 2.3 =
* Assorted bug fixes and minor improvements. Also added Chromeless player.

= 2.2 =
* Assorted minor improvements

= 2.1 =
* New options to change player colours, chose your thumbnails and control API usage

= 2.0.4 =
* Fixed SSL bug by removing HTTPS access to API

= 2.0.3 =
* Removed secure API access as this was causing some users issues

= 2.0.2 =
* Further update to fix a few minor bugs found in 2.0. A few small enhancements have also been made

= 2.0.1 =
* Update to fix a few minor bugs found in 2.0 and add a couple of small enhancements

= 2.0 =
* Upgrade to take advantage of many new features. Code completely re-written

= 1.5 =
* Upgrade to add a number of new options including video size ratios, disabling keyboard controls, an editor button and different demonstration video options on the admin screen

= 1.4.2 =
* Upgrade is you upgraded to version 1.4 or 1.4.1 from a previous version, to fix an important bug

= 1.4.1 =
* Upgrade to make a small correction to the parameter lists

= 1.4 =
* Update to add EmbedPlus, multi-widgets and transcript output capabilities

= 1.3.1 =
* Update if you wish to change the widget heading

= 1.3 =
* Update if you find that the videos are covering up layers

= 1.2 =
* Update to ensure no warnings are reported by XHTML validators

= 1.1 =
* Update to get the test video on the options screen working again!

= 1.0 =
* Initial release