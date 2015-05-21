<?php
// Homepage Options Dashboard Menu
function summer_control_menu() {
  add_menu_page( 'Homepage Options', 'Homepage Options', 'edit_posts', 'home-menu', null,'', 30 );
}

add_action('admin_menu', 'summer_control_menu');
// Custom Post Types

add_action( 'init', 'create_new_slides' );
function create_new_slides() {
	// Add Student Types
	$labels = array(
		'name' => 'Slides',
		 'singular_name' => 'Slide',
		 'menu_name' => 'Slides',
		 'add_new' => 'Add Slide',
		 'add_new_item' => 'Add New Slide',
		 'edit' => 'Edit',
		 'edit_item' => 'Edit Slide',
		 'new_item' => 'New Slide',
		 'view' => 'View Slide',
		 'view_item' => 'View Slide',
		 'search_items' => 'Search Slides',
		 'not_found' => 'No Slides Found',
		 'not_found_in_trash' => 'No Slides Found in Trash',
		 'parent' => 'Parent Slide'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Create new slides for Summer @ SU. These are displayed on the homepage',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'slide'),
		'query_var' => true,
		'exclude_from_search' => true,
		'menu_position' => 1,
		'show_in_menu' => 'home-menu',
		'supports' => array('title'),
	);
	register_post_type('slide', $args);
};
// New Modules For Homepage
add_action( 'init', 'create_new_modules' );
function create_new_modules() {
	// Add Modules
	$labels = array(
		'name' => 'Modules',
		 'singular_name' => 'Module',
		 'menu_name' => 'Modules',
		 'add_new' => 'Add Module',
		 'add_new_item' => 'Add New Module',
		 'edit' => 'Edit',
		 'edit_item' => 'Edit Module',
		 'new_item' => 'New Module',
		 'view' => 'View Module',
		 'view_item' => 'View Module',
		 'search_items' => 'Search Modules',
		 'not_found' => 'No Modules Found',
		 'not_found_in_trash' => 'No Modules Found in Trash',
		 'parent' => 'Parent Module'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Create new modules for Summer @ SU. These are displayed on the homepage',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'module'),
		'query_var' => true,
		'exclude_from_search' => true,
		'menu_position' => 2,
		'show_in_menu' => 'home-menu',
		'supports' => array('title', 'editor', 'thumbnail'),
	);
	register_post_type('module', $args);
};
// Register Custom Post Type
add_action( 'init', 'create_new_tabs' );
function create_new_tabs() {
	// Add Student Types
	$labels = array(
		'name' => 'Page Tabs',
		 'singular_name' => 'Page Tab',
		 'menu_name' => 'Page Tabs',
		 'add_new' => 'Add Page Tab',
		 'add_new_item' => 'Add New Page Tab',
		 'edit' => 'Edit',
		 'edit_item' => 'Edit Page Tab',
		 'new_item' => 'New Page Tab',
		 'view' => 'View Page Tab',
		 'view_item' => 'View Page Tab',
		 'search_items' => 'Search Page Tabs',
		 'not_found' => 'No Page Tabs Found',
		 'not_found_in_trash' => 'No Page Tabs Found in Trash',
		 'parent' => 'Parent Page Tab'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Create new page tabs for homepage',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'sections'),
		'query_var' => true,
		'exclude_from_search' => true,
		'menu_position' => 5,
		'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',  // Icon Path
		'supports' => array('title', 'editor'),
	);
	register_post_type('tabs', $args);
};

// Register Custom Taxonomy
function tab_tax()  {
	$labels = array(
		'name'                       => _x( 'Sections', 'Taxonomy General Name', 'summertheme' ),
		'singular_name'              => _x( 'Section', 'Taxonomy Singular Name', 'summertheme' ),
		'menu_name'                  => __( 'Sections', 'summertheme' ),
		'all_items'                  => __( 'All Sections', 'summertheme' ),
		'parent_item'                => __( 'Parent Section', 'summertheme' ),
		'parent_item_colon'          => __( 'Parent Section:', 'summertheme' ),
		'new_item_name'              => __( 'New Section Name', 'summertheme' ),
		'add_new_item'               => __( 'Add New Section', 'summertheme' ),
		'edit_item'                  => __( 'Edit Section', 'summertheme' ),
		'update_item'                => __( 'Update Section', 'summertheme' ),
		'separate_items_with_commas' => __( 'Separate sections with commas', 'summertheme' ),
		'search_items'               => __( 'Search sections', 'summertheme' ),
		'add_or_remove_items'        => __( 'Add or remove sections', 'summertheme' ),
		'choose_from_most_used'      => __( 'Choose from the most used sections', 'summertheme' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);

	register_taxonomy( 'sections', 'tabs', $args );
}
// Hook into the 'init' action
add_action( 'init', 'tab_tax', 0 );
?>