<?php
/**
 * Template Name: Facilities
 *
 * This is the template that displays full width page without sidebar
 *
 * @package Schools
 */

get_header();
$banner_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
?>
	<section class="myraid">
  <div class="background-light clearfix"> 


<!-- banner -->
 <div class="facilitybg clearfix"   style="background-image: url(<?php echo $banner_image[0]; ?>)">
  <div class="pull-right">
     <div class="banner-content">    
    <h1><?php echo $post->banner_text ?></h1>
    <hr class="banner-line">
     </div>
     <div class="border"> </div> 
  </div></div>`
 <!-- end banner -->


<div class="container-fluid paddinglr">
    
     <?php while (have_posts()) : the_post(); ?>
  <div class="marginlarge clearfix">
  
   <div class="col-md-8 col-sm-8">
   
       <div class="col-md-12 col-sm-12">
       
           
           <?php the_content();?>
       </div>
       
       <section>    
   <?php $facilitis=get_posts(array('post_type'=>'facility','posts_per_page'=>-1,'category_name'=>'facility'));
    
		foreach($facilitis as $facility)
		{
		setup_postdata( $facility);
		$image_url=wp_get_attachment_url(get_post_thumbnail_id($facility->ID));
		$custom=get_post_custom($facility->ID);
		$link = get_permalink();
		//$description=wp_trim_words(get_the_content($facility->ID), 50 )

 ?>
   
   <div class="col-md-6 col-lg-6 col-sm-12">
   <a href="#" data-toggle="modal" data-target="#facilitymodel_<?php echo $facility->ID;?>"><img class="img-responsive imgfacility" src="<?php echo $image_url; ?>"/></a>
   <h2><?php echo get_the_title($facility->ID);?></h2>
          <p><?php echo apply_filters( 'the_excerpt', wp_trim_words(get_the_excerpt($facility->ID),20));?> </p>
          </div>
          
       
    <?php  } wp_reset_postdata();?>       
     
          
               
     
   <!-- model -->
   
   <?php 
   foreach($facilitis as $facility)
		{
		setup_postdata( $facility);
		$gallery = get_post_gallery_images($facility->ID);
   ?>
   
   <div class="modal fade" id="facilitymodel_<?php echo $facility->ID;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modelcon">
      
      <div class="modal-body">
      
      <div id="facility-carosel_<?php echo $facility->ID;?>" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators olfacility">
     <?php
                                $i = 0;
                                foreach ($gallery as $gal) {
                                    ?>
                                    <li data-target="#facility-carosel_<?php echo $facility->ID; ?>" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? "active" : ""; ?>"></li>
                                    <?php
                                    $i++;
                                }
                                ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  
   <?php
       $i = 0;
        foreach ($gallery as $gal) {
			$active='';
			if($i==1){
				$active='active';
				}
             ?>
  
  
    <div class="item <?php echo $active;?>">
      <img class="img-responsive imgwidth" src="<?php echo $gal;?>">
      </div>
    
    <?php $i++;}?>
    
  
  
 </div>

 
</div>
      
      <div class="margin clearfix">
      
     <h2><?php echo get_the_title($facility->ID);?></h2>
          <p><?php echo apply_filters( 'the_excerpt', get_the_excerpt($facility->ID));?> </p>
      </div>
      
      </div>
      
    </div>
  </div>
</div>
   
   <?php } ?>
   <!-- end model -->  
   </section>   
      <!-- sports --> 
       <div class="margin clearfix">
       <div class="col-md-12 col-sm-12">
       
           <h2>Games & Sports</h2>
           <p>Kalpa believes in a healthy mind and a healthy body. It gives equal emphasis on the training of the mind and the development of the body and therefore makes sports and games an integral part of the curriculum.
           </p>
	<p>It offers a range of sports activities with qualified coach for students to choose from.
</p>
         
       </div></div>
       
       
       <section>    
   <?php $facilitis=get_posts(array('post_type'=>'facility','posts_per_page'=>-1,'category_name'=>'games'));
    
		foreach($facilitis as $facility)
		{
		setup_postdata( $facility);
		$image_url=wp_get_attachment_url(get_post_thumbnail_id($facility->ID));
		$custom=get_post_custom($facility->ID);
		$link = get_permalink();
		//$description=wp_trim_words(get_the_content($facility->ID), 50 )

 ?>
   
   <div class="col-md-6 col-lg-6 col-sm-12">
   <a href="#" data-toggle="modal" data-target="#facilitymodel_<?php echo $facility->ID;?>"><img class="img-responsive imgfacility" src="<?php echo $image_url; ?>"/></a>
   <h2><?php echo get_the_title($facility->ID);?></h2>
          <p><?php echo apply_filters( 'the_excerpt', wp_trim_words(get_the_excerpt($facility->ID),20));?> </p>
          </div>
          
       
    <?php  } wp_reset_postdata();?>       
     
          
               
     
   <!-- model -->
   
   <?php 
   foreach($facilitis as $facility)
		{
		setup_postdata( $facility);
		$gallery = get_post_gallery_images($facility->ID);
   ?>
   
   <div class="modal fade" id="facilitymodel_<?php echo $facility->ID;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modelcon">
      
      <div class="modal-body">
      
      <div id="facility-carosel_<?php echo $facility->ID;?>" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators olfacility">
     <?php
                                $i = 0;
                                foreach ($gallery as $gal) {
                                    ?>
                                    <li data-target="#facility-carosel_<?php echo $facility->ID; ?>" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? "active" : ""; ?>"></li>
                                    <?php
                                    $i++;
                                }
                                ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  
   <?php
       $i = 0;
        foreach ($gallery as $gal) {
			$active='';
			if($i==1){
				$active='active';
				}
             ?>
  
  
    <div class="item <?php echo $active;?>">
      <img class="img-responsive imgwidth" src="<?php echo $gal;?>">
      </div>
    
    <?php $i++;}?>
    
  
  
 </div>

 
</div>
      
      <div class="margin clearfix">
      
     <h2><?php echo get_the_title($facility->ID);?></h2>
          <p><?php echo apply_filters( 'the_excerpt', get_the_excerpt($facility->ID));?> </p>
      </div>
      
      </div>
      
    </div>
  </div>
</div>
   
   <?php } ?>
   <!-- end model -->  
   </section>  
       
     <!-- end sports -->  
     <div class="col-md-12 col-sm-12">
         <p>Several other activities are also been promoted and children have a choice to opt for them.</p>   
         
     </div>  
     
     
   </div>
   
   
    <!-- right section -->
        <div class="col-md-4 col-sm-4 ">
          <div class="margin-left clearfix">
            <div class="white-grid-alu clearfix">
              <h3>Notifications</h3>
              
             <?php
        $newss = get_posts(array('post_type' => 'notification', 'posts_per_page' => 3));
        foreach ($newss as $news) {
            setup_postdata($news); 
			$custom = get_post_custom($news->ID);
            $priority = $custom['notification_high_priority'][0];
            $link = get_permalink($news->ID);
            $description = wp_trim_words(get_the_content($news->ID), 20)
               ?>
              <span class="grey"><?php //echo get_the_date(); ?></span> <?php if ($priority) { ?><a href="<?php echo $link; ?>"><span class="new">new</span></a>
                    <?php } else { ?><a href="<?php echo $link; ?>"><span class="new1">new</span></a>  <?php } ?>
              <div class="marginlyte"><a class="ablack1" href="<?php echo $link; ?>"><?php echo $description; ?></a></div>
              <hr>
              
          <?php } wp_reset_postdata();?>    
             
            </div>
            <div class="white-grid-alu clearfix">
              <div class="col-md-12 col-sm-12 padding-none">
                <h3>Address</h3>
                <p><?php echo of_get_option('op_contect_address');?></p>
              </div>
              <div class="margin">
                <div class="col-md-6 col-sm-12 padding-none">
                  <h3>Phone</h3>
                  <?php echo of_get_option('op_alumni_num')?> </div>
                <div class="col-md-6 col-sm-12 padding-none">
                  <h3>Email</h3>
                  <a href="mailto:<?php echo of_get_option('op_alumni_email')?>" class="ablack1"><?php echo of_get_option('op_alumni_email')?></a> </div>
              </div>
            </div>
            <div class="white-grid-alu clearfix">
              <h3>School Timings</h3>
              <p> <?php 
echo of_get_option('op_school_time');
//echo preg_replace('/[-]/', '<br />', of_get_option('op_school_time')); ?></p>
              

            </div>
          </div>
        </div>
        
        <!-- end right --> 
   
    
  </div>
    
    <?php endwhile; // end of the loop.  ?>
</div>


<!-- end facility -->


<!-- shorcut icons -->
<?php get_sidebar('shortlinks');?>

<!-- end shortcut icon -->

</div></section><!-- #section -->

<?php get_footer(); ?>
