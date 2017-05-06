<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
//
// Header functions
//

global $n2mu_js_params;

// Get header layout
function n2mu_get_header_layout() {

    $layout = n2mu_get_option( 'header-layout', NULL, 'header-custom' );

    $layouts = array(
        'header1'   =>  array(
            'classes'       => 'header1',
            'class_wrapper' => '',
            'top-fullwidth' => false,
            'top-left'      => '',
            'top-center'    => '',
            'top-right'     => '',
            'middle-fullwidth' => false,
            'middle-left'   => 'logo',
            'middle-center' =>  '',
            'middle-right'  =>  array('menu', 'tools'),
            'bottom-fullwidth' => false,
            'bottom-left'   =>  '',
            'bottom-center' =>  '',
            'bottom-right'  =>  '',
            ),
        'header2'   =>  array(
            'classes'       => 'header2',
            'class_wrapper' => '',
            'top-fullwidth' => false,
            'top-left'      => '',
            'top-center'    => '',
            'top-right'     => '',
            'middle-fullwidth' => true,
            'middle-left'   => '',
            'middle-center' =>  'logo',
            'middle-right'  =>  '',
            'bottom-fullwidth' => false,
            'bottom-left'   =>  '',
            'bottom-center' =>  array('menu', 'tools'),
            'bottom-right'  =>  '',
            ),
        'header3'   =>  array(
            'classes'       => 'header3',
            'class_wrapper' => '',
            'top-fullwidth' => false,
            'top-left'      => '',
            'top-center'    => '',
            'top-right'     => '',
            'middle-fullwidth' => false,
            'middle-left'   => 'logo',
            'middle-center' =>  '',
            'middle-right'  =>  array('menu', 'menu_holder', 'tools'),
            'bottom-fullwidth' => false,
            'bottom-left'   =>  '',
            'bottom-center' =>  '',
            'bottom-right'  =>  '',
            ),
        'header4'   =>  array(
            'classes'       => 'header4',
            'class_wrapper' => '',
            'top-fullwidth' => false,
            'top-left'      => 'menu_widget_left',
            'top-center'    => '',
            'top-right'     => 'menu_widget_right',
            'middle-fullwidth' => false,
            'middle-left'   => 'logo',
            'middle-center' =>  '',
            'middle-right'  =>  array('menu', 'tools'),
            'bottom-fullwidth' => false,
            'bottom-left'   =>  '',
            'bottom-center' =>  '',
            'bottom-right'  =>  '',
            ),
        'header5'   =>  array(
            'classes'       => 'header5',
            'class_wrapper' => '',
            'top-fullwidth' => false,
            'top-left'      => '',
            'top-center'    => '',
            'top-right'     => '',
            'middle-fullwidth' => false,
            'middle-left'   => 'menu_right',
            'middle-center' =>  'logo',
            'middle-right'  =>  array('menu_left', 'tools'),
            'bottom-fullwidth' => false,
            'bottom-left'   =>  '',
            'bottom-center' =>  '',
            'bottom-right'  =>  '',
            ),
        'header6'   =>  array(
            'classes'       => 'header6',
            'class_wrapper' => '',
            'top-fullwidth' => false,
            'top-left'      => 'menu_widget_left',
            'top-center'    => '',
            'top-right'     => 'menu_widget_right',
            'middle-fullwidth' => false,
            'middle-left'   => 'logo',
            'middle-center' =>  '',
            'middle-right'  =>  array('menu', 'tools'),
            'bottom-fullwidth' => false,
            'bottom-left'   =>  'menu_bottom',
            'bottom-center' =>  '',
            'bottom-right'  =>  '',
            ),
       /* temporary disabled - TODO
        'header7'   =>  array(
            'classes'       => 'header7',
            'class_wrapper' => 'menu-side-left',
            'top-fullwidth' => false,
            'top-left'      => '',
            'top-center'    => '',
            'top-right'     => '',
            'middle-fullwidth' => false,
            'middle-left'   => 'logo',
            'middle-center' =>  'menu',
            'middle-right'  =>  array('tools', 'menu_widget_right'),
            'bottom-fullwidth' => false,
            'bottom-left'   =>  '',
            'bottom-center' =>  '',
            'bottom-right'  =>  '',
            ),
        'header8'   =>  array(
            'classes'       => 'header8',
            'class_wrapper' => 'menu-side-right',
            'top-fullwidth' => false,
            'top-left'      => '',
            'top-center'    => '',
            'top-right'     => '',
            'middle-fullwidth' => false,
            'middle-left'   => 'logo',
            'middle-center' =>  'menu',
            'middle-right'  =>  array('tools', 'menu_widget_right'),
            'bottom-fullwidth' => false,
            'bottom-left'   =>  '',
            'bottom-center' =>  '',
            'bottom-right'  =>  '',
            ), */
    );

    
    if(!$layout) {
        return $layouts['header1'];
    } else {
        return $layouts[$layout];
    }

    
}

// Get header element
function n2mu_get_header_elem($element) {

    if(!$element) {
        return;
    }

    $elements = array(
        'logo'              =>  array('templates/elements/logo', 'default'),
        'menu'              =>  array('templates/elements/menu', 'default'),
        'menu_left'         =>  array('templates/elements/menu', 'left'),
        'menu_right'        =>  array('templates/elements/menu', 'right'),
        'menu_bottom'        =>  array('templates/elements/menu', 'bottom'),
        'menu_holder'       =>  array('templates/elements/menu', 'holder'),
        'menu_widget_right' =>  array('templates/elements/menu', 'widgetright'),
        'menu_widget_left'  =>  array('templates/elements/menu', 'widgetleft'),
        'tools'             =>  array('templates/elements/menu', 'tools'),
    );

    // Check if $element is array and get all elements of array or get single element
    if(is_array($element)) { 
        foreach ($element as $elem) {
            get_template_part($elements[$elem][0], $elements[$elem][1]);
        }
    } else {
        get_template_part($elements[$element][0], $elements[$element][1]);
    }
    
}

// Get header classes
function n2mu_get_header_classes() {
    $header_layout = n2mu_get_header_layout();
    return $header_layout['classes'];
}

// Set header classes for wrapper - TODO with side menu
// function n2mu_set_header_wrapper_classes() {
//     $header_layout = n2mu_get_header_layout();
//     return $header_layout['class_wrapper'];
// }

// Get menu
function n2mu_get_nav_menu($menu){

    if ($menu == 'mobile_menu') {
        if ( has_nav_menu( 'main_menu' ) AND !has_nav_menu( 'mobile_menu' ) ) { // setup main manu as mobile menu
            $args = array( 
                'container' 		=> 'nav',
                'container_id'		=> '',
                'container_class'   => 'n-menu-wrap n-mobile-menu-wrap',
                'menu_class'		=> $menu,
                'depth' 			=> 5,
                'link_before'     	=> '<span>',
                'link_after'      	=> '</span>',
                'theme_location'	=> 'main_menu',
                'fallback_cb'       => false
            );
        } else { // mobile menu is setup
           $args = array( 
                'container' 		=> 'nav',
                'container_id'		=> '', 
                'container_class'   => 'n-menu-wrap n-mobile-menu-wrap',
                'menu_class'		=> $menu,
                'depth' 			=> 5,
                'link_before'     	=> '<span>',
                'link_after'      	=> '</span>',
                'theme_location'	=> 'mobile_menu',
                'fallback_cb'       => false
            ); 
        }
    } else { // get other menus
        $args = array( 
                'container' 		=> 'nav',
                'container_id'		=> '',
                'container_class'   => 'n-menu-wrap n-desktop-menu-wrap',
                'menu_class'		=> $menu,
                'depth' 			=> 5,
                'link_before'     	=> '<span>',
                'link_after'      	=> '</span>',
                'theme_location'	=> $menu,
                'fallback_cb'       => false
            );
    }

	wp_nav_menu( $args ); 
}

function n2mu_add_search_footer() { ?>
    <div class="n2mu-search-holder">
        <div class="n2mu-search-close-holder">
            <div class="n2mu-search-close-wrapper">
                <a class="n2mu-search-close" href="javascript:void(0)">
                    <i class="fa fa-close"></i>
                </a>
            </div>
        </div>

        <div class="n2mu-search-wrapper">
            <div class="n2mu-search">
                <form method="get" action="<?php echo esc_url( home_url( '/' ) )?>" role="search" class="">
                    <div class="form-group">
                        <input type="search" name="s" autocomplete="off" class="form-control n2mu-search-field" placeholder="<?php echo esc_html__( 'Search...', 'magnat' )?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php 
}

