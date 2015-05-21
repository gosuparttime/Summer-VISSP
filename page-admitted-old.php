<?php 
// Template Name: Admitted Students
//
get_header(); ?>
<div id="content" class="clearfix row-fluid">
  <div id="main" class="span8 clearfix white-bg" role="main">
    <div class="orange-bg pad-one-t"></div>
    <div class="clear-logo">
      <?php while (have_posts()) : the_post(); ?>
      
      <h1 class="blue"><?php bloginfo('title');?></h1>
      <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
        <header>
          <div class="page-header">
            <h1 class="page-title" itemprop="headline">
              <?php the_title(); ?>
            </h1>
          </div>
        </header>
        <!-- end article header -->
        
        <section class="post_content clearfix" itemprop="articleBody">
          <?php the_content(); ?>
        </section>
        <!-- end article section -->
        
        <footer>
          <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","summertheme") . ':</span> ', ', ', '</p>'); ?>
        </footer>
        <!-- end article footer --> 
        
      </article>
      <!-- end article -->
	  <?php endwhile; ?>
      <article class="mar-one-t" id="procedures-links" role="complementary">
          <header id="procedures-title">
            <h3>Procedures</h3>
          </header>
          <section>
          <? $query = new WP_Query( 
	$args = array(
		'posts_per_page' => '-1',
        'sections' => $section,
		'post_type' => 'tabs',
		'order' => 'ASC',
    ) );
	$output = "";
	$c = 1; //init counter
	$d = 0;
	$query = new WP_Query($args);
	echo '<div id="procedures">';
	echo '<div class="accordion" id="accordion'.$c.'">';
	echo '<div class="accordion-group">';
    while ( $query->have_posts() ) : $query->the_post();
		$d++; //init counter
		echo '<div class="accordion-heading">';
      	echo '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$c.'" href="#collapse'.$d.'">';
		echo the_title();
		echo '<i class="icon-plus pull-right"></i></a></div>';
		echo '<div id="collapse'.$d.'" class="accordion-body collapse">';
      	echo '<div class="accordion-inner pad-one">';
		echo the_content();
		echo '</div></div>';
	endwhile;
	echo '</div>';
	echo '</div>';
	echo '</div>';
	$c++;
	wp_reset_postdata();
	?>
          </section>
      </article>
      <article class="mar-one-t" id="helpful-links" role="complementary">
       <header id="helpful-title">
            <h3>Helpful Links</h3>
          </header>
          <section id="helpful">
          <?php echo do_shortcode('[display-links cat="Helpful Links"]') ?>
          </section>
      </article>
      </div>
      
     
      <div class="visible-phone mar-one"><a href="#top" id="to-top" class="pad-one">Back to top <i class="icon-circle-arrow-up"></i></a></div>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
