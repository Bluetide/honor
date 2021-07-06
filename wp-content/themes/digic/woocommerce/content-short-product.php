<?php
	global $product, $woocommerce_loop, $post;
	$digic_settings = digic_global_settings();
	if(!isset($layout_shop)){
		$layout_shop = digic_get_config('layout_shop','1');
	}	
?>
<?php if ($layout_shop == '1') { ?>
	<div class="products-entry content-product1 clearfix product-wapper">
		<div class="products-thumb">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<div class='product-button'>
				<?php do_action('woocommerce_after_shop_loop_item'); ?>
			</div>
		</div>
		<div class="products-content">
			<div class="contents">
				<?php woocommerce_template_loop_rating(); ?>
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<div itemprop="description" class="description">
					<?php echo apply_filters( 'woocommerce_short_description', wp_kses( $post->post_excerpt,'social' ) ) ?>
				</div>
				<h3 class="product-title"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			</div>
		</div>
	</div>
<?php }elseif ($layout_shop == '2') { ?>
	<?php
	remove_action('woocommerce_before_shop_loop_item_title', 'digic_add_countdownt_item', 15 );
	?>
	<div class="products-entry content-product2 clearfix product-wapper">
		<div class="products-thumb">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<div class='product-button'>
				<?php do_action('woocommerce_after_shop_loop_item'); ?>
			</div>
		</div>
		<div class="products-content">
			<div class="contents">
				<?php woocommerce_template_loop_rating(); ?>
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<div itemprop="description" class="description">
					<?php echo apply_filters( 'woocommerce_short_description', wp_kses( $post->post_excerpt,'social' ) ) ?>
				</div>
				<h3 class="product-title"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			</div>
		</div>
	</div>
<?php }elseif ($layout_shop == '3') { ?>
	<?php
	remove_action('woocommerce_before_shop_loop_item_title', 'digic_add_countdownt_item', 15 );
	?>
	<div class="products-entry content-product3 clearfix product-wapper">
		<div class="products-thumb">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</div>
		<div class="products-content">
			<div class="contents">
				<?php woocommerce_template_loop_rating(); ?>
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<div itemprop="description" class="description">
					<?php echo apply_filters( 'woocommerce_short_description', wp_kses( $post->post_excerpt,'social' ) ) ?>
				</div>
				<h3 class="product-title"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			</div>
		</div>
	</div>
<?php }elseif ($layout_shop == '4') { ?>
	<?php
	remove_action('woocommerce_after_shop_loop_item', 'digic_woocommerce_template_loop_add_to_cart', 15 );
	?>
	<div class="products-entry content-product4 clearfix product-wapper">
		<div class="products-thumb">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<div class='product-button'>
				<?php do_action('woocommerce_after_shop_loop_item'); ?>
			</div>
		</div>
		<div class="products-content">
			<div class="contents">
				<?php woocommerce_template_loop_rating(); ?>
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<div itemprop="description" class="description">
					<?php echo apply_filters( 'woocommerce_short_description', wp_kses( $post->post_excerpt,'social' ) ) ?>
				</div>
				<h3 class="product-title"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
				<div class="btn-atc">
					<?php digic_woocommerce_template_loop_add_to_cart(); ?>
				</div>
			</div>
		</div>
	</div>
<?php }elseif ($layout_shop == '5') { ?>
	<div class="products-entry content-product5 clearfix product-wapper">
		<div class="products-thumb">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<div class='product-button'>
				<?php do_action('woocommerce_after_shop_loop_item'); ?>
			</div>
		</div>
		<div class="products-content">
			<div class="contents">
				<div class="content-top">
					<?php woocommerce_template_loop_rating(); ?>
					<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				</div>
				<div itemprop="description" class="description">
					<?php echo apply_filters( 'woocommerce_short_description', wp_kses( $post->post_excerpt,'social' ) ) ?>
				</div>
				<h3 class="product-title"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			</div>
		</div>
	</div>
<?php }elseif ($layout_shop == '6') { ?>
	<div class="products-entry content-product6 clearfix product-wapper">
		<div class="products-thumb">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<div class='product-button'>
				<?php do_action('woocommerce_after_shop_loop_item'); ?>
			</div>
		</div>
		<div class="products-content">
			<div class="contents">
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<div itemprop="description" class="description">
					<?php echo apply_filters( 'woocommerce_short_description', wp_kses( $post->post_excerpt,'social' ) ) ?>
				</div>
				<h3 class="product-title"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
				<?php woocommerce_template_loop_rating(); ?>
			</div>
		</div>
	</div>
<?php } ?>