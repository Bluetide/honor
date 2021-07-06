<?php
namespace ElementorWpbingo\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Bwp_Image extends Widget_Base {
	public function get_name() {
		return 'bwp_image';
	}
	public function get_title() {
		return __( 'Wpbingo Image', 'wpbingo' );
	}
	public function get_icon() {
		return 'fa fa-picture-o';
	}	
	public function get_categories() {
		return [ 'general' ];
	}
	protected function _register_controls() {
		$number = array('style1' => 'style 1', 'style2' => 'style 2', 'style3' => 'style 3');
		$terms = get_terms( 'product_cat', array( 'hide_empty' => false ) );
		if( count( $terms ) == 0 ){
			return ;
		}
		foreach( $terms as $cat ){
			$term[$cat->slug] = $cat -> name;
		}		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'wpbingo' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);		
		$this->add_control(
			'title1',
			[
				'label' => __( 'Title', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your title here', 'wpbingo' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Sub Title', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your sub title here', 'wpbingo' ),
			]
		);
		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => '',
				'placeholder' => __( 'Type your Description here', 'wpbingo' ),
			]
		);
		$this->add_control(
			'label',
			[
				'label' => __( 'Button label', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your Button label here', 'wpbingo' ),
			]
		);		
		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '#',
				'placeholder' => __( 'Type your Link here', 'wpbingo' ),
			]
		);
		$this->add_control(
			'time_deal',
			[
				'label' => __( 'Time Coundown', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Ex : 2019-5-25', 'wpbingo' ),
				'condition'   => [
                    'layout' => ['banner-countdown','banner-product-countdown'],
                ]
			]
		);
		$this->add_control(
			'show_count',
			[
				'label' => __( 'Show Count Product Categories', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => __( 'yes', 'wpbingo' ),
					'0' => __( 'no', 'wpbingo' ),
				],
				'condition'   => [
                    'layout' => ['banner-category'],
                ]				
			]
		);
		$this->add_control(
			'category',
			[
				'label' => __( 'Select Categories', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $term,
				'condition'   => [
                    'layout' => ['banner-category'],
                ]				
			]
		);
		$this->add_control(
			'product_id',
			[
				'label' => __( 'Product Id', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your Product Id here', 'wpbingo' ),
				'condition'   => [
                    'layout' => ['banner-product-countdown'],
                ]
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'wpbingo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'wpbingo' ),
					'banner-countdown'  => __( 'Banner Countdown', 'wpbingo' ),
					'banner-product-countdown'  => __( 'Banner Product Countdown', 'wpbingo' ),
					'layout-1'  => __( 'Layout 1', 'wpbingo' ),
					'layout-2'  => __( 'Layout 2', 'wpbingo' ),
					'layout-3'  => __( 'Layout 3', 'wpbingo' ),
					'layout-4'  => __( 'Layout 4', 'wpbingo' ),
					'layout-5'  => __( 'Layout 5', 'wpbingo' ),
					'layout-6'  => __( 'Layout 6', 'wpbingo' ),
					'layout-7'  => __( 'Layout 7', 'wpbingo' ),
					'layout-8'  => __( 'Layout 8', 'wpbingo' ),
					'layout-9'  => __( 'Layout 9', 'wpbingo' ),
					'layout-10'  => __( 'Layout 10', 'wpbingo' ),
					'layout-11'  => __( 'Layout 11', 'wpbingo' ),
					'layout-12'  => __( 'Layout 12', 'wpbingo' ),
					'layout-13'  => __( 'Layout 13', 'wpbingo' ),
					'layout-14'  => __( 'Layout 14', 'wpbingo' ),
					'layout-15'  => __( 'Layout 15', 'wpbingo' ),
					'layout-16'  => __( 'Layout 16', 'wpbingo' ),
					'layout-17'  => __( 'Layout 17', 'wpbingo' ),
				],
			]
		);		
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( shortcode_atts(
			array(
				'title1' 	=> '',
				'subtitle' 	=> '',
				'description' => '',
				'link' 		=> '#',
				'link' 		=> '#',
				'label' 	=> '',
				'image' 	=> '',
				'time_deal' => '25-5-2019',
				'category' 	=> '',
				'show_count' => '0',
				'product_id'	=> '',
				'layout'  	=> 'default',
			), $settings )
		);
		$image		 = 	( $settings['image'] && $settings['image']['url'] ) ? $settings['image']['url'] : '';
		$widget_id = 'bwp_banner_image_'.rand().time();
		if( $layout == 'default' ){
			include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-image/default.php' );
		}elseif( $layout == 'banner-menu' || $layout == 'layout-1' || $layout == 'layout-2' || $layout == 'layout-3' || $layout == 'layout-4' 
		|| $layout == 'layout-5' || $layout == 'layout-6' || $layout == 'layout-7' || $layout == 'layout-8' || $layout == 'layout-9' 
		|| $layout == 'layout-10' || $layout == 'layout-11' || $layout == 'layout-12' || $layout == 'layout-13' || $layout == 'layout-14' 
		|| $layout == 'layout-15' || $layout == 'layout-16' || $layout == 'layout-17' ){
			include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-image/layout.php' );
		}elseif( $layout == 'banner-countdown' ){
			include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-image/banner_countdown.php' );
		}elseif( $layout == 'banner-product-countdown'){
			include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-image/banner_product_countdown.php' );
		}
	}
}