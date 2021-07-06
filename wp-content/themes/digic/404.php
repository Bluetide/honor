<?php 
	get_header(); 
	$digic_settings = digic_global_settings();
?>
<div class="page-404">
	<div class="content-page-404">
		<div class="title-error">
			<?php if(isset($digic_settings['title-error']) && $digic_settings['title-error']){
				echo esc_html($digic_settings['title-error']);
			}else{
				echo esc_html__('404', 'digic');
			}?>
		</div>
		<div class="sub-title">
			<?php if(isset($digic_settings['sub-title']) && $digic_settings['sub-title']){
				echo esc_html($digic_settings['sub-title']);
			}else{
				echo esc_html__("Oops! That page can't be found.", "digic");
			}?>
		</div>
		<div class="sub-error">
			<?php if(isset($digic_settings['sub-error']) && $digic_settings['sub-error']){
				echo esc_html($digic_settings['sub-error']);
			}else{
				echo esc_html__("We're really sorry but we can't seem to find the page you were looking for.", 'digic');
			}?>
		</div>
		<a class="btn" href="<?php echo esc_url( home_url('/') ); ?>">
			<?php if(isset($digic_settings['btn-error']) && $digic_settings['btn-error']){
				echo esc_html($digic_settings['btn-error']);}
			else{
				echo esc_html__('Back The Homepage', 'digic');
			}?>
		</a>
	</div>
</div>
<?php
get_footer();