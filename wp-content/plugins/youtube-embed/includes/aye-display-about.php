<?php
/**
* About Page
*
* About the plugin
*
* @package	Artiss-YouTube-Embed
* @since	2.0
*/
?>
<div class="wrap" style="width: 1010px;">
<div class="icon32"><img src="<?php echo plugins_url(); ?>/youtube-embed/images/screen_icon.png" alt="" title="" height="32px" width="32px"/><br /></div>

<h2><?php _e( 'About Artiss YouTube Embed', 'youtube-embed' ); ?></h2>

<?php

// Display ads

$options = aye_set_general_defaults();
if ( $options[ 'donated'] != 1 ) { artiss_plugin_ads( 'youtube-embed', 990 ); }
?>

<div class="updated fade"><p>Have you voted for which features of YouTube Embed you'd like to retain in version 3? <a href="http://www.artiss.co.uk/youtube-embed/youtube-embed-features-vote" target="_new">Click here</a> to vote!</p></div>

<p><?php echo sprintf( __( 'You are using Artiss YouTube Embed version %s. It was written by David Artiss.', 'youtube-embed' ), youtube_embed_version ); ?></p>

<a href="http://www.youtube.com/"><img src="<?php echo plugins_url(); ?>/youtube-embed/images/poweredby.png" alt="<?php _e( 'Powered by YouTube', 'youtube-embed' ); ?>" title="<?php _e( 'Powered by YouTube', 'youtube-embed' ); ?>" align="right" /></a>

<?php

echo '<h3>' . __( 'Copyrights', 'youtube-embed' ) . '</h3>';

echo '<p>' . __( 'YouTube, and all associated logos, is the copyright of Google Inc.', 'youtube-embed' ) . '</p>';

echo '<p>' . __( 'EmbedPlus is copyright. Read the <a href="http://embedplus.com/terms.aspx" target="_blank">Terms &amp; Conditions of Use</a>.', 'youtube-embed' ) . '</p>';

echo '<h3>' . __( 'Acknowledgements', 'youtube-embed' ) . '</h3>';

echo '<p>' . __( 'Images have been compressed with <a href="http://www.smushit.com/ysmush.it/">Smush.it</a>.', 'youtube-embed' ) . '</p>';

echo '<p>' . __( 'JavaScript has been compressed with <a href="http://javascriptcompressor.com/">JavaScript Compressor</a>.', 'youtube-embed' ) . '</p>';

echo '<p>' . __( 'YouTube icons are courtesy of <a href="http://www.youtube.com/t/creators_downloads">YouTube</a>. Other icons are by <a href="http://p.yusukekamiyamane.com/">Yusuke Kamiyamane</a>.', 'youtube-embed' ) . '</p>';

echo '<h3>' . __( 'Support Information', 'youtube-embed' ) . '</h3>';

echo '<p>' . __( 'Useful support information and links can be found by clicking on the Help tab at the top of each of the Artiss YouTube Embed administration screens.', 'youtube-embed' ) . '</p>';

echo '<h4>' . __( 'This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.', 'youtube-embed' ) . '</h4>';

echo '<h3>' . __( 'Stay in Touch', 'youtube-embed' ) . '</h3>';

echo '<p>' . __( '<a href="http://www.artiss.co.uk/wp-plugins">See the full list</a> of Artiss plugins, including beta releases.', 'youtube-embed' ) . '</p>';

echo '<p>' . __( '<a href="http://www.twitter.com/artiss_tech">Follow Artiss.co.uk</a> on Twitter.', 'youtube-embed' ) . '</p>';

echo '<p>' . __( '<a href="http://www.artiss.co.uk/feed">Subscribe</a> to the Artiss.co.uk news feed.', 'youtube-embed' ) . '</p>';

?>
</div>