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
// Register sidebars
if( function_exists('register_sidebar') ) {
    register_sidebar(array('name'=> sprintf(__('Sidebar Blog','sanando')), 'id' => 'sidebar-blog'));
}
// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu {

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
   	if ( $args->has_children ) {
      $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    }

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
        wp_register_style( 'bootstrap', 'http://staticelite.info/elitenetwork/assets/bootstrap-3.1.1/css/bootstrap.min.css', array(), '3.1.1', 'all' );
        wp_enqueue_style( 'bootstrap' );
        wp_register_style( 'bootstrap-theme', 'http://staticelite.info/elitenetwork/assets/bootstrap-3.1.1/css/bootstrap-theme.min.css', array(), '3.1.1', 'all' );
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
      'http://staticelite.info/elitenetwork/assets/bootstrap-3.1.1/js/bootstrap.min.js', 
      array('jquery'), 
      '3.1.1' );
    wp_register_script( 'picturefill',
      'http://staticelite.info/elitenetwork/scripts/picturefill-1.2.1.js',
      '',
      '1.2.1'
    );
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('picturefill');
  }
}
add_action( 'wp_enqueue_scripts', 'theme_js' );
/**
 * Theme Options
 */
function sanando_customize_register( $wp_customize ) {
  // Front End Section
  $wp_customize->add_section( 'sanando_front_end' , array(
    'title'      => __( 'Opciones de Sanando', 'sanando' ),
    'priority'   => 0,
  ) );
  // Jumbotron Quote
  $wp_customize->add_setting( 'jumbotron_hpquote' , array(
    'id'          => 'jumbotron_hpquote',
    'default'     => 'Frase',
    'transport'   => 'refresh',
  ) );
  // Control
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'jumbotron_hpquote',
      array(
        'label'          => __( 'Frase de Entrada', 'sanando' ),
        'section'        => 'sanando_front_end',
        'settings'       => 'jumbotron_hpquote',
        'type'           => 'text',
      )
    )
  );
  // Jumbotron Homepage Call to Action
  $wp_customize->add_setting( 'jumbotron_hpcalltoaction' , array(
    'id'          => 'jumbotron_hpcalltoaction',
    'default'     => 'Llamada a la Acción',
    'transport'   => 'refresh',
  ) );
  // Control
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'jumbotron_hpcalltoaction',
      array(
        'label'          => __( 'Título del Botón', 'sanando' ),
        'section'        => 'sanando_front_end',
        'settings'       => 'jumbotron_hpcalltoaction',
        'type'           => 'text',
      )
    )
  );
  // Jumbotron Homepage Call to Action Link
  $wp_customize->add_setting( 'jumbotron_hpcalltoaction_link' , array(
    'id'          => 'jumbotron_hpcalltoaction_link',
    'default'     => 'Enlace de Llamada a la Acción',
    'transport'   => 'refresh',
  ) );
  // Control
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'jumbotron_hpcalltoaction_link',
      array(
        'label'          => __( 'Enlace del Botón', 'sanando' ),
        'section'        => 'sanando_front_end',
        'settings'       => 'jumbotron_hpcalltoaction_link',
        'type'           => 'dropdown-pages',
      )
    )
  );
  // Cuenta Medicamentos
  $wp_customize->add_setting( 'medicamentos_donados' , array(
    'id'          => 'medicamentos_donados',
    'default'     => 'Cantidad de Medicamentos Donados',
    'transport'   => 'refresh',
  ) );
  // Control
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'medicamentos_donados',
      array(
        'label'          => __( 'Medicamentos Donados', 'sanando' ),
        'section'        => 'sanando_front_end',
        'settings'       => 'medicamentos_donados',
        'type'           => 'text',
      )
    )
  );
  // Alertas
  $wp_customize->add_setting( 'homepage_alert' , array(
    'id'          => 'homepage_alert',
    'default'     => 'Esta es una <strong>alerta al Público</strong>',
    'transport'   => 'refresh',
  ) );
  // Control
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'homepage_alert',
      array(
        'label'          => __( 'Alerta al Público', 'sanando' ),
        'section'        => 'sanando_front_end',
        'settings'       => 'homepage_alert',
        'type'           => 'text',
      )
    )
  );
}
add_action( 'customize_register', 'sanando_customize_register' );
/**
 * Picturefill Async
 */
function defer_parsing_of_js ( $url ) {
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( !strpos( $url, 'picturefill.js' ) ) return $url;
    return "$url' async='async";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
/**
 * Breadcrumbs
 */
function the_breadcrumb() {
    global $post;
    echo '<ol class="breadcrumb">';
      if (  !is_home() || !is_front_page()  ) {
          echo '<li><a href="';
            echo get_option('home');
          echo '">';
            echo __('Inicio', 'sanando');
          echo '</a></li>';
          if( is_post_type_archive() ) {
            echo '<li>';
              echo post_type_archive_title();
            echo '</li>';
          }
          if (  is_category() || is_single() ) {
              if( get_post_type() != 'post' || get_post_type() != 'page' ) {
                echo '<li><a href="';
                  echo get_option('home');
                echo '/'.get_post_type().'">';
                echo ucwords( get_post_type() );
                echo '</a></li>';
              } else {
                echo '<li>';
                  echo the_category(' </li><li> ');
                echo '</li>';
              }
              if (is_single()) {
                  echo '</li><li>';
                    the_title();
                  echo '</li>';
              }
          } elseif (  is_page() ) {
             if( $post->post_parent  ) {
                  $anc = get_post_ancestors( $post->ID );
                  $title = get_the_title();
                  foreach ( $anc as $ancestor ) {
                      $output[] = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>';
                  }
                  $output = array_reverse( $output );
                  foreach ($output as $key => $value) {
                    echo $value;
                  }
                  echo '<li><strong>'.$title.'</strong></li>';
              } else {
                  echo '<li><strong>'.get_the_title().'</strong></li>';
              }
          }
      }
      elseif (  is_tag()  ) { single_tag_title(); }
      elseif (  is_day()  ) { echo "<li>".__('Archivo','sanando')." "; the_time('F jS, Y'); echo '</li>'; }
      elseif (  is_month()  ) { echo "<li>".__('Archivo','sanando')." "; the_time('F, Y'); echo '</li>'; }
      elseif (  is_year() ) {  echo "<li>".__('Archivo','sanando')." "; the_time('Y'); echo '</li>'; }
      elseif (  is_author() ) {  echo"<li>".__('Autor','sanando')." "; echo '</li>'; }
      elseif (  isset($_GET['paged']) && !empty($_GET['paged']) ) {  echo "<li>".__('Archivos','sanando'); echo '</li>'; }
      elseif (  is_search() ) { echo "<li>".__('Resultados','sanando'); echo '</li>'; }
    echo '</ol>';
}
/**
 * Disqus Comments
 */
function disqus_lazyload() {
  wp_register_script('disqus', 'http://staticelite.info/elitenetwork/scripts/disqus_lazyload.js');
  wp_enqueue_script('disqus');
}
add_action('wp_footer', 'disqus_lazyload');
/**
 * Login
 */
function my_login_stylesheet() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/style.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(http://staticelite.info/sanando/images/logo_80.png);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
/**
 * The formatted output of a list of pages.
 *
 * Displays page links for paginated posts (i.e. includes the "nextpage".
 * Quicktag one or more times). This tag must be within The Loop.
 *
 * The defaults for overwriting are:
 * 'next_or_number' - Default is 'number' (string). Indicates whether page
 *      numbers should be used. Valid values are number and next.
 * 'nextpagelink' - Default is 'Next Page' (string). Text for link to next page.
 *      of the bookmark.
 * 'previouspagelink' - Default is 'Previous Page' (string). Text for link to
 *      previous page, if available.
 * 'pagelink' - Default is '%' (String).Format string for page numbers. The % in
 *      the parameter string will be replaced with the page number, so Page %
 *      generates "Page 1", "Page 2", etc. Defaults to %, just the page number.
 * 'before' - Default is '<p id="post-pagination"> Pages:' (string). The html 
 *      or text to prepend to each bookmarks.
 * 'after' - Default is '</p>' (string). The html or text to append to each
 *      bookmarks.
 * 'text_before' - Default is '' (string). The text to prepend to each Pages link
 *      inside the <a> tag. Also prepended to the current item, which is not linked.
 * 'text_after' - Default is '' (string). The text to append to each Pages link
 *      inside the <a> tag. Also appended to the current item, which is not linked.
 *
 * @param string|array $args Optional. Overwrite the defaults.
 * @return string Formatted output in HTML.
 */
function custom_wp_link_pages( $args = '' ) {
    $defaults = array(
        'before' => '<div class="pagination">',
        'after' => '</div>',
        'text_before' => '',
        'text_after' => '',
        'next_or_number' => 'number', 
        'pagelink' => '%',
        'echo' => 1
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    $output = '';
    if ( $multipage ) {
        if ( 'number' == $next_or_number ) {
            $output .= $before;
            for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
                $j = str_replace( '%', $i, $pagelink );
                $output .= ' ';
                if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
                    $output .= _wp_link_page( $i );
                else
                    $output .= '<span class="current">';

                $output .= $text_before . $j . $text_after;
                if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
                    $output .= '</a>';
                else
                    $output .= '</span>';
            }
            $output .= $after;
        } else {
            if ( $more ) {
                $output .= $before;
                $i = $page - 1;
                if ( $i && $more ) {
                    $output .= _wp_link_page( $i );
                    $output .= $text_before . $previouspagelink . $text_after . '</a>';
                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                    $output .= _wp_link_page( $i );
                    $output .= $text_before . $nextpagelink . $text_after . '</a>';
                }
                $output .= $after;
            }
        }
    }

    if ( $echo )
        echo $output;

    return $output;
}
/**
 * Pagination
 */
function kriesi_pagination($pages = '', $range = 2) {  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}
?>