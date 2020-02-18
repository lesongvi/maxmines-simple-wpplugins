<?php

class smmch_widget extends WP_Widget {

public function __construct() {
	parent::__construct('simple-monero-miner-maxmines', 'Simple Monero Miner - MaxMines');
}
public function widget( $args, $instance ) {
	extract( $args );
	$title      = apply_filters( 'widget_title', $instance['title'] );
	$message    = esc_attr( $instance['message'] );
	$color    	= esc_attr( $instance['color'] );
	$bgcolor    	= esc_attr( $instance['bgcolor'] );
	$minepercttext  = esc_attr( $instance['minepercttext'] );
	$hashestext    	= esc_attr( $instance['hashestext'] );
	$hashesinfo    	= esc_attr( $instance['hashesinfo'] );
	$hashescontl   	= esc_attr( $instance['hashescontl'] );
	
	$smmch_publickey = get_option('smmch_public_sitekey');
	$smmch_throttle = number_format((float)get_option('smmch_throttle'), 1, '.', '');
	$smmch_block_for_mobile = esc_attr(get_option('smmch_block_for_mobile'));
	$smmch_disable_plugin = esc_attr(get_option('smmch_disable_plugin'));
	
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
				echo $before_widget;
				if ( $title ) {
					echo $before_title . $title . $after_title;
				}
				if ( $message ) {
					echo '<p class="smmch-control-shower">' . $message . '</p>';
				}
				
				?>
				<?php if($hashesinfo != 'on'){ ?>
					<div class="smmch-value">
						<span class="smmch-mining"><b><?php echo $minepercttext; ?></b>
						<span class="smmch-val-perct">0%</span></span></div>
					<div class="smmch-hashes">
						<b><?php echo $hashestext; ?></b>
						<span class="smmch-val-total">0</span>
						(<span class="smmch-val-sec">0</span> H/s)
					</div>
				<?php }
				if($hashescontl != 'on'){ ?>
				<div class="smmch-controls">
					<span class="smmch-ok">Ok</span>
					<?php if($hashesinfo != 'on'){ ?>
						<span class="smmch-increase">+</span>
						<span class="smmch-reduce">-</span>
					<?php } ?>
					<span class="smmch-stop" data-smmch="stop">Dừng</span>
				</div>
				<?php } else { ?>
					<div class="smmch-controls smmch-control-only-ok">
						<span class="smmch-ok">Ok</span>
					</div>
				<?php } ?>
				<style type="text/css">
					.widget .smmch-ok, .widget .smmch-stop, .widget .smmch-reduce, .widget .smmch-increase {
						background-color: <?php echo $bgcolor; ?>;
						color: <?php echo $color; ?>;
					}
				</style>
				<script type="text/javascript">
					smmchMineOptions = {};
					smmchMineOptions.sitekey = '<?php echo esc_textarea($smmch_publickey); ?>';
					smmchMineOptions.throttle = '<?php echo esc_textarea($smmch_throttle); ?>';
					smmchMineOptions.mobileblock = '<?php echo esc_textarea($smmch_block_for_mobile); ?>';
				</script>
				<?php
				echo $after_widget;
			}
		}
	}
}
public function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['message'] = strip_tags( $new_instance['message'] );
	$instance['color'] = strip_tags( $new_instance['color'] );
	$instance['bgcolor'] = strip_tags( $new_instance['bgcolor'] );
	$instance['minepercttext'] = strip_tags( $new_instance['minepercttext'] );
	$instance['hashestext'] = strip_tags( $new_instance['hashestext'] );
	$instance['hashesinfo'] = strip_tags( $new_instance['hashesinfo'] );
	$instance['hashescontl'] = strip_tags( $new_instance['hashescontl'] );
	return $instance;    
}
public function form( $instance ) {
	$title      = esc_attr( $instance['title'] );
	$titleid 	= $this->get_field_id( 'title' );
	$titlename 	= $this->get_field_name( 'title' );
	
	$message    	= esc_attr( $instance['message'] );
	$messageid 		= $this->get_field_id( 'message' );
	$messagename	= $this->get_field_name( 'message' );

	$color    	= esc_attr( $instance['color'] );
	$colorid 	= $this->get_field_id( 'color' );
	$colorname 	= $this->get_field_name( 'color' );

	$bgcolor    	= esc_attr( $instance['bgcolor'] );
	$bgcolorid 		= $this->get_field_id( 'bgcolor' );
	$bgcolorname	= $this->get_field_name( 'bgcolor' );

	$minepercttext	= esc_attr( $instance['minepercttext'] );
	$mineperctid 	= $this->get_field_id( 'minepercttext' );
	$mineperctname 	= $this->get_field_name( 'minepercttext' );
	
	$hashestext    	= esc_attr( $instance['hashestext'] );
	$hashestextid 	= $this->get_field_id( 'hashestext' );
	$hashestextname = $this->get_field_name( 'hashestext' );

	$hashesinfo    	= esc_attr( $instance['hashesinfo'] );
	$hashesinfoid 	= $this->get_field_id( 'hashesinfo' );
	$hashesinfoname = $this->get_field_name( 'hashesinfo' );

	$hashescontl    	= esc_attr( $instance['hashescontl'] );
	$hashescontlid 		= $this->get_field_id( 'hashescontl' );
	$hashescontlname	= $this->get_field_name( 'hashescontl' );

	if($title == ''){
		$title = 'Hỗ trợ tôi';
	}
	if($message == ''){
		$message = 'Chào! Bây giờ bạn có thể giúp duy trì trang web này bằng cách sử dụng sức mạnh CPU dư thừa của bạn! Bạn có thể dừng lại nếu bạn cần!';
	}
	if($color == ''){
		$color = '#ffffff';
	}
	if($bgcolor == ''){
		$bgcolor = '#000000';
	}
	if($minepercttext == ''){
		$minepercttext = 'Tỷ lệ khai thác:';
	}	
	if($hashestext == ''){
		$hashestext = 'Tổng số hash được chấp nhận:';
	} ?>
	<script type='text/javascript'>
		jQuery(document).ready(function($) {
			$('.smmch-widget-config .my-wonder-color-picker').each(function(){
				if($(this).closest('#available-widgets').length == 0) {
					$(this).wpColorPicker();
				}
			});
		});
	</script>
	<div class="smmch-widget-config">
		<p style="border-left: 2px solid green;padding: 5px;font-style: italic;background-color: #fafafa;box-sizing: border-box;">
		Nếu bạn đang sử dụng widget này, đảm bảo tùy chọn <b>'Simple Miner UI Widget'</b> được bật trên <b>Simple Monero Miner - MaxMines</b> <?php echo '<a href="' . admin_url( 'options-general.php?page=simple-monero-miner-maxmines' ) . '"><img style="vertical-align: middle;width:15px;height:15px;border:0;" src="'.plugin_dir_url(__FILE__).'../img/monero-coin.png">Settings</a>'; ?>. Để tránh các lỗi giao diện điều khiển không cần thiết.
		</p>
		<p>
			<label for="<?php echo $titleid; ?>"><?php _e( 'Tiêu đề:' ); ?></label>
			<input class="widefat" id="<?php echo $titleid; ?>" name="<?php echo $titlename; ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $messageid; ?>"><?php _e( 'Mô tả:' ); ?></label>
			<input class="widefat" id="<?php echo $messageid; ?>" name="<?php echo $messagename; ?>" type="text" value="<?php echo $message; ?>" />
		</p>
		<p>
			<label for="<?php echo $mineperctid; ?>"><?php _e( 'Text phần trăm khai thác:' ); ?></label>
			<input class="widefat" id="<?php echo $mineperctid; ?>" name="<?php echo $mineperctname; ?>" type="text" value="<?php echo $minepercttext; ?>" />
		</p>
		<p>
			<label for="<?php echo $hashestextid; ?>"><?php _e( 'Text tổng Hash được chấp nhận:' ); ?></label>
			<input class="widefat" id="<?php echo $hashestextid; ?>" name="<?php echo $hashestextname; ?>" type="text" value="<?php echo $hashestext; ?>" />
		</p>
		<p>
			<label for="<?php echo $colorid; ?>"><?php _e( 'Màu text của button:' ); ?></label><br/>
			<input type="text" id="<?php echo $colorid; ?>" class="my-wonder-color-picker" name="<?php echo $colorname; ?>" value="<?php echo $color; ?>" />
		</p>
		<p>
			<label for="<?php echo $bgcolorid; ?>"><?php _e( 'Màu nền button:' ); ?></label><br/>
			<input type="text" id="<?php echo $bgcolorid; ?>" class="my-wonder-color-picker" name="<?php echo $bgcolorname; ?>" value="<?php echo $bgcolor; ?>" />
		</p>
		<p>
			<label for="<?php echo $hashesinfoid; ?>"><?php _e( 'Ẩn thông tin hashes:' ); ?></label><br/>
			<input type="checkbox" id="<?php echo $hashesinfoid; ?>" name="<?php echo $hashesinfoname; ?>" <?php if($hashesinfo == "on") {echo "checked='checked'";} ?> />
		</p>
		<p>
			<label for="<?php echo $hashescontlid; ?>"><?php _e( 'Ẩn bảng điều khiển hash:' ); ?></label><br/>
			<input type="checkbox" id="<?php echo $hashescontlid; ?>" name="<?php echo $hashescontlname; ?>" <?php if($hashescontl == "on") {echo "checked='checked'";} ?> />
		</p>
	</div>
<?php
}
}
add_action( 'widgets_init', function(){
	register_widget( 'smmch_widget' );
});

function smmch_custom_load() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'load-widgets.php', 'smmch_custom_load' );