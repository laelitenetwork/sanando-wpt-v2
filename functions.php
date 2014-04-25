<?php
/**
 * Author: L'Elite
 * URL: http://laelitenetwork.com
 */
// Text Domain
load_theme_textdomain( 'sanando', get_template_directory() . '/lang' );
// Add default posts and comments RSS feed links to <head>.
add_theme_support( 'automatic-feed-links' );
// adding post format support
add_theme_support( 'post-formats',      // post formats
	array( 
		'aside',   // title less blurb
		'gallery', // gallery of images
		'link',    // quick link to other site
		'image',   // an image
		'quote',   // a quick quote
		'status',  // a Facebook like status update
		'video',   // video 
		'audio',   // audio
		'chat'     // chat transcript 
	)
);
// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
add_theme_support( 'post-thumbnails' );
// Custom Background
add_theme_support( 'custom-background' );
// Custom Header
add_theme_support( 'custom-header' );
// Menus
add_theme_support( 'menus' );

// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

	 global $wp_query;
	 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	 $class_names = $value = '';

		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;

		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
       
   	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

   	$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
   	$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
   	$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
   	$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

   	// if the item has children add these two attributes to the anchor tag
   	// if ( $args->has_children ) {
		  // $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    // }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
    	$item_output .= '<b class="caret"></b></a>';
    }
    else {
    	$item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function
        
  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
      
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }        
}
// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );
function add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    	$classes[] = "active";
	}
  
  return $classes;
}

function wp_bootstrap_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu( 
    	array( 
    		'menu' => 'main_nav', /* menu name */
    		'menu_class' => 'nav navbar-nav',
    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
    		'container' => 'false', /* container class */
    		'fallback_cb' => 'wp_bootstrap_main_nav_fallback', /* menu fallback */
    		// 'depth' => '2',  suppress lower levels for now 
    		'walker' => new Bootstrap_walker()
    	)
    );
}

register_nav_menus(                      // wp3+ menus
	array( 
		'main_nav' => 'Menu Principal',   // main nav in header
		'footer_links' => 'Enlaces de Pie' // secondary nav in footer
	)
);

// enqueue styles
if( !function_exists("theme_styles") ) {  
    function theme_styles() {
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), '3.1.1', 'all' );
        wp_enqueue_style( 'bootstrap' );
        wp_register_style( 'bootstrap-theme', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap-theme.min.css', array(), '3.1.1', 'all' );
        wp_enqueue_style( 'bootstrap-theme' );
        wp_register_style( 'wpcss', get_template_directory_uri() . '/style.css', array(), '2.0', 'all' );
        wp_enqueue_style( 'wpcss' );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

// enqueue javascript
if( !function_exists( "theme_js" ) ) {  
  function theme_js() {
    wp_register_script( 'bootstrap', 
      get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', 
      array('jquery'), 
      '3.1.1' );
  
    wp_enqueue_script('bootstrap');
  }
}
add_action( 'wp_enqueue_scripts', 'theme_js' );
?>