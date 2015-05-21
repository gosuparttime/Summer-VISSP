<?php get_header(); ?>

<div id="content" class="clearfix row-fluid">
  <div id="main" class="span8 clearfix white-bg" role="main">
    <div class="orange-bg pad-one-t"></div>
    <div class="clear-logo orange-text">
      <article id="post-404-error" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
        <header>
          <div class="page-header">
            <h1 class="page-title" itemprop="headline">Epic 404 - Article Not Found</h1>
            <p>This is embarassing. We can't find what you were looking for.</p>
            </h1>
          </div>
        </header>
        <!-- end article header -->
        
        <section class="post_content clearfix" itemprop="articleBody">
          <p>Whatever you were looking for was not found, but maybe try looking again or search using the form below.</p>
          <div class="row-fluid">
            <div class="span12">
              <?php get_search_form(); ?>
            </div>
          </div>
        </section>
        <!-- end article section -->
        
        <footer>
          <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","summertheme") . ':</span> ', ', ', '</p>'); ?>
        </footer>
        <!-- end article footer --> 
        
      </article>
      <!-- end article --> 
    </div>
    <div class="visible-phone mar-one"><a href="#top" id="to-top" class="pad-one">Back to top <i class="icon-circle-arrow-up"></i></a></div>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
