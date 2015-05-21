<div id="sidebar-nav" class="fluid-sidebar sidebar span4 mar-one-b-neg" role="complementary"> 
  <!-- Collapse Nav -->
  <?php summer_main_nav(); // Adjust using Menus in Wordpress Admin ?>
  <!-- close nav --> 
  <!-- Calendar Of Events -->
  <div class="hidden-phone pad-two-t clearfix">
  	<div class="row">
    	<?php 
		$post_object = get_field('download_application', 'option');
		if( $post_object):
			$post = $post_object;
				
				setup_postdata($post);
				echo '<a href="';
				echo $post->guid;//get_permalink();
				echo '" class="btn btn-block btn-blue" target="_blank">';
				echo '<i class="icon icon-download-alt"></i>';
				echo get_the_title();
				echo '<small>';
				echo get_the_content();
				echo '</small>';
				echo '</a>';
			
			wp_reset_postdata();
		endif;
		?>
  	</div>
  </div>
  <div class="hidden-phone pad-two-t clearfix">
    <!-- Important Links -->
    <div class="row">
      <div class="pad-one-b" id="important-links"> <a class="btn-large btn-blue" data-target="#links" data-toggle="collapse"><i class="icon-chevron-right"></i>Important Links</a>
        <div class="collapse" id="links">
          <div class="pad-one mar-two-l list-links"> <?php echo do_shortcode('[display-links cat="Important Links"]') ?> </div>
        </div>
      </div>
    </div>
    <!-- close links --> 
    <?php if (is_front_page()) :
		dynamic_sidebar( 'sidebar2' );
	endif; ?>
  </div>
</div>
