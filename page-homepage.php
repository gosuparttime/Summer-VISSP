<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>

<div id="content" class="clearfix row-fluid">
  <div id="main" class="span8 clearfix white-bg" role="main">
    <div class="orange-bg pad-one-t"></div>
    <div id="myCarousel" class="carousel slide" > 
          
          <!-- Carousel items -->
          <div class="carousel-inner">
            <?php
			$post_num = 0;
            $query = new WP_Query(array( 'post_type' => 'slide'));
			while ( $query->have_posts() ) : $query->the_post();
			$post_num++;
			// Image swaps?
			$attachment_id = get_field('slide_image');
			$size = "summer-slide";
			$image = wp_get_attachment_image_src( $attachment_id, $size );
            echo '<div class="item ';
			if($post_num == 1){ 
				echo 'active';
			}
            echo '"><img src="';
			echo $image[0];
			echo '" alt="';
			the_title();
			echo '" />';
			?>
          </div>
          <?php endwhile; ?>
        </div>
        <!-- Carousel nav --> 
        <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="icon-chevron-left"></i></a> <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="icon-chevron-right"></i></a> 
        <!-- Carousel nav --> 
         <div class="row-fluid clearfix">
        <h2 class="tagline" role="heading">
          <?php bloginfo('title'); ?>
        </h2>
      </div>
      </div>
    <?php while (have_posts()) : the_post(); ?>
    <div class="pad-two">
      <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
        <header>
          <div class="page-header">
            <h3 class="block" itemprop="headline">
              <?php the_title(); ?>
            </h3>
          </div>
        </header>
        <!-- end article header -->
        
        <section class="post_content clearfix" itemprop="articleBody">
          <p class="lead"><?php echo get_the_content(); ?></p>
        </section>
        <!-- end article section -->
        
        <footer>
          <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","summertheme") . ':</span> ', ', ', '</p>'); ?>
        </footer>
        <!-- end article footer --> 
        
      </article>
      <!-- end article -->
      <?php 
 		if(get_field('feature_sections')){
			
		 
			while(has_sub_field('feature_sections')):
			{
				echo '<article class="pad-one-tb">';
				echo '<div class="row-fluid">';
				
				$attachment_id = get_sub_field('feature_image');
				$size = "feature-thumb";
				$image = wp_get_attachment_image_src( $attachment_id, $size );
				echo '<div class="span5 featured-section">';
				echo '<img class="above" src="';
				echo $image[0];
				echo '" alt="';
				the_title();
				echo '" />';
				echo '</div><div class="span7">';
				echo '<h4>';
				echo get_sub_field('feature_title');
				echo '</h4>';
				echo get_sub_field('feature_text');
				echo '<div class="pad-one-l"><a class="btn btn-clear" href="';
				echo get_sub_field('feature_link');
				echo '"><i class="icon-chevron-right"></i>';
				echo get_sub_field('link_title');
				echo '</a></div></div>';
				echo '</div>';
				echo '</article>';
			}
		 	endwhile;
			
		} ?>
	  <?php endwhile; ?> 
    </div>
    
    <div class="visible-phone mar-one"><a href="#top" id="to-top" class="pad-one">Back to top <i class="icon-circle-arrow-up"></i></a></div>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
