<?php
    /**
     * N2mu theme options config
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    if ( !function_exists( 'n2mu_change_demo_directory_path' ) ) {
        /**
        * Change the path to the directory that contains demo data folders.
        */
        function n2mu_change_demo_directory_path( $demo_directory_path ) {
            $demo_directory_path = get_template_directory().'/demo-import/';
            return $demo_directory_path;
        }
        add_filter('wbc_importer_dir_path', 'n2mu_change_demo_directory_path' );
    }

    add_action( 'redux/construct', 'n2mu_redux_remove_as_plugin_flag' );

    function n2mu_redux_remove_as_plugin_flag() {
        ReduxFramework::$_as_plugin = false;
    }

    // Set homepage and menu after import

if ( !function_exists( 'n2mu_extended_import' ) ) {
	function n2mu_extended_import( $demo_active_import , $demo_directory_path ) {
		reset( $demo_active_import );
		$current_key = key( $demo_active_import );
		/************************************************************************
		* Setting Menus
		*************************************************************************/
		$wbc_menu_array = array( 'main');
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
            $header_bottom_menu = get_term_by( 'name', 'Header Bottom Menu', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main_menu'     => $main_menu->term_id,
						'mobile_menu'   => $main_menu->term_id,
                        'bottom_menu'   => $header_bottom_menu->term_id
					)
				);
			}
		}

        $wbc_menu_array = array( 'onepage1', 'onepage2');
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Menu', 'nav_menu' );
			if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main_menu'     => $main_menu->term_id,
						'mobile_menu'   => $main_menu->term_id
					)
				);
			}
		}
		/************************************************************************
		* Set HomePage
		*************************************************************************/
		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'main' => 'Home',
			'onepage1' => 'One Page 1',
			'onepage2' => 'One Page 2',
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}
    }
    add_action( 'wbc_importer_after_content_import', 'n2mu_extended_import', 10, 2 );
}




    // This is your option name where all the Redux data is stored.
    $opt_name = 'magnat_options';

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Magnat Theme', 'magnat' ),
        'page_title'           => esc_html__( 'Magnat Theme', 'magnat' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'     => false,                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
        'show_options_object' => false,
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'magnat-docs',
        'href'  => 'http://magnat.n2mu.studio/documentation/',
        'title' => esc_html__( 'Documentation', 'magnat' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'magnat-support',
        'href'  => 'http://n2mu.ticksy.com',
        'title' => esc_html__( 'Support', 'magnat' ),
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'magnat' ),
        'id'               => 'general',
        'desc'             => esc_html__( 'Basic options', 'magnat' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-home'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Logo', 'magnat' ),
        'id'               => 'logo-section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => esc_html__( 'Adjust your logo settings', 'magnat' ),
        'fields'           => array(
            array(
                'id'       => 'favicon-img-default',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload Favicon', 'magnat' ),
            ),
            array(
                'id'       => 'logo-option-default',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Logo type', 'magnat' ),
                'subtitle' => esc_html__( 'Image / text / disabled', 'magnat' ),
                'options'  => array(
                    '1' => 'Image',
                    '2' => 'Text',
                    '3' => 'Disabled'
                ),
                'default'  => n2mu_default_config('logo-option')
            ),
            array(
                'id'       => 'logo-img-default',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload logo image', 'magnat' ),
                'default'  => array( 'url' => n2mu_default_config('logo-img') ),
                'required' => array( 'logo-option-default', '=', '1' )
            ),
            /*
            array(
                'id'       => 'logo-img-transparent-default',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload logo image for transparent version (optional)', 'magnat' ),
                'default'  => array( 'url' => get_template_directory_uri() . '/img/logo.png' ),
                'required' => array( 'logo-option-default', '=', '1' )
            ),
            */
            array(
                'id'       => 'logo-img-sticky-default',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload logo image for sticky version (optional)', 'magnat' ),
                'default'  => array( 'url' => n2mu_default_config('logo-img-sticky') ),
                'required' => array( 'logo-option-default', '=', '1' )
            ),
            array(
                'id'       => 'logo-img-mobile-default',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload logo image for mobile version', 'magnat' ),
                'default'  => array( 'url' => n2mu_default_config('logo-img-mobile') ),
                'required' => array( 'logo-option-default', '=', '1' )
            ),
            array(
                'id'            => 'logo-img-height-default',
                'type'          => 'slider',
                'title'         => esc_html__( 'Adjust logo height', 'magnat' ),
                'subtitle'      => esc_html__( 'Set logo height. Logo width will be automaticly calculated.', 'magnat' ),
                'desc'          => esc_html__( 'Default: 28', 'magnat' ),
                'default'       => n2mu_default_config('logo-img-height'),
                'min'           => 0,
                'step'          => 1,
                'max'           => 200,
                'required' => array( 'logo-option-default', '=', '1' ),
                'display_value' => 'text'
            ),
            array(
                'id'       => 'logo-text-default',
                'type'     => 'text',
                'title'    => esc_html__( 'Text for logo', 'magnat' ),
                'subtitle' => esc_html__( 'This text will be displayed in logo section', 'magnat' ),
                'default'  => n2mu_default_config('logo-text'),
                'required' => array( 'logo-option-default', '=', '2' )
            ),
            array(
                'id'       => 'page-preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page preloader', 'magnat' ),
                'subtitle' => esc_html__( 'Turn on if you want to display page loader when page is loading', 'magnat' ),
                'default'  => n2mu_default_config('page-preloader'),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Background', 'magnat' ),
        'id'               => 'background-section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'desc'             => esc_html__( 'Add background to your site', 'magnat' ),
        'fields'           => array(
            array(
                'id'       => 'page-background-default',
                'type'     => 'background',
                'title'    => esc_html__( 'Page background', 'magnat' ),
                'subtitle' => esc_html__( 'You can override this option on every page', 'magnat' ),
            ),
        )
    ) );

    // -> START Header
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'magnat' ),
        'id'               => 'header',
        'desc'             => esc_html__( 'Header Options', 'magnat' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-home'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header layout', 'magnat' ),
        'id'               => 'header-layout-section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'header-layout-default',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header layout', 'magnat' ),
                'subtitle' => esc_html__( 'Choose your header layout', 'magnat' ),
                'options'  => array(
                    'header1' => array( 'title' => 'Header 1', 'img' => get_template_directory_uri() . '/framework/img/header1.png' ),
                    'header2' => array( 'title' => 'Header 2', 'img' => get_template_directory_uri() . '/framework/img/header2.png' ),
                    'header3' => array( 'title' => 'Header 3', 'img' => get_template_directory_uri() . '/framework/img/header3.png' ),
                    'header4' => array( 'title' => 'Header 4', 'img' => get_template_directory_uri() . '/framework/img/header4.png' ),
                    'header5' => array( 'title' => 'Header 5', 'img' => get_template_directory_uri() . '/framework/img/header5.png' ),
                    'header6' => array( 'title' => 'Header 6', 'img' => get_template_directory_uri() . '/framework/img/header6.png' ),
                /* TODO
                    'header7' => array( 'title' => 'Header 7', 'img' => get_template_directory_uri() . '/framework/img/header7.png' ),
                    'header8' => array( 'title' => 'Header 8', 'img' => get_template_directory_uri() . '/framework/img/header8.png' ),
                */
                ),
                'default'  => n2mu_default_config('header-layout')
            ),
            array(
                'id'            => 'header-top-height-default',
                'type'          => 'slider',
                'title'         => esc_html__( 'Height of Header Top section', 'magnat' ),
                'subtitle'      => esc_html__( 'Works only when header has top header section', 'magnat' ),
                'desc'          => esc_html__( 'Min: 30, max: 300, default value: 50', 'magnat' ),
                'default'       => n2mu_default_config('header-top-height'),
                'min'           => 30,
                'step'          => 1,
                'max'           => 300,
                'display_value' => 'text'
            ),
            array(
                'id'            => 'header-middle-height-default',
                'type'          => 'slider',
                'title'         => esc_html__( 'Height of Header Middle section', 'magnat' ),
                'subtitle'      => esc_html__( 'Works only when header has middle header section', 'magnat' ),
                'desc'          => esc_html__( 'Min: 30, max: 300, default value: 100', 'magnat' ),
                'default'       => n2mu_default_config('header-middle-height'),
                'min'           => 30,
                'step'          => 1,
                'max'           => 300,
                'display_value' => 'text'
            ),
            array(
                'id'            => 'header-bottom-height-default',
                'type'          => 'slider',
                'title'         => esc_html__( 'Height of Header Bottom section', 'magnat' ),
                'subtitle'      => esc_html__( 'Works only when header has bottom header section', 'magnat' ),
                'desc'          => esc_html__( 'Min: 30, max: 300, default value: 50', 'magnat' ),
                'default'       => n2mu_default_config('header-bottom-height'),
                'min'           => 30,
                'step'          => 1,
                'max'           => 300,
                'display_value' => 'text'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Mobile Header', 'magnat' ),
        'id'               => 'header-mobile-section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'            => 'header-mobile-height-default',
                'type'          => 'slider',
                'title'         => esc_html__( 'Height of Mobile Header', 'magnat' ),
                'desc'          => esc_html__( 'Min: 50, max: 250, default value: 75', 'magnat' ),
                'default'       => n2mu_default_config('header-mobile-height'),
                'min'           => 50,
                'step'          => 1,
                'max'           => 300,
                'display_value' => 'text'
            ),
            array(
                'id'            => 'header-mobile-point',
                'type'          => 'slider',
                'title'         => esc_html__( 'When you want Mobile Header active', 'magnat' ),
                'subtitle'      => esc_html__( 'Choose when you want mobile header. Select screen width value.', 'magnat' ),
                'desc'          => esc_html__( 'Min: 400, max: 1300, default value: 1000', 'magnat' ),
                'default'       => n2mu_default_config('header-mobile-point'),
                'min'           => 400,
                'step'          => 1,
                'max'           => 1300,
                'display_value' => 'text'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header tools', 'magnat' ),
        'id'               => 'header-tools-section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'header-tools-search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Search in header', 'magnat' ),
                'subtitle' => esc_html__( 'Display search in header', 'magnat' ),
                'default'  => n2mu_default_config('header-tools-search'),
            ),
            array(
                'id'       => 'header-tools-cart',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cart in header', 'magnat' ),
                'subtitle' => esc_html__( 'Display cart in header. Works only with WooCommerce enabled', 'magnat' ),
                'default'  => n2mu_default_config('header-tools-cart'),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header sticky', 'magnat' ),
        'id'               => 'header-sticky-section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'header-sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky header on desktop version', 'magnat' ),
                'subtitle' => esc_html__( 'Turn on to enable sticky header', 'magnat' ),
                'default'  => n2mu_default_config('header-sticky'),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'magnat' ),
        'id'         => 'footer-settings',
        'desc'       => esc_html__( 'Adjust settings for footer', 'magnat'),
        'fields'     => array(
            array(
                'id'       => 'footer-columns-default',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Columns (Widget Areas)', 'magnat' ),
                'subtitle' => esc_html__( 'How Many columns you want your footer split into. Select disable to disable top footer', 'magnat' ),
                'options'  => array(
                    '0' => 'Disable footer top',
                    '1' => '1 column',
                    '2' => '2 columns',
                    '3' => '3 columns',
                    '4' => '4 columns',
                ),
                'default'  => n2mu_default_config('footer-columns')
            ),
            array(
                'id'       => 'footer-top-borders-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable / disable borders between widget areas in footer', 'magnat' ),
                'subtitle' => esc_html__( 'Turn off if you want to disable this', 'magnat' ),
                'default'  => n2mu_default_config('footer-top-borders'),
            ),
            array(
                'id'       => 'footer-bottom-enabled-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Bottom footer enabled', 'magnat' ),
                'subtitle' => esc_html__( 'Turn off if you want to disable bottom footer', 'magnat' ),
                'default'  => n2mu_default_config('footer-bottom-enabled'),
            ),
            array(
                'id'       => 'copyrights',
                'type'     => 'text',
                'title'    => esc_html__( 'Copyrights text', 'magnat' ),
                'subtitle'    => esc_html__( 'Copyrights text in footer', 'magnat' ),
                'default'  => n2mu_default_config('copyrights'),
            ),
            array(
                'id'       => 'footer-top-spacing-default',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                //'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                // Have one field that applies to all
                'top'           => true,
                'bottom'        => true,
                'right'         => false,
                'left'          => false,
                'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                //'units_extended'=> 'true',    // Allow users to select any type of unit
                'display_units' => 'true',   // Set to false to hide the units if the units are specified
                'title'    => esc_html__( 'Padding for top footer', 'magnat' ),
                'output'      => array( '.footer-top' ),
                'default'  => array(
                    'padding-top'    => '10px',
                    'padding-bottom' => '10px',
                )
            ),
            array(
                'id'       => 'footer-bottom-spacing-default',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                //'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                // Have one field that applies to all
                'top'           => true,
                'bottom'        => true,
                'right'         => false,
                'left'          => false,
                'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                //'units_extended'=> 'true',    // Allow users to select any type of unit
                'display_units' => 'true',   // Set to false to hide the units if the units are specified
                'title'    => esc_html__( 'Padding for bottom footer', 'magnat' ),
                'output'      => array( '.footer-bottom' ),
                'default'  => array(
                    'padding-top'    => '10px',
                    'padding-bottom' => '10px',
                )
            ),
            array(
                'id'       => 'footer-background-default',
                'type'     => 'background',
                'title'    => esc_html__( 'Footer image background', 'magnat' ),
                'subtitle' => esc_html__( 'If you want only color for background, leave this empty and go to "Colors" section', 'magnat' ),
                'background-color' => false,
                'output' => '.footer-top',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Colors', 'magnat' ),
        'id'         => 'color-Color',
        'desc'       => esc_html__( 'Adjust colors for theme', 'magnat'),
        'subsection' => false,
        'fields'     => array(
            array(
                'id'       => 'color-main-theme',
                'type'     => 'color',
                'title'    => esc_html__( 'Main theme color', 'magnat' ),
                'subtitle' => esc_html__( 'Used for accent color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-main-theme'),
            ),
            array(
                'id'       => 'color-buttons',
                'type'     => 'color',
                'title'    => esc_html__( 'Buttons color', 'magnat' ),
                'subtitle' => esc_html__( 'Used for many buttons', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-buttons'),
            ),
            array(
                'id'       => 'color-buttons-font',
                'type'     => 'color',
                'title'    => esc_html__( 'Buttons font color', 'magnat' ),
                'subtitle' => esc_html__( 'Used for many buttons', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-buttons-font'),
            ),
            array(
                'id'       => 'color-buttons-hover',
                'type'     => 'color',
                'title'    => esc_html__( 'Buttons color on hover', 'magnat' ),
                'subtitle' => esc_html__( 'Used for many buttons', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-buttons-hover'),
            ),
            array(
                'id'       => 'color-buttons-font-hover',
                'type'     => 'color',
                'title'    => esc_html__( 'Buttons font color on hover', 'magnat' ),
                'subtitle' => esc_html__( 'Used for many buttons', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-buttons-font-hover'),
            ),
            array(
                'id'       => 'section-start-typo-styling',
                'type'     => 'section',
                'title'    => esc_html__( 'Typography styling', 'magnat' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'color-body',
                'type'     => 'color',
                'title'    => esc_html__( 'Body text color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-body'),
            ),
            array(
                'id'       => 'color-h1',
                'type'     => 'color',
                'title'    => esc_html__( 'H1 text color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-h1'),
            ),
            array(
                'id'       => 'color-h2',
                'type'     => 'color',
                'title'    => esc_html__( 'h2 text color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-h2'),
            ),
            array(
                'id'       => 'color-h3',
                'type'     => 'color',
                'title'    => esc_html__( 'h3 text color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-h3'),
            ),
            array(
                'id'       => 'color-h4',
                'type'     => 'color',
                'title'    => esc_html__( 'h4 text color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-h4'),
            ),
            array(
                'id'       => 'color-h5',
                'type'     => 'color',
                'title'    => esc_html__( 'h5 text color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-h5'),
            ),
            array(
                'id'       => 'color-h6',
                'type'     => 'color',
                'title'    => esc_html__( 'h6 text color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-h6'),
            ),
            array(
                'id'       => 'color-page-heading-title',
                'type'     => 'color',
                'title'    => esc_html__( 'Page heading title text color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-page-heading-title'),
            ),
            array(
                'id'       => 'color-page-heading-subtitle',
                'type'     => 'color',
                'title'    => esc_html__( 'Page heading subtitle text color', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-page-heading-subtitle'),
            ),
            array(
                'id'       => 'color-link',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Links Color', 'magnat' ),
                'subtitle' => esc_html__( 'Select color for links', 'magnat' ),
                'output'      => array( 'a' ),
                'default'  => array(
                    'regular' => n2mu_default_config('color-link-regular'),
                    'hover'   => n2mu_default_config('color-link-hover'),
                    'active'  => n2mu_default_config('color-link-active'),
                )
            ),
            array(
                'id'     => 'section-end-typo-styling',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'section-start-header-styling',
                'type'     => 'section',
                'title'    => esc_html__( 'Header styling', 'magnat' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'color-link-menu-top',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Top menu link colors', 'magnat' ),
                'subtitle' => esc_html__( 'Select color for top menu links', 'magnat' ),
                'output'      => array( '.at-top a' ),
                'default'  => array(
                    'regular' => n2mu_default_config('color-link-menu-top-regular'),
                    'hover'   => n2mu_default_config('color-link-menu-top-hover'),
                    'active'  => n2mu_default_config('color-link-menu-top-active'),
                )
            ),
            array(
                'id'       => 'color-link-menu-middle',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Middle menu link colors', 'magnat' ),
                'subtitle' => esc_html__( 'Select color for middle menu links (Main menu)', 'magnat' ),
                'output'      => array( '.at-middle a' ),
                'default'  => array(
                    'regular' => n2mu_default_config('color-link-menu-middle-regular'),
                    'hover'   => n2mu_default_config('color-link-menu-middle-hover'),
                    'active'  => n2mu_default_config('color-link-menu-middle-active'),
                )
            ),
            array(
                'id'       => 'color-link-menu-bottom',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Bottom menu link colors', 'magnat' ),
                'subtitle' => esc_html__( 'Select color for bottom menu links', 'magnat' ),
                'output'      => array( '.at-bottom a' ),
                'default'  => array(
                    'regular' => n2mu_default_config('color-link-menu-bottom-regular'),
                    'hover'   => n2mu_default_config('color-link-menu-bottom-hover'),
                    'active'  => n2mu_default_config('color-link-menu-bottom-active'),
                )
            ),
            array(
                'id'       => 'color-link-menu-submenu',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Submenu link colors', 'magnat' ),
                'subtitle' => esc_html__( 'Select color for submenu links', 'magnat' ),
                'output'      => array( '.sub-menu a' ),
                'default'  => array(
                    'regular' => n2mu_default_config('color-link-menu-submenu-regular'),
                    'hover'   => n2mu_default_config('color-link-menu-submenu-hover'),
                    'active'  => n2mu_default_config('color-link-menu-submenu-active'),
                )
            ),
            array(
                'id'       => 'color-menu-mobile-link',
                'type'     => 'color',
                'title'    => esc_html__( 'Mobile menu link colors', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-menu-mobile-link'),
            ),
            array(
                'id'       => 'color-header-top-content',
                'type'     => 'color',
                'title'    => esc_html__( 'Text color for top header', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-header-top-content'),
            ),
            array(
                'id'       => 'color-header-top',
                'type'     => 'color',
                'title'    => esc_html__( 'Background color for top header', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-header-top'),
            ),
            array(
                'id'       => 'color-header-middle',
                'type'     => 'color',
                'title'    => esc_html__( 'Background color for middle header', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-header-middle'),
            ),
            array(
                'id'       => 'color-header-bottom',
                'type'     => 'color',
                'title'    => esc_html__( 'Background color for bottom header', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-header-bottom'),
            ),
            array(
                'id'       => 'color-header-submenu',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background color for sub-menu', 'magnat' ),
                'default'  => array(
                    'color' => n2mu_default_config('color-header-submenu-color'),
                    'alpha' => n2mu_default_config('color-header-submenu-alpha')
                ),
                'output'   => array( 'background-color' => 'header .n-header-desktop .sub-menu' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'       => 'color-header-submenu-hover',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background color for sub-menu on hover', 'magnat' ),
                'default'  => array(
                    'color' => n2mu_default_config('color-header-submenu-hover-color'),
                    'alpha' => n2mu_default_config('color-header-submenu-hover-alpha')
                ),
                'output'   => array( 'background-color' => 'header .n-header-desktop .sub-menu li:hover > a' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'     => 'section-end-header-styling',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'section-start-footer-styling',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer styling', 'magnat' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'color-footer-top-headings',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer top headings colors (h1, h2...)', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-footer-top-headings'),
            ),
            array(
                'id'       => 'color-footer-top-text',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer top text colors', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-footer-top-text'),
            ),
            array(
                'id'       => 'color-footer-top-link',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Footer top link colors', 'magnat' ),
                'output'      => array( '.footer-top a' ),
                'default'  => array(
                    'regular' => n2mu_default_config('color-footer-top-link-regular'),
                    'hover'   => n2mu_default_config('color-footer-top-link-hover'),
                    'active'  => n2mu_default_config('color-footer-top-link-active'),
                )
            ),
            array(
                'id'       => 'color-footer-top',
                'type'     => 'color',
                'title'    => esc_html__( 'Background color for top footer', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-footer-top'),
            ),
            array(
                'id'       => 'color-footer-top-border',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Border color between widgets in footer', 'magnat' ),
                'default'  => array(
                    'color' => n2mu_default_config('color-footer-top-border-color'),
                    'alpha' => n2mu_default_config('color-footer-top-border-alpha')
                ),
                'output'   => array( 'border-color' => '.footer-top .n2mu-footer-column' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'       => 'color-footer-bottom-headings',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer bottom headings colors (h1, h2...)', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-footer-bottom-headings'),
            ),
            array(
                'id'       => 'color-footer-bottom-text',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer bottom text colors', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-footer-bottom-text'),
            ),
            array(
                'id'       => 'color-footer-bottom-link',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Footer bottom link colors', 'magnat' ),
                'output'      => array( '.footer-bottom a' ),
                'default'  => array(
                    'regular' => n2mu_default_config('color-footer-bottom-link-regular'),
                    'hover'   => n2mu_default_config('color-footer-bottom-link-hover'),
                    'active'  => n2mu_default_config('color-footer-bottom-link-active'),
                )
            ),
            array(
                'id'       => 'color-footer-bottom',
                'type'     => 'color',
                'title'    => esc_html__( 'Background color for bottom footer', 'magnat' ),
                'transparent' => false,
                'default'  => n2mu_default_config('color-footer-bottom'),
            ),
            array(
                'id'     => 'section-end-footer-styling',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'section-start-elements-styling',
                'type'     => 'section',
                'title'    => esc_html__( 'Elements styling', 'magnat' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'color-element-portfolio-hover',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background color for portfolio listing overlay', 'magnat' ),
                'default'  => array(
                    'color' => n2mu_default_config('color-element-portfolio-hover-color'),
                    'alpha' => n2mu_default_config('color-element-portfolio-hover-alpha')
                ),
                'output'   => array( 'background' => '.hover-zoom-out .portfolio-item-desc, .hover-zoom-in .portfolio-item-desc, .hover-overlay .portfolio-item-desc' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'     => 'section-end-elements-styling',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        ),
    ) );

    // -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Typography', 'magnat' ),
        'id'     => 'typography',
        'desc'   => 'Here you can adjust your typography options',
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'          => 'typo-body',
                'type'        => 'typography',
                'title'       => esc_html__( 'Body font', 'magnat' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true,
                // Select a backup non-google font in addition to a google font
                //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                //'subsets'       => false, // Only appears if google is true and subsets not set to false
                //'font-size'     => false,
                //'line-height'   => false,
                //'word-spacing'  => true,  // Defaults to false
                //'letter-spacing'=> true,  // Defaults to false
                'color'         => false,
                //'preview'       => false, // Disable the previewer
                'all_styles'  => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'      => array( 'body, .p' ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select your body font', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '26px'
                ),
            ),
            array(
                'id'          => 'typo-h1',
                'type'        => 'typography',
                'title'       => esc_html__( 'H1 font', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'output'      => array( 'h1, .h1' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select your H1 font', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '50px',
                    'line-height' => '55px'
                ),
            ),
            array(
                'id'          => 'typo-h2',
                'type'        => 'typography',
                'title'       => esc_html__( 'H2 font', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( 'h2, .h2' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select your H2 font', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '45px',
                    'line-height' => '55px'
                ),
            ),
            array(
                'id'          => 'typo-h3',
                'type'        => 'typography',
                'title'       => esc_html__( 'H3 font', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( 'h3, .h3' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select your H3 font', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '24px',
                    'line-height' => '30px'
                ),
            ),
            array(
                'id'          => 'typo-h4',
                'type'        => 'typography',
                'title'       => esc_html__( 'H4 font', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( 'h4, .h4' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select your H4 font', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '18px',
                    'line-height' => '26px'
                ),
            ),
            array(
                'id'          => 'typo-h5',
                'type'        => 'typography',
                'title'       => esc_html__( 'H5 font', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( 'h5, .h5' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select your H5 font', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '17px',
                    'line-height' => '24px'
                ),
            ),
            array(
                'id'          => 'typo-h6',
                'type'        => 'typography',
                'title'       => esc_html__( 'H6 font', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( 'h6, .h6' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select your H6 font', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '22px'
                ),
            ),
            array(
                'id'          => 'typo-menu-top-middle',
                'type'        => 'typography',
                'title'       => esc_html__( 'Main navigation font (main menu)', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( '.at-middle .n-menu-wrap li, .at-middle .n-menu-wrap li a' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select font for menu navigation (Top level items) in middle menu (main)', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '15px',
                    'line-height' => '25px'
                ),
            ),
            array(
                'id'          => 'typo-menu-top-top',
                'type'        => 'typography',
                'title'       => esc_html__( 'Main navigation font (Top menu)', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( '.at-top, .at-top .menu li, .at-top .menu li a' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select font for menu navigation (Top level items) in top menu', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Raleway',
                    'google'      => true,
                    'font-size'   => '13px',
                    'line-height' => '26px'                ),
            ),
            array(
                'id'          => 'typo-menu-top-bottom',
                'type'        => 'typography',
                'title'       => esc_html__( 'Main navigation font (bottom menu)', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( '.at-bottom .n-menu-wrap li, .at-bottom .n-menu-wrap li a' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select font for menu navigation (Top level items) in bottom menu', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Raleway',
                    'google'      => true,
                    'font-size'   => '14px',
                    'line-height' => '22px'
                ),
            ),
            array(
                'id'          => 'typo-menu-submenu',
                'type'        => 'typography',
                'title'       => esc_html__( 'Submenu font', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( '.n-menu-wrap .sub-menu li, .n-menu-wrap .sub-menu li a' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select font for submenu', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '14px',
                    'line-height' => '24px'
                ),
            ),
            array(
                'id'          => 'typo-page-heading-title',
                'type'        => 'typography',
                'title'       => esc_html__( 'Page heading title', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( '.page-heading-title' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select font for page heading Title', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '30px',
                    'line-height' => '40px'
                ),
            ),
            array(
                'id'          => 'typo-page-heading-subtitle',
                'type'        => 'typography',
                'title'       => esc_html__( 'Page heading subtitle', 'magnat' ),
                'font-backup' => true,
                'all_styles'  => true,
                'color'         => false,
                'output'      => array( '.page-heading-subtitle' ),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Select font for page heading subtitle', 'magnat' ),
                'default'     => array(
                    'font-style'  => 'normal',
                    'font-family' => 'Lato',
                    'google'      => true,
                    'font-size'   => '18px',
                    'line-height' => '26px'
                ),
            ),
        
        )
    ) );

    // -> START Page settings
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Page', 'magnat' ),
        'id'    => 'page_settings',
        'icon'  => 'el el-cogs'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Heading', 'magnat' ),
        'id'         => 'page-heading',
        'desc'       => esc_html__( 'Adjust global settings for page heading (at top of page).', 'magnat'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'page-heading-on-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Heading', 'magnat' ),
                'subtitle' => esc_html__( 'Displayed on top of page', 'magnat' ),
                'default'  => n2mu_default_config('page-heading-on'),
            ),
            array(
                'id'       => 'page-heading-style-default',
                'type'     => 'select',
                'required' => array( 'page-heading-on-default', '=', '1' ),
                'title'    => esc_html__( 'Page heading style', 'magnat' ),
                'subtitle' => esc_html__( 'Choose one', 'magnat' ),
                'options'  => array(
                    'heading-simple' => 'Simple',
                    'heading-centered' => 'Centered',
                ),
                'default'  => n2mu_default_config('page-heading-style')
            ),
            array(
                'id'       => 'page-heading-background-default',
                'type'     => 'background',
                'required' => array( 'page-heading-on-default', '=', '1' ),
                'title'    => esc_html__( 'Page heading background', 'magnat' ),
                'subtitle' => esc_html__( 'You can override this option on every page', 'magnat' ),
                'default'  => array('background-color' => n2mu_default_config('page-heading-background')),
            ),
            array(
                'id'       => 'page-heading-spacing-default',
                'type'     => 'spacing',
                'required' => array( 'page-heading-on-default', '=', '1' ),
                // An array of CSS selectors to apply this font style to
                //'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                // Have one field that applies to all
                'top'           => true,
                'bottom'        => true,
                'right'         => false,
                'left'          => false,
                'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                //'units_extended'=> 'true',    // Allow users to select any type of unit
                'display_units' => 'true',   // Set to false to hide the units if the units are specified
                'title'    => esc_html__( 'Padding for page heading', 'magnat' ),
                'subtitle' => esc_html__( 'Choose how big page heading should be ', 'magnat' ),
                'default'  => array(
                    'padding-top'    => n2mu_default_config('page-heading-spacing-top'),
                    'padding-bottom' => n2mu_default_config('page-heading-spacing-bottom'),
                )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Options', 'magnat' ),
        'id'         => 'page-options-sub',
        'desc'       => esc_html__( 'Adjust global settings for page', 'magnat'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'page-comments-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable comments on pages', 'magnat' ),
                'subtitle' => esc_html__( 'Turn on if you want comments on pages', 'magnat' ),
                'default'  => n2mu_default_config('page-comments'),
            ),

            array(
                'id'       => 'page-padding',
                'type'     => 'spacing',
                'all'      => false,
                'top'           => true,
                'bottom'        => true,
                'right'         => false,
                'left'          => false,
                'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                'display_units' => 'true',   // Set to false to hide the units if the units are specified
                'title'    => esc_html__( 'Paddings for pages', 'magnat' ),
                'output'    => '.page-content',
                'default'  => array(
                    'padding-top'    => n2mu_default_config('page-padding-top'),
                    'padding-bottom' => n2mu_default_config('page-padding-bottom'),
                )
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'magnat' ),
        'id'         => 'blog-settings',
        'desc'       => esc_html__( 'Adjust global settings for blog', 'magnat'),
        'fields'     => array(
            array(
                'id'       => 'blog-listing-style',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog listing style', 'magnat' ),
                'subtitle' => esc_html__( 'Choose one', 'magnat' ),
                'options'  => array(
                    'blog-listing-simple' => 'Simple',
                    'blog-listing-simple-3col' => 'Simple 3 columns',
                    'blog-listing-card-3col' => 'Card style 3 columns',
                ),
                'default'  => n2mu_default_config('blog-listing-style')
            ),
            array(
                'id'       => 'blog-listing-img',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog listing page img size', 'magnat' ),
                'subtitle' => esc_html__( 'Choose one', 'magnat' ),
                'options'  => array(
                    'n2mu-medium' => '600x400',
                    'n2mu-cropped-big' => '1200x600',
                    'full' => 'Full',
                ),
                'default'  => n2mu_default_config('blog-listing-img')
            ),
            array(
                'id'       => 'section-start-blog-listing-meta',
                'type'     => 'section',
                'title'    => esc_html__( 'Blog listing meta', 'magnat' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'blog-listing-meta-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta on blog listing page', 'magnat' ),
                'default'  => n2mu_default_config('blog-listing-meta'),
            ),
            array(
                'id'       => 'blog-listing-meta-date-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta date on blog listing page', 'magnat' ),
                'required' => array( 'blog-listing-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-listing-meta-date'),
            ),
            array(
                'id'       => 'blog-listing-meta-author-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta author on blog listing page', 'magnat' ),
                'required' => array( 'blog-listing-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-listing-meta-author'),
            ),
            array(
                'id'       => 'blog-listing-meta-categories-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta categories on blog listing page', 'magnat' ),
                'required' => array( 'blog-listing-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-listing-meta-categories'),
            ),
            array(
                'id'       => 'blog-listing-meta-comments-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta comments on blog listing page', 'magnat' ),
                'required' => array( 'blog-listing-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-listing-meta-comments'),
            ),
            array(
                'id'       => 'blog-listing-meta-tags-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta tags on blog listing page', 'magnat' ),
                'required' => array( 'blog-listing-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-listing-meta-tags'),
            ),
            array(
                'id'       => 'section-start-blog-single-meta',
                'type'     => 'section',
                'title'    => esc_html__( 'Blog single meta', 'magnat' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'blog-single-meta-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta on blog single page', 'magnat' ),
                'default'  => n2mu_default_config('blog-single-meta'),
            ),
            array(
                'id'       => 'blog-single-meta-date-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta date on blog single page', 'magnat' ),
                'required' => array( 'blog-single-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-single-meta-date'),
            ),
            array(
                'id'       => 'blog-single-meta-author-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta author on blog single page', 'magnat' ),
                'required' => array( 'blog-single-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-single-meta-author'),
            ),
            array(
                'id'       => 'blog-single-meta-categories-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta categories on blog single page', 'magnat' ),
                'required' => array( 'blog-single-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-single-meta-categories'),
            ),
            array(
                'id'       => 'blog-single-meta-comments-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta comments on blog single page', 'magnat' ),
                'required' => array( 'blog-single-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-single-meta-comments'),
            ),
            array(
                'id'       => 'blog-single-meta-tags-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display post meta tags on blog single page', 'magnat' ),
                'required' => array( 'blog-single-meta-default', '=', '1' ),
                'default'  => n2mu_default_config('blog-single-meta-tags'),
            ),
            array(
                'id'       => 'section-send-blog-single-meta',
                'type'     => 'section',
                'indent'   => false, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'n2mu-blog-full-post-content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Full Post Content', 'magnat' ),
                'desc'    => esc_html__( 'By default (when OFF) only the excerpt is shown - starting 60 words. If you set to ON you can still use THE MORE tag to manually set where your content would be cut off.', 'magnat' ),
                'default'  => n2mu_default_config('n2mu-blog-full-post-content'),
            ),  
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Portfolio', 'magnat' ),
        'id'         => 'portfolio-settings',
        'desc'       => esc_html__( 'Adjust settings for portfolio', 'magnat'),
        'fields'     => array(
            array(
                'id'       => 'portfolio-related-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Related Projects in Portfolio', 'magnat' ),
                'subtitle' => esc_html__( 'Turn on if you want to display related portfolio on single portfolio page', 'magnat' ),
                'default'  => n2mu_default_config('portfolio-related'),
            ),
            array(
                'id'       => 'portfolio-page-slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Type your portfolio page link', 'magnat' ),
                'subtitle'    => esc_html__( 'Used on single portfolio as link to back to portfolio page (icon)', 'magnat' ),
                'desc'     => esc_html__( 'e.g. portfolio', 'magnat' ),
                'default'  => n2mu_default_config('portfolio-page-slug'),
            ),
        )
    ) );

    // -> START Page settings
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Sidebar settings', 'magnat' ),
        'id'    => 'sidebar_settings',
        'icon'  => 'el el-cogs',
        'fields'     => array(
            array(
                'title'     => esc_html__( 'Page Layout', 'magnat' ),
                'subtitle' => esc_html__( 'You can override this option on each page.', 'magnat' ),
                'desc'      => esc_html__( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'magnat' ),
                'id'        => 'layout-default',
                'default'   => n2mu_default_config('layout'),
                'type'      => 'image_select',
                'customizer'=> array(),
                'options'   => array( 
                0           => ReduxFramework::$_url . 'assets/img/1c.png',
                1           => ReduxFramework::$_url . 'assets/img/2cr.png',
                2           => ReduxFramework::$_url . 'assets/img/2cl.png',
                3           => ReduxFramework::$_url . 'assets/img/3cm.png',
                )
            ),
            array(
                'title'     => esc_html__( 'Post Layout', 'magnat' ),
                'subtitle' => esc_html__( 'You can override this option on each page.', 'magnat' ),
                'desc'      => esc_html__( 'Select main content and sidebar arrangement for single post. Choose between 1, 2 or 3 column layout.', 'magnat' ),
                'id'        => 'layout-post-default',
                'default'   => n2mu_default_config('layout-post'),
                'type'      => 'image_select',
                'customizer'=> array(),
                'options'   => array( 
                0           => ReduxFramework::$_url . 'assets/img/1c.png',
                1           => ReduxFramework::$_url . 'assets/img/2cr.png',
                2           => ReduxFramework::$_url . 'assets/img/2cl.png',
                3           => ReduxFramework::$_url . 'assets/img/3cm.png',
                )
            ),
            array(
                'id'       => 'n2mu-sidebars',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'Add more sidebars', 'magnat' ),
                'desc'     => esc_html__( 'Please enter name of sidebar. Make sure there is no white spaces in sidebar name. E.g. Please use: SidebarName instead of: Sidebar Name (no spaces & it shouldnt start with a digit)', 'magnat' )
            ),
            
        )
    ) );

    // -> START WooCommerce section
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'WooCommerce', 'magnat' ),
        'id'    => 'woocommerce_settings',
        'icon'  => 'el el-cogs',
        'fields'     => array(
            array(
                'title'     => esc_html__( 'Product Layout', 'magnat' ),
                'subtitle' => esc_html__( 'You can override this option on each product.', 'magnat' ),
                'desc'      => esc_html__( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'magnat' ),
                'id'        => 'layout-shop-default',
                'default'   => n2mu_default_config('layout-shop'),
                'type'      => 'image_select',
                'customizer'=> array(),
                'options'   => array( 
                0           => ReduxFramework::$_url . 'assets/img/1c.png',
                1           => ReduxFramework::$_url . 'assets/img/2cr.png',
                2           => ReduxFramework::$_url . 'assets/img/2cl.png',
                3           => ReduxFramework::$_url . 'assets/img/3cm.png',
                )
            ),
            array(
                'id'       => 'woo-catalog-mode-default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Catalog mode', 'magnat' ),
                'subtitle' => esc_html__( 'Turn ON if you want to disable BUY buttons on WooCommerce pages', 'magnat' ),
                'default'  => n2mu_default_config('woo-catalog-mode'),
            ),
        )
    ) );

    // -> START Quick tranlation section
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Quick translation', 'magnat' ),
        'id'    => 'quick-translation-settings',
        'desc'  => esc_html__( 'If you have only one language on your site you can use this options to translate in quick way most front end strings to your language', 'magnat' ),
        'icon'  => 'el el-cogs',
        'fields'     => array(
            array(
                'id'       => 'quick-translation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Quick translation', 'magnat' ),
                'subtitle' => esc_html__( 'Turn ON if you want to use quick translate function.', 'magnat' ),
                'desc' => esc_html__( 'If you are using this option normal translation (po, mo files) wont work for this strings', 'magnat' ),
                'default'  => n2mu_default_config('quick-translation'),
            ),
            array(
                'id'       => 'section-start-404-qt',
                'type'     => 'section',
                'title'    => esc_html__( '404 page', 'magnat' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'qt-404',
                'type'     => 'text',
                'title'    => '',
                'subtitle' => esc_html__( '404', 'magnat' ),
                'default'  => esc_html__( '404', 'magnat' ),
            ),
            array(
                'id'       => 'qt-404-title',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Ooops...', 'magnat' ),
                'default'  => esc_html__( 'Ooops...', 'magnat' ),
            ),
            array(
                'id'       => 'qt-404-subtitle',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'We are sorry, but the page you are looking for does not exist.', 'magnat' ),
                'default'  => esc_html__( 'We are sorry, but the page you are looking for does not exist.', 'magnat' ),
            ),
            array(
                'id'       => 'qt-404-desc',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Please check entered address and try again or back to', 'magnat' ),
                'default'  => esc_html__( 'Please check entered address and try again or back to', 'magnat' ),
            ),
            array(
                'id'       => 'qt-404-button',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Button text: Homepage', 'magnat' ),
                'default'  => esc_html__( 'Homepage', 'magnat' ),
            ),
            array(
                'id'     => 'section-end-404-qt',
                'type'   => 'section',
                'indent' => false,
            ),
            array(
                'id'       => 'section-start-single-portfolio-qt',
                'type'     => 'section',
                'title'    => esc_html__( 'Single portfolio page', 'magnat' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'qt-single-portfolio-details-title',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Project details', 'magnat' ),
                'default'  => esc_html__( 'Project details', 'magnat' ),
            ),
            array(
                'id'       => 'qt-single-portfolio-details-client',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Client:', 'magnat' ),
                'default'  => esc_html__( 'Client:', 'magnat' ),
            ),
            array(
                'id'       => 'qt-single-portfolio-details-url',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Site URL:', 'magnat' ),
                'default'  => esc_html__( 'Site URL:', 'magnat' ),
            ),
            array(
                'id'       => 'qt-single-portfolio-details-date',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Date:', 'magnat' ),
                'default'  => esc_html__( 'Date:', 'magnat' ),
            ),
            array(
                'id'       => 'qt-single-portfolio-button-prev',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Button previous portfiolio item: PREV', 'magnat' ),
                'default'  => esc_html__( 'PREV', 'magnat' ),
            ),
            array(
                'id'       => 'qt-single-portfolio-button-next',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Button next portfiolio item: NEXT', 'magnat' ),
                'default'  => esc_html__( 'NEXT', 'magnat' ),
            ),
            array(
                'id'       => 'qt-single-portfolio-related',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Related Portfolio Items', 'magnat' ),
                'default'  => esc_html__( 'Related Portfolio Items', 'magnat' ),
            ),
            array(
                'id'     => 'section-end-single-portfolio-qt',
                'type'   => 'section',
                'indent' => false,
            ),
            array(
                'id'       => 'section-start-blog-listing-qt',
                'type'     => 'section',
                'title'    => esc_html__( 'Blog', 'magnat' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'qt-blog-listing-no-post',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Sorry, no posts matched your criteria.', 'magnat' ),
                'default'  => esc_html__( 'Sorry, no posts matched your criteria.', 'magnat' ),
            ),
            array(
                'id'       => 'qt-blog-listing-button',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Button: Read more', 'magnat' ),
                'default'  => esc_html__( 'Read more', 'magnat' ),
            ),
            array(
                'id'       => 'qt-blog-no-comment',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'No comments yet', 'magnat' ),
                'default'  => esc_html__( 'No comments yet', 'magnat' ),
            ),
            array(
                'id'       => 'qt-blog-one-comment',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'One comment: 1 comment', 'magnat' ),
                'default'  => esc_html__( '1 comment', 'magnat' ),
            ),
            array(
                'id'       => 'qt-blog-comments',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'More comments: comments', 'magnat' ),
                'default'  => esc_html__( 'comments', 'magnat' ),
            ),
            array(
                'id'       => 'qt-blog-comments-off',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Comments are Off', 'magnat' ),
                'default'  => esc_html__( 'Comments are Off', 'magnat' ),
            ),
            array(
                'id'       => 'qt-blog-comment-password',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Enter your password to view comments.', 'magnat' ),
                'default'  => esc_html__( 'Enter your password to view comments.', 'magnat' ),
            ),
            array(
                'id'       => 'qt-blog-tags',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Tags:', 'magnat' ),
                'default'  => esc_html__( 'Tags:', 'magnat' ),
            ),
            array(
                'id'     => 'section-end-blog-listing-qt',
                'type'   => 'section',
                'indent' => false,
            ),
            array(
                'id'       => 'section-start-comments-qt',
                'type'     => 'section',
                'title'    => esc_html__( 'Comments', 'magnat' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'qt-comments-password-protected',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'This post is password protected. Enter the password to view comments.', 'magnat' ),
                'default'  => esc_html__( 'This post is password protected. Enter the password to view comments.', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-no-comments',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'No Comments', 'magnat' ),
                'default'  => esc_html__( 'No Comments', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-one-comment',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'One Comment', 'magnat' ),
                'default'  => esc_html__( 'One Comment', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-comments',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Comments', 'magnat' ),
                'default'  => esc_html__( 'Comments', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-closed',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Comments are closed.', 'magnat' ),
                'default'  => esc_html__( 'Comments are closed.', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-leave',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Leave A Comment', 'magnat' ),
                'default'  => esc_html__( 'Leave A Comment', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-loggedin',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Logged in as', 'magnat' ),
                'default'  => esc_html__( 'Logged in as', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-logout',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Log out', 'magnat' ),
                'default'  => esc_html__( 'Log out', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-submit',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Comment', 'magnat' ),
                'default'  => esc_html__( 'Comment', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-name',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Name', 'magnat' ),
                'default'  => esc_html__( 'Name', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-email',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Email', 'magnat' ),
                'default'  => esc_html__( 'Email', 'magnat' ),
            ),
            array(
                'id'       => 'qt-comments-website',
                'type'     => 'text',
                'title'    => '',
                'subtitle'    => esc_html__( 'Website', 'magnat' ),
                'default'  => esc_html__( 'Website', 'magnat' ),
            ), 
        )
    ) );

    // -> START Custom CSS section
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Custom CSS', 'magnat' ),
        'id'    => 'custom_css_settings',
        'icon'  => 'el el-cogs',
        'fields'     => array(
            array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__('CSS Code', 'magnat'),
            'subtitle' => esc_html__('Paste your CSS code here.', 'magnat'),
            'mode'     => 'css',
            'theme'    => 'chrome',
            ),
        )
    ) );



    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

