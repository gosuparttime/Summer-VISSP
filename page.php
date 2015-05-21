<?php get_header(); ?>
<div id="content" class="clearfix row-fluid">
  <div id="main" class="span8 clearfix white-bg" role="main">
    <div class="orange-bg pad-one-t"></div>
    
      <?php while (have_posts()) : the_post(); ?>
      <div class="clear-logo">
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
        	<?php if ( has_post_thumbnail() ) {
				echo '<div class="pad-one-b">';
				the_post_thumbnail('summer-slide');
				echo '</div>';
			} ?>
          	<?php the_content(); ?>
        </section>
        <!-- end article section -->
        
        <footer>
          <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","summertheme") . ':</span> ', ', ', '</p>'); ?>
        </footer>
        <!-- end article footer --> 
        
      </article>
      <!-- end article -->
      </div>
      <?php endwhile; ?>
     
      <div class="visible-phone mar-one"><a href="#top" id="to-top" class="pad-one">Back to top <i class="icon-circle-arrow-up"></i></a></div>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
