<?php get_header(); ?>

<div id="main_container">

  <div class="top_box_logo">
  
    <a href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" class="logo" /></a>
  
  </div><!--//top_box-->
  
  
       <?php
         global $post;
         $x = 0;
         $myposts = get_posts('numberposts=3&category_name=Featured Small');
         foreach($myposts as $post) :
           setup_postdata($post);
         ?>
         
        <div class="top_box <?php if($x == 2) { ?> last <?php } ?>">
        
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          
          <?php
          if ( has_post_thumbnail() ) {
            ?> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured-small'); ?></a> <?php
          } else {
            ?> <a href="<?php the_permalink(); ?>"><img src="<?php echo catch_that_image() ?>" width="160" height="148" /></a> <?php
          }
          ?>
        
        </div><!--//top_box-->

        <?php $x++; ?>
       <?php endforeach; ?>
  
  
  <div class="top_box">
    <div style="padding-left: 10px;">
    <br /><br /><br /><br /><br /><br />
   Erika Joan Anderson<br />
   <a href="mailto:ejoanand@gmail.com">ejoanand@gmail.com</a><br />
    <a href="http://twitter.com/#!/eejaya">Twitter</a><br />
    <a href="http://www.ejoan.tumblr.com">Tumblr</a><br />
    </div>
  
  </div>
  
  

  <div class="clear"></div>
  <br /><br />
  
  <div class="top_box_logo bottom">
    
    <div class="thick_line"></div>
    
    <h3 class="dot_bottom">Portfolio</h3>
    
    <ul class="portfolio">
       <?php
         global $post;
         $myposts = get_posts('numberposts=20&category_name=Portfolio');
         foreach($myposts as $post) :
           setup_postdata($post);
         ?>
        
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

       <?php endforeach; ?>    
    </ul><!--//portfolio-->
    
   <!-- <div class="divider"></div>
    
    <h3>Links</h3>
    
    <ul class="link_list">
      <?php wp_list_bookmarks('title_li=&categorize=0'); ?>--!>
    </ul><!--//link_list-->
  
  </div><!--//top_box_logo-->
 
  <div class="box_big_single">
  
    <div class="thick_line"></div>
    
    <div style="padding: 0 5px;">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
      <h3><?php the_title(); ?></h3>
    
      <?php the_content(); ?>
      
      <?php //comments_template(); ?>
      
    <?php endwhile; else: ?>

      <h3>Sorry, no posts matched your criteria.</h3>
  
    <?php endif; ?>
    </div>
  
  </div><!--//box_big-->
  
<?php get_footer(); ?>