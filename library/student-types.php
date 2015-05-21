<?php
//

// Create Student Type Navigation
// –––––––––––––––––––––––––––––––––––––
function main_student_nav(){
	echo '<ul class="row-fluid" id="main-student" role="navigation">';
    $query = new WP_Query(array( 'post_type' => 'student-type', 'order' => 'ASC'));
    while ( $query->have_posts() ) : $query->the_post();
	$post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
	if ($slug == "quick-links"){
		echo '<li class="the-end"><a class="toggle" data-toggle="collapse" data-parent="#panels" href="#'.$slug.'"><i class="icon-chevron-right"></i>';
	} else {
		echo '<li><a class="toggle" data-toggle="collapse" data-parent="#panels" href="#'.$slug.'"><i class="icon-chevron-right"></i>';
	}
	echo the_title();
	echo '</a></li>';
    endwhile;
	echo '</ul><div class="row-fluid" id="panels">';
	while ( $query->have_posts() ) : $query->the_post();
	$post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
	//echo '<div id="'.$slug.'" class="collapse info-panel"/><div class="pad-one white-bg mar-one-t" >';
	if ($slug == "quick-links"){
		echo '<div id="'.$slug.'" class="collapse info-panel"><div>';
		echo summer_main_nav();
	} else {
		echo '<div id="'.$slug.'" class="collapse info-panel"><div class="pad-one white-bg list-links" >';
		echo student_nav_pop($slug);
	}
	echo '</div></div>';
    endwhile;
	echo '</div>';
}

function second_student_nav(){
	echo '<ul class="student-nav clearfix" id="student-nav" role="navigation">';
    $query = new WP_Query(array( 'post_type' => 'student-type', 'order' => 'ASC', 'post__not_in' => array(165)));
    while ( $query->have_posts() ) : $query->the_post();
	$post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
	echo '<li><a class="toggle" data-toggle="collapse" data-parent="#panels" href="#'.$slug.'"><i class="icon-chevron-right"></i>';
	echo the_title();
	echo '</a></li>';
    endwhile;
	echo '</ul><div class="row-fluid pad-one-tb" id="panels">';
	while ( $query->have_posts() ) : $query->the_post();
	$post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
	echo '<div id="'.$slug.'" class="collapse info-panel"><div class="pad-one white-bg list-links" >';
	echo student_nav_pop($slug);
	echo '</div></div>';
    endwhile;
	echo '</div>';
}
function student_nav_pop($slug){
	echo '<div class="row-fluid">';
	echo '<div class="row-fluid orange-text"><h3 class="block">';
	if (get_field('intro_title')){
		echo get_field('intro_title');
	} else {
		echo the_title();
	}
	echo '</h3></div>';
	echo '<div class="one-third"><div class="copy-block list-links">';
	echo the_field('intro_copy');
	echo '</div></div>';
	echo '<div class="two-thirds">';
	if (get_field('remove_links')){
		$newspan = "one-half";
	} else {
		$newspan = "one-third";
		echo '<div class="'.$newspan.'" id="'.$slug.'-intro"><div class="list-links">';
		echo the_field('intro_links');
		echo '</div></div>';
	}
	echo '<div class="'.$newspan.'" id="'.$slug.'-programs"><div class="list-links">';
	echo '<h4>'.get_field('program_title').'</h4>';
	echo get_field('program_links');
	echo '</div></div>';
	echo '<div class="'.$newspan.'" id="'.$slug.'-resources"><div class="list-links">';
	echo '<h4>'.get_field('resource_title').'</h4>';
	echo get_field('resource_links');
	echo '</div></div>';
	echo '</div></div>';
}
?>