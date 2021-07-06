<?php
/***** Active Plugin ********/
add_action( 'tgmpa_register', 'digic_register_required_plugins' );
function digic_register_required_plugins() {
    $plugins = array(
		array(
            'name'               => esc_html__('Woocommerce', 'digic'), 
            'slug'               => 'woocommerce', 
            'required'           => false
        ),
		array(
            'name'      		 => esc_html__('Elementor', 'digic'),
            'slug'     			 => 'elementor',
            'required' 			 => false
        ),		
		array(
            'name'               => esc_html__('Revolution Slider', 'digic'), 
			'slug'               => 'revslider',
			'source'             => get_template_directory() . '/plugins/revslider.zip', 
			'required'           => true, 
        ),
		array(
            'name'               => esc_html__('Wpbingo Core', 'digic'), 
            'slug'               => 'wpbingo', 
            'source'             => get_template_directory() . '/plugins/wpbingo.zip',
            'required'           => true, 
        ),			
		array(
            'name'               => esc_html__('Redux Framework', 'digic'), 
            'slug'               => 'redux-framework', 
            'required'           => false
        ),			
		array(
            'name'      		 => esc_html__('Contact Form 7', 'digic'),
            'slug'     			 => 'contact-form-7',
            'required' 			 => false
        ),	
		array(
            'name'     			 => esc_html__('WPC Smart Wishlist for WooCommerce', 'digic'),
            'slug'      		 => 'woo-smart-wishlist',
            'required' 			 => false
        ),
		array(
            'name'      		 => esc_html__('WPC Smart Compare for WooCommerce', 'digic'),
            'slug'      		 => 'woo-smart-compare',
            'required'			 => false
        ),
		array(
            'name'     			 => esc_html__('WooCommerce Variation Swatches', 'digic'),
            'slug'      		 => 'variation-swatches-for-woocommerce',
            'required' 			 => false
        ),
		array(
            'name'     			 => esc_html__('Dokan', 'digic'),
            'slug'      		 => 'dokan-lite',
            'required' 			 => false
        ),		
    );
    $config = array();
    tgmpa( $plugins, $config );
}