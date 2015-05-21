<?php
/*
Author: Eddie Machado
URL: htp://themble.com/summer/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get summer Core Up & Running!
require_once('library/summer.php');            // core functions (don't remove)
//require_once('library/student-types.php');          // Student Type Navs
require_once('library/plugins.php');          // plugins & extra functions (optional)

// Post Types
require_once('library/post-types.php');

// Shortcodes
require_once('library/shortcodes.php');

// Extras
require_once('library/extras.php');

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

// Custom Backend Footer
add_filter('admin_footer_text', 'summer_custom_admin_footer');
function summer_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://320press.com" target="_blank">320press</a></span>. Built using <a href="http://themble.com/summer" target="_blank">summer</a>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'summer_custom_admin_footer');

// Set content width
if ( ! isset( $content_width ) ) $content_width = 580;

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'summer-slide', 800, 533, true );
add_image_size( 'summer-featured', 640, 960, false);
add_image_size( 'summer-row', 360, 480, true);
add_image_size( 'summer-thumb-600', 600, 150, false );
add_image_size( 'summer-thumb-300', 300, 100, true );
add_image_size( 'feature-thumb', 300, 225, true );
add_image_size( 'sidebar-thumb', 400, 300, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'summer-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'summer-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function summer_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Main Sidebar',
    	'description' => 'Used on every page BUT the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Homepage Sidebar',
    	'description' => 'Used only on the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function summer_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard row-fluid clearfix">
				<div class="avatar span2">
					<?php echo get_avatar($comment,$size='75',$default='<path_to_url>' ); ?>
				</div>
				<div class="span10 comment-text">
					<?php printf(__('<h4>%s</h4>','summertheme'), get_comment_author_link()) ?>
					<?php edit_comment_link(__('Edit','summertheme'),'<span class="edit-comment btn btn-small btn-info"><i class="icon-white icon-pencil"></i>','</span>') ?>
                    
                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','summertheme') ?></p>
          				</div>
					<?php endif; ?>
                    
                    <?php comment_text() ?>
                    
                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                    
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php 

}

// Only display comments in comment count (which isn't currently displayed in wp-bootstrap, but i'm putting this in now so i don't forget to later)
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
	    $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
	    return count($comments_by_type['comment']);
	} else {
	    return $count;
	}
}

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function summer_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'summertheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search the Site..." />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search','summertheme') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

/****************** password protected post form *****/

add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . __( "<p>This post is password protected. To view it please enter your password below:</p>" ,'summertheme') . '
	<label for="' . $label . '">' . __( "Password:" ,'summertheme') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'summertheme' ) . '" /></div>
	</form></div>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}



// filter tag clould output so that it can be styled by CSS
function add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";
        foreach( $tags as $tag ) {
        	$tagn[] = preg_replace($regex, "('$1$2 label tag-'.get_tag($2)->slug.'$3')", $tag );
        }
    $taglinks = implode('</a>', $tagn);
    return $taglinks;
}

add_action('wp_tag_cloud', 'add_tag_class');

add_filter('wp_tag_cloud','wp_tag_cloud_filter', 10, 2);

function wp_tag_cloud_filter($return, $args)
{
  return '<div id="tag-cloud">'.$return.'</div>';
}

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Disable jump in 'read more' link
function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Add thumbnail class to thumbnail links
function add_class_attachment_link($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a class="thumbnail"',$html);
    return $html;
}
add_filter('wp_get_attachment_link','add_class_attachment_link',10,1);



// Menu output mods
/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Roots_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */

class Roots_Nav_Walker extends Walker_Nav_Menu {
 
  function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
	$output .= "\n<ul class=\"accordion-menu\">\n";
  }

   function end_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "</ul>\n</div>\n</div>\n</div>\n";
  }
  function end_el(&$output, $depth = 0, $args = array()) {
    $output .= "</li>\n";
	
  }
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    global $wp_query;
	$indent = ($depth) ? str_repeat("\t", $depth) : '';
	$slug = sanitize_title($item->title);
    $id = 'menu-' . $slug;

    $class_names = $value = '';
    $li_attributes = '';
    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes = array_filter($classes, array(&$this, 'check_current'));

    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = $class_names ? ' class="' . $id . ' ' . esc_attr($class_names) . '"' : ' class="' . $id . '"';

    if ($args->has_children){
		$output .= "<div class=\"accordion-group\">\n";
        $output .= "<div class=\"accordion-heading\">\n";
        $output .= "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#acc-menu-$args->theme_location\" href=\"#acc-" . sanitize_title($item->title) . "\">\n";
        $output .= '<i class="icon-chevron-right"></i>'.$item->title ."\n </a>\n</div>";
        $output .= "<div id=\"acc-" . sanitize_title($item->title) . "\" class=\"accordion-body collapse\">\n";
        $output .= "<div class=\"accordion-inner accordion-".sanitize_title($item->title) ."\">\n";
		
    }
	else if ($depth == 0) {
		$output .= "<div class=\"accordion-group\">\n";
        $output .= "<div class=\"accordion-heading\">\n";
		$output .= '<a class="accordion-toggle" href="'.$item->url.'">';
        $output .= '<i class="icon-chevron-right"></i>'.$item->title ."\n </a>\n</div>\n</div>";		
    }else {
    $output .= $indent . '<li' . $class_names . '>';
	
	
    $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
    $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
    $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
    $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';

    $item_output  = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= ($args->has_children && $depth == 0);
    $item_output .= '</a>';
    $item_output .= $args->after;
    }
    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 2, $args, &$output) {
    if (!$element) { return; }

    $id_field = $this->db_fields['id'];

    if (is_array($args[0])) {
      $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
    } elseif (is_object($args[0])) {
      $args[0]->has_children = !empty($children_elements[$element->$id_field]);
    }

    $cb_args = array_merge(array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'start_el'), $cb_args);

    $id = $element->$id_field;

    if (($max_depth == 0 || $max_depth > $depth+1) && isset($children_elements[$id])) {
      foreach ($children_elements[$id] as $child) {
        if (!isset($newlevel)) {
          $newlevel = true;
          $cb_args = array_merge(array(&$output, $depth), $args);
          call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
		  
        }
		
        $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
      }
      unset($children_elements[$id]);
    }

    if (isset($newlevel) && $newlevel) {
      $cb_args = array_merge(array(&$output, $depth), $args);
      call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
    }

    $cb_args = array_merge(array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'end_el'), $cb_args);
  }
}
// Menu output mods
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			$class_names = $value = '';
			
			// If the item has children, add the dropdown class for bootstrap
			if ( $args->has_children ) {
				$class_names = "dropdown ";
			}
			
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( $class_names ) . '"';
           
           	$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           	$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           	$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           	$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           	$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
           	// if the item has children add these two attributes to the anchor tag
           	if ( $args->has_children ) {
				$attributes .= 'class="dropdown-toggle" data-toggle="dropdown"';
			}

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            // if the item has children add the caret just before closing the anchor tag
            
            $item_output .= '</a>';
            
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
            
        function start_lvl(&$output, $depth) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"show-me\">\n";
        }
            
      	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
      	    {
      	        $id_field = $this->db_fields['id'];
      	        if ( is_object( $args[0] ) ) {
      	            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
      	        }
      	        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
      	    }
      	
            
}

/**
 * Cleanup wp_nav_menu_args
 *
 * Remove the container
 * Use Roots_Nav_Walker() by default
 */
function roots_nav_menu_args($args = '') {
  $roots_nav_menu_args['container']  = false;
  $roots_nav_menu_args['items_wrap'] = '<div id="acc-menu-'. $args[theme_location] .'" class="%2$s">%3$s</div>';
  if (current_theme_supports('bootstrap-top-navbar')) {
    $roots_nav_menu_args['depth'] = 2;
  }

  if (!$args['walker']) {
    $roots_nav_menu_args['walker'] = new Roots_Nav_Walker();
  }

  return array_merge($args, $roots_nav_menu_args);
}

add_filter('wp_nav_menu_args', 'roots_nav_menu_args');

add_editor_style('editor-style.css');

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item

add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );
function add_active_class($classes, $item) {
	if($item->menu_item_parent == 0 && in_array('current-menu-item', $classes)) {
        $classes[] = "active";
	}
    return $classes;
}

// enqueue styles

function theme_styles()  
{ 
    // This is the compiled css file from LESS - this means you compile the LESS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
	//CSS
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap.css', array(), '1.0', 'all' );
    wp_register_style( 'bootstrap-responsive', get_template_directory_uri() . '/library/css/responsive.css', array(), '1.0', 'all' );
    wp_register_style( 'wp-bootstrap', get_template_directory_uri() . '/style.css', array(), '1.0', 'all' );
	//JS
	wp_deregister_script('jquery'); // initiate the function  
  	wp_register_script('jquery', get_template_directory_uri().'/library/js/libs/jquery-1.9.0.min.js', false, '1.9.0');
	wp_register_script('modernizr', get_template_directory_uri().'/library/js/modernizr.full.min.js');
	wp_register_script('fit-maps', get_template_directory_uri().'/library/js/fitmaps.js');
    //CSS
    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_style( 'bootstrap-responsive' );
    wp_enqueue_style( 'wp-bootstrap');
	//JS
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', array('jQuery'), '2.0.6', true);
	wp_enqueue_script('fit-maps', array('jQuery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_styles');

// enqueue javascript

function theme_js(){
  //wp_register_script('less', get_template_directory_uri().'/library/js/less-1.3.0.min.js');
  wp_register_script('bootstrap-button', get_template_directory_uri().'/library/js/bootstrap-button.js');
  wp_register_script('bootstrap-carousel', get_template_directory_uri().'/library/js/bootstrap-carousel.js');
  wp_register_script('bootstrap-collapse', get_template_directory_uri().'/library/js/bootstrap-collapse.js');
  wp_register_script('bootstrap-dropdown', get_template_directory_uri().'/library/js/bootstrap-dropdown.js');
  wp_register_script('bootstrap-alert', get_template_directory_uri().'/library/js/bootstrap-alert.js');
  //wp_register_script('bootstrap-modal', get_template_directory_uri().'/library/js/bootstrap-modal.js');
  //wp_register_script('bootstrap-popover', get_template_directory_uri().'/library/js/bootstrap-popover.js');
  //wp_register_script('bootstrap-scrollspy', get_template_directory_uri().'/library/js/bootstrap-scrollspy.js');
  wp_register_script('bootstrap-tab', get_template_directory_uri().'/library/js/bootstrap-tab.js');
  //wp_register_script('bootstrap-tooltip', get_template_directory_uri().'/library/js/bootstrap-tooltip.js');
  wp_register_script('bootstrap-transition', get_template_directory_uri().'/library/js/bootstrap-transition.js');
  //wp_register_script('bootstrap-typeahead', get_template_directory_uri().'/library/js/bootstrap-typeahead.js');
  //wp_register_script('bootstrap-affix', get_template_directory_uri().'/library/js/bootstrap-affix.js');
  wp_register_script('retina', get_template_directory_uri().'/library/js/retina.js');
  wp_register_script('wpbs-scripts', get_template_directory_uri().'/library/js/scripts.js');
 

  //wp_enqueue_script('less', array(''), '1.3.0', true);
  
  wp_enqueue_script('bootstrap-transition', array('jQuery'), '2.2.2', true);
  wp_enqueue_script('bootstrap-alert', array('jQuery'), '2.2.2', true);
  //wp_enqueue_script('bootstrap-modal', array('jQuery'), '2.2.2', true);
  wp_enqueue_script('bootstrap-dropdown', array('jQuery'), '2.2.2', true);
  //wp_enqueue_script('bootstrap-scrollspy', array('jQuery'), '2.2.2', true);
  wp_enqueue_script('bootstrap-tab', array('jQuery'), '2.2.2', true);
  //wp_enqueue_script('bootstrap-tooltip', array('jQuery'), '2.2.2', true);
  //wp_enqueue_script('bootstrap-popover', array('jQuery'), '2.2.2', true);
  wp_enqueue_script('bootstrap-button', array('jQuery'), '2.2.2', true);
  wp_enqueue_script('bootstrap-collapse', array('jQuery'), '2.2.2', true);
  wp_enqueue_script('bootstrap-carousel', array('jQuery'), '2.2.2', true);
  //wp_enqueue_script('bootstrap-typeahead', array('jQuery'), '2.2.2', true);
  //wp_enqueue_script('bootstrap-affix', array('jQuery'), '2.2.2', true); 
  wp_enqueue_script('retina', array('jQuery'), '1.0', true);
  wp_enqueue_script('wpbs-scripts', array('jQuery'), '1.0', true);

}
add_action('wp_footer', 'theme_js');

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
	
    return 'class="btn-orange"';
}

?>
