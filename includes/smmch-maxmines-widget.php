<?php

class smmch_maxmines_widget extends WP_Widget {

public function __construct() {
	parent::__construct('maxmines-minermax', 'MaxMines');
}
public function widget( $args, $instance ) {
	extract( $args );

	$smmch_publickey = get_option('smmch_public_sitekey');
	$smmch_disable_plugin = esc_attr(get_option('smmch_disable_plugin'));

	$title     	 = apply_filters( 'widget_title', $instance['title'] );
	$message   	 = esc_attr( $instance['message'] );
	$width  	 = esc_attr( $instance['width'] );
	$height  	 = esc_attr( $instance['height'] );
	$manualstart = esc_attr( $instance['manualstart'] );
	$whitelabel  = esc_attr( $instance['whitelabel'] );
	$background  = esc_attr( $instance['background'] );
	$text  		 = esc_attr( $instance['text'] );
	$action    	 = esc_attr( $instance['action'] );
	$graph    	 = esc_attr( $instance['graph'] );
	$threads   	 = esc_attr( $instance['threads'] );
	$throttle	 = esc_attr( $instance['throttle'] );

	if($smmch_disable_plugin != "on"){
		if($smmch_publickey != ''){
			echo $before_widget;
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
			if ( $message ) {
				echo '<p>' . $message . '</p>';
			}
			?>
			<script src="//maxmines.com/lib/simple-ui.min.js" async></script>
			<div class="maxmines-miner" 
				style="width: <?php echo esc_textarea($width); ?>; height: <?php echo esc_textarea($height); ?>"
				data-ref="wp-smm"
				data-key="<?php echo esc_textarea($smmch_publickey); ?>"
				data-autostart="<?php if(esc_textarea($manualstart) != 'on') echo 'true'; ?>"
				data-whitelabel="<?php if(esc_textarea($whitelabel) == 'on') echo 'true'; ?>"
				data-background="<?php echo esc_textarea($background); ?>"
				data-text="<?php echo esc_textarea($text); ?>"
				data-action="<?php echo esc_textarea($action); ?>"
				data-graph="<?php echo esc_textarea($graph); ?>"
				data-threads="<?php echo esc_textarea($threads); ?>"
				data-throttle="<?php echo esc_textarea($throttle); ?>">
				<em>Loading...</em>
			</div>
			<?php
			echo $after_widget;
		}
	}
}
public function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] 		= strip_tags( $new_instance['title'] );
	$instance['message'] 	= strip_tags( $new_instance['message'] );
	$instance['width'] 		= strip_tags( $new_instance['width'] );
	$instance['height'] 	= strip_tags( $new_instance['height'] );
	$instance['manualstart']= strip_tags( $new_instance['manualstart'] );
	$instance['whitelabel']	= strip_tags( $new_instance['whitelabel'] );
	$instance['background'] = strip_tags( $new_instance['background'] );
	$instance['text'] 		= strip_tags( $new_instance['text'] );
	$instance['action'] 	= strip_tags( $new_instance['action'] );
	$instance['graph'] 		= strip_tags( $new_instance['graph'] );
	$instance['threads'] 	= strip_tags( $new_instance['threads'] );
	$instance['throttle'] 	= strip_tags( $new_instance['throttle'] );
	return $instance;
}
public function form( $instance ) {

	$title    	= esc_attr( $instance['title'] );
	$titleid	= $this->get_field_id( 'title' );
	$titlename	= $this->get_field_name( 'title' );

	$message    = esc_attr( $instance['message'] );
	$messageid	= $this->get_field_id( 'message' );
	$messagename= $this->get_field_name( 'message' );

	$width    	= esc_attr( $instance['width'] );
	$widthid	= $this->get_field_id( 'width' );
	$widthname	= $this->get_field_name( 'width' );

	$height    	= esc_attr( $instance['height'] );
	$heightid	= $this->get_field_id( 'height' );
	$heightname	= $this->get_field_name( 'height' );

	$manualstart    = esc_attr( $instance['manualstart'] );
	$manualstartid 	= $this->get_field_id( 'manualstart' );
	$manualstartname= $this->get_field_name( 'manualstart' );

	$whitelabel		= esc_attr( $instance['whitelabel'] );
	$whitelabelid	= $this->get_field_id( 'whitelabel' );
	$whitelabelname	= $this->get_field_name( 'whitelabel' );

	$background    	= esc_attr( $instance['background'] );
	$backgroundid 	= $this->get_field_id( 'background' );
	$backgroundname	= $this->get_field_name( 'background' );

	$text    	= esc_attr( $instance['text'] );
	$textid 	= $this->get_field_id( 'text' );
	$textname 	= $this->get_field_name( 'text' );

	$action		= esc_attr( $instance['action'] );
	$actionid 	= $this->get_field_id( 'action' );
	$actionname = $this->get_field_name( 'action' );

	$graph    	= esc_attr( $instance['graph'] );
	$graphid 	= $this->get_field_id( 'graph' );
	$graphname  = $this->get_field_name( 'graph' );

	$threads    	= esc_attr( $instance['threads'] );
	$threadsid 		= $this->get_field_id( 'threads' );
	$threadsname	= $this->get_field_name( 'threads' );

	$throttle    	= esc_attr( $instance['throttle'] );
	$throttleid 	= $this->get_field_id( 'throttle' );
	$throttlename	= $this->get_field_name( 'throttle' );

	if($title == ''){
		$title = 'Donation';
	}
	if($message == ''){
		$message = 'Chào! Miễn là bạn giữ trang này mở, bạn sẽ đóng góp vào những nỗ lực của tôi bằng sức mạnh máy tính của bạn.';
	}
	if($width == ''){
		$width = '100%';
	}
	if($height == ''){
		$height = '250px';
	}
	if($background == ''){
		$background = '#fafafa';
	}
	if($text == ''){
		$text = '#000000';
	}
	if($action == ''){
		$action = '#1e9ee0';
	}
	if($graph == ''){
		$graph = '#1e9ee0';
	}
	if($threads == ''){
		$threads = '4';
	}
	if($throttle == ''){
		$throttle = '0.3';
	}
	?>
	<script type='text/javascript'>
		jQuery(document).ready(function($) {
			$('.smmch-maxmines-widget-config .my-wonder-color-picker').each(function(){
				if($(this).closest('#available-widgets').length == 0) {
					$(this).wpColorPicker();
				}
			});
		});
	</script>
	<div class="smmch-maxmines-widget-config">
		<p style="border-left: 2px solid green;padding: 5px;font-style: italic;background-color: #fafafa;box-sizing: border-box;">
		Nếu bạn đang sử dụng widget này, đảm bảo tùy chọn <b>'MaxMines Widget'</b> được bật trong <b>Simple Monero Miner - MaxMines</b> <?php echo '<a href="' . admin_url( 'options-general.php?page=simple-monero-miner-maxmines' ) . '"><img style="vertical-align: middle;width:15px;height:15px;border:0;" src="'.plugin_dir_url(__FILE__).'../img/monero-coin.png">Settings</a>'; ?>. để tránh các lỗi giao diện điều khiển không cần thiết.
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
			<label for="<?php echo $widthid; ?>"><?php _e( 'Chiều rộng:' ); ?></label>
			<input class="widefat" id="<?php echo $widthid; ?>" name="<?php echo $widthname; ?>" type="text" value="<?php echo $width; ?>" />
		</p>
		<p>
			<label for="<?php echo $heightid; ?>"><?php _e( 'Chiều cao:' ); ?></label>
			<input class="widefat" id="<?php echo $heightid; ?>" name="<?php echo $heightname; ?>" type="text" value="<?php echo $height; ?>" />
		</p>
		<p>
			<label for="<?php echo $manualstartid; ?>"><?php _e( 'Bắt đầu sau khi người dùng nhấp:' ); ?></label><br/>
			<input type="checkbox" id="<?php echo $manualstartid; ?>" name="<?php echo $manualstartname; ?>" <?php if($manualstart == "on") {echo "checked='checked'";} ?> />
		</p>
		<p>
			<label for="<?php echo $whitelabelid; ?>"><?php _e( 'Ẩn "Powered by MaxMines"' ); ?></label><br/>
			<input type="checkbox" id="<?php echo $whitelabelid; ?>" name="<?php echo $whitelabelname; ?>" <?php if($whitelabel == "on") {echo "checked='checked'";} ?> />
		</p>
		<p>
			<label for="<?php echo $backgroundid; ?>"><?php _e( 'Màu nền:' ); ?></label><br/>
			<input type="text" id="<?php echo $backgroundid; ?>" class="my-wonder-color-picker" name="<?php echo $backgroundname; ?>" value="<?php echo $background; ?>" />
		</p>
		<p>
			<label for="<?php echo $textid; ?>"><?php _e( 'Màu chữ:' ); ?></label><br/>
			<input type="text" id="<?php echo $textid; ?>" class="my-wonder-color-picker" name="<?php echo $textname; ?>" value="<?php echo $text; ?>" />
		</p>
		<p>
			<label for="<?php echo $actionid; ?>"><?php _e( 'Màu Button:' ); ?></label><br/>
			<input type="text" id="<?php echo $actionid; ?>" class="my-wonder-color-picker" name="<?php echo $actionname; ?>" value="<?php echo $action; ?>" />
		</p>
		<p>
			<label for="<?php echo $graphid; ?>"><?php _e( 'Màu đồ thị:' ); ?></label><br/>
			<input type="text" id="<?php echo $graphid; ?>" class="my-wonder-color-picker" name="<?php echo $graphname; ?>" value="<?php echo $graph; ?>" />
		</p>
		<p>
			<label for="<?php echo $threadsid; ?>"><?php _e( 'Số Thread:' ); ?></label><br/>
			<input class="widefat" id="<?php echo $threadsid; ?>" type="text" name="<?php echo $threadsname; ?>" value="<?php echo $threads; ?>" />
		</p>
		<p>
			<label for="<?php echo $throttleid; ?>"><?php _e( 'Throttle:' ); ?></label><br/>
			<input class="widefat" id="<?php echo $throttleid; ?>" type="text" name="<?php echo $throttlename; ?>" value="<?php echo $throttle; ?>" />
		</p>
	</div>
<?php
}
}
add_action( 'widgets_init', function(){
	register_widget( 'smmch_maxmines_widget' );
});

function smmch_maxmines_custom_load() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'load-widgets.php', 'smmch_maxmines_custom_load' );