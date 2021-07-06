<?php $j = 1; ?>
<?php while($list->have_posts()): $list->the_post();
	global $product, $post, $wpdb, $average;
?>
	<?php if ($layout_content == 1) { ?>
		<?php if( $j%5 == 1 || $j%5 == 0 ) { ?>
		<div class="item <?php if( $j%5 == 1 ) { ?>four<?php } ?><?php if( $j%5 == 0 ) { ?>one<?php } ?>">
		<?php } ?>
	<?php }else{ ?>
		<?php if( ( $j % $item_row ) == 1 && $item_row !=1) { ?>
		<div class="item">
		<?php } ?>
	<?php } ?>
		<div class="item-product <?php echo $class_col; ?>">
			<?php
			if($content_product)
				include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product'.esc_attr($content_product).'.php'); 
			else
				include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product.php'); 
			?>
		</div>
	<?php if ($layout_content == 1) { ?>
		<?php if( $j%5 == 4 || $j%5 == 0 ) { ?>
		</div>
		<?php  } $j++;?>	
	<?php }else{ ?>
		<?php if( ($j % $item_row == 0 || $j == $list->post_count) && $item_row !=1  ){?> 
		</div>
		<?php  } $j++;?>
	<?php } ?>
<?php endwhile; wp_reset_postdata(); ?>