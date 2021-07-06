	<?php 
		$digic_settings = digic_global_settings();
		$cart_layout = digic_get_config('cart-layout','dropdown');
		$cart_style = digic_get_config('cart-style','light');
		$show_minicart = (isset($digic_settings['show-minicart']) && $digic_settings['show-minicart']) ? ($digic_settings['show-minicart']) : false;
		$show_compare = (isset($digic_settings['show-compare']) && $digic_settings['show-compare']) ? ($digic_settings['show-compare']) : false;
		$enable_sticky_header = ( isset($digic_settings['enable-sticky-header']) && $digic_settings['enable-sticky-header'] ) ? ($digic_settings['enable-sticky-header']) : false;
		$show_searchform = (isset($digic_settings['show-searchform']) && $digic_settings['show-searchform']) ? ($digic_settings['show-searchform']) : false;
		$show_wishlist = (isset($digic_settings['show-wishlist']) && $digic_settings['show-wishlist']) ? ($digic_settings['show-wishlist']) : false;
		$show_currency = (isset($digic_settings['show-currency']) && $digic_settings['show-currency']) ? ($digic_settings['show-currency']) : false;
		$show_menutop = (isset($digic_settings['show-menutop']) && $digic_settings['show-menutop']) ? ($digic_settings['show-menutop']) : false;
		$show_mostsearch = (isset($digic_settings['show-mostsearch']) && $digic_settings['show-mostsearch']) ? ($digic_settings['show-mostsearch']) : false;
	?>
	<h1 class="bwp-title hide"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<header id='bwp-header' class="bwp-header header-v8">
		<?php digic_campbar(); ?>
		<?php digic_menu_stcky(); ?>
		<?php if(isset($digic_settings['show-header-top']) && $digic_settings['show-header-top']){ ?>
		<div id="bwp-topbar" class="topbar-v2 hidden-sm hidden-xs">
			<div class="topbar-inner">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 topbar-left hidden-sm hidden-xs">
							<?php if( isset($digic_settings['address']) && $digic_settings['address'] ) : ?>
							<div class="address hidden-xs">
								<a href="<?php echo esc_html($digic_settings['link_address']); ?>"><i class="icon-pin"></i><?php echo esc_html($digic_settings['address']); ?></a>
							</div>
							<?php endif; ?>
							<?php if( isset($digic_settings['email']) && $digic_settings['email'] ) : ?>
							<div class="email hidden-xs">
								<i class="icon-email"></i><a href="mailto:<?php echo esc_attr($digic_settings['email']); ?>"><?php echo esc_html($digic_settings['email']); ?></a>
							</div>
							<?php endif; ?>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 topbar-right">
							<?php if($show_menutop){ ?>
								<?php wp_nav_menu( 
								  array( 
									  'theme_location' => 'topbar_menu', 
									  'container' => 'false', 
									  'menu_id' => 'topbar_menu', 
									  'menu_class' => 'menu'
								   ) 
								); ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php digic_menu_mobile(true); ?>
		<div class="header-desktop">
			<?php if(($show_minicart || $show_wishlist || $show_searchform || is_active_sidebar('top-link')) && class_exists( 'WooCommerce' ) ){ ?>
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 header-left">
							<?php digic_header_logo(); ?>
						</div>
						<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 header-center">
							<div class="header-search-form">
								<!-- Begin Search -->
								<?php if($show_searchform && class_exists( 'WooCommerce' )){ ?>
									<?php get_template_part( 'search-form' ); ?>
								<?php } ?>
								<!-- End Search -->	
							</div>
							<?php if($show_mostsearch){ ?>
								<div class="content-mostsearch">
									<label><?php echo esc_html__("Most searched :","digic") ?></label>
									<?php wp_nav_menu( 
									  array( 
										  'theme_location' => 'mostsearch_menu', 
										  'container' => 'false', 
										  'menu_id' => 'mostsearch_menu', 
										  'menu_class' => 'menu'
									   ) 
									); ?>
								</div>
							<?php } ?>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 header-right">
							<div class="header-page-link">
								<div class="login-header">
									<?php if (is_user_logged_in()) { ?>
										<?php if(is_active_sidebar('top-link')){ ?>
											<div class="block-top-link">
												<?php dynamic_sidebar( 'top-link' ); ?>
											</div>
										<?php } ?>
									<?php }else{ ?>
										<a class="active-login" href="#" ><i class="icon-profile"></i></a>
										<?php digic_login_form(); ?>
									<?php } ?>
								</div>
								<?php if($show_compare && class_exists( 'WPCleverWooscp' )){ ?>
								<div class="compare-box hidden-sm hidden-xs">        
									<a href="<?php echo WPCleverWooscp::wooscp_get_page_url(); ?>"><?php echo esc_html__('Compare', 'digic')?></a>
								</div>
								<?php } ?>		
								<?php if($show_wishlist && class_exists( 'WPCleverWoosw' )){ ?>
								<div class="wishlist-box">
									<a href="<?php echo WPcleverWoosw::get_url(); ?>"><i class="icon-heart"></i></a>
									<span class="count-wishlist"><?php echo WPcleverWoosw::get_count(); ?></span>
								</div>
								<?php } ?>
								<?php if($show_minicart && class_exists( 'WooCommerce' )){ ?>
								<div class="digic-topcart <?php echo esc_attr($cart_layout); ?> <?php echo esc_attr($cart_style); ?>">
									<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class='header-wrapper' data-sticky_header="<?php echo esc_attr($digic_settings['enable-sticky-header']); ?>">
				<div class="container">
					<div class="row">
						<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 header-left content-header">
							<?php $class_vertical = digic_dropdown_vertical_menu(); ?>
							<div class="header-vertical-menu">
								<div class="categories-vertical-menu hidden-sm hidden-xs <?php echo esc_attr($class_vertical); ?>"
									data-textmore="<?php echo esc_html__("Other","digic"); ?>" 
									data-textclose="<?php echo esc_html__("Close","digic"); ?>" 
									data-max_number_1530="<?php echo esc_attr(digic_limit_verticalmenu()->max_number_1530); ?>" 
									data-max_number_1200="<?php echo esc_attr(digic_limit_verticalmenu()->max_number_1200); ?>" 
									data-max_number_991="<?php echo esc_attr(digic_limit_verticalmenu()->max_number_991); ?>">
									<?php echo digic_vertical_menu(); ?>
								</div>
								<div class="hidden-lg hidden-md pull-right">
									<?php digic_navbar_vertical_menu(); ?>
								</div>	
							</div>
							<div class="content-header-main">
								<div class="wpbingo-menu-mobile header-menu">
									<div class="header-menu-bg">
										<?php digic_top_menu(); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 header-right">
							<?php if( isset($digic_settings['ship']) && $digic_settings['ship'] ) : ?>
							<div class="ship hidden-xs hidden-sm">
								<i class="icon-delivery"></i>
								<div class="content">
									<?php echo esc_html($digic_settings['ship']); ?>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div><!-- End header-wrapper -->
			<?php }else{ ?>
				<div class="header-normal">
					<div class='header-wrapper' data-sticky_header="<?php echo esc_attr($digic_settings['enable-sticky-header']); ?>">
						<div class="container">
							<div class="row">
								<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 header-left">
									<?php digic_header_logo(); ?>
								</div>
								<div class="col-xl-9 col-lg-9 col-md-6 col-sm-6 col-6 wpbingo-menu-mobile header-main">
									<div class="header-menu-bg">
										<?php digic_top_menu(); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</header><!-- End #bwp-header -->