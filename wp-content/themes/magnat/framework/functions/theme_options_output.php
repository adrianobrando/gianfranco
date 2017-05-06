<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
	n2mu Inline CSS Generation
**/
if( ! function_exists( 'n2mu_get_inline_CSS' ) ) { 
	function n2mu_get_inline_CSS() {
		global $n2mu_js_params;
        global $magnat_options;
		
		// Inline CSS to be included
		$inline_css = '';

        // Header section
        $inline_css .= '
        .logo {
            height: '. n2mu_get_option('logo-img-height') .'px;
        }';

        $header_layout = n2mu_get_option('header-layout');

        // Header Top Height
        if($header_layout == 'header4' OR $header_layout == 'header6') {
            $inline_css .= '
            .header4 .at-top, .header6 .at-top {
                height: '. n2mu_get_option('header-top-height') .'px;
            }';
        }

        // Header Middle Height
        if($header_layout == 'header1' OR $header_layout == 'header2' OR $header_layout == 'header3' 
        OR $header_layout == 'header4' OR $header_layout == 'header5' OR $header_layout == 'header6') {
            $inline_css .= '
            .header1 .at-middle, .header2 .at-middle, .header3 .at-middle, .header4 .at-middle, .header5 .at-middle, .header6 .at-middle {
                height: '. n2mu_get_option('header-middle-height') .'px;
            }';
        }

        // Header Bottom Height
        if($header_layout == 'header2' OR $header_layout == 'header6') {
            $inline_css .= '
            .header2 .at-bottom, .header6 .at-bottom {
                height: '. n2mu_get_option('header-bottom-height') .'px;
            }';
        }

        // Header Mobile
        $inline_css .= '
        .n-header-mobile .n-subheader-cell {
            height: '. n2mu_get_option('header-mobile-height') .'px;
        }';

        $header_mobile_point = n2mu_get_option('header-mobile-point');
        $inline_css .= '
        @media (max-width: '.$header_mobile_point.'px) {
	        .header1, .header2, .header3, .header4, .header5, .header6, .header7, .header8 {
		        display:none;
            }
            .n-header-mobile {
                display: block;
            }
            .menu-side-left header, .menu-side-right header {
                width: 100%;
                position: inherit;
                top: inherit;
                left: inherit;
                bottom: inherit;
                overflow-y: inherit;
            }
            .menu-side-left main, .menu-side-right main {
                padding-right: 0px;
                padding-left: 0px;
            }
            @media (min-width: 1200px) {
                .container {
                    width: 1170px;
                }
            }
            @media (min-width: 992px) {
                .container {
                    width: 970px;
                }
            }
            @media (min-width: 768px) {
                .container {
                    width: 750px;
                }
            }
	    }';

        $n2mu_js_params['header_mobile_point'] = $header_mobile_point;

        // One page mode
        $one_page_mode = n2mu_get_post_meta('one-page-mode');

        if($one_page_mode) {
            $n2mu_js_params['one_page_mode'] = '1';
        }

        // Current menu item
        $color_current_menu_item = n2mu_get_option('color-link-menu-middle', 'hover');
        
        $inline_css .= '
            .at-middle .n-main-menu-wrapper > nav > ul > li.current_page_item > a {
                color: '. esc_attr($color_current_menu_item).';
            }';
        

        // Page Heading

        $page_heading_on = n2mu_get_option('page-heading-on', NULL, 'page-heading-custom');

        if($page_heading_on) {
            $page_heading_padding_top = n2mu_get_option('page-heading-spacing', 'padding-top', 'page-heading-custom');
            $page_heading_padding_bottom = n2mu_get_option('page-heading-spacing', 'padding-bottom', 'page-heading-custom');
            $page_heading_background_color = n2mu_get_option('page-heading-background', 'background-color', 'page-heading-custom');
            $page_heading_background_repeat = n2mu_get_option('page-heading-background', 'background-repeat', 'page-heading-custom');
            $page_heading_background_size = n2mu_get_option('page-heading-background', 'background-size', 'page-heading-custom');
            $page_heading_background_attachment = n2mu_get_option('page-heading-background', 'background-attachment', 'page-heading-custom');
            $page_heading_background_position = n2mu_get_option('page-heading-background', 'background-position', 'page-heading-custom');
            $page_heading_background_image = n2mu_get_option('page-heading-background', 'background-image', 'page-heading-custom');
            $page_heading_title_color = n2mu_get_option('page-heading-title-color', NULL, 'page-heading-custom');
            $page_heading_subtitle_color = n2mu_get_option('page-heading-subtitle-color', NULL, 'page-heading-custom');
            $inline_css .= '
            .page-heading {
                padding-top: '. esc_attr($page_heading_padding_top).';
                padding-bottom: '. esc_attr($page_heading_padding_bottom).';
                background-color: '.esc_attr($page_heading_background_color).';
                background-repeat: '.esc_attr($page_heading_background_repeat).';
                background-size: '.esc_attr($page_heading_background_size).';
                background-attachment: '.esc_attr($page_heading_background_attachment).';
                background-position: '.esc_attr($page_heading_background_position).';
                background-image: url('.esc_url($page_heading_background_image).');
            }
            .page-heading .page-heading-title {
                color: '.esc_attr($page_heading_title_color).';
            }
            .page-heading .page-heading-subtitle {
                color: '.esc_attr($page_heading_subtitle_color).';
            }';
        }

        // Page background
        $page_background_color = n2mu_get_option('page-background', 'background-color', 'page-background-custom');
        $page_background_repeat = n2mu_get_option('page-background', 'background-repeat', 'page-background-custom');
        $page_background_size = n2mu_get_option('page-background', 'background-size', 'page-background-custom');
        $page_background_attachment = n2mu_get_option('page-background', 'background-attachment', 'page-background-custom');
        $page_background_position = n2mu_get_option('page-background', 'background-position', 'page-background-custom');
        $page_background_image = n2mu_get_option('page-background', 'background-image', 'page-background-custom');
        $inline_css .= '
            body {
                background-color: '.esc_attr($page_background_color).';
                background-repeat: '.esc_attr($page_background_repeat).';
                background-size: '.esc_attr($page_background_size).';
                background-attachment: '.esc_attr($page_background_attachment).';
                background-position: '.esc_attr($page_background_position).';
                background-image: url('.esc_url($page_background_image).');
            }';

        // Borders in footer
        $footer_borders = n2mu_get_option('footer-top-borders');

        if($footer_borders == false) {
            $inline_css .= '
                .n2mu-footer-column {
                    border-right: none;
                }';
        }


        // Colors
        $color_main_theme = n2mu_get_option('color-main-theme');
        $inline_css .= '
            header .n-header-desktop .sub-menu, .n2mu-preloader-icon::before {
                border-top-color: '. esc_attr($color_main_theme).';
            }

            .header-cart-icon .cart-number, 
            .gotoplink:hover, .woocommerce span.onsale, 
            .woocommerce-page span.onsale {
                background-color: '. esc_attr($color_main_theme).';
            }

            .header-cart-icon .cart-number::before {
                border-right-color: '. esc_attr($color_main_theme).';
            }

            blockquote {
                border-left-color: '. esc_attr($color_main_theme).';
            }

            .woocommerce ul.products li.product .price ins, 
            .woocommerce-page ul.products li.product .price ins, 
            .product_list_widget ins, 
            .product_list_widget ins .amount {
                color: '. esc_attr($color_main_theme).';
            }';

        $color_buttons = n2mu_get_option('color-buttons');
        $inline_css .= '
            input[type="submit"], 
            .n-btn, .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button, 
            .woocommerce #respond input#submit, 
            .woocommerce #content input.button, 
            .woocommerce-page a.button,
			.woocommerce a.button.alt,
            .woocommerce-page button.button, 
            .woocommerce-page input.button, 
            .woocommerce-page #respond input#submit, 
            .woocommerce-page #content input.button,
            .woocommerce button.button.alt,
			.woocommerce button.button.alt.disabled,
            .pagination li.active a,
            .woocommerce nav.woocommerce-pagination ul li a:focus, 
            .woocommerce nav.woocommerce-pagination ul li a:hover, 
            .woocommerce nav.woocommerce-pagination ul li span.current {
                background-color: '. esc_attr($color_buttons).';
            }

            .pagination li.active a,
			.woocommerce nav.woocommerce-pagination ul li:first-child a.current {
                border-color: '. esc_attr($color_buttons).';
            }

            .pagination li a {
                color: '. esc_attr($color_buttons).';
            }';


        $color_buttons_font = n2mu_get_option('color-buttons-font');
        $inline_css .= '
            input[type="submit"], 
            .n-btn, .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button, 
            .woocommerce #respond input#submit, 
            .woocommerce #content input.button, 
            .woocommerce-page a.button, 
			.woocommerce a.button.alt,
            .woocommerce-page button.button, 
            .woocommerce-page input.button, 
            .woocommerce-page #respond input#submit, 
            .woocommerce-page #content input.button,
            .woocommerce button.button.alt,
			.woocommerce button.button.alt.disabled,
            .woocommerce nav.woocommerce-pagination ul li a:focus, 
            .woocommerce nav.woocommerce-pagination ul li a:hover, 
            .woocommerce nav.woocommerce-pagination ul li span.current,
			.woocommerce input.button:disabled,
			.woocommerce input.button:disabled[disabled] {
                color: '. esc_attr($color_buttons_font).';
            }';

        $color_buttons_hover = n2mu_get_option('color-buttons-hover');
        $inline_css .= '
            input[type="submit"]:hover, 
            .n-btn:hover, 
            .woocommerce a.button:hover, 
            .woocommerce button.button:hover, 
            .woocommerce input.button:hover, 
            .woocommerce #respond input#submit:hover, 
            .woocommerce #content input.button:hover, 
            .woocommerce-page a.button:hover, 
			.woocommerce a.button.alt:hover,
			.woocommerce button.button.alt.disabled:hover,
            .woocommerce-page button.button:hover, 
            .woocommerce-page input.button:hover, 
            .woocommerce-page #respond input#submit:hover, 
            .woocommerce-page #content input.button:hover,
            .woocommerce button.button.alt:hover, 
            .pagination li.active a:hover {
                background-color: '. esc_attr($color_buttons_hover).';
            }
            
            .pagination li.active a:hover {
                border-color: '. esc_attr($color_buttons_hover).';
            }
            
            .pagination li a:hover {
                color: '. esc_attr($color_buttons_hover).';
            }';

        $color_buttons_font_hover = n2mu_get_option('color-buttons-font-hover');
        $inline_css .= '
            input[type="submit"]:hover, 
            .n-btn:hover, 
            .woocommerce a.button:hover, 
            .woocommerce button.button:hover, 
            .woocommerce input.button:hover, 
            .woocommerce #respond input#submit:hover, 
            .woocommerce #content input.button:hover, 
            .woocommerce-page a.button:hover,
			.woocommerce a.button.alt:hover,
			.woocommerce button.button.alt.disabled:hover,			
            .woocommerce-page button.button:hover, 
            .woocommerce-page input.button:hover, 
            .woocommerce-page #respond input#submit:hover, 
            .woocommerce-page #content input.button:hover,
            .woocommerce button.button.alt:hover {
                color: '. esc_attr($color_buttons_font_hover).';
            }';
            
        $color_body = n2mu_get_option('color-body');
        $inline_css .= '
            body, .p {
                color: '. esc_attr($color_body).';
            }';

        $color_h1 = n2mu_get_option('color-h1');
        $inline_css .= '
            h1, .h1 {
                color: '. esc_attr($color_h1).';
            }';

        $color_h2 = n2mu_get_option('color-h2');
        $inline_css .= '
            h2, .h2 {
                color: '. esc_attr($color_h2).';
            }';
        
        $color_h3 = n2mu_get_option('color-h3');
        $inline_css .= '
            h3, .h3 {
                color: '. esc_attr($color_h3).';
            }';

        $color_h4 = n2mu_get_option('color-h4');
        $inline_css .= '
            h4, .h4 {
                color: '. esc_attr($color_h4).';
            }';

        $color_h5 = n2mu_get_option('color-h5');
        $inline_css .= '
            h5, .h5 {
                color: '. esc_attr($color_h5).';
            }';

        $color_h6 = n2mu_get_option('color-h6');
        $inline_css .= '
            h6, .h6 {
                color: '. esc_attr($color_h6).';
            }';

        $color_page_heading_title = n2mu_get_option('color-page-heading-title');
        $inline_css .= '
            .page-heading-title {
                color: '. esc_attr($color_page_heading_title).';
            }';

        $color_page_heading_subtitle = n2mu_get_option('color-page-heading-subtitle');
        $inline_css .= '
            .page-heading-subtitle {
                color: '. esc_attr($color_page_heading_subtitle).';
            }';

        $color_menu_mobile_link = n2mu_get_option('color-menu-mobile-link');
        $inline_css .= '
            .n-header-mobile .n-menu-wrap ul li a {
                color: '. esc_attr($color_menu_mobile_link).';
            }';

        $color_header_top_content = n2mu_get_option('color-header-top-content');
        $inline_css .= '
            .at-top {
                color: '. esc_attr($color_header_top_content).';
            }';

        $color_header_top = n2mu_get_option('color-header-top');
        $inline_css .= '
            .at-top {
                background-color: '. esc_attr($color_header_top).';
            }';

        $color_header_middle = n2mu_get_option('color-header-middle');
        $inline_css .= '
            .at-middle {
                background-color: '. esc_attr($color_header_middle).';
            }';

        $color_header_bottom = n2mu_get_option('color-header-bottom');
        $inline_css .= '
            .at-bottom {
                background-color: '. esc_attr($color_header_bottom).';
            }';

        $color_footer_top_headings = n2mu_get_option('color-footer-top-headings');
        $inline_css .= '
            .footer-top h1, .footer-top .h1, .footer-top h2, .footer-top .h2, .footer-top h3, .footer-top .h3, 
            .footer-top h4, .footer-top .h4, .footer-top h5, .footer-top .h5, .footer-top h6, .footer-top .h6 {
                color: '. esc_attr($color_footer_top_headings).';
            }';

        $color_footer_top_text = n2mu_get_option('color-footer-top-text');
        $inline_css .= '
            .footer-top, .footer-top p, .footer-top span {
                color: '. esc_attr($color_footer_top_text).';
            }';

        $color_footer_top = n2mu_get_option('color-footer-top');
        $inline_css .= '
            .footer-top {
                background-color: '. esc_attr($color_footer_top).';
            }';

        $color_footer_bottom_headings = n2mu_get_option('color-footer-bottom-headings');
        $inline_css .= '
            .footer-bottom h1, .footer-bottom .h1, .footer-bottom h2, .footer-bottom .h2, .footer-bottom h3, .footer-bottom .h3, 
            .footer-bottom h4, .footer-bottom .h4, .footer-bottom h5, .footer-bottom .h5, .footer-bottom h6, .footer-bottom .h6 {
                color: '. esc_attr($color_footer_bottom_headings).';
            }';

        $color_footer_bottom_text = n2mu_get_option('color-footer-bottom-text');
        $inline_css .= '
            .footer-bottom, .footer-bottom p, .footer-bottom span {
                color: '. esc_attr($color_footer_bottom_text).';
            }';

        $color_footer_bottom = n2mu_get_option('color-footer-bottom');
        $inline_css .= '
            .footer-bottom {
                background-color: '. esc_attr($color_footer_bottom).';
            }';
            
        // Normal/Sticky Header - Add param to js if header sticky option is checked
        if(n2mu_get_option('header-sticky') == '1'){
            $n2mu_js_params['sticky_header'] = '1';
        } else {
            $n2mu_js_params['sticky_header'] = '0';
        }
        
        // Custom CSS
		if($n2mu_custom_css = n2mu_get_option('custom_css')){
			$inline_css .="".esc_attr($n2mu_custom_css)."";
		}	

        // Clean inline css for better performance
		// Remove comments
		$buffer = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $inline_css );

		// Remove space after colons
		$buffer = str_replace( ': ', ':', $buffer );

		// Remove whitespace
		$buffer = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $buffer );

		// Return $inline_css
		$inline_css = $buffer;
		
		return html_entity_decode($inline_css);
	}
}