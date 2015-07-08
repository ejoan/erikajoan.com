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
<!--<p>SORRY, this site is currently<br/>
under construction. Please feel<br/>
free to contact me for my porfolio<br/>
at the email provided above.</p></br>--!>
    </div>
  
  </div>
  
  
  <div class="clear"></div>
  <br /><br />
  
  <div class="top_box_logo bottom">
    
  <div class="thick_line"></div>
    
  <h3>About</h3>
    <!--<img src="<?php bloginfo('stylesheet_directory'); ?>/images/about-image.jpg" />-->
    
   <p>Erika Anderson<br />
    Graphic Designer<br />
    From Ottawa <br />
    Living in Toronto</p>
    
<!--<p> Currently a student completing<br /> 
her Bachelor of Design from <br />
the York/Sheridan Joint Honours<br /> 
Program in Design.<br />--!>
</p>
<p>
Graduated from the York/Sheridan<br/>
Joint Honours Programme in<br/>
Design April 2012.</p>
<p>
Erika is interested in pursuing <br />
opportunities that will provide her <br />
with valuable experience to  <br />
further develop her skills as a <br />
multi-faceted designer.</p>

 
   <!--<div class="divider"></div>--!>
    
   <!--<h3>Links</h3>
    
    <ul class="link_list">
      <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
    </ul><!--//link_list-->
  
  </div><!--//top_box_logo--!>
  
  <div class="bottom_box">
    
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
  
  </div><!--//bottom_box-->


   <?php
     global $post;
     $x = 0;
     $myposts = get_posts('numberposts=1&category_name=Featured Big');
     foreach($myposts as $post) :
       setup_postdata($post);
     ?>
     
     
    <div class="box_big">
    
      <div class="thick_line"></div>
      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    
      <?php
      if ( has_post_thumbnail() ) {
        ?> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured-big'); ?></a> <?php
      } else {
        ?> <a href="<?php the_permalink(); ?>"><img src="<?php echo catch_that_image() ?>" width="330" height="431" /></a> <?php
      }
      ?>
    
    </div><!--//box_big-->
     

    <?php $x++; ?>
   <?php endforeach; ?>


  
<?php get_footer(); ?>