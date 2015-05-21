<?php 
//
//	Template Name: Events Page
//
get_header(); ?>

<div id="content" class="clearfix row-fluid">
  <div id="main" class="span8 clearfix white-bg" role="main">
    <div class="orange-bg pad-one-t"></div>
    <?php the_post(); ?>
    <div class="clear-logo orange-text">
      <div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="page-header">
          <h1 class="page-title" itemprop="headline">
            <?php the_title(); ?>
          </h1>
        </div>
        <?php the_content(); ?>
        
        <!-- end article footer --> 
        
      </div>
      <!-- end article --> 
    </div>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
