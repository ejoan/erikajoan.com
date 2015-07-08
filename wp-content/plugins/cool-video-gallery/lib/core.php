<?php 
/**
 * Class specifying main functions of video gallery.
 * 
 * @author Praveen Rajan
 *
 */
class CvgCore extends videoDB{
	
	var $default_gallery_path;
	var $winabspath;
	
	/**
	 * Initializes values
	 * @author Praveen Rajan
	 */
	function CvgCore() {
		$cool_video_gallery = new CoolVideoGallery();
		$this->default_gallery_path = $cool_video_gallery->default_gallery_path;
		$this->winabspath = $cool_video_gallery->winabspath;
	}
	
	/**
	 * Function to upload and add gallery.
	 * @author Praveen Rajan
	 */
	function processor(){
		
    	if ($_POST['addgallery']){

    		$newgallery = esc_attr( $_POST['galleryname'] );
    		if(isset($_POST['gallerydesc'])) 
    			$gallery_desc = esc_attr ( $_POST['gallerydesc'] );
			else 
				$gallery_desc = '';
    		if ( !empty($newgallery) )
    			CvgCore::create_gallery($newgallery, $gallery_desc);
    		else
    			CvgCore::show_video_error( __('No valid gallery name!') );
    	}
		if ($_POST['uploadvideo']){
    		if ( $_FILES['videofiles']['error'][0] == 0 ){
    			$messagetext = CvgCore::upload_videos();
    			CvgCore::xml_playlist($galleryID);	
    		}else{
    			CvgCore::show_video_error( __('Upload failed! ' . CvgCore::decode_upload_error( $_FILES['videofiles']['error'][0])) );
    		}	
    	}
	}
	
	/**
	 * Function to create a new gallery & folder
	 * 
	 * @param string $gallerytitle
	 * @param string $defaultpath
	 * @param bool $output if the function should show an error messsage or not
	 * @author Praveen Rajan
	 */
	function create_gallery($gallerytitle, $gallery_desc ,$output = true) {

		global $wpdb, $user_ID;
		
		$defaultpath = $this->default_gallery_path;	
		
		$galleryname = sanitize_file_name( $gallerytitle );
		$video_path = $defaultpath . $galleryname;
		$videoRoot = $this->winabspath . $defaultpath;
		$txt = '';

		if ( empty($galleryname) ) {	
			if ($output) 
				CvgCore::show_video_error( __('No valid gallery name!') );
			return false;
		}
		
		if ( !is_dir($videoRoot) ) {
			if ( !wp_mkdir_p( $videoRoot ) ) {
				$txt  = __('Directory').' <strong>' . $defaultpath . '</strong> '.__('didn\'t exist. Please create first the main gallery folder').'!<br />';
				$txt .= __('Check this link, if you didn\'t know how to set the permission :').' <a href="http://codex.wordpress.org/Changing_File_Permissions">http://codex.wordpress.org/Changing_File_Permissions</a> ';
				if ($output) 
					CvgCore::show_video_error($txt);
				return false;
			}
		}

		if ( !is_writeable( $videoRoot ) ) {
			$txt  = __('Directory').' <strong>' . $defaultpath . '</strong> '.__('is not writeable !').'<br />';
			$txt .= __('Check this link, if you didn\'t know how to set the permission :').' <a href="http://codex.wordpress.org/Changing_File_Permissions">http://codex.wordpress.org/Changing_File_Permissions</a> ';
			if ($output) 
				CvgCore::show_video_error($txt);
			return false;
		}

		if ( !is_dir($this->winabspath . $video_path) ) {
			if ( !wp_mkdir_p ($this->winabspath . $video_path) ) 
				$txt  = __('Unable to create directory').$video_path.'!<br />';
		}
		
		if ( !is_writeable($this->winabspath . $video_path ) ) {
			$txt .= __('Directory').' <strong>'.$video_path.'</strong> '.__('is not writeable !').'<br />';
		}
		
		if ( !is_dir($this->winabspath . $video_path . '/thumbs') ) {				
			if ( !wp_mkdir_p ( $this->winabspath . $video_path . '/thumbs') ) 
				$txt .= __('Unable to create directory').' <strong>' . $video_path . '/thumbs !</strong>';
		}
		
		if ( !empty($txt) ) {
			rmdir($this->winabspath . $video_path . '/thumbs');
			rmdir($this->winabspath . $video_path);
		}
		
		$result = $wpdb->get_var("SELECT name FROM " . $wpdb->prefix . "cvg_gallery WHERE name = '$galleryname' ");
		
		if ($result) {
			if ($output) 
				CvgCore::show_video_error( _n( 'Gallery', 'Galleries', 1 ) .' <strong>\'' . $galleryname . '\'</strong> '.__('already exists'));
			return false;			
		} else { 
			$result = $wpdb->query( $wpdb->prepare("INSERT INTO " . $wpdb->prefix . "cvg_gallery (name, path, title, author, galdesc) VALUES (%s, %s, %s, %s, %s)", $galleryname, $video_path, $gallerytitle , $user_ID, $gallery_desc) );
			if ($result) {
				$message  = __("Gallery '$galleryname' successfully created.<br/>");
				if ($output)
					CvgCore::show_video_message($message); 
			}
			return true;
		} 
	}
	
	/**
	 * Function for uploading of videos via the upload form
	 * 
	 * @return void
	 * @author Praveen Rajan
	 */
	function upload_preview() {
	
		// Videos must be an array
		$imageslist = array();
	
		// get selected gallery
		$videoID = (int) $_POST['TB_previewimage_single'];
	
		if ($videoID == 0) {
			CvgCore::show_video_error(__('Error uploading preview image!'));
			return;	
		}
		
		$video = videoDB::find_video($videoID);
		$video_thumb_name = $video[0]->thumb_filename;
		
		$video_preview = 'thumbs_' . $video[0]->alttext . '_preview.png' ;
		
		$gallery_path = $this->winabspath . $video[0]->path;
		if ( empty($video[0]->path) ){
			CvgCore::show_video_error(__('Failure in database, no gallery path set !'));
			return;
		} 
		
		$videofiles = $_FILES['preview_image'];
		
		if (is_array($videofiles)) {
			foreach ($videofiles['name'] as $key => $value) {
	
				// look only for uploded files
				if ($videofiles['error'][$key] == 0) {
		
					$temp_file = $videofiles['tmp_name'][0];
							
					$temp_file_size = filesize($temp_file);
					$temp_file_size = intval(CvgCore::wp_convert_bytes_to_kb($temp_file_size));
					
					$max_upload_size = CvgCore::get_max_size();
					
					if($temp_file_size > $max_upload_size){
						CvgCore::show_video_error( __('File upload size limit exceeded.'));
						return;
					}
					
					$dest_file = $gallery_path . '/thumbs/' . $video_thumb_name;
				
					if ( !@move_uploaded_file($temp_file, $dest_file) ){
						CvgCore::show_video_error(__('Error, the file could not moved to : ') . $dest_file);
						return;
					}else {
						
						$options = get_option('cvg_settings');
						$thumb_width = $options['cvg_preview_width'];
						$thumb_height = $options['cvg_preview_height'];
						$cv_zc = $options['cvg_zc'];
						$thumb_quality = $options['cvg_preview_quality'];
					
						if($cv_zc == 1)
							$crop = true;
						elseif($cv_zc == 0)
							$crop = false;
								
						$image_details = @getimagesize($dest_file);
						if($image_details[0] > $thumb_width && $image_details[1] > $thumb_height){ 	
							$new_file = image_resize( $dest_file, $thumb_width, $thumb_height, $crop, 'thumbs', NULL, $thumb_quality );
					
							$preview_file = $gallery_path . '/thumbs/' . $video_preview;
							@rename($dest_file, $preview_file); 	
							@rename($new_file, $dest_file);
							CvgCore::chmod ($preview_file); 	
						} 
						
					}
					
					if ( !CvgCore::chmod($dest_file) ) {
						CvgCore::show_video_error(__('Error, the file permissions could not set'));
						return;
					}
				}else {
					CvgCore::show_video_error(CvgCore::decode_upload_error($videofiles['error'][0]));
					return;
				}
			}
		}
		CvgCore::show_video_message( (' Video preview image successfully added'));
		return;
	}
	
	/**
	 * Function for uploading of videos via the upload form
	 * 
	 * @return void
	 * @author Praveen Rajan
	 */
	function upload_videos() {
	
		// Videos must be an array
		$videoslist = array();
	
		// get selected gallery
		$galleryID = (int) $_POST['galleryselect'];
	
		if ($galleryID == 0) {
			CvgCore::show_video_error(__('No gallery selected !'));
			return;	
		}
		
		// get the path to the gallery	
		$gallery = videoDB::find_gallery($galleryID);
		
		if ( empty($gallery->path) ){
			CvgCore::show_video_error(__('Failure in database, no gallery path set !'));
			return;
		} 
	
		// read list of images
		$dirlist = CvgCore::scandir_video_name($gallery->abspath);
		
		$videofiles = $_FILES['videofiles'];
		
		if (is_array($videofiles)) {
			foreach ($videofiles['name'] as $key => $value) {
	
				// look only for uploded files
				if ($videofiles['error'][$key] == 0) {
					
					$temp_file = $videofiles['tmp_name'][$key];
					
					$temp_file_size = filesize($temp_file);
					$temp_file_size = intval(CvgCore::wp_convert_bytes_to_kb($temp_file_size));
					
					$max_upload_size = CvgCore::get_max_size();

					if($temp_file_size > $max_upload_size){
						
						CvgCore::show_video_error( __('File upload size limit exceeded.'));
						continue;
					}
					//clean filename and extract extension
					$filepart = CvgCore::fileinfo( $videofiles['name'][$key] );
					$filename = $filepart['basename'];
					$file_name = $filepart['filename'];
						
					// check for allowed extension and if it's an image file
					$ext = array('mp4', 'flv', 'MP4', 'FLV', 'mov', 'MOV', 'mp3', 'MP3'); 
					if ( !in_array($filepart['extension'], $ext) || !@filesize($temp_file) ){ 
						CvgCore::show_video_error('<strong>' . $videofiles['name'][$key] . ' </strong>' . __('is no valid video file !'));
						continue;
					}
	
					// check if this filename already exist in the folder
					$i = 0;
					
					while ( in_array( $file_name, $dirlist ) ) {
						$i++;
						$filename = $filepart['filename'] . '_' . $i . '.' .$filepart['extension'];
						$file_name = $filepart['filename'] . '_' . $i;
					}
					
					$dest_file = $gallery->abspath . '/' . $filename;
					
					//check for folder permission
					if ( !is_writeable($gallery->abspath) ) {
						$message = sprintf(__('Unable to write to directory %s. Is this directory writable by the server?'), $gallery->abspath);
						CvgCore::show_video_error($message);
						return;				
					}
					
					// save temp file to gallery
					if ( !@move_uploaded_file($temp_file, $dest_file) ){
						CvgCore::show_video_error(__('Error, the file could not moved to : ') . $dest_file);
						continue;
					} 
					if ( !CvgCore::chmod($dest_file) ) {
						CvgCore::show_video_error(__('Error, the file permissions could not set.'));
						continue;
					}
					
					// add to imagelist & dirlist
					$videolist[] = $filename;
					$dirlist[] = $file_name;
				}else {
					
					CvgCore::show_video_error(CvgCore::decode_upload_error($videofiles['error'][0]));
					return;
				}
			}
		}
	
		if (count($videolist) > 0) {
			
			// add videos to database		
			$videos_ids = CvgCore::add_Videos($galleryID, $videolist);
	
			if (CvgCore::ffmpegcommandExists("ffmpeg")) 	{
				foreach($videos_ids as $video_id )
					CvgCore::create_thumbnail_video($video_id);
			}	
			
			CvgCore::show_video_message( count($videos_ids) . __(' Video(s) successfully added.'));
		}
		return;
	}
	
	/**
	 * Function to scan gallery folder for new videos
	 * @param $galleryID - gallery id
	 * @author Praveen Rajan
	 */
	function scan_upload_videos($galleryID){
		
		global $wpdb;
		
		$gallery = videoDB::find_gallery($galleryID);
		$dirlist = CvgCore::scandir_video($gallery->abspath);
		$videolist = array();
		
		foreach($dirlist as $video) {
			$video_newname = sanitize_file_name($video);
			$video_found = $wpdb->get_var("SELECT filename FROM " .  $wpdb->prefix . "cvg_videos  WHERE filename = '$video_newname' AND galleryid = '$galleryID'");
			if(!$video_found) {
				@rename($gallery->abspath . '/' . $video, $gallery->abspath . '/' . $video_newname );
				$videolist[] = $video_newname;
			}	
		}
		
		// add videos to database		
		$videos_ids = CvgCore::add_Videos($galleryID, $videolist);

		if (CvgCore::ffmpegcommandExists("ffmpeg")) 	{
			foreach($videos_ids as $video_id )
				CvgCore::create_thumbnail_video($video_id);
		}	
		if(count($videos_ids)> 0)
			CvgCore::show_video_message( count($videos_ids) . __(' Video(s) successfully added.'));
		else 
			CvgCore::show_video_error( __(' No new video(s) found.'));	
	}
	
	/**
	 * Add videos to database
	 * 
	 * @param int $galleryID
	 * @param array $videolist
	 * @return array $video_ids Id's which are sucessful added
	 * @author Praveen Rajan
	 */
	function add_Videos($galleryID, $videolist) {
		
		global $wpdb;
	
		$video_ids = array();
		
		if ( is_array($videolist) ) {
			foreach($videolist as $video) {
				
				// strip off the extension of the filename
				$path_parts = pathinfo( $video );
				$alttext = ( !isset($path_parts['filename']) ) ? substr($path_parts['basename'], 0,strpos($path_parts['basename'], '.')) : $path_parts['filename'];
				$time_updated = current_time('mysql', 1);
				
				$thumb_filename = 'thumbs_' . $alttext . '.png';
				
				// save it to the database 
				$result = $wpdb->query( $wpdb->prepare("INSERT INTO " . $wpdb->prefix ."cvg_videos (galleryid, filename, thumb_filename, alttext, description, videodate) VALUES (%s, %s, %s, %s, %s, %s)", $galleryID, $video, $thumb_filename, $alttext, $alttext, $time_updated) );
				// and give me the new id
				$vid_id = (int) $wpdb->insert_id;
				
				if ($result) 
					$video_ids[] = $vid_id;
	
			} 
		} // is_array
	        
		return $video_ids;
	}
	
	
	/**
	 * Function to generate xml for video playlist
	 * 
	 * @author Praveen Rajan
	 */
	function xml_playlist($galleryID = null) {
		
		global $wpdb;
		
		$gallery_detail = videoDB::find_gallery($galleryID);
		$gallery_details = videoDB::get_gallery($galleryID);

		$xml .= '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<rss version="2.0" xmlns:jwplayer="http://developer.longtailvideo.com/trac/" xmlns:media="http://search.yahoo.com/mrss/">'; 
		$xml .= '<channel>';
		$xml .= '<title>'. $gallery_detail->galdesc . '</title>';
		
		foreach($gallery_details as $video){
			
			$video_url = site_url()  . '/' . $video->path . '/' . $video->filename;
			$thumb_url = site_url() . '/' . $video->path . '/thumbs/' . $video->thumb_filename;
			$preview_url = site_url() . '/' . $video->path . '/thumbs/thumbs_' . $video->alttext . '_preview.png';
			
			if(!file_exists(ABSPATH . '/' . $video->path . '/thumbs/' . $video->thumb_filename ))
				$thumb_url  = WP_CONTENT_URL .  '/plugins/' . dirname(dirname( plugin_basename(__FILE__))) . '/images/default_video.png';

			if(!file_exists(ABSPATH . '/' . $video->path . '/thumbs/thumbs_' . $video->alttext . '_preview.png' )) 	
				$preview_url = WP_CONTENT_URL .  '/plugins/' . dirname(dirname( plugin_basename(__FILE__))) . '/images/default_video.png';	
				
			$desc = $video->description;
			$pub_date = $video->videodate;
			$title = $video->alttext;
			
			$xml .= '<item>';
			$xml .= '<title>' . $title . '</title>';
			$xml .= '<pubDate>' . $pub_date . '</pubDate>';
			$xml .= '<description>' . $desc . '</description>';
			$xml .= '<media:content url="' . $video_url . '" />';
			$xml .= '<media:thumbnail url="' . $preview_url . '" />';
			$xml .= '<jwplayer:playlist.image>' . $thumb_url . '</jwplayer:playlist.image>';
			$xml .= '</item>';
		}
		$xml .= '</channel></rss>';
		
		$gallery_name = $gallery_detail->name;
		
		$playlist_xml = ABSPATH . '/' . $gallery_detail->path . '/' . $gallery_name . '-playlist.xml';
	  	 if(CvgCore::createFile($playlist_xml)) {
			if (file_put_contents ($playlist_xml, $xml)) {
				CvgCore::chmod ($playlist_xml);
				return true;
			}
	   }	
	}
	
	/**
	 * Function to create a preview thumbnail for video
	 * 
	 * @param object | int $video contain all information about the video or the id
	 * @return string result code
	 * @author Praveen Rajan
	 */
	function create_thumbnail_video($video) {
	
		$options = get_option('cvg_settings');
		$thumb_width = $options['cvg_preview_width'];
		$thumb_height = $options['cvg_preview_height'];
				
		if (is_numeric ( $video ))
			$video = videoDB::find_video ( $video );
			
		$video = $video[0];
		
		if ( !is_object($video) ) 
			return __('Object didn\'t contain correct data');
			
		$filepart = CvgCore::fileinfo( $video->filename );
			
		// check for allowed extension and if it's an image file
		$ext = array('mp4', 'flv', 'MP4', 'FLV', 'mov', 'MOV'); 
		if ( !in_array($filepart['extension'], $ext) ){ 
			return;
		}
		$video_input = $this->winabspath . $video->path . '/' . $video->filename;
		$new_target_filename = $video->alttext . '.png';
		$new_target_file = $this->winabspath . $video->path . '/thumbs/thumbs_' . $new_target_filename;
		
		$video_preview = $this->winabspath . $video->path . '/thumbs/thumbs_' . $video->alttext . '_preview.png' ;
		
		$command = $options['cvg_ffmpegpath'] . " -i '$video_input' -vcodec mjpeg -vframes 1 -an -f rawvideo -ss 5 -s ".$thumb_width ."x".$thumb_height." '$new_target_file'";
		exec ( $command );
		
		$command = $options['cvg_ffmpegpath'] . " -i '$video_input' -vcodec mjpeg -vframes 1 -an -f rawvideo -ss 5 -s ".$thumb_width ."x".$thumb_height." '$video_preview'";
		exec ( $command );
		
		//get video duration
		$video_duration = CvgCore::video_duration($video_input);
		
		if (file_exists ( $new_target_file )) {
			
			CvgCore::chmod ($new_target_file); 
			CvgCore::chmod ($video_preview);
			
			/*$options = get_option('cvg_settings');
			$thumb_width = $options['cvg_preview_width'];
			$thumb_height = $options['cvg_preview_height'];
			$cv_zc = $options['cvg_zc'];
			$thumb_quality = $options['cvg_preview_quality'];
		
			if($cv_zc == 1)
				$crop = true;
			elseif($cv_zc == 0)
				$crop = false;
					
			$image_details = @getimagesize($new_target_file);
			if($image_details[0] > $thumb_width && $image_details[1] > $thumb_height){ 	
				$new_file = image_resize( $new_target_file, $thumb_width, $thumb_height, $crop, 'thumbs', NULL, $thumb_quality ); 	
				@unlink($new_target_file); 	
				@rename($new_file, $new_target_file); 	
			} 
				
			$new_size = @getimagesize ( $new_target_file );
			$size ['width'] = $new_size [0];
			$size ['height'] = $new_size [1];
			*/
			
			// add them to the database
			videoDB::update_video_meta ( $video->pid, array ('video_thumbnail' => $size , 'videoDuration' => $video_duration ) );
		}
	}
	
	/**
	 * Function to delete video file from a gallery
	 * 
	 * @param $pid - video id
	 * @author Praveen Rajan
	 */	
	function delete_video_files($pid = '') {
			
		$video_detail = videoDB::find_video($pid);
	    $video_path = $this->winabspath . $video_detail[0]->path . '/' . $video_detail[0]->filename;
	    $thumb_filename = $video_detail[0]->alttext . '.png';
	    
	    $thumb_path = $this->winabspath . $video_detail[0]->path . '/thumbs/thumbs_' . $thumb_filename;
		@unlink($video_path);
		@unlink($thumb_path);
		
	}
	
	/**
	 * Function to delete folder for gallery.
	 * 
	 * @param $gid - gallery id
	 * @author Praveen Rajan
	 */
	function delete_video_gallery($gid = '') {
		
		$videos = videoDB::get_gallery($gid);
		$video_gallery_path = videoDB::find_gallery($gid);
		
		CvgCore::deleteDir( $video_gallery_path->abspath. '/thumbs' );
		CvgCore::deleteDir( $video_gallery_path->abspath );
	
		return true;	
	}
	
	
	/**
	 * Function to remove directory and its files recursively
	 * @param $directory - directory path
	 * @param $empty - recursive true/false
	 * @return true or false
	 * @author Praveen Rajan
	 */
	function deleteDir($directory, $empty = false) {
	    if(substr($directory,-1) == "/") {
	        $directory = substr($directory,0,-1);
	    }
	    if(!file_exists($directory) || !is_dir($directory)) {
	        return false;
	    } elseif(!is_readable($directory)) {
	        return false;
	    } else {
	        $directoryHandle = opendir($directory);
	        while ($contents = readdir($directoryHandle)) {
	            if($contents != '.' && $contents != '..') {
	                $path = $directory . "/" . $contents;
	                if(is_dir($path)) {
	                    CvgCore::deleteDir($path);
	                } else {
	                    @unlink($path);
	                }
	            }
	        }
	        closedir($directoryHandle);
	        if($empty == false) {
	            if(!@rmdir($directory)) {
	                return false;
	            }
	        }
	        return true;
	    }
	} 
	
	/**
	 * Function to generate xml sitemap for videos
	 * 
	 * @author Praveen Rajan
	 */
	function xml_sitemap() {
		
		global $wpdb;
		
		$results = $wpdb->get_results('SELECT * FROM '. $wpdb->prefix .'cvg_videos ORDER BY galleryid', ARRAY_A);
		
		$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">';
		$xml .= '<!-- Generated by (http://wordpress.org/extend/plugins/cool-video-gallery/) -->' . "\n";
		$xml .= '<url>'; 
		$xml .= '<loc>'. site_url() . '</loc>';
		
		foreach($results as $result){
			
			if($result['meta_data'] != ''){
				$video_meta_data = unserialize($result['meta_data']);
				
				$seconds = date('s', strtotime($video_meta_data['videoDuration']));
				$minutes = date('i', strtotime($video_meta_data['videoDuration']));
				$hours = date('H', strtotime($video_meta_data['videoDuration']));
				
				$total_seconds = round( ($hours*60*60) + ($minutes*60) + $seconds );
			}else{
				
				$total_seconds = 100;
			}	
				
			$gallery_details = $wpdb->get_results('SELECT * FROM '. $wpdb->prefix .'cvg_gallery WHERE gid='. $result['galleryid'], ARRAY_A);
			
			$video_url = site_url()  . '/' . $gallery_details[0]['path'] . '/' . $result['filename'];
			$thumb_url = site_url() . '/' . $gallery_details[0]['path'] . '/thumbs/' . $result['thumb_filename'];
			$player_url =  WP_PLUGIN_URL . '/cool-video-gallery/cvg-player/player.swf';
			
			$xml .= '<video:video>';
			$xml .= '<video:thumbnail_loc>' . $thumb_url . '</video:thumbnail_loc>';
			$xml .= '<video:title>' . $result['alttext'] . '</video:title>';
			$xml .= '<video:description>' . $result['description'] . '</video:description>';
			$xml .= '<video:content_loc>' . $video_url . '</video:content_loc>';
			$xml .= '<video:duration>' . $total_seconds . '</video:duration>';
			$xml .= '</video:video> ';
		}
		
	   $xml .= '</url>'; 
	   $xml .= '</urlset>'; 

	   $video_sitemap_url = ABSPATH . 'sitemap-video.xml';
	   
	   if(CvgCore::createFile($video_sitemap_url)) {
			if (file_put_contents ($video_sitemap_url, $xml)) {
				
				CvgCore::show_video_message('Google XML Video Sitemap successfully created at location <b>' . $video_sitemap_url . '</b>');
				return true;
			}
	   }	
	}
	
	/**
	 * Function to create a file with permissions.
	 * 
	 * @param $filename - file path
	 * @author Praveen Rajan
	 */
	function createFile($filename) {
		if(!is_writable($filename)) {
			if(!@chmod($filename, 0666)) {
				$pathtofilename = dirname($filename);
				if(!is_writable($pathtofilename)) {
					if(!@chmod($pathtoffilename, 0666)) {
						return false;
					}
				}
			}
		}
		return true;
	}
	
	/**
	 * Function to return proper error messages while uploading files.
	 * 
	 * @param $code
	 * @author Praveen Rajan
	 */
	function decode_upload_error( $code ) {
		
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = __ ( 'The uploaded file exceeds the upload_max_filesize directive in php.ini' );
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = __ ( 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form' );
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = __ ( 'The uploaded file was only partially uploaded' );
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = __ ( 'No file was uploaded' );
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = __ ( 'Missing a temporary folder' );
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = __ ( 'Failed to write file to disk' );
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = __ ( 'File upload stopped by extension' );
                break;
            default:
                $message = __ ( 'Unknown upload error' );
                break;
        }
        return $message; 
	}
	
	/**
	 * Function to display overview of video gallery
	 *
	 * @return html code to display overview
	 * @author Praveen Rajan 
	 * 
	 */
	function gallery_overview() {
			
		global $wpdb;
		
		$videos    = intval( $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "cvg_videos") );
		$galleries = intval( $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "cvg_gallery") );
		?>
		<div class="table table_content">
			<p class="sub"><?php _e('At a Glance'); ?></p>
			<table>
				<tbody>
					<tr class="first">
						<td class="first b"><a href="<?php echo admin_url('admin.php?page=cvg-gallery-add');?>"><?php echo $videos; ?></a></td>
						<td class="b"></td>
						<td class="t"><a href="<?php echo admin_url('admin.php?page=cvg-gallery-add');?>"><?php echo _n( 'Videos', 'Videos', $videos ); ?></a></td>
					</tr>
					<tr>
						<td class="first b"><a href="<?php echo admin_url('admin.php?page=cvg-gallery-manage');?>"><?php echo $galleries; ?></a></td>
						<td class="b"></td>
						<td class="t"><a href="<?php echo admin_url('admin.php?page=cvg-gallery-manage');?>"><?php echo _n( 'Gallery', 'Galleries', $galleries ); ?></a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="versions" style="padding-top:14px">
		    <p>
			<a class="button rbutton" href="<?php echo admin_url('admin.php?page=cvg-gallery-add#uploadvideo');?>"><?php _e('Upload videos') ?></a>
			<p><?php echo 'Here you can control your videos and galleries.'; ?></p>
			</p>
		<br class="clear" />
		</div>    
		<?php
	}
	
	/**
	 * Function to get tab order.
	 * 
	 * @author Praveen Rajan
	 */
	function tabs_order() {
	    $tabs = array();
	    $tabs['addgallery'] = __('Add new gallery' );
	    $tabs['uploadvideo'] = __( 'Upload Videos' );
	   	return $tabs;
	}
	
	/**
	 * Function for gallery tab.
	 * 
	 * @author Praveen Rajan
	 */
 	function tab_addgallery() {
    ?>
		<!-- create gallery -->
		<h2><?php _e('Add new gallery') ;?></h2>
		<form name="addgallery" id="addgallery_form" method="POST" action="<?php echo admin_url('admin.php?page=cvg-gallery-add') . '#add'; ?>" accept-charset="utf-8" >
			<table class="form-table"> 
			<tr valign="top"> 
				<th scope="row"><?php _e('New Gallery') ;?>:</th> 
				<td><input type="text" size="35" name="galleryname" value="" style="width:94%;"/><br />
				<i>( <?php _e('Allowed characters for file and folder names are') ;?>: a-z, A-Z, 0-9, -, _ )</i></td>
			</tr>
			<tr>
				<th><?php _e('Description') ?>:</th> 
				<td><textarea name="gallerydesc" cols="30" rows="3" style="width: 94%" ></textarea></td>
			</tr>
			</table>
			<div class="submit"><input class="button-primary" type="submit" name= "addgallery" value="<?php _e('Add gallery') ;?>"/></div>
		</form>
    <?php
    }

    /**
	 * Function for upload video tab.
	 * 
	 * @author Praveen Rajan
	 */
	 function tab_uploadvideo() {
	?>
    	<!-- upload videos -->
    	<?php 
			$max_upload_size = wp_convert_bytes_to_hr(wp_max_upload_size());
    	?>
    	<h2><?php _e('Upload Videos') ;?></h2>
    	<form name="uploadvideo" id="uploadvideo_form" method="POST" enctype="multipart/form-data" action="<?php echo admin_url('admin.php?page=cvg-gallery-add').'#uploadvideo'; ?>" accept-charset="utf-8" >
			<table class="form-table"> 
			<tr valign="top"> 
				<th scope="row"><?php _e('Upload Video') ;?></th>
				<td><span id='spanButtonPlaceholder'></span><input type="file" name="videofiles[]" id="videofiles" size="35" class="videofiles"/>
				<br/>
				<i><?php _e('Allowed File Formats: H.264 (.mp4, .mov), FLV (.flv) and MP3 (.mp3)') ;?>
					<br />
					<?php echo 'Maximum file upload size: '. $max_upload_size ; ?> 
				</i></td>
			</tr> 
			<tr valign="top"> 
				<th scope="row"><?php _e('in to') ;?></th> 
				<td><select name="galleryselect" id="galleryselect">
				<option value="0" ><?php _e('Choose gallery') ?></option>
				<?php
					$gallerylist = videoDB::find_all_galleries('gid', 'ASC');
					foreach($gallerylist as $gallery) {
						$name = ( empty($gallery->title) ) ? $gallery->name : $gallery->title;
						echo '<option value="' . $gallery->gid . '" >' . $gallery->gid . ' - ' . $name . '</option>' . "\n";
					}					
					?>
				</select>
			</tr> 
			</table>
			<div class="submit">
				<input type="hidden" value="Upload Videos" name="uploadvideo" />
				<input class="button-primary" type="button" name="uploadvideo_btn" id="uploadvideo_btn" value="<?php _e('Upload Videos') ;?>" />
			</div>
		</form>
		
    <?php
    }        
    
    /**
     * Function to get maximum upload size of a file.
     * @return file size
     * @author Praveen Rajan
     */
    function get_max_size() {
    	
		return intval(CvgCore::wp_convert_bytes_to_kb(wp_max_upload_size()));
    }
    
    function wp_convert_bytes_to_kb ($bytes) {
    	
    	return intval($bytes/1024);
    }
	/**
	 * Function to update video details.
	 * 
	 * @author Praveen Rajan
	 */
	function update_videos() {
		global $wpdb;
	
		$description = 	isset ( $_POST['description'] ) ? $_POST['description'] : false;
		
		if ( is_array($description) ) {
			foreach( $description as $key => $value ) {
				$desc = $wpdb->escape($value);
				$wpdb->query( "UPDATE " . $wpdb->prefix . "cvg_videos SET description = '$desc' WHERE pid = $key");
			}
		}
		return true;
	}
	
	/**
	 * Function to return duration of an uploaded video.
	 * 
	 * @param $videofile
	 * @return duration of VideoSource
	 * @author Praveen Rajan
	 */
	function video_duration($videofile) {
		ob_start ();
		
		$options = get_option('cvg_settings');
		passthru ( $options['cvg_ffmpegpath'] . " -i \"" . $videofile . "\" 2>&1" );
		$duration = ob_get_contents ();
		ob_end_clean ();
		preg_match ( '/Duration: (.*?),/', $duration, $matches );
		$duration = $matches [1];
		return ($duration);
	}
		
	/**
	 * Function to get fileinfo 
	 * 
	 * @param string $name The name being checked. 
	 * @return array containing information about file
	 * author Praveen Rajan
	 */
	function fileinfo( $name ) {
		
		//Sanitizes a filename replacing whitespace with dashes
		$name = sanitize_file_name($name);
		
		//get the parts of the name
		$filepart = pathinfo ( strtolower($name) );
		
		if ( empty($filepart) )
			return false;
		
		if ( empty($filepart['filename']) ) 
			$filepart['filename'] = substr($filepart['basename'],0 ,strlen($filepart['basename']) - (strlen($filepart['extension']) + 1) );
		
		$filepart['filename'] = sanitize_title_with_dashes( $filepart['filename'] );
		
		$filepart['extension'] = $filepart['extension'];	
		//combine the new file name
		$filepart['basename'] = $filepart['filename'] . '.' . $filepart['extension'];
		
		return $filepart;
	}
	
	/**
	 * Scan folder for new videos
	 * 
	 * @param string $dirname
	 * @return array $files list of video filenames
	 * @author Praveen Rajan 
	 */
	function scandir_video( $dirname = '.' ) { 
		$ext = array('mp4', 'flv', 'MP4', 'FLV', 'mov', 'MOV', 'mp3', 'MP3'); 

		$files = array(); 
		if( $handle = opendir( $dirname ) ) { 
			while( false !== ( $file = readdir( $handle ) ) ) {
				$info = pathinfo( $file );
				// just look for video with the correct extension
                if ( isset($info['extension']) )
				    if ( in_array( strtolower($info['extension']), $ext) )
					   $files[] = utf8_encode( $file );
			}		
			closedir( $handle ); 
		} 
		sort( $files );
		return ( $files ); 
	} 
	
	/**
	 * Function to scan video file names
	 * @param $dirname - directory name
	 * @author Praveen Rajan
	 */
	function scandir_video_name( $dirname = '.' ) { 
		$ext = array('mp4', 'flv', 'MP4', 'FLV', 'mov', 'MOV', 'mp3', 'MP3'); 

		$files = array(); 
		if( $handle = opendir( $dirname ) ) { 
			while( false !== ( $file = readdir( $handle ) ) ) {
				$info = pathinfo( $file );
				// just look for video with the correct extension
                if ( isset($info['extension']) )
				    if ( in_array( strtolower($info['extension']), $ext) )
					   $files[] = utf8_encode( $info['filename'] );
			}		
			closedir( $handle ); 
		} 
		sort( $files );
		return ( $files ); 
	}
	
	/**
	 * Function to check if ffmpeg is installed.
	 * 
	 * @param $command - commandline argument
	 * @author Praveen Rajan
	 */
	function ffmpegcommandExists($command) {
	    $command = escapeshellarg($command);
	    exec($command, $output, $return);

		if(is_array($output) && !empty($output)) {
			return true;
		}
	
		return false;
	}
	
	/**
	 * Function to get webserver information.
	 * author Praveen Rajan
	 */
	function cvg_serverinfo() {
	
		global $wpdb, $ngg;
		// Get MYSQL Version
		$sqlversion = $wpdb->get_var("SELECT VERSION() AS version");
		// GET SQL Mode
		$mysqlinfo = $wpdb->get_results("SHOW VARIABLES LIKE 'sql_mode'");
		
		// Get PHP Max Upload Size
		$upload_max = wp_convert_bytes_to_hr(wp_max_upload_size());
		
		if (CvgCore::ffmpegcommandExists("ffmpeg")) 
		   $ffmpeg = 'Installed';
		else 
		   $ffmpeg = 'Not Installed';
		
		?>
		<li><?php _e('Operating System'); ?> : <span><?php echo PHP_OS; ?>&nbsp;(<?php echo (PHP_INT_SIZE * 8) ?>&nbsp;Bit)</span></li>
		<li><?php _e('Server'); ?> : <span><?php echo $_SERVER["SERVER_SOFTWARE"]; ?></span></li>
		<li><?php _e('MySQL Version'); ?> : <span><?php echo $sqlversion; ?></span></li>
		<li><?php _e('PHP Version'); ?> : <span><?php echo PHP_VERSION; ?></span></li>
		<li><?php _e('PHP Max Upload Size'); ?> : <span><?php echo $upload_max; ?></span></li>
		<li><?php _e('FFMPEG'); ?> : <span><?php echo $ffmpeg; ?></span></li>
		<?php if($ffmpeg == 'Not Installed') {?> 
		<li style="text-align:justify;">
		<span style="color:red;font-weight:normal;">[Note: Preview images for uploaded videos will not be created automatically using FFMPEG. Manually upload preview images for videos.]</span>
		</li>
		<?php }
	}
	
	/**
	 * Set correct file permissions (taken from wp core)
	 * 
	 * @param string $filename
	 * @return bool $result
	 * @author Praveen Rajan
	 */
	function chmod($filename = '') {

		$stat = @ stat(dirname($filename));
		$perms = $stat['mode'] & 0007777;
		$perms = $perms & 0000666;
		if ( @chmod($filename, $perms) )
			return true;
			
		return false;
	}
	
	/**
	* Show a error messages
	* author Praveen Rajan
	*/
	function show_video_error($message) {
		echo '<div class="wrap"><h2></h2><div class="error" id="error"><p>' . $message . '</p></div></div>' . "\n";
	}
	
	/**
	* Show a system messages
	* author Praveen Rajan
	*/
	function show_video_message($message) {
		echo '<div class="wrap"><h2></h2><div class="updated fade" id="message"><p>' . $message . '</p></div></div>' . "\n";
	}
	
	/**
	 * videoShowGallery() - return a gallery  
	 * 
	 * @param int $galleryID
	 * @param string $template (optional) name for a template file
	 * @param int $videos (optional) number of videos per page
	 * @return the content
	 * @author Praveen Rajan
	 */
	function videoShowGallery( $galleryID, $slide_show = false, $limit= 0 ) {
	    
	    $galleryID = (int) $galleryID;
	    
	     $limit_by  = ( $limit > 0 ) ? $limit : 0;
	    
	    // get gallery values
	    $videolist = videoDB::get_gallery($galleryID, 'sortorder', 'ASC', $limit_by);
	    $outer = '';
	     
	    if ( !$videolist )
	        return __('[Gallery not found]');
	    
	    // get all picture with this galleryid
	    if ( is_array($videolist) ) {
	    
	    	$outer .= '<div class="video-gallery-thumbnail-box-outer" id="video-'.$galleryID.'">';
	        $outer .= CvgCore::videoCreateGallery($videolist, $galleryID, $slide_show);
			$outer .= '</div>';
	    }	
        return $outer;
	}
	
	/**
	 * Build a gallery output
	 * 
	 * @param array $videolist
	 * @param bool $galleryID - gallery ID
	 * @param string $template (optional) name for a template file
	 * @param int $videos (optional) number of videos per page
	 * @return the content
	 * @author Praveen Rajan
	 */
	function videoCreateGallery($videolist, $galleryID = false, $slide_show = false) {
	
	    if ( !is_array($videolist) )
	        $videolist = array($videolist);
	       
	    $video_gallery = videoDB::find_gallery($galleryID);
	    
	    $video_gallery_name = $video_gallery->name;
		$index = 0;
		$out = '';
		$options = get_option('cvg_settings');
		
		if($slide_show){
			$out .= ' <div class="video-gallery-thumbnail-box slide"><ul class="slideContent" id="slide_'.$galleryID.'">';
		}else {
			if(!empty($video_gallery->galdesc)){
				if($options['cvg_description'] == 1) 	
					$out .= '<div class="clear"></div><div style="font-weight:bold;font-size:12px;">Description: '.$video_gallery->galdesc.'</div>';
			}	
		}		
	    foreach ($videolist as $video) {
	
	    	$video_filename = $video->rel_path . $video_gallery_name . '/' . $video->filename;
	    	$new_target_filename = $video->alttext . '.png';
	    	
			$new_target_file = $video->rel_path . $video_gallery_name . '/thumbs/thumbs_' . $new_target_filename;
			$cool_video_gallery = new CoolVideoGallery();
			
			if($slide_show) {
				$out .= '<li class="slideImage">';
				$out .= $cool_video_gallery->CVGVideo_Parse('[cvg-video videoId='. $video->pid . ' /]');
		    	$out .= '<span class="bottom">Click to Play</span></li>';
			}else {	
				$out .= '<div style="float:left;margin-right:10px;"><div class="video-gallery-thumbnail-box" style="padding:0px;" id="vide-file-'.$index.'">';
				$out .= '<div class="video-gallery-thumbnail">';
				$out .= $cool_video_gallery->CVGVideo_Parse('[cvg-video videoId='. $video->pid . ' /]');
		    	$out .= '</div></div><div class="clear"></div>';
		    	
		    	if($options['cvg_description'] == 1) 	
		    		$out .= '<div style="text-align:center;">'.$video->description.'</div>';
		    		
		    	$out .= '</div>';
			}	
	    	$index++;
	    }
	    
	    if($slide_show){	
		 $out .= '<div class="clear slideImage"></div></ul></div><div class="clear"></div>';
		 
		 if($options['cvg_description'] == 1) 
		 	$out .= '<div>Description: '.$video_gallery->galdesc.'</div>';
		 	
		 $out .= '<div class="clear" style="min-height:10px;"></div>';	
		}else {
		 $out .= '<div class="clear"></div>';
		}
		return $out;
	}
}
?>