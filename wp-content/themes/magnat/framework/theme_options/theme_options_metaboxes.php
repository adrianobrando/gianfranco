<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Redux' ) ) {
        return;
    }


if ( !function_exists( "n2mu_add_metaboxes" ) ):
    function n2mu_add_metaboxes($metaboxes) {
    $boxSections[] = array(
        'title' => esc_html__('Global Settings', 'magnat'),
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'page-background-custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom Page background settings', 'magnat' ),
                'desc'      => esc_html__( 'Turn on if you want to override settings from theme options.', 'magnat' ),
                'default'  => false,
            ),
            array(
            'id'       => 'page-background',
            'type'     => 'background',
            'title'    => esc_html__( 'Page background', 'magnat' ),
            'subtitle' => esc_html__( 'This settings will override theme options', 'magnat' ),
            'required' => array( 'page-background-custom', '=', '1' ),
            ),
            array(
                'id'       => 'page-disable-header',
                'type'     => 'switch',
                'title'    => esc_html__( 'Disable header for this page', 'magnat' ),
                'desc'      => esc_html__( 'Turn on if you want to hide header for this page.', 'magnat' ),
                'default'  => false,
            ),
            array(
                'id'       => 'page-disable-footer',
                'type'     => 'switch',
                'title'    => esc_html__( 'Disable footer for this page', 'magnat' ),
                'desc'      => esc_html__( 'Turn on if you want to hide footer for this page.', 'magnat' ),
                'default'  => false,
            ),
            array(
                'id'       => 'one-page-mode',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable one page mode', 'magnat' ),
                'desc'      => esc_html__( 'Links with # will be smooth scrolled', 'magnat' ),
                'default'  => false,
            ),
        )
    );


    $boxSections[] = array(
        'title' => esc_html__('Logo', 'magnat'),
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'logo-custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom Logo settings', 'magnat' ),
                'desc'      => esc_html__( 'Turn on if you want to override settings from theme options.', 'magnat' ),
                'default'  => false,
            ),
            array(
                'id'       => 'logo-option',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Logo type', 'magnat' ),
                'subtitle' => esc_html__( 'Image / text / disabled', 'magnat' ),
                'required' => array( 'logo-custom', '=', '1' ),
                'options'  => array(
                    '1' => 'Image',
                    '2' => 'Text',
                    '3' => 'Disabled'
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'logo-img',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload logo image', 'magnat' ),
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default'  => array( 'url' => get_template_directory_uri() . '/img/logo.png' ),
                'required'      => array(
                        array( 'logo-custom', '=', '1' ),
                        array( 'logo-option', '=', '1' )
                ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
            /* TODO
            array(
                'id'       => 'logo-img-transparent',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload logo image for transparent version (optional)', 'magnat' ),
                'default'  => array( 'url' => get_template_directory_uri() . '/img/logo.png' ),
                'required'      => array(
                        array( 'logo-custom', '=', '1' ),
                        array( 'logo-option', '=', '1' )
                ),
            ),
            */
            array(
                'id'       => 'logo-img-sticky',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload logo image for sticky version (optional)', 'magnat' ),
                'required' => array( 'logo-custom', '=', '1' ),
                'default'  => array( 'url' => get_template_directory_uri() . '/img/logo.png' ),
                'required'      => array(
                        array( 'logo-custom', '=', '1' ),
                        array( 'logo-option', '=', '1' )
                ),
            ),
            array(
                'id'       => 'logo-img-mobile',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload logo image for mobile version (optional)', 'magnat' ),
                'required' => array( 'logo-custom', '=', '1' ),
                'default'  => array( 'url' => get_template_directory_uri() . '/img/logo.png' ),
                'required'      => array(
                        array( 'logo-custom', '=', '1' ),
                        array( 'logo-option', '=', '1' )
                ),
            ),
            array(
                'id'            => 'logo-img-height',
                'type'          => 'slider',
                'title'         => esc_html__( 'Adjust logo height', 'magnat' ),
                'subtitle'      => esc_html__( 'Logo width will be automaticly calculated.', 'magnat' ),
                'desc'          => esc_html__( 'Default: 45', 'magnat' ),
                'default'       => 45,
                'min'           => 0,
                'step'          => 1,
                'max'           => 200,
                'required'      => array(
                        array( 'logo-custom', '=', '1' ),
                        array( 'logo-option', '=', '1' )
                ),
                'display_value' => 'text'
            ),
            array(
                'id'       => 'logo-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Text for logo', 'magnat' ),
                'subtitle' => esc_html__( 'This text will be displayed in logo section', 'magnat' ),
                'default'  => 'Magnat',
                'required'      => array(
                        array( 'logo-custom', '=', '1' ),
                        array( 'logo-option', '=', '2' )
                ),
            ),                                       
        ),
    );

    $boxSections[] = array(
        'title' => esc_html__('Header', 'magnat'),
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'header-custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom Header settings', 'magnat' ),
                'desc'      => esc_html__( 'Turn on if you want to override settings from theme options.', 'magnat' ),
                'default'  => false,
            ),
            array(
                'id'       => 'header-layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header layout', 'magnat' ),
                'subtitle' => esc_html__( 'Choose your header layout', 'magnat' ),
                'required' => array( 'header-custom', '=', '1' ),
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
                'default'  => 'header1'
            ),
            array(
                'id'            => 'header-top-height',
                'type'          => 'slider',
                'title'         => esc_html__( 'Height of Header Top section', 'magnat' ),
                'subtitle'      => esc_html__( 'Works only when header has top header section', 'magnat' ),
                'required'      => array( 'header-custom', '=', '1' ),
                'desc'          => esc_html__( 'Min: 30, max: 300, default value: 50', 'magnat' ),
                'default'       => 50,
                'min'           => 30,
                'step'          => 1,
                'max'           => 300,
                'display_value' => 'text'
            ),
            array(
                'id'            => 'header-middle-height',
                'type'          => 'slider',
                'title'         => esc_html__( 'Height of Header Middle section', 'magnat' ),
                'subtitle'      => esc_html__( 'Works only when header has middle header section', 'magnat' ),
                'required'      => array( 'header-custom', '=', '1' ),
                'desc'          => esc_html__( 'Min: 30, max: 300, default value: 100', 'magnat' ),
                'default'       => 100,
                'min'           => 30,
                'step'          => 1,
                'max'           => 300,
                'display_value' => 'text'
            ),
            array(
                'id'            => 'header-bottom-height',
                'type'          => 'slider',
                'title'         => esc_html__( 'Height of Header Bottom section', 'magnat' ),
                'subtitle'      => esc_html__( 'Works only when header has bottom header section', 'magnat' ),
                'required'      => array( 'header-custom', '=', '1' ),
                'desc'          => esc_html__( 'Min: 30, max: 300, default value: 50', 'magnat' ),
                'default'       => 50,
                'min'           => 30,
                'step'          => 1,
                'max'           => 300,
                'display_value' => 'text'
            ),
        ),
    );

    $boxSections[] = array(
        'title' => esc_html__('Page Heading', 'magnat'),
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'page-heading-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Page title', 'magnat' ),
                'desc'     => esc_html__( 'Leave empty if you want to display page title', 'magnat' ),
                'default'  => '',
            ),
            array(
                'id'       => 'page-heading-subtitle',
                'type'     => 'text',
                'title'    => esc_html__( 'Page subtitle', 'magnat' ),
                'desc'     => esc_html__( 'Leave empty if you dont want to use this', 'magnat' ),
                'default'  => '',
            ),
            array(
                'id'       => 'page-heading-title-option',
                'type'     => 'switch',
                'title'    => esc_html__( 'Disable page heading title', 'magnat' ),
                'desc'      => esc_html__( 'Turn ON if you want to disable page heading title (you want only image on top without text)', 'magnat' ),
                'default'  => false,
            ),
            array(
                'id'       => 'page-heading-custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom Page Heading settings', 'magnat' ),
                'desc'      => esc_html__( 'Turn on if you want to override settings from theme options.', 'magnat' ),
                'default'  => false,
            ),
            array(
                'id'       => 'page-heading-on',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Heading', 'magnat' ),
                'subtitle' => esc_html__( 'Displayed on top of page', 'magnat' ),
                'required' => array( 'page-heading-custom', '=', '1' ),
                'default'  => false,
            ),
            array(
                'id'       => 'page-heading-title-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page heading title color', 'magnat' ),
                'desc'     => esc_html__( 'Leave empty if you want to use color from theme options', 'magnat' ),
                'transparent' => false,
                'required' => array(
                    array( 'page-heading-custom', '=', '1' ),
                    array( 'page-heading-on', '=', '1' ),
                ),
                'default'  => '',
            ),
            array(
                'id'       => 'page-heading-subtitle-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page heading subtitle color', 'magnat' ),
                'desc'     => esc_html__( 'Leave empty if you want to use color from theme options', 'magnat' ),
                'transparent' => false,
                'required' => array(
                    array( 'page-heading-custom', '=', '1' ),
                    array( 'page-heading-on', '=', '1' ),
                ),
                'default'  => '',
            ),
            array(
                'id'       => 'page-heading-style',
                'type'     => 'select',
                'required' => array(
                    array( 'page-heading-custom', '=', '1' ),
                    array( 'page-heading-on', '=', '1' ),
                ),
                'title'    => esc_html__( 'Page heading style', 'magnat' ),
                'subtitle' => esc_html__( 'Choose one', 'magnat' ),
                'options'  => array(
                    'heading-simple' => 'Simple',
                    'heading-centered' => 'Centered',
                ),
                'default'  => 'heading-simple'
            ),
            array(
                'id'       => 'page-heading-background',
                'type'     => 'background',
                'required' => array(
                    array( 'page-heading-custom', '=', '1' ),
                    array( 'page-heading-on', '=', '1' ),
                ),
                'title'    => esc_html__( 'Page heading background', 'magnat' ),
                'subtitle' => esc_html__( 'You can override this option on every page', 'magnat' ),
                'default'  => array('background-color' => '#efefef'),
            ),
            array(
                'id'       => 'page-heading-spacing',
                'type'     => 'spacing',
                'required' => array(
                    array( 'page-heading-custom', '=', '1' ),
                    array( 'page-heading-on', '=', '1' ),
                ),
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
                    'padding-top'    => '',
                    'padding-bottom' => '',
                )
            ),                             
        ),
    );

    $metaboxes[] = array(
        'id' => 'n-page-settings',
        'title' => esc_html__('Page Settings', 'magnat'),
        'post_types' => array('page', 'post', 'product', 'n2mu_portfolio'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
        'sections' => $boxSections
    );


    // Testimonials
    $boxSections = array();
    $boxSections[] = array(
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'n2mu-testimonial-client',
                'type'     => 'text',
                'title'    => esc_html__( 'Client name', 'magnat' ),
                'default'  => '',
            ),
            array(
                'id'       => 'n2mu-testimonial-url',
                'type'     => 'text',
                'title'    => esc_html__( 'Client url', 'magnat' ),
                'default'  => '',
            ),
            array(
                'id'       => 'n2mu-testimonial-position',
                'type'     => 'text',
                'title'    => esc_html__( 'Client position', 'magnat' ),
                'default'  => '',
            ),
        )
    );

    $metaboxes[] = array(
        'id' => 'testimonial-options',
        'title' => esc_html__('Testimonial Settings', 'magnat'),
        'post_types' => array('n2mu_testimonial'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
        'sections' => $boxSections
    );
    

    // Portfolio
    $boxSections = array();
    $boxSections[] = array(
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'n2mu-portfolio-single-image-enabled',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio featured image', 'magnat' ),
                'subtitle'      => esc_html__( 'Turn off to disable featured image on top of page (e.g. you want to use visual composer)', 'magnat' ),
                'default'  => true,
            ),
            array(
                'id'       => 'n2mu-portfolio-details-enabled',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio details', 'magnat' ),
                'subtitle'      => esc_html__( 'Turn off to disable project details', 'magnat' ),
                'default'  => true,
            ),
            array(
                'id'       => 'n2mu-portfolio-client',
                'type'     => 'text',
                'title'    => esc_html__( 'Project name', 'magnat' ),
                'required' => array( 'n2mu-portfolio-details-enabled', '=', '1' ),
                'default'  => '',
            ),
            array(
                'id'       => 'n2mu-portfolio-url',
                'type'     => 'text',
                'title'    => esc_html__( 'URL', 'magnat' ),
                'required' => array( 'n2mu-portfolio-details-enabled', '=', '1' ),
                'default'  => '',
            ),
            array(
                'id'       => 'n2mu-portfolio-date',
                'type'     => 'text',
                'title'    => esc_html__( 'Date', 'magnat' ),
                'required' => array( 'n2mu-portfolio-details-enabled', '=', '1' ),
                'default'  => '',
            ),
            array(
                'id'       => 'n2mu-portfolio-desc',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Description', 'magnat' ),
                'required' => array( 'n2mu-portfolio-details-enabled', '=', '1' ),
                'default'  => '',
            ),
        )
    );

    $metaboxes[] = array(
        'id' => 'portfolio-options',
        'title' => esc_html__('Portfolio Settings', 'magnat'),
        'post_types' => array('n2mu_portfolio'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
        'sections' => $boxSections
    );


    // Sidebar default
    $boxSections = array();
    $boxSections[] = array(
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'layout-custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom sidebar settings', 'magnat' ),
                'desc'      => esc_html__( 'Turn on if you want to override settings from theme options.', 'magnat' ),
                'default'  => false,
            ),
            array(
                'title'     => esc_html__( 'Layout', 'magnat' ),
                'desc'      => esc_html__( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'magnat' ),
                'id'        => 'layout',
                'required' => array( 'layout-custom', '=', '1' ),
                'default'   => '0',
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
                'id' => 'sidebar-left',
                'title' => esc_html__( 'Sidebar Left', 'magnat' ),
                'desc' => 'Please select left sidebar you would like to display on this page.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'n2mu_default_sidebar',
            ),
            array(
                'id' => 'sidebar-right',
                'title' => esc_html__( 'Sidebar Right', 'magnat' ),
                'desc' => 'Please select right sidebar you would like to display on this page.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'n2mu_default_sidebar',
            ),
        )
    );
    $metaboxes[] = array(
        'id' => 'sidebar-layout',
        'title' => esc_html__('Sidebar settings', 'magnat'),
        'post_types' => array('page'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'side', // normal, advanced, side
        'priority' => 'default', // high, core, default, low
        'sections' => $boxSections
    );


    // Sidebar post
    $boxSections = array();
    $boxSections[] = array(
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'layout-post-custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom sidebar settings', 'magnat' ),
                'desc'      => esc_html__( 'Turn on if you want to override settings from theme options.', 'magnat' ),
                'default'  => false,
            ),
            array(
                'title'     => esc_html__( 'Layout', 'magnat' ),
                'desc'      => esc_html__( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'magnat' ),
                'id'        => 'layout-post',
                'required' => array( 'layout-post-custom', '=', '1' ),
                'default'   => '0',
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
                'id' => 'sidebar-left',
                'title' => esc_html__( 'Sidebar Left', 'magnat' ),
                'desc' => 'Please select left sidebar you would like to display on this page.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'n2mu_default_sidebar',
            ),
            array(
                'id' => 'sidebar-right',
                'title' => esc_html__( 'Sidebar Right', 'magnat' ),
                'desc' => 'Please select right sidebar you would like to display on this page.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'n2mu_default_sidebar',
            ),
        )
    );
    $metaboxes[] = array(
        'id' => 'sidebar-post-layout',
        'title' => esc_html__('Sidebar settings', 'magnat'),
        'post_types' => array('post'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'side', // normal, advanced, side
        'priority' => 'default', // high, core, default, low
        'sections' => $boxSections
    );


    // Sidebar product
    $boxSections = array();
    $boxSections[] = array(
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'layout-shop-custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom sidebar settings', 'magnat' ),
                'desc'      => esc_html__( 'Turn on if you want to override settings from theme options.', 'magnat' ),
                'default'  => false,
            ),
            array(
                'title'     => esc_html__( 'Layout', 'magnat' ),
                'desc'      => esc_html__( 'Select main content and sidebar arrangement. Choose between 1, 2 or 3 column layout.', 'magnat' ),
                'id'        => 'layout-shop',
                'required' => array( 'layout-shop-custom', '=', '1' ),
                'default'   => '0',
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
                'id' => 'sidebar-left',
                'title' => esc_html__( 'Sidebar Left', 'magnat' ),
                'desc' => 'Please select left sidebar you would like to display on this page.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'n2mu_default_sidebar',
            ),
            array(
                'id' => 'sidebar-right',
                'title' => esc_html__( 'Sidebar Right', 'magnat' ),
                'desc' => 'Please select right sidebar you would like to display on this page.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'n2mu_default_sidebar',
            ),
        )
    );
    $metaboxes[] = array(
        'id' => 'sidebar-shop-layout',
        'title' => esc_html__('Sidebar settings', 'magnat'),
        'post_types' => array('product'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'side', // normal, advanced, side
        'priority' => 'default', // high, core, default, low
        'sections' => $boxSections
    );

    return $metaboxes;
  }
  add_action('redux/metaboxes/magnat_options/boxes', 'n2mu_add_metaboxes');
endif;