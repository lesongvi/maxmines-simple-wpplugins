<?php

if ( ! defined( 'ABSPATH' ) ) exit;

$smmch_visual = esc_attr(get_option('smmch_visual'));

function smmch_footer_script($isshortcode) {
	$smmch_publickey = get_option('smmch_public_sitekey');
	$smmch_throttle = number_format((float)get_option('smmch_throttle'), 1, '.', '');
	
	$smmch_visual = esc_attr(get_option('smmch_visual'));
	$smmch_block_for_mobile = esc_attr(get_option('smmch_block_for_mobile'));
	$smmch_disable_plugin = esc_attr(get_option('smmch_disable_plugin'));

	$smmch_topbottom_pos = strtolower(esc_attr(get_option('smmch_topbottom_pos')));
	$smmch_notification_pos = strtolower(esc_attr(get_option('smmch_notification_pos')));		
	$smmch_visual_title = esc_attr(get_option('smmch_visual_title'));
	$smmch_visual_desc = esc_attr(get_option('smmch_visual_desc'));
	$smmch_visual_text_color = esc_attr(get_option('smmch_visual_text_color'));
	$smmch_visual_bg_color = esc_attr(get_option('smmch_visual_bg_color'));
	$smmch_visual_button_color = esc_attr(get_option('smmch_visual_button_color'));
	$smmch_visual_button_bg_color = esc_attr(get_option('smmch_visual_button_bg_color'));
	$smmch_mining_perct = esc_attr(get_option('smmch_mining_perct'));
	$smmch_accepted_hashes = esc_attr(get_option('smmch_accepted_hashes'));
	$smmch_visual_hide_time = esc_attr(get_option('smmch_visual_hide_time'));
	$smmch_first_session = esc_attr(get_option('smmch_first_session'));
	$smmch_hide_hashes_infmn = esc_attr(get_option('smmch_hide_hashes_infmn'));
	$smmch_hide_hashes_contrl = esc_attr(get_option('smmch_hide_hashes_contrl'));
	
	if($smmch_visual == '1'){
		if($smmch_topbottom_pos == 'top'){
			$smmch_notice_class = 'smmch_top';
		} else {
			$smmch_notice_class = 'smmch_bottom';
		}
	} else if($smmch_visual == '2'){
		if($smmch_notification_pos == 'top left'){
			$smmch_notice_class = 'smmch_top_left';
		} else if($smmch_notification_pos == 'top right'){
			$smmch_notice_class = 'smmch_top_right';
		} else if($smmch_notification_pos == 'bottom left'){
			$smmch_notice_class = 'smmch_bottom_left';
		} else {
			$smmch_notice_class = 'smmch_bottom_right';
		}
	}
	if($smmch_disable_plugin != "on"){
		if($smmch_throttle != 1) {
			if($smmch_publickey != ''){
				if ($smmch_throttle) {
					if($smmch_throttle > 0.9) {
						$smmch_throttle = 0.9;
					}
				} else {
					$smmch_throttle = "";
				}
				//change the text to php value, defaults text when empty
				//if visual is 2 and check positoin for top left, right or bottom left, right
				if($smmch_notice_class){
					$smmch_notice_class = ' ' . $smmch_notice_class;
				}
				if($isshortcode == 'shortcode'){
					echo '<div class="smmch-shortcode-box">';
					$smmch_notice_class = '';
					$smmch_visual_hide_time = '';
					$smmch_first_session = '';
				} else {
					$smmch_notice_id = 'id="smmch-notice"';
					if($smmch_visual_hide_time) {
						$smmch_visual_hide_time = 'data-hide="' . $smmch_visual_hide_time . '"';
					}
					if($smmch_first_session == 'on') {
						$smmch_first_session = 'data-session="' . $smmch_first_session . '"';
					}
				}
				?>
				<div class="smmch-notice<?php echo $smmch_notice_class; ?>" <?php echo $smmch_notice_id.' '.$smmch_visual_hide_time.' '.$smmch_first_session; ?>>
					<div class="smmch-notice-container">
						<div class="smmch-control-shower">
							<?php if($smmch_visual_title) {
								echo $smmch_visual_title . ': ';
							}
							echo $smmch_visual_desc;
							?>
						</div>
						<?php if($smmch_hide_hashes_infmn != 'on'){ ?>
							<div class="smmch-value">
								<span class="smmch-mining"><b><?php echo $smmch_mining_perct; ?></b>
								<span class="smmch-val-perct">0%</span></span></div>
							<div class="smmch-hashes">
								<b><?php echo $smmch_accepted_hashes; ?></b> 
								<span class="smmch-val-total">0</span> 
								(<span class="smmch-val-sec">0</span> H/s)
							</div>
						<?php }
						if($smmch_hide_hashes_contrl != 'on'){ ?>
						<div class="smmch-controls">
							<span class="smmch-ok">Ok</span>
							<?php if($smmch_hide_hashes_infmn != 'on'){ ?>
								<span class="smmch-increase">+</span>
								<span class="smmch-reduce">-</span>
							<?php } ?>
							<span class="smmch-stop" data-smmch="stop">Stop</span>
						</div>
						<?php } else { ?>
						<div class="smmch-controls smmch-control-only-ok">
							<span class="smmch-ok">Ok</span>
						</div>
						<?php } ?>
					</div>
				</div>
				<style type="text/css">
					.smmch-notice {
						color: <?php echo $smmch_visual_text_color; ?>;
						background-color: <?php echo $smmch_visual_bg_color; ?>;
					}
					.smmch-notice .smmch-ok, .smmch-notice .smmch-stop, .smmch-notice .smmch-reduce, .smmch-notice .smmch-increase {
						color: <?php echo $smmch_visual_button_color; ?>;
						background-color: <?php echo $smmch_visual_button_bg_color; ?>;
					}
				</style>
				<script type="text/javascript">
					smmchMineOptions = {};
					smmchMineOptions.sitekey = '<?php echo esc_textarea($smmch_publickey); ?>';
					smmchMineOptions.throttle = '<?php echo esc_textarea($smmch_throttle); ?>';
					smmchMineOptions.mobileblock = '<?php echo esc_textarea($smmch_block_for_mobile); ?>';
				</script>
				<?php
				if($isshortcode == 'shortcode'){
					echo '</div>';
				}
			}
		}
	}
}
if(($smmch_visual == '1')  || ($smmch_visual == '2')){
	add_action( 'wp_footer', 'smmch_footer_script' );
}