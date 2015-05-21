<?php
/**
* A single event.  This displays the event title, description, meta, and 
* optionally, the Google map for the event.
*
* You can customize this view by putting a replacement file of the same name (single.php) in the events/ directory of your theme.
*/

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }
?>
<div class="entry-content">
	<?php
	if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) {?>
		<div class="pad-one-b"><?php the_post_thumbnail('summer-slide'); ?></div>
	<?php } ?>
	<div class="summary pad-two-b"><?php the_content(); ?></div>
	<?php if (function_exists('tribe_get_ticket_form') && tribe_get_ticket_form()) { tribe_get_ticket_form(); } ?>		
</div>
<?php
	$gmt_offset = (get_option('gmt_offset') >= '0' ) ? ' +' . get_option('gmt_offset') : " " . get_option('gmt_offset');
 	$gmt_offset = str_replace( array( '.25', '.5', '.75' ), array( ':15', ':30', ':45' ), $gmt_offset );
 	if (strtotime( tribe_get_end_date(get_the_ID(), false, 'Y-m-d G:i') . $gmt_offset ) <= time() ) { ?><div class="event-passed"><?php  _e('This event has passed.', 'tribe-events-calendar'); ?></div><?php } ?>
<h4 class="block">Event Details</h4>
<div id="tribe-events-event-meta" itemscope itemtype="http://schema.org/Event">
	<div class="row-fluid">
    <div class="span6">
		<div class="row-fluid">
        	<div class="span3 event-label event-label-name"><?php _e('Event:', 'tribe-events-calendar'); ?></div>
			<div class="span9 event-meta event-meta-name" itemprop="name"><span class="summary"><?php the_title(); ?></span></div>
        </div>
        <?php if (tribe_get_start_date() !== tribe_get_end_date() ) { ?>
        <div class="row-fluid">
			<div class="span3 event-label event-label-start"><?php _e('Start:', 'tribe-events-calendar'); ?></div> 
			<div class="span9 event-meta event-meta-start"><meta itemprop="startDate" content="<?php echo tribe_get_start_date( null, false, 'Y-m-d-h:i:s' ); ?>"/><?php echo tribe_get_start_date(); ?></div>
            </div>
        <div class="row-fluid">
			<div class="span3 event-label event-label-end"><?php _e('End:', 'tribe-events-calendar'); ?></div>
			<div class="span9 event-meta event-meta-end"><meta itemprop="endDate" content="<?php echo tribe_get_end_date( null, false, 'Y-m-d-h:i:s' ); ?>"/><?php echo tribe_get_end_date(); ?></div>	
        </div>					
		<?php } else { ?>
        <div class="row-fluid">
			<div class="span3 event-label event-label-date"><?php _e('Date:', 'tribe-events-calendar'); ?></div> 
			<div class="span9 event-meta event-meta-date"><meta itemprop="startDate" content="<?php echo tribe_get_start_date( null, false, 'Y-m-d-h:i:s' ); ?>"/><?php echo tribe_get_start_date(); ?></div>
		</div>
		<?php } ?>
		<?php if ( tribe_get_cost() ) : ?>
		<div class="row-fluid">
        	<div class="span3 event-label event-label-cost"><?php _e('Cost:', 'tribe-events-calendar'); ?></div>
			<div class="span9 event-meta event-meta-cost" itemprop="price"><?php echo tribe_get_cost(); ?></div>
        </div>
		<?php endif; ?>
		
		<?php if ( class_exists('TribeEventsRecurrenceMeta') && function_exists('tribe_get_recurrence_text') && tribe_is_recurring_event() ) : ?>
		</div>
        <div class="row-fluid">	
            <div class="span3 event-label event-label-schedule"><?php _e('Schedule:', 'tribe-events-calendar'); ?></div>
            <div class="span9 event-meta event-meta-schedule"><?php echo tribe_get_recurrence_text(); ?> 
            <?php if( class_exists('TribeEventsRecurrenceMeta') && function_exists('tribe_all_occurences_link')): ?>(<a href='<?php tribe_all_occurences_link(); ?>'>See all</a>)<?php endif; ?></div>
        </div>
		<?php endif; ?>
        
	</div>
    <div class="span6" itemprop="location" itemscope itemtype="http://schema.org/Place">
		<?php if(tribe_get_venue()) : ?>
        <div class="row-fluid">
            <div class="span3 event-label event-label-venue"><?php _e('Venue:', 'tribe-events-calendar'); ?></div> 
            <div class="span9 event-meta event-meta-venue" itemprop="name">
                <?php if( class_exists( 'TribeEventsPro' ) ): ?>
                    <?php tribe_get_venue_link( get_the_ID(), class_exists( 'TribeEventsPro' ) ); ?>
                <?php else: ?>
                    <?php echo tribe_get_venue( get_the_ID() ); ?>
                <?php endif; ?>
            </div>
        </div>
		<?php endif; ?>
		<?php if(tribe_get_phone()) : ?>
        
        <div class="row-fluid">
			<div class="span3 event-label event-label-venue-phone"><?php _e('Phone:', 'tribe-events-calendar'); ?></div> 
			<div class="span9 event-meta event-meta-venue-phone" itemprop="telephone"><?php echo tribe_get_phone(); ?></div>
        </div>
		<?php endif; ?>
		<?php if( tribe_address_exists( get_the_ID() ) ) : ?>
        
        <div class="row-fluid">
		<div class="span3 event-label event-label-address">
			<?php _e('Address:', 'tribe-events-calendar') ?>
		</div>
			<div class="span9 event-meta event-meta-address"><?php echo tribe_get_full_address( get_the_ID() ); ?>
			<?php if( tribe_show_google_map_link( get_the_ID() ) ) : ?>
				<div class="google-map"><a class="btn-red" itemprop="maps" href="<?php echo tribe_get_map_link(); ?>" title="<?php _e('Click to view a Google Map', 'tribe-events-calendar'); ?>" target="_blank"><i class="icon-chevron-right"></i><?php _e('Google Map', 'tribe-events-calendar' ); ?></a></div>
			<?php endif; ?></div>
         </div>
		<?php endif; ?>
	</div>
  
    <div class="row-fluid pad-one-t">	<?php if( tribe_embed_google_map( get_the_ID() ) ) : ?>
<?php if( tribe_address_exists( get_the_ID() ) ) { echo tribe_get_embedded_map(); } ?>
<?php endif; ?>
<?php if( function_exists('tribe_get_single_ical_link') ): ?>
   <a class="ical single btn-red" href="<?php echo tribe_get_single_ical_link(); ?>"><?php _e('iCal Import', 'tribe-events-calendar'); ?></a>
<?php endif; ?>
<?php if( function_exists('tribe_get_gcal_link') ): ?>
   <a href="<?php echo tribe_get_gcal_link(); ?>" class="gcal-add btn-red" title="<?php _e('Add to Google Calendar', 'tribe-events-calendar'); ?>"><?php _e('+ Google Calendar', 'tribe-events-calendar'); ?></a>
<?php endif; ?></div>
    </div>

  
   	<?php if( function_exists('tribe_the_custom_fields') && tribe_get_custom_fields( get_the_ID() ) ): ?>
	  	<?php tribe_the_custom_fields( get_the_ID() ); ?>
	<?php endif; ?>
</div>
<div class="row-fluid"><div class="span4"><a class="btn-blue" href="<?php echo tribe_get_events_link(); ?>"><i class="icon-chevron-left"></i><?php _e('Back to Events', 'tribe-events-calendar'); ?></a></div></div>		


