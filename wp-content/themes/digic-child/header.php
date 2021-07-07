<?php
/**
 * Version:            1.0.0
 * Theme Name:         digic
 * Theme URI:          http://wpbingosite.com/themes/digic/
 * Author:             Wpbingo
 * Author URI:         http://wpbingosite.com/
 * License:            GNU General Public License v2 or later
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
	global $digic_page_id;
	$digic_settings = digic_global_settings();
	$direction = digic_get_direction(); 
	$digic_page_id = get_the_ID();	
	$header_style = digic_get_config('header_style', ''); 
	$header_style  = (get_post_meta( $digic_page_id, 'page_header_style', true )) ? get_post_meta($digic_page_id, 'page_header_style', true ) : $header_style ;
	$enable_sticky_header = ( isset($digic_settings['enable-sticky-header']) && $digic_settings['enable-sticky-header'] ) ? ($digic_settings['enable-sticky-header']) : false;
	$show_minicart = (isset($digic_settings['show-minicart']) && $digic_settings['show-minicart']) ? ($digic_settings['show-minicart']) : false;
	$show_searchform = (isset($digic_settings['show-searchform']) && $digic_settings['show-searchform']) ? ($digic_settings['show-searchform']) : false;
	$background_page = get_post_meta( get_the_ID(), 'page_background', true );
	$checkout_page_style="";
	if( function_exists('is_checkout') && is_checkout() ){
		$checkout_page_style = digic_get_config('checkout_page_style','checkout-page-style-1');
	}
?>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php digic_loading_overlay(); ?>
<div id='page' class="hfeed page-wrapper  <?php echo esc_attr($checkout_page_style) ; ?>" <?php if($background_page) { ?>style="background-image: url('<?php echo esc_url($background_page); ?>');background-repeat:no-repeat;background-position:top center;"<?php } ?>>
	<?php if(isset($header_style) && $header_style) { ?>
		<?php get_template_part('templates/headers/header',$header_style); ?>
	<?php }else{ ?>
		<div id='bwp-header' class="bwp-header bwp-header-default">
			<?php digic_menu_mobile(); ?>
			<div class="header-desktop">
				<div class="container">
					<div class='header-content' data-sticky_header="<?php echo esc_attr($enable_sticky_header); ?>">
						<div class="row">
							<?php if($show_minicart || $show_searchform){ ?>
								<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 header-logo">
									<?php digic_header_logo(); ?>
								</div>
								<div class="col-xl-8 col-lg-8 col-md-12 col-12  wpbingo-menu-mobile">
									<?php digic_top_menu(); ?>
								</div>
								<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 margin-top-20">
									 <!-- Begin menu -->
									<?php if($show_minicart && class_exists( 'WooCommerce' )){ ?>
									<div class="wpbingo-cart-top pull-right">
										<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
									</div>
									<?php } ?>
									<!-- Begin Search -->
									<?php if($show_searchform && class_exists( 'WooCommerce' )){ ?>
									<div class="search-box pull-right">
										<div class="search-toggle"><i class="fa fa-search"></i></div>
										<div class="dropdown-search"><?php digic_search_form_product(); ?></div>
									</div>
									<?php } ?>
									<!-- End Search -->
								</div>
							<?php }else{ ?>
								<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-8 header-logo">
									<?php digic_header_logo(); ?>
								</div>
								<div class="col-xl-10 col-lg-10 col-md-6 col-sm-6 col-4 wpbingo-menu-mobile text-right">
									<?php digic_top_menu(); ?>
								</div>						
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- End header-wrapper -->		
	<?php } ?>
<div id="bwp-main" class="bwp-main">
<?php digic_get_page_title(); ?>