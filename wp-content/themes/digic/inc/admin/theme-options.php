<?php
/**
 * Digic Settings Options
 */
if (!class_exists('Redux_Framework_digic_settings')) {
    class Redux_Framework_digic_settings {
        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;
        public function __construct() {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }
        public function initSettings() {
            $this->theme = wp_get_theme();
            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();
            // Create the sections and fields
            $this->setSections();
            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
			$custom_font = digic_get_config('custom_font',false);
			if($custom_font != 1){
				remove_action( 'wp_head', array( $this->ReduxFramework, '_output_css' ),150 );
			}
        }
        function compiler_action($options, $css, $changed_values) {
        }
        function dynamic_section($sections) {
            return $sections;
        }
        function change_arguments($args) {
            return $args;
        }
        function change_defaults($defaults) {
            return $defaults;
        }
        function remove_demo() {
        }
        public function setSections() {
            $page_layouts = digic_options_layouts();
            $sidebars = digic_options_sidebars();
            $digic_header_type = digic_options_header_types();
            $digic_banners_effect = digic_options_banners_effect();
            // General Settings  ------------
            $this->sections[] = array(
                'icon' => 'fa fa-home',
                'icon_class' => 'icon',
                'title' => esc_html__('General', 'digic'),
                'fields' => array(                
                )
            );  
            // Layout Settings
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Layout', 'digic'),
                'fields' => array(
                    array(
                        'id' => 'background_img',
                        'type' => 'media',
                        'title' => esc_html__('Background Image', 'digic'),
                        'sub_desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id'=>'show-newletter',
                        'type' => 'switch',
                        'title' => esc_html__('Show Newletter Form', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Show', 'digic'),
                        'off' => esc_html__('Hide', 'digic'),
                    ),
                    array(
                        'id' => 'background_newletter_img',
                        'type' => 'media',
                        'title' => esc_html__('Popup Newletter Image', 'digic'),
                        'url'=> true,
                        'readonly' => false,
                        'sub_desc' => '',
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/newsletter-image.jpg'
                        )
                    ),
                    array(
                            'id' => 'back_active',
                            'type' => 'switch',
                            'title' => esc_html__('Back to top', 'digic'),
                            'sub_desc' => '',
                            'desc' => '',
                            'default' => '1'// 1 = on | 0 = off
                            ),                          
                    array(
                            'id' => 'direction',
                            'type' => 'select',
                            'title' => esc_html__('Direction', 'digic'),
                            'options' => array( 'ltr' => esc_html__('Left to Right', 'digic'), 'rtl' => esc_html__('Right to Left', 'digic') ),
                            'default' => 'ltr'
                        )        
                )
            );
            // Logo & Icons Settings
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Logo & Icons', 'digic'),
                'fields' => array(
                    array(
                        'id'=>'sitelogo',
                        'type' => 'media',
                        'compiler'  => 'true',
                        'mode'      => false,
                        'title' => esc_html__('Logo', 'digic'),
                        'desc'      => esc_html__('Upload Logo image default here.', 'digic'),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo/logo.png'
                        )
                    )
                )
            );
			//Vertical Menu
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'subsection' => true,
                'title' => esc_html__('Vertical Menu', 'digic'),
                'fields' => array( 
                    array(
                        'id'        => 'max_number_1530',
                        'type'      => 'text',
                        'title'     => esc_html__('Max number on screen >= 1530px', 'digic'),
                        'default'   => '12'
                    ),
                    array(
                        'id'        => 'max_number_1200',
                        'type'      => 'text',
                        'title'     => esc_html__('Max number on on screen >= 1200px', 'digic'),
                        'default'   => '8'
                    ),
					array(
                        'id'        => 'max_number_991',
                        'type'      => 'text',
                        'title'     => esc_html__('Max number on on screen >= 991px', 'digic'),
                        'default'   => '6'
                    )
                )
            );
            // Header Settings
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Header', 'digic'),
                'fields' => array(
                    array(
                        'id'=>'header_style',
                        'type' => 'image_select',
                        'full_width' => true,
                        'title' => esc_html__('Header Type', 'digic'),
                        'options' => $digic_header_type,
                        'default' => '4'
                    ),
                    array(
                        'id'=>'show-header-top',
                        'type' => 'switch',
                        'title' => esc_html__('Show Header Top', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'show-searchform',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Form', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'show-ajax-search',
                        'type' => 'switch',
                        'title' => esc_html__('Show Ajax Search', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic')
                    ),
                    array(
                        'id'=>'limit-ajax-search',
                        'type' => 'text',
                        'title' => esc_html__('Limit Of Result Search', 'digic'),
						'default' => 6,
						'required' => array('show-ajax-search','equals',true)
                    ),					
                    array(
                        'id'=>'search-cats',
                        'type' => 'switch',
                        'title' => esc_html__('Show Categories', 'digic'),
                        'required' => array('search-type','equals',array('post', 'product')),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'show-wishlist',
                        'type' => 'switch',
                        'title' => esc_html__('Show Wishlist', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
					array(
                        'id'=>'show-campbar',
                        'type' => 'switch',
                        'title' => esc_html__('Show Campbar', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
					array(
                        'id'=>'link-campbar',
                        'type' => 'text',
                        'title' => esc_html__('Link Campbar', 'digic'),
						'default' => '#',
						'required' => array('show-campbar','equals',true),
                    ),
					array(
                        'id'=>'content-campbar',
                        'type' => 'text',
                        'title' => esc_html__('Content Campbar', 'digic'),
						'default' => '20% OFF EVERYTHING – USE CODE:FLASH20 – ENDS SUNDAY',
						'required' => array('show-campbar','equals',true),
                    ),
					array(
						'id' => 'img-campbar',
						'type' => 'media',
						'title' => esc_html__('Image Campbar', 'digic'),
						'url'=> true,
						'readonly' => false,
						'required' => array('show-campbar','equals',true),
						'sub_desc' => '',
						'default' => array(
							'url' => ""
						)
					),
					 array(
                      'id' => 'color-campbar',
                      'type' => 'color',
                      'title' => esc_html__('Color Campbar', 'digic'),
                      'subtitle' => esc_html__('Select a color for Campbar.', 'digic'),
                      'default' => '#424cc7',
                      'transparent' => false,
					  'required' => array('show-campbar','equals',true),
                    ),
					array(
                        'id'=>'show-menutop',
                        'type' => 'switch',
                        'title' => esc_html__('Show Menu Top', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
					array(
                        'id'=>'show-mostsearch',
                        'type' => 'switch',
                        'title' => esc_html__('Show Most search', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
					array(
                        'id'=>'show-compare',
                        'type' => 'switch',
                        'title' => esc_html__('Show Compare', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
					array(
                        'id'=>'show-minicart',
                        'type' => 'switch',
                        'title' => esc_html__('Show Mini Cart', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
					array(
                        'id'=>'cart-layout',
						'type' => 'button_set',
                        'title' => esc_html__('Cart Layout', 'digic'),
                        'options' => array('dropdown' => esc_html__('Dropdown', 'digic'),
											'popup' => esc_html__('Popup', 'digic')),
						'default' => 'dropdown',
						'required' => array('show-minicart','equals',true),
                    ),
					array(
                        'id'=>'cart-style',
						'type' => 'button_set',
                        'title' => esc_html__('Cart Style', 'digic'),
                        'options' => array('dark' => esc_html__('Dark', 'digic'),
											'light' => esc_html__('Light', 'digic')),
						'default' => 'light',
						'required' => array('show-minicart','equals',true),
                    ),
                    array(
                        'id'=>'enable-sticky-header',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Sticky Header', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
					array(
                        'id'=>'email',
                        'type' => 'text',
                        'title' => esc_html__('Header Email', 'digic'),
                        'default' => ''
                    ),
					array(
                        'id'=>'address',
                        'type' => 'text',
                        'title' => esc_html__('Address', 'digic'),
                        'default' => 'Find Store'
                    ),
					array(
                        'id'=>'link_address',
                        'type' => 'text',
                        'title' => esc_html__('Link Address', 'digic'),
                        'default' => '#'
                    ),
					array(
                        'id'=>'phone',
                        'type' => 'text',
                        'title' => esc_html__('Phone', 'digic'),
                        'default' => '(+1)202-333-800'
                    ),
					array(
                        'id'=>'ship',
                        'type' => 'text',
                        'title' => esc_html__('Ship', 'digic'),
                        'default' => 'Free Shipping on Orders $300'
                    )
                )
            );
            // Footer Settings
            $footers = digic_get_footers();
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Footer', 'digic'),
                'fields' => array(
                    array(
                        'id' => 'footer_style',
                        'type' => 'image_select',
                        'title' => esc_html__('Footer Style', 'digic'),
                        'sub_desc' => esc_html__( 'Select Footer Style', 'digic' ),
                        'desc' => '',
                        'options' => $footers,
                        'default' => '32'
                    ),
                )
            );
            // Copyright Settings
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Copyright', 'digic'),
                'fields' => array(
                    array(
                        'id' => "footer-copyright",
                        'type' => 'textarea',
                        'title' => esc_html__('Copyright', 'digic'),
                        'default' => sprintf( wp_kses('&copy; Copyright %s. All Rights Reserved.', 'digic'), date('Y') )
                    ),
                    array(
                        'id'=>'footer-payments',
                        'type' => 'switch',
                        'title' => esc_html__('Show Payments Logos', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'footer-payments-image',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => esc_html__('Payments Image', 'digic'),
                        'required' => array('footer-payments','equals','1'),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/payments.png'
                        )
                    ),
                    array(
                        'id'=>'footer-payments-image-alt',
                        'type' => 'text',
                        'title' => esc_html__('Payments Image Alt', 'digic'),
                        'required' => array('footer-payments','equals','1'),
                        'default' => ''
                    ),
                    array(
                        'id'=>'footer-payments-link',
                        'type' => 'text',
                        'title' => esc_html__('Payments Link URL', 'digic'),
                        'required' => array('footer-payments','equals','1'),
                        'default' => ''
                    )
                )
            );
            // Page Title Settings
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Page Title', 'digic'),
                'fields' => array(
					array(
                        'id'=>'show_bg_breadcrumb',
                        'type' => 'switch',
                        'title' => esc_html__('Show Background Breadcrumb', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'page_title',
                        'type' => 'switch',
                        'title' => esc_html__('Show Page Title', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
						'required' => array('show_bg_breadcrumb','equals', true),
                    ),
                    array(
                        'id'=>'page_title_bg',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => esc_html__('Background', 'digic'),
						'required' => array('show_bg_breadcrumb','equals', true),
	                    'default' => array(
                            'url' => "",
                        )							
                    ),
                    array(
                        'id' => 'breadcrumb',
                        'type' => 'switch',
                        'title' => esc_html__('Show Breadcrumb', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                        'required' => array('show_bg_breadcrumb','equals', true),
                    ),
                )
            );
            // 404 Page Settings
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('404 Error', 'digic'),
                'fields' => array(
                    array(
                        'id'=>'title-error',
                        'type' => 'text',
                        'title' => esc_html__('Content Page 404', 'digic'),
                        'desc' => esc_html__('Input a block slug name', 'digic'),
                        'default' => '404'
                    ),
					array(
                        'id'=>'sub-title',
                        'type' => 'text',
                        'title' => esc_html__('Content Page 404', 'digic'),
                        'desc' => esc_html__('Input a block slug name', 'digic'),
                        'default' => "Oops! That page can't be found."
                    ), 					
                    array(
                        'id'=>'sub-error',
                        'type' => 'text',
                        'title' => esc_html__('Content Page 404', 'digic'),
                        'desc' => esc_html__('Input a block slug name', 'digic'),
                        'default' => "We're really sorry but we can't seem to find the page you were looking for."
                    ),               
                    array(
                        'id'=>'btn-error',
                        'type' => 'text',
                        'title' => esc_html__('Button Page 404', 'digic'),
                        'desc' => esc_html__('Input a block slug name', 'digic'),
                        'default' => 'Back The Homepage'
                    )                      
                )
            );
            // Social Share Settings
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Social Share', 'digic'),
                'fields' => array(
                    array(
                        'id'=>'social-share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Links', 'digic'),
                        'desc' => esc_html__('Show social links in post and product, page, portfolio, etc.', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'share-fb',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Facebook Share', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'share-tw',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Twitter Share', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'share-linkedin',
                        'type' => 'switch',
                        'title' => esc_html__('Enable LinkedIn Share', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'share-pinterest',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Pinterest Share', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                )
            );
            $this->sections[] = array(
				'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Socials Link', 'digic'),
                'fields' => array(
                    array(
                        'id'=>'socials_link',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Socials link', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'link-fb',
                        'type' => 'text',
                        'title' => esc_html__('Enter Facebook link', 'digic'),
						'default' => '#'
                    ),
                    array(
                        'id'=>'link-tw',
                        'type' => 'text',
                        'title' => esc_html__('Enter Twitter link', 'digic'),
						'default' => '#'
                    ),
                    array(
                        'id'=>'link-linkedin',
                        'type' => 'text',
                        'title' => esc_html__('Enter LinkedIn link', 'digic'),
						'default' => '#'
                    ),
                    array(
                        'id'=>'link-youtube',
                        'type' => 'text',
                        'title' => esc_html__('Enter Youtube link', 'digic'),
						'default' => '#'
                    ),
                    array(
                        'id'=>'link-pinterest',
                        'type' => 'text',
                        'title' => esc_html__('Enter Pinterest link', 'digic'),
						'default' => '#'
                    ),
                    array(
                        'id'=>'link-instagram',
                        'type' => 'text',
                        'title' => esc_html__('Enter Instagram link', 'digic'),
						'default' => '#'
                    ),
                )
            );			
            //     The end -----------
            // Styling Settings  -------------
            $this->sections[] = array(
                'icon' => 'icofont icofont-brand-appstore',
                'icon_class' => 'icon',
                'title' => esc_html__('Styling', 'digic'),
                'fields' => array(              
                )
            );  
            // Color & Effect Settings
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Color & Effect', 'digic'),
                'fields' => array(
                    array(
                        'id'=>'compile-css',
                        'type' => 'switch',
                        'title' => esc_html__('Compile Css', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),					
                    array(
                      'id' => 'main_theme_color',
                      'type' => 'color',
                      'title' => esc_html__('Main Theme Color', 'digic'),
                      'subtitle' => esc_html__('Select a main color for your site.', 'digic'),
                      'default' => '#222222',
                      'transparent' => false,
					  'required' => array('compile-css','equals',array(true)),
                    ),      
                    array(
                        'id'=>'show-loading-overlay',
                        'type' => 'switch',
                        'title' => esc_html__('Loading Overlay', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Show', 'digic'),
                        'off' => esc_html__('Hide', 'digic'),
                    ),
                    array(
                        'id'=>'banners_effect',
                        'type' => 'image_select',
                        'full_width' => true,
                        'title' => esc_html__('Banner Effect', 'digic'),
                        'options' => $digic_banners_effect,
                        'default' => 'banners-effect-1'
                    )                   
                )
            );
            // Typography Settings
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Typography', 'digic'),
                'fields' => array(
                    array(
                        'id'=>'custom_font',
                        'type' => 'switch',
                        'title' => esc_html__('Custom Font', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),				
                    array(
                        'id'=>'select-google-charset',
                        'type' => 'switch',
                        'title' => esc_html__('Select Google Font Character Sets', 'digic'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
						'required' => array('custom_font','equals',true),
                    ),
                    array(
                        'id'=>'google-charsets',
                        'type' => 'button_set',
                        'title' => esc_html__('Google Font Character Sets', 'digic'),
                        'multi' => true,
                        'required' => array('select-google-charset','equals',true),
                        'options'=> array(
                            'cyrillic' => 'Cyrrilic',
                            'cyrillic-ext' => 'Cyrrilic Extended',
                            'greek' => 'Greek',
                            'greek-ext' => 'Greek Extended',
                            'khmer' => 'Khmer',
                            'latin' => 'Latin',
                            'latin-ext' => 'Latin Extneded',
                            'vietnamese' => 'Vietnamese'
                        ),
                        'default' => array('latin','greek-ext','cyrillic','latin-ext','greek','cyrillic-ext','vietnamese','khmer')
                    ),
                    array(
                        'id'=>'family_font_body',
                        'type' => 'typography',
                        'title' => esc_html__('Body Font', 'digic'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
						'output'      => array('body'),
                        'color' => false,
                        'default'=> array(
                            'color'=>"#777777",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'14px',
                            'line-height' => '22px'
                        ),
						'required' => array('custom_font','equals',true)
                    ),
                    array(
                        'id'=>'h1-font',
                        'type' => 'typography',
                        'title' => esc_html__('H1 Font', 'digic'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'color' 	=> false,
						'output'      => array('body h1'),
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'36px',
                            'line-height' => '44px'
                        ),
						'required' => array('custom_font','equals',true)
                    ),
                    array(
                        'id'=>'h2-font',
                        'type' => 'typography',
                        'title' => esc_html__('H2 Font', 'digic'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'color' => false,
						'output'      => array('body h2'),
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'300',
                            'font-family'=>'Open Sans',
                            'font-size'=>'30px',
                            'line-height' => '40px'
                        ),
						'required' => array('custom_font','equals',true)
                    ),
                    array(
                        'id'=>'h3-font',
                        'type' => 'typography',
                        'title' => esc_html__('H3 Font', 'digic'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'color' => false,
						'output'      => array('body h3'),
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'25px',
                            'line-height' => '32px'
                        ),
						'required' => array('custom_font','equals',true)
                    ),
                    array(
                        'id'=>'h4-font',
                        'type' => 'typography',
                        'title' => esc_html__('H4 Font', 'digic'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'color' => false,
						'output'      => array('body h4'),
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'20px',
                            'line-height' => '27px'
                        ),
						'required' => array('custom_font','equals',true)
                    ),
                    array(
                        'id'=>'h5-font',
                        'type' => 'typography',
                        'title' => esc_html__('H5 Font', 'digic'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'color' => false,
						'output'      => array('body h5'),
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'600',
                            'font-family'=>'Open Sans',
                            'font-size'=>'14px',
                            'line-height' => '18px'
                        ),
						'required' => array('custom_font','equals',true)
                    ),
                    array(
                        'id'=>'h6-font',
                        'type' => 'typography',
                        'title' => esc_html__('H6 Font', 'digic'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'color' => false,
						'output'      => array('body h6'),
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'14px',
                            'line-height' => '18px'
                        ),
						'required' => array('custom_font','equals',true)
                    )
                )
            );
            //     The end -----------          
            if ( class_exists( 'Woocommerce' ) ) :
                $this->sections[] = array(
                    'icon' => 'icofont icofont-cart-alt',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Ecommerce', 'digic'),
                    'fields' => array(              
                    )
                );
                $this->sections[] = array(
                    'icon' => 'icofont icofont-double-right',
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Product Archives', 'digic'),
                    'fields' => array(
						array(
                            'id'=>'shop_paging',
							'title' => esc_html__('Shop Paging', 'digic'),
                            'type' => 'select',
							'options' => array(
								'shop-pagination' => esc_html__('Pagination', 'digic'),
								'shop-infinity' => esc_html__('Infinity', 'digic'),
								'shop-loadmore' => esc_html__('Load More', 'digic'),
                             ),
                            'default' => 'shop-pagination',
                        ),
						array(
                            'id'=>'show_background_shop',
							'title' => esc_html__('Show Background Shop', 'digic'),
                            'type' => 'button_set',
                            'default' => 'no',
							'options' => array(
								'yes' => esc_html__('Yes', 'digic'),
								'no' => esc_html__('No', 'digic')
							),
                        ),
						array(
                            'id'=>'show_catagories_top',
							'title' => esc_html__('Show Categories Top', 'digic'),
                            'type' => 'button_set',
                            'default' => 'no',
							'options' => array(
								'yes' => esc_html__('Yes', 'digic'),
								'no' => esc_html__('No', 'digic')
							),
                        ),
						array(
                            'id'=>'catagories_top_style',
							'title' => esc_html__('Categories Top Style', 'digic'),
                            'type' => 'button_set',
							'required' => array('show_catagories_top','equals','yes'),
							'options' => array(
								'style_1' => esc_html__('Style 1', 'digic'),
								'style_2' => esc_html__('Style 2', 'digic')
                             ),
                            'default' => 'style_1',
                        ),
						array(
                            'id'=>'limit_catagories_top',
							'title' => esc_html__('Limit Categories Top', 'digic'),
                            'type' => 'text',
							'required' => array('show_catagories_top','equals','yes'),
                            'default' => '9',
                        ),
						array(
                            'id'=>'limit_children_shop',
							'title' => esc_html__('Limit Children Categories Top', 'digic'),
                            'type' => 'text',
							'required' => array('show_catagories_top','equals','yes'),
                            'default' => '4',
                        ),
						array(
                            'id'=>'layout_shop',
							'title' => esc_html__('Style Layout Shop', 'digic'),
                            'type' => 'button_set',
							'options' => array(
								'1' => esc_html__('Style 1', 'digic'),
								'2' => esc_html__('Style 2', 'digic'),
								'3' => esc_html__('Style 3', 'digic'),
								'4' => esc_html__('Style 4', 'digic'),
								'5' => esc_html__('Style 5', 'digic'),
								'6' => esc_html__('Style 6', 'digic'),
								'7' => esc_html__('Style 7', 'digic'),
								'8' => esc_html__('Style 8', 'digic'),
                             ),
                            'default' => '1',
                        ),	
						array(
                            'id'=>'show-bestseller-category',
                            'type' => 'switch',
                            'title' => esc_html__('Show Bestseller on Page Category', 'digic'),
                            'type' => 'button_set',
                            'default' => 'no',
							'options' => array(
								'yes' => esc_html__('Yes', 'digic'),
								'no' => esc_html__('No', 'digic')
							),
                        ),
						 array(
                            'id' => 'bestseller_limit',
                            'type' => 'text',
                            'title' => esc_html__('Shop product Bestseller', 'digic'),
                            'default' => '9',
							'required' => array('show-bestseller-category','equals','yes'),
                        ),
						array(
                            'id'=>'show-featured-category',
                            'type' => 'switch',
                            'title' => esc_html__('Show Featured on Page Category', 'digic'),
                            'type' => 'button_set',
                            'default' => 'no',
							'options' => array(
								'yes' => esc_html__('Yes', 'digic'),
								'no' => esc_html__('No', 'digic')
							),
                        ),
						 array(
                            'id' => 'featured_limit',
                            'type' => 'text',
                            'title' => esc_html__('Shop product Featured', 'digic'),
                            'default' => '9',
							'required' => array('show-featured-category','equals','yes'),
                        ),
                        array(
                            'id'=>'show-banner-category',
                            'type' => 'switch',
                            'title' => esc_html__('Show Banner Category', 'digic'),
                            'type' => 'button_set',
                            'default' => 'yes',
							'options' => array(
								'yes' => esc_html__('Yes', 'digic'),
								'no' => esc_html__('No', 'digic')
							),
                        ),
						array(
							'id' => 'banner-shop',
							'type' => 'media',
							'title' => esc_html__('Banner Shop', 'digic'),
							'url'=> true,
							'readonly' => false,
							'required' => array('show-banner-category','equals','yes'),
							'sub_desc' => '',
							'default' => array(
								'url' => ""
							)
						),
						 array(
                            'id' => 'link-banner-shop',
                            'type' => 'text',
                            'title' => esc_html__('Url Banner Shop', 'digic'),
                            'default' => '#',
							'required' => array('show-banner-category','equals','yes'),
                        ),
                        array(
                            'id'=>'category-view-mode',
                            'type' => 'button_set',
                            'title' => esc_html__('View Mode', 'digic'),
                            'options' => digic_ct_category_view_mode(),
                            'default' => 'grid',
                        ),
                        array(
                            'id' => 'product_col_large',
                            'type' => 'button_set',
                            'title' => esc_html__('Product Listing column Desktop', 'digic'),
                            'options' => array(
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4'                        
                                ),
                            'default' => '4',
                            'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'digic' ),
                        ),
                        array(
                            'id' => 'product_col_medium',
                            'type' => 'button_set',
                            'title' => esc_html__('Product Listing column Medium Desktop', 'digic'),
                            'options' => array(
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4'                          
                                ),
                            'default' => '3',
                            'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'digic' ),
                        ),
                        array(
                            'id' => 'product_col_sm',
                            'type' => 'button_set',
                            'title' => esc_html__('Product Listing column Ipad Screen', 'digic'),
                            'options' => array(
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4'                          
                                ),
                            'default' => '3',
                            'sub_desc' => esc_html__( 'Select number of column on Ipad Screen', 'digic' ),
                        ),
						array(
                            'id' => 'product_col_xs',
                            'type' => 'button_set',
                            'title' => esc_html__('Product Listing column Mobile Screen', 'digic'),
                            'options' => array(
									'1' => '1',
                                    '2' => '2',
                                    '3' => '3'                        
                                ),
                            'default' => '2',
                            'sub_desc' => esc_html__( 'Select number of column on Mobile Screen', 'digic' ),
                        ),
                        array(
                            'id'=>'woo-show-rating',
                            'type' => 'switch',
                            'title' => esc_html__('Show Rating in Woocommerce Products Widget', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),						
						array(
                            'id'=>'show-category',
                            'type' => 'switch',
                            'title' => esc_html__('Show Category', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
                        array(
                            'id' => 'product_count',
                            'type' => 'text',
                            'title' => esc_html__('Shop pages show at product', 'digic'),
                            'default' => '12',
                            'sub_desc' => esc_html__( 'Type Count Product Per Shop Page', 'digic' ),
                        ),						
                        array(
                            'id'=>'category-image-hover',
                            'type' => 'switch',
                            'title' => esc_html__('Enable Image Hover Effect', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
                        array(
                            'id'=>'category-hover',
                            'type' => 'switch',
                            'title' => esc_html__('Enable Hover Effect', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
                        array(
                            'id'=>'product-wishlist',
                            'type' => 'switch',
                            'title' => esc_html__('Show Wishlist', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
						array(
							'id'=>'product-compare',
							'type' => 'switch',
							'title' => esc_html__('Show Compare', 'digic'),
							'default' => false,
							'on' => esc_html__('Yes', 'digic'),
							'off' => esc_html__('No', 'digic'),
						),						
                        array(
                            'id'=>'product_quickview',
                            'type' => 'switch',
                            'title' => esc_html__('Show Quick View', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic')
                        ),
                        array(
                            'id'=>'product-quickview-label',
                            'type' => 'text',
                            'required' => array('product-quickview','equals',true),
                            'title' => esc_html__('"Quick View" Text', 'digic'),
                            'default' => ''
                        ),
						array(
                            'id'=>'product-countdown',
                            'type' => 'switch',
                            'title' => esc_html__('Show Product Countdown', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic')
                        ),
						array(
                            'id'=>'checkout_page_style',
                            'title' => esc_html__('Checkout Page Style', 'digic'),
                            'type' => 'button_set',
                            'options' => array(
                                    'checkout-page-style-1' => 'Style 1',
                                    'checkout-page-style-2' => 'Style 2',                        
                                ),
                            'default' => 'style-1',
                        ),
                    )
                );
                $this->sections[] = array(
                    'icon' => 'icofont icofont-double-right',
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Single Product', 'digic'),
                    'fields' => array(
						array(
							'id'=>'layout_sigle_product',
							'type' => 'button_set',
							'title' => esc_html__('Layout Single Product', 'digic'),
							'options' => array(
								'default' => esc_html__('Default', 'digic'),
								'box' => esc_html__('Box', 'digic'),
								'sidebar' => esc_html__('Sidebar', 'digic')
							),
							'default' => 'default'
						),
                        array(
                            'id'=>'product-stock',
                            'type' => 'switch',
                            'title' => esc_html__('Show "Out of stock" Status', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
						array(
                            'id'=>'show-sticky-cart',
                            'type' => 'switch',
                            'title' => esc_html__('Show Sticky Cart Product', 'digic'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
						array(
                            'id'=>'show-brands',
                            'type' => 'switch',
                            'title' => esc_html__('Show Brands', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
						array(
                            'id'=>'show-countdown',
                            'type' => 'switch',
                            'title' => esc_html__('Show CountDown', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
						array(
                            'id'=>'show-quick-buy',
                            'type' => 'switch',
                            'title' => esc_html__('Show Button Buy Now', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),						
                        array(
                            'id'=>'product-short-desc',
                            'type' => 'switch',
                            'title' => esc_html__('Show Short Description', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),					
                        array(
                            'id'=>'product-related',
                            'type' => 'switch',
                            'title' => esc_html__('Show Related Product', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
                        array(
                            'id'=>'product-related-count',
                            'type' => 'text',
                            'required' => array('product-related','equals',true),
                            'title' => esc_html__('Related Product Count', 'digic'),
                            'default' => '10'
                        ),
                        array(
                            'id'=>'product-related-cols',
                            'type' => 'button_set',
                            'required' => array('product-related','equals',true),
                            'title' => esc_html__('Related Product Columns', 'digic'),
                            'options' => digic_ct_related_product_columns(),
                            'default' => '4',
                        ),
                        array(
                            'id'=>'product-upsell',
                            'type' => 'switch',
                            'title' => esc_html__('Show Upsell Products', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),                      
                        array(
                            'id'=>'product-upsell-count',
                            'type' => 'text',
                            'required' => array('product-upsell','equals',true),
                            'title' => esc_html__('Upsell Products Count', 'digic'),
                            'default' => '10'
                        ),
                        array(
                            'id'=>'product-upsell-cols',
                            'type' => 'button_set',
                            'required' => array('product-upsell','equals',true),
                            'title' => esc_html__('Upsell Product Columns', 'digic'),
                            'options' => digic_ct_related_product_columns(),
                            'default' => '3',
                        ),
                        array(
                            'id'=>'product-crosssells',
                            'type' => 'switch',
                            'title' => esc_html__('Show Crooss Sells Products', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),                      
                        array(
                            'id'=>'product-crosssells-count',
                            'type' => 'text',
                            'required' => array('product-crosssells','equals',true),
                            'title' => esc_html__('Crooss Sells Products Count', 'digic'),
                            'default' => '10'
                        ),
                        array(
                            'id'=>'product-crosssells-cols',
                            'type' => 'button_set',
                            'required' => array('product-crosssells','equals',true),
                            'title' => esc_html__('Crooss Sells Product Columns', 'digic'),
                            'options' => digic_ct_related_product_columns(),
                            'default' => '3',
                        ),						
                        array(
                            'id'=>'product-hot',
                            'type' => 'switch',
                            'title' => esc_html__('Show "Hot" Label', 'digic'),
                            'desc' => esc_html__('Will be show in the featured product.', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
                        array(
                            'id'=>'product-hot-label',
                            'type' => 'text',
                            'required' => array('product-hot','equals',true),
                            'title' => esc_html__('"Hot" Text', 'digic'),
                            'default' => ''
                        ),
                        array(
                            'id'=>'product-sale',
                            'type' => 'switch',
                            'title' => esc_html__('Show "Sale" Label', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
                         array(
                            'id'=>'product-sale-percent',
                            'type' => 'switch',
                            'required' => array('product-sale','equals',true),
                            'title' => esc_html__('Show Sale Price Percentage', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),  
                        array(
                            'id'=>'product-share',
                            'type' => 'switch',
                            'title' => esc_html__('Show Social Share Links', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
						array(
							'id'=>'description-style',
							'type' => 'select',
							'title' => esc_html__('Description Style', 'digic'),
							'options' => array(
										'full-content' => esc_html__('Full Content', 'digic'),
										'tab' => esc_html__('Tab', 'digic'),
										),
							'default' => 'tab',
						),
                    )
                );
                $this->sections[] = array(
                    'icon' => 'icofont icofont-double-right',
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Image Product', 'digic'),
                    'fields' => array(
                        array(
                            'id'=>'product-thumbs',
                            'type' => 'switch',
                            'title' => esc_html__('Show Thumbnails', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
                        ),
						array(
                            'id'=>'layout-thumbs',
                            'type' => 'button_set',
                            'title' => esc_html__('Layouts Product', 'digic'),
                            'options' => array('zoom' => esc_html__('Zoom', 'digic'),
												'scroll' => esc_html__('Scroll', 'digic'),
												'special' => esc_html__('Special', 'digic'),
											),	
                            'default' => 'zoom',
                        ),
                        array(
                            'id'=>'position-thumbs',
                            'type' => 'button_set',
                            'title' => esc_html__('Position Thumbnails', 'digic'),
                            'options' => array('left' => esc_html__('Left', 'digic'),
												'right' => esc_html__('Right', 'digic'),
												'bottom' => esc_html__('Bottom', 'digic'),
												'outsite' => esc_html__('Outsite', 'digic')),
                            'default' => 'bottom',
							'required' => array('product-thumbs','equals',true),
                        ),						
                        array(
                            'id' => 'product-thumbs-count',
                            'type' => 'button_set',
                            'title' => esc_html__('Thumbnails Count', 'digic'),
                            'options' => array(
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4', 
									'5' => '5', 									
                                    '6' => '6'                          
                                ),
							'default' => '4',
							'required' => array('product-thumbs','equals',true),
                        ),
						 array(
                            'id' => 'video-style',
                            'type' => 'button_set',
                            'title' => esc_html__('Video Style', 'digic'),
                            'options' => array(
                                    'popup' => 'Popup',
                                    'inner' => 'Inner',                          
                                ),
							'default' => 'inner',
                        ),
                        array(
                            'id'=>'zoom-type',
                            'type' => 'button_set',
                            'title' => esc_html__('Zoom Type', 'digic'),
                            'options' => array(
									'inner' => esc_html__('Inner', 'digic'),
									'window' => esc_html__('Window', 'digic'),
									'lens' => esc_html__('Lens', 'digic')
									),
                            'default' => 'inner',
							'required' => array('layout-thumbs','equals',"zoom"),
                        ),
                        array(
                            'id'=>'zoom-scroll',
                            'type' => 'switch',
                            'title' => esc_html__('Scroll Zoom', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
							'required' => array('layout-thumbs','equals',"zoom"),
                        ),
                        array(
                            'id'=>'zoom-border',
                            'type' => 'text',
                            'title' => esc_html__('Border Size', 'digic'),
                            'default' => '2',
							'required' => array('layout-thumbs','equals',"zoom"),
                        ),
                        array(
                            'id'=>'zoom-border-color',
                            'type' => 'color',
                            'title' => esc_html__('Border Color', 'digic'),
                            'default' => '#f9b61e',
							'required' => array('layout-thumbs','equals',"zoom"),
                        ),                      
                        array(
                            'id'=>'zoom-lens-size',
                            'type' => 'text',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => esc_html__('Lens Size', 'digic'),
                            'default' => '200',
							'required' => array('layout-thumbs','equals',"zoom"),
                        ),
                        array(
                            'id'=>'zoom-lens-shape',
                            'type' => 'button_set',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => esc_html__('Lens Shape', 'digic'),
                            'options' => array('round' => esc_html__('Round', 'digic'), 'square' => esc_html__('Square', 'digic')),
                            'default' => 'square',
							'required' => array('layout-thumbs','equals',"zoom"),
                        ),
                        array(
                            'id'=>'zoom-contain-lens',
                            'type' => 'switch',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => esc_html__('Contain Lens Zoom', 'digic'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'digic'),
                            'off' => esc_html__('No', 'digic'),
							'required' => array('layout-thumbs','equals',"zoom"),
                        ),
                        array(
                            'id'=>'zoom-lens-border',
                            'type' => 'text',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => esc_html__('Lens Border', 'digic'),
                            'default' => true,
							'required' => array('layout-thumbs','equals',"zoom")
                        ),
                    )
                );
            endif;
            // Blog Settings  -------------
            $this->sections[] = array(
                'icon' => 'icofont icofont-ui-copy',
                'icon_class' => 'icon',
                'title' => esc_html__('Blog', 'digic'),
                'fields' => array(              
                )
            );      
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Blog & Post Archives', 'digic'),
                'fields' => array(
                    array(
                        'id'=>'post-format',
                        'type' => 'switch',
                        'title' => esc_html__('Show Post Format', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'hot-label',
                        'type' => 'text',
                        'title' => esc_html__('"HOT" Text', 'digic'),
                        'desc' => esc_html__('Hot post label', 'digic'),
                        'default' => ''
                    ),
                    array(
                        'id'=>'sidebar_blog',
                        'type' => 'image_select',
                        'title' => esc_html__('Page Layout', 'digic'),
                        'options' => $page_layouts,
                        'default' => 'left'
                    ),
                    array(
                        'id' => 'layout_blog',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout Blog', 'digic'),
                        'options' => array(
                                'list'  =>  esc_html__( 'List', 'digic' ),
                                'grid' =>  esc_html__( 'Grid', 'digic' ),
								'masonry' =>  esc_html__( 'Masonry', 'digic' ),
								'modern' =>  esc_html__( 'Modern', 'digic' ),
								'standar' =>  esc_html__( 'Standar', 'digic' )
                        ),
                        'default' => 'standar',
                        'sub_desc' => esc_html__( 'Select style layout blog', 'digic' ),
                    ),
                    array(
                        'id' => 'blog_col_large',
                        'type' => 'button_set',
                        'title' => esc_html__('Blog Listing column Desktop', 'digic'),
                        'required' => array('layout_blog','equals','grid'),
                        'options' => array(
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',                         
                                '6' => '6'                          
                            ),
                        'default' => '4',
                        'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'digic' ),
                    ),
                    array(
                        'id' => 'blog_col_medium',
                        'type' => 'button_set',
                        'title' => esc_html__('Blog Listing column Medium Desktop', 'digic'),
                        'required' => array('layout_blog','equals','grid'),
                        'options' => array(
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',                         
                                '6' => '6'                          
                            ),
                        'default' => '3',
                        'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'digic' ),
                    ),   
                    array(
                        'id' => 'blog_col_sm',
                        'type' => 'button_set',
                        'title' => esc_html__('Blog Listing column Ipad Screen', 'digic'),
                        'required' => array('layout_blog','equals','grid'),
                        'options' => array(
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',                         
                                '6' => '6'                          
                            ),
                        'default' => '3',
                        'sub_desc' => esc_html__( 'Select number of column on Ipad Screen', 'digic' ),
                    ),   					
                    array(
                        'id'=>'archives-author',
                        'type' => 'switch',
                        'title' => esc_html__('Show Author', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'archives-comments',
                        'type' => 'switch',
                        'title' => esc_html__('Show Count Comments', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),                  
                    array(
                        'id'=>'blog-excerpt',
                        'type' => 'switch',
                        'title' => esc_html__('Show Excerpt', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'list-blog-excerpt-length',
                        'type' => 'text',
                        'required' => array('blog-excerpt','equals',true),
                        'title' => esc_html__('List Excerpt Length', 'digic'),
                        'desc' => esc_html__('The number of words', 'digic'),
                        'default' => '50',
                    ),
                    array(
                        'id'=>'grid-blog-excerpt-length',
                        'type' => 'text',
                        'required' => array('blog-excerpt','equals',true),
                        'title' => esc_html__('Grid Excerpt Length', 'digic'),
                        'desc' => esc_html__('The number of words', 'digic'),
                        'default' => '12',
                    ),                  
                )
            );
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Single Post', 'digic'),
                'fields' => array(
                    array(
                        'id'=>'post-single-layout',
                        'type' => 'select',
                        'title' => esc_html__('Page Layout', 'digic'),
                        'options' => array(
								'sidebar' =>  esc_html__( 'Sidebar', 'digic' ),
                                'one_column' =>  esc_html__( 'One Column', 'digic' ),
								'prallax_image' =>  esc_html__( 'Prallax Image', 'digic' ),
								'simple_title' =>  esc_html__( 'Simple Title', 'digic' ),
								'sticky_title' =>  esc_html__( 'Sticky Title', 'digic' )
                        ),
                        'default' => 'sidebar'
                    ),
                    array(
                        'id'=>'post-title',
                        'type' => 'switch',
                        'title' => esc_html__('Show Title', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'post-author',
                        'type' => 'switch',
                        'title' => esc_html__('Show Author Info', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
                    ),
                    array(
                        'id'=>'post-comments',
                        'type' => 'switch',
                        'title' => esc_html__('Show Comments', 'digic'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'digic'),
                        'off' => esc_html__('No', 'digic'),
					)
				)
			);	
            $this->sections[] = array(
				'id' => 'wbc_importer_section',
				'title'  => esc_html__( 'Demo Importer', 'digic' ),
				'icon'   => 'fa fa-cloud-download',
				'desc'   => wp_kses( 'Increase your max execution time, try 40000 I know its high but trust me.<br>
				Increase your PHP memory limit, try 512MB.<br>
				1. The import process will work best on a clean install. You can use a plugin such as WordPress Reset to clear your data for you.<br>
				2. Ensure all plugins are installed beforehand, e.g. WooCommerce - any plugins that you add content to.<br>
				3. Be patient and wait for the import process to complete. It can take up to 3-5 minutes.<br>
				4. Enjoy','social' ),				
				'fields' => array(
					array(
						'id'   => 'wbc_demo_importer',
						'type' => 'wbc_importer'
					)
				)
            );			
        }
        public function setHelpTabs() {
        }
        public function setArguments() {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args = array(
                'opt_name'          => 'digic_settings',
                'display_name'      => $theme->get('Name') . ' ' . esc_html__('Theme Options', 'digic'),
                'display_version'   => esc_html__('Theme Version: ', 'digic') . digic_version,
                'menu_type'         => 'submenu',
                'allow_sub_menu'    => true,
                'menu_title'        => esc_html__('Theme Options', 'digic'),
                'page_title'        => esc_html__('Theme Options', 'digic'),
                'footer_credit'     => esc_html__('Theme Options', 'digic'),
                'google_api_key' => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII',
                'disable_google_fonts_link' => true,
                'async_typography'  => false,
                'admin_bar'         => false,
                'admin_bar_icon'       => 'dashicons-admin-generic',
                'admin_bar_priority'   => 50,
                'global_variable'   => '',
                'dev_mode'          => false,
                'customizer'        => false,
                'compiler'          => false,
                'page_priority'     => null,
                'page_parent'       => 'themes.php',
                'page_permissions'  => 'manage_options',
                'menu_icon'         => '',
                'last_tab'          => '',
                'page_icon'         => 'icon-themes',
                'page_slug'         => 'digic_settings',
                'save_defaults'     => true,
                'default_show'      => false,
                'default_mark'      => '',
                'show_import_export' => true,
                'show_options_object' => false,
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,
                'output_tag'        => true,
                'database'              => '',
                'system_info'           => false,
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                ),
                'ajax_save'                 => false,
                'use_cdn'                   => true,
            );
            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
            }
            $this->args['intro_text'] = sprintf('<p style="color: #0088cc">'.wp_kses('Please regenerate again default css files in <strong>Skin > Compile Default CSS</strong> after <strong>update theme</strong>.', 'digic').'</p>', $v);
        }           
    }
	if ( !function_exists( 'wbc_extended_example' ) ) {
		function wbc_extended_example( $demo_active_import , $demo_directory_path ) {
			reset( $demo_active_import );
			$current_key = key( $demo_active_import );	
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] )) {
				//Import Sliders
				if ( class_exists( 'RevSlider' ) ) {
					$wbc_sliders_array = array(
						'digic' => array('slider-1.zip','slider-2.zip','slider-3.zip','slider-4.zip','slider-5.zip','slider-6.zip','slider-7.zip','slider-8.zip','slider-9.zip','slider-10.zip','slider-11.zip')
					);
					$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
					if( is_array( $wbc_slider_import ) ){
						foreach ($wbc_slider_import as $slider_zip) {
							if ( !empty($slider_zip) && file_exists( $demo_directory_path.'rev_slider/'.$slider_zip ) ) {
								$slider = new RevSlider();
								$slider->importSliderFromPost( true, true, $demo_directory_path.'rev_slider/'.$slider_zip );
							}
						}
					}else{
						if ( file_exists( $demo_directory_path.'rev_slider/'.$wbc_slider_import ) ) {
							$slider = new RevSlider();
							$slider->importSliderFromPost( true, true, $demo_directory_path.'rev_slider/'.$wbc_slider_import );
						}
					}
				}				
				// Setting Menus
				$primary = get_term_by( 'name', 'Main menu', 'nav_menu' );
				$primary_vertical   	= get_term_by( 'name', 'Vertical Menu', 'nav_menu' );
				$primary_mostsearch   	= get_term_by( 'name', 'Most Search Menu', 'nav_menu' );
				$primary_topbar   		= get_term_by( 'name', 'Topbar Menu', 'nav_menu' );
				if ( isset( $primary->term_id ) && isset( $primary_vertical->term_id ) && isset( $primary_mostsearch->term_id ) && isset( $primary_topbar->term_id ) ) {
					set_theme_mod( 'nav_menu_locations', array(
							'main_navigation' 	=> $primary->term_id,
							'vertical_menu' 	=> $primary_vertical->term_id,
							'mostsearch_menu'	=> $primary_mostsearch->term_id,
							'topbar_menu' 		=> $primary_topbar->term_id	
						)
					);
				}
				// Set HomePage
				$home_page = 'Home 1';
				$page = get_page_by_title( $home_page );
				if ( isset( $page->ID ) ) {
					update_option( 'page_on_front', $page->ID );
					update_option( 'show_on_front', 'page' );
				}					
			}
		}
		// Uncomment the below
		add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
	}
    global $reduxDigicSettings;
    $reduxDigicSettings = new Redux_Framework_digic_settings();
}