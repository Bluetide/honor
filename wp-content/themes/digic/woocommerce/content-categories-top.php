<?php 
	$query_string = digic_get_query_string();
	parse_str($query_string, $params);
	$category_slug = isset( $params['product_cat'] ) ? $params['product_cat'] : '';
	$terms = get_terms( 'product_cat', array( 'parent' => 0, 'hide_empty' => false ) );
	$catagories_top_style 		= digic_get_config('catagories_top_style','style_1');
	$limit_children_shop 		= digic_get_config('limit_children_shop',4);
	$limit_catagories_top 		= digic_get_config('limit_catagories_top',9);
	$j=0;
?>
<div class="content-categories-top <?php echo esc_attr($catagories_top_style) ?>">
	<ul class="content-categories">
		<?php foreach( $terms as $cat ){?>
			<li class="items">
				<div class="item-product-cat-content">
					<?php 
						$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
						$thumb = wp_get_attachment_url( $thumbnail_id );
						$i = 0;
					?>
					<?php if($thumb) : ?>
					<div class="item-image">
						<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($cat->slug); ?>" />
					</div>
					<?php endif ; ?>
					<div class="content">
						<h2 class="item-title">
							<a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>"><?php echo esc_html( $cat->name ); ?></a>
						</h2>
						<?php
							$args_childrens = array(
								'hide_empty' => 0,
								'parent' => $cat->term_id,
								'taxonomy' => 'product_cat'
							);
							$childrens = get_categories($args_childrens);
						?>
						<?php if($childrens): ?>
						<ul class="item-children">
							<?php foreach ($childrens as $children) { ?>
								<li><a href="<?php echo get_term_link( $children->slug, $children->taxonomy );?>"><?php echo esc_html($children->name); ?></a></li>
								<?php $i++; ?>
							<?php if($i == $limit_children_shop ) { break; } } ?>
						</ul>
						<?php endif; ?>
						<div class="item-btn">
							<a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>"><?php echo esc_html__("View more",'digic'); ?></a>
						</div>
					</div>
				</div>
			</li>
		<?php $j++; ?>
		<?php if($j == $limit_catagories_top ) { break; } } ?>
	</ul>
</div>