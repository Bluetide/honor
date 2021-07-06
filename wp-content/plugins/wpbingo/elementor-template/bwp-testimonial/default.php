<?php $tag_id = 'testimonial_' .rand().time(); 
	$args = array(
		'post_type' => 'testimonial',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	);
	$query = new WP_Query($args);
	$count = $query->post_count;
	$j=0;
?>
<?php if($query->have_posts()):?>
<div class="bwp-testimonial <?php echo esc_attr($layout); ?>">
	<div class="block">
		<div class="testimonial-title">
			<?php
				if (isset($title1) && $title1)
				echo '<h2>'. $title1 .'</h2>';
			?>
		</div>
	<div class="block_content">
		<div id="<?php echo esc_attr($tag_id); ?>" class="slick-carousel " data-slidesToScroll="true" data-nav="<?php echo esc_attr($show_nav);?>" data-dots="<?php echo esc_attr($show_pag);?>" data-columns4="<?php echo $columns4; ?>" data-columns3="<?php echo $columns3; ?>" data-columns2="<?php echo $columns2; ?>" data-columns1="<?php echo $columns1; ?>" data-columns="<?php echo $columns; ?>">
			<?php while($query->have_posts()):$query->the_post(); ?>
				<?php	if( ( $j % $item_row ) == 0 ) { ?>
					<div class="testimonial-content">
				<?php } ?>
					<div class="item">
						<div class="testimonial-image">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</div>
						<div class="testimonial-info">
							<div class="testimonial-item">
								<span aria-hidden="true" class="icon-quote-light"></span>
								<div class="testimonial-customer-position"><?php echo wpbingo_get_excerpt( $length, false ); ?></div>
								<h2 class="testimonial-customer-name"><?php the_title(); ?></h2>
							</div>
						</div>
					</div>
					<!-- Wrapper for slides -->
				<?php if(( $j+1 ) % $item_row == 0 || ( $j+1 ) == $count ){?> 
				</div>
				<?php  } ?>
			<?php $j++; endwhile; ?>
		</div>
	</div>
 </div>
</div>
<?php endif;?>