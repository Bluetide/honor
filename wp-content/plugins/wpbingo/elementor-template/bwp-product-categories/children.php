<?php  
if( $category == '' ){
	return ;
}
if( !is_array( $category ) ){
	$category = explode( ',', $category );
}
$widget_id = isset( $widget_id ) ? $widget_id : 'category_slide_'.rand().time();
?>
<div id="<?php echo $widget_id; ?>" class="bwp-woo-categories <?php echo esc_attr($layout); ?>">
	<?php if( isset($subtitle) && $subtitle) : ?>
		<div class="bwp-categories-subtitle">					
			<?php echo ($subtitle); ?>							
		</div>	
	<?php endif;?>
	<?php if( $title1) : ?>
		<h3 class="bwp-categories-title"><?php echo esc_html( $title1 ); ?></h3>
	<?php endif; ?>
	<div class="box-content-category">
		<div class="content-category slick-carousel" data-dots="<?php echo esc_attr($show_pag);?>" data-slidesToScroll="true" data-nav="<?php echo esc_attr($show_nav);?>" data-columns4="<?php echo $columns4; ?>" data-columns3="<?php echo $columns3; ?>" data-columns2="<?php echo $columns2; ?>" data-columns1="<?php echo $columns1; ?>" data-columns="<?php echo $columns; ?>" data-columns1440="<?php echo esc_attr($columns1440); ?>">
			<?php
				foreach( $category as $j => $cat ){
					$term = get_term_by('slug', $cat, 'product_cat');
					$i = 0;
					if($term) :		
						$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
						$thumb = wp_get_attachment_url( $thumbnail_id );
						if(!$thumb)
							$thumb = wc_placeholder_img_src();
						?>
						<?php	if( ( $j % $item_row ) == 0 ) { ?>
							<div class="item item-product-cat">	
						<?php } ?>
							<div class="item-product-cat-content">
								<div class="content-image">
									<div class="item-image">
										<?php if($thumb) : ?>
											<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo $term->slug ;?>" />
										<?php endif ; ?>
									</div>
								</div>
								<div class="content">
									<h2 class="item-title">
										<a href="<?php echo get_term_link( $term->term_id, 'product_cat' ); ?>"><?php echo esc_html( $term->name ); ?></a>
									</h2>
									<?php
										$args_childrens = array(
											'hide_empty' => 0,
											'parent' => $term->term_id,
											'taxonomy' => 'product_cat'
										);
										$childrens = get_categories($args_childrens);
									?>
									<?php if($childrens): ?>
									<ul class="item-children">
										<?php foreach ($childrens as $children) { ?>
											<li><a href="<?php echo get_term_link( $children->slug, $children->taxonomy );?>"><?php echo $children->name;?></a></li>
											<?php $i++; ?>
										<?php if($i == $limit_children ) { break; } } ?>
									</ul>
									<?php endif; ?>
									<div class="item-btn">
										<a href="<?php echo get_term_link( $term->term_id, 'product_cat' ); ?>"><?php echo esc_html__("View more","wpbingo"); ?></a>
									</div>
								</div>
							</div>
						<?php if( ( $j+1 ) % $item_row == 0 || ( $j+1 ) == count($category) ){?> 
							</div>
						<?php  } ?>
					<?php endif; ?>		
			<?php } ?>
		</div>
	</div>
</div>