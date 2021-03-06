<?php
/**
* The TEC template for a list of events. This includes the Past Events and Upcoming Events views 
* as well as those same views filtered to a specific category.
*
* You can customize this view by putting a replacement file of the same name (list.php) in the events/ directory of your theme.
*/

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

?>
<div id="tribe-events-content" class="upcoming">

	
	<div id="tribe-events-loop" class="tribe-events-events post-list clearfix pad-one-b">
	
	<?php if (have_posts()) : ?>
	<?php $hasPosts = true; $first = true; ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php global $more; $more = false; ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('tribe-events-event clearfix'); ?> itemscope itemtype="http://schema.org/Event">
			<?php if ( tribe_is_new_event_day() && !tribe_is_day() && !tribe_is_multiday() ) : ?>
				<h4 class="event-day"><?php echo tribe_get_start_date( null, false ); ?></h4>
			<?php endif; ?>
			<?php if( !tribe_is_day() && tribe_is_multiday() ) : ?>
				<h4 class="event-day"><?php echo tribe_get_start_date( null, false ); ?> – <?php echo tribe_get_end_date( null, false ); ?></h4>
			<?php endif; ?>
			<?php if ( tribe_is_day() && $first ) : $first = false; ?>
				<h4 class="event-day"><?php echo tribe_event_format_date(strtotime(get_query_var('eventDate')), false); ?></h4>
			<?php endif; ?>
            <div class="row-fluid date-separate">
            <!-- start cols/rows -->
			<div class="span5"><?php the_title('<a class="btn-blue" href="' . tribe_get_event_link() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">', '<i class="icon-chevron-right"></i></a>'); ?>
            <div class="entry-content pad-half-tb" itemprop="description">
				<?php if (has_excerpt ()): ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div> <!-- End tribe-events-event-entry -->

			</div>
			
			<div class="span6 offset1 pad-half-t" itemprop="location" itemscope itemtype="http://schema.org/Place">
					<?php if (tribe_is_multiday() || !tribe_get_all_day()): ?>
					<div class="row-fluid">
						<div class="tribe-events-event-meta-desc span3"><?php _e('Start:', 'tribe-events-calendar'); ?></div>
						<div class="tribe-events-event-meta-value span9" itemprop="startDate" content="<?php echo tribe_get_start_date(); ?>"><?php echo tribe_get_start_date(); ?></div>
					</div>
					<div class="row-fluid">
						<div class="tribe-events-event-meta-desc span3"><?php _e('End:', 'tribe-events-calendar'); ?></div>
						<div class="tribe-events-event-meta-value span9" itemprop="endDate" content="<?php echo tribe_get_end_date(); ?>"><?php echo tribe_get_end_date(); ?></div>
					</div>
					<?php else: ?>
					<div class="row-fluid">
						<div class="tribe-events-event-meta-desc span3"><?php _e('Date:', 'tribe-events-calendar'); ?></div>
						<div class="tribe-events-event-meta-value span9" itemprop="startDate" content="<?php echo tribe_get_start_date(); ?>"><?php echo tribe_get_start_date(); ?></div>
					</div>
					<?php endif; ?>

					<?php
						$venue = tribe_get_venue();
						if ( !empty( $venue ) ) :
					?>
					<div class="row-fluid">
						<div class="tribe-events-event-meta-desc span3"><?php _e('Venue:', 'tribe-events-calendar'); ?></div>
						<div class="tribe-events-event-meta-value span9" itemprop="name">
							<?php if( class_exists( 'TribeEventsPro' ) ): ?>
								<?php tribe_get_venue_link( get_the_ID(), class_exists( 'TribeEventsPro' ) ); ?>
							<?php else: ?>
								<?php echo tribe_get_venue( get_the_ID() ); ?>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
										
				</div>
            </div>
		</div> <!-- End post -->
	<?php endwhile;// posts ?>
	<?php else :?>
		<div class="tribe-events-no-entry">
		<?php 
			$tribe_ecp = TribeEvents::instance();
			if ( is_tax( $tribe_ecp->get_event_taxonomy() ) ) {
				$cat = get_term_by( 'slug', get_query_var('term'), $tribe_ecp->get_event_taxonomy() );
				if( tribe_is_upcoming() ) {
					$is_cat_message = sprintf(__(' listed under %s. Check out past events for this category or view the full calendar.','tribe-events-calendar'),$cat->name);
				} else if( tribe_is_past() ) {
					$is_cat_message = sprintf(__(' listed under %s. Check out upcoming events for this category or view the full calendar.','tribe-events-calendar'),$cat->name);
				}
			}
		?>
		<?php if(tribe_is_day()): ?>
			<?php printf( __('No events scheduled for <strong>%s</strong>. Please try another day.', 'tribe-events-calendar'), date_i18n('F d, Y', strtotime(get_query_var('eventDate')))); ?>
		<?php endif; ?>

		<?php if(tribe_is_upcoming()){ ?>
			<?php _e('No upcoming events', 'tribe-events-calendar');
			echo !empty($is_cat_message) ? $is_cat_message : "."; ?>

		<?php }elseif(tribe_is_past()){ ?>
			<?php _e('No previous events' , 'tribe-events-calendar');
			echo !empty($is_cat_message) ? $is_cat_message : "."; ?>
		<?php } ?>
		</div>
	<?php endif; ?>


	</div><!-- #tribe-events-loop -->
	<div id="tribe-events-nav-below" class="tribe-events-nav clearfix">

		<div class="tribe-events-nav-previous"><?php 
		// Display Previous Page Navigation
		if( tribe_is_upcoming() && get_previous_posts_link() ) : ?>
			<?php previous_posts_link( '<span>'.__('<i class="icon-chevron-left"></i> Previous Events', 'tribe-events-calendar').'</span>' ); ?>
		<?php elseif( tribe_is_upcoming() && !get_previous_posts_link( ) ) : ?>
			<a class="btn-orange" href='<?php echo tribe_get_past_link(); ?>'><i class="icon-chevron-left"></i><?php _e('Previous Events', 'tribe-events-calendar' ); ?></a>
		<?php elseif( tribe_is_past() && get_next_posts_link( ) ) : ?>
			<?php next_posts_link( '<span>'.__('<i class="icon-chevron-left"></i> Previous Events', 'tribe-events-calendar').'</span>' ); ?>
		<?php endif; ?>
		</div>

		<div class="tribe-events-nav-next"><?php
		// Display Next Page Navigation
		if( tribe_is_upcoming() && get_next_posts_link( ) ) : ?>
			<?php next_posts_link( '<span>'.__('Next Events <i class="icon-chevron-right"></i>', 'tribe-events-calendar').'</span>' ); ?>
		<?php elseif( tribe_is_past() && get_previous_posts_link( ) ) : ?>
			<?php previous_posts_link( '<span>'.__('Next Events <i class="icon-chevron-right"></i>', 'tribe-events-calendar').'</span>' ); // a little confusing but in 'past view' to see newer events you want the previous page ?>
		<?php elseif( tribe_is_past() && !get_previous_posts_link( ) ) : ?>
			<a class="btn-orange" href='<?php echo tribe_get_upcoming_link(); ?>'><i class="icon-chevron-right"></i><?php _e('Next Events', 'tribe-events-calendar'); ?></a>
		<?php endif; ?>
		</div>

	</div>
	<?php if ( !empty($hasPosts) && function_exists('tribe_get_ical_link') ): ?>
		<a class="btn-orange" title="<?php esc_attr_e('iCal Import', 'tribe-events-calendar'); ?>" class="ical" href="<?php echo tribe_get_ical_link(); ?>"><?php _e('iCal Import', 'tribe-events-calendar'); ?></a>
	<?php endif; ?>
</div>
