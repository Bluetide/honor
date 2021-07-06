<?php if($settings['list_tab']){ ?>
	<?php $j = 0; ?>
	<div class="bwp-slider <?php echo esc_attr($layout); ?>">
		<?php if($title1 || $label_button) { ?>
		<div class="content-title">
			<h2><?php echo wp_kses($title1,'social'); ?></h2>
			<div class="button-view"><a href="<?php echo esc_url($url_button); ?>"><?php echo esc_html($label_button); ?></a></div>
		</div>
		<?php } ?>
		<div class="slick-carousel slick-carousel-center" data-nav="<?php echo esc_attr($show_nav);?>" data-dots="<?php echo esc_attr($show_pag);?>" data-columns4="<?php echo esc_attr($columns4); ?>" data-columns3="<?php echo esc_attr($columns3); ?>" data-columns2="<?php echo esc_attr($columns2); ?>" data-columns1="<?php echo esc_attr($columns1); ?>" data-columns="<?php echo esc_attr($columns); ?>" >
			<?php foreach ($settings['list_tab'] as  $item){ ?>
				<div class="item">
					<div class="content-image">
						<?php if( $item['image'] && $item['image']['url'] ){ ?>
							<a href="<?php echo wp_kses_post($item['link_slider']); ?>"><img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr__('Image Slider','wpbingo'); ?>"></a>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php }?>