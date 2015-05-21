<?php

// shortcodes

// Gallery shortcode

// remove the standard shortcode
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_tbs');

function gallery_shortcode_tbs($attr) {
	global $post, $wp_locale;

	$output = "";

	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
	if ($attachments) {
		$output = '<div class="row-fluid"><ul class="thumbnails">';
		foreach ( $attachments as $attachment ) {
			$output .= '<li class="span2">';
			$att_title = apply_filters( 'the_title' , $attachment->post_title );
			$output .= wp_get_attachment_link( $attachment->ID , 'thumbnail', true );
			$output .= '</li>';
		}
		$output .= '</ul></div>';
	}

	return $output;
}



// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'color' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'url'  => '',
	'text' => '',
	'subtext' => '',
	'blank' => false,
	'icon'=>'',
	), $atts ) );
	
	if($color == "default"){
		$color = "btn-clear";
	}
	else{ 
		$color = "btn-" . $color;
	}
	if($blank == false){
		$blank = "_self";
	}
	else{ 
		$blank = "_blank";
	}
	if(! $icon){
		$icon = "icon-chevron-right";
	}
	
		
	$output = '<a href="' . $url . '" class="'. $color . '" target="'.$blank.'" title="'.$text.'" role="button">';
	$output .= '<i class="' . $icon . '"></i>';
	$output .= $text;
	if($subtext){
		$output .= '<small>';
		$output .= $subtext;
		$output .= '</small>';
	}
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'buttons'); 

// Alerts
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('block-message', 'block_messages'); 

// Block Messages
function blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'blockquotes'); 
 
// Links
function show_links($atts, $content = null){
	extract( shortcode_atts( array(
	'cat'  => '',
	'class' => '',
	'icon' => '',
	'exclude' => '',
	), $atts ) );
	$bookmarks = mylinkorder_get_bookmarks( 
		array(
			'category_name'  => $cat,
			'order' => 'ASC',
			'orderby' => 'order',
			'exclude' => $exclude,
    	)
	);
	$output = "";
	if (! $class){
		$output .= '<ul role="navigation">';
	} else {
		$output .= '<div class="pad-one-l"><ul role="navigation">';
	}
	foreach ( $bookmarks as $bm ) { 
    	if (! $class){
			$output .= '<li>';
		}
		$output .= '<a class="'.$class.'" href="'.$bm->link_url.'" role="button">';
		if ($class){
			if ($icon){
				$output .= '<i class="'.$icon.'"></i>';
			} else {
				$output .= '<i class="icon-chevron-right"></i>';
			}
		}
		$output .= $bm->link_name;
		$output .= '</a>';
		if (! $class){
			$output .= '</li>';
		}
	}
	if (! $class){	
		$output .= '</ul>';
	} else {
		$output .= '</ul></div>';
	}
	return $output;
}
add_shortcode('display-links', 'show_links'); 

// Tabs
function show_tabs($atts, $content = null){
	extract( shortcode_atts( array(
	'section'  => '',
	'exclude' => '',
	), $atts ) );
	
    
	return $output;
}
add_shortcode('display-tabs', 'show_tabs'); 
?>