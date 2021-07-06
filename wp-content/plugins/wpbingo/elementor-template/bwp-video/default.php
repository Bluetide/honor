<div class="bwp-widget-video <?php echo esc_attr($class); ?> <?php echo esc_attr($layout); ?>">	
	<div class="bg-video">		
		<div class="video-wrapper videos">
			<?php  if($image): ?>
			<div class="bwp-image">
				<div class="videoThumb">
					<img class="img-responsive" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr__("Image Video","wpbingo"); ?>" />
				</div>
			</div>
			<?php endif;?>
		</div>
	</div>
	<div class="content">
		<?php  if($link): ?>
			<?php
				$youtube_id = digic_get_youtube_video_id($link);
				$vimeo_id = digic_get_vimeo_video_id($link);
				$url_video = "#";
				if($youtube_id){
					$url_video = "https://www.youtube.com/embed/".esc_attr($youtube_id);
				}elseif($vimeo_id){
					$url_video = "https://player.vimeo.com/video/".esc_attr($vimeo_id);
				}
			?>
			<div class="bwp-video" data-toggle="modal" data-target="#myModal" data-src="<?php echo esc_attr($url_video); ?>">
				<div class="bwp-video-btn">
					<i class="fa fa-play" aria-hidden="true"></i>
				</div>
				<?php if( $labelbutton) : ?>
					<?php echo esc_html( $labelbutton ); ?>
				<?php endif; ?>
			</div>
			<div class="content-video modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<?php if($youtube_id){ ?>
						<iframe id="video" width="800px" height="auto" src="<?php echo esc_url($url_video); ?>" title="<?php echo esc_html__("YouTube video player","wpbingo"); ?>" frameborder="0" allowfullscreen></iframe>
					<?php }elseif($vimeo_id){?>
						<iframe id="video" src="<?php echo esc_url($url_video); ?>" width="800px" height="auto" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
					<?php } ?>
				</div>
			</div>
		<?php endif;?>
	</div>
</div>
