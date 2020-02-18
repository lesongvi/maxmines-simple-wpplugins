<?php

if ( ! defined( 'ABSPATH' ) ) exit;

$smmch_publickey = esc_attr(get_option('smmch_public_sitekey'));
$smmch_visual = esc_attr(get_option('smmch_visual'));

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

?>
<div class="smmchshadow-box">
	<h2>Visual Control Settings</h2>
	<?php
	if($smmch_visual == 0){
		echo '<h3>Tùy chọn hiện tại: Chạy dưới nền</h3>';
		echo '<p>MaxMines Script đang chạy dưới nền trên trang web.</p>';
	} else if($smmch_visual == 3){
		echo '<h3>Tùy chọn hiện tại: Tiện ích simple UI</h3>';
		echo '<p>Điều hướng đến Widgets và thêm tiện ích "Simple Monero Miner - MaxMines" vào thanh bên.</p>';
	}  else if($smmch_visual == 5){
		echo '<h3>Tùy chọn hiện tại: Tiện ích MaxMines</h3>';
		echo '<p>Điều hướng đến Widget và thêm tiện ích "MaxMines" vào thanh bên.</p>';
	} else {
		switch($smmch_visual){
			case 1:
				echo '<h3>Tùy chọn hiện tại: Trên/dưới của trang</h3>';
				break;
			case 2:
				echo '<h3>Tùy chọn hiện tại: Popup thông báo</h3>';
				break;
			case 4:
				echo '<h3>Tùy chọn hiện tại: Shortcode</h3>';
				echo '<h4>Thêm shortcode vào trang của bạn: [simple-miner]</h4>';
				echo "<h4>Thêm shortcode này vào Template của bạn: &lt;?php echo do_shortcode('[simple-miner]'); ?&gt;</h4>";
				break;
		} ?>
		<form method="post" action="options.php">
			<?php settings_fields('smmch_visual_control'); ?>
			<table class="form-table">
				<tbody>
					<tr class="smmch-each-section <?php if($smmch_visual != 1){ echo 'smmch-hide'; } ?>">
						<th scope="row">
							<label class="main-descpn" for="smmch_topbottom_pos">Vị trí</label>
						</th>
						<td>
							<select name="smmch_topbottom_pos" id="smmch_topbottom_pos">
								<option <?php echo ($smmch_topbottom_pos == 'top' ? "selected" : ""); ?>>Trên</option>
								<option <?php echo ($smmch_topbottom_pos == 'bottom' ? "selected" : ""); ?>>Dưới</option>
							</select>
						</td>
					</tr>
					<tr class="smmch-each-section <?php if($smmch_visual != 2){ echo 'smmch-hide'; } ?>">
						<th scope="row">
							<label class="main-descpn" for="smmch_notification_pos">Vị trí</label>
						</th>
						<td>
							<select name="smmch_notification_pos" id="smmch_notification_pos">
								<option <?php echo ($smmch_notification_pos == 'top left' ? "selected" : ""); ?>>Trên trái</option>
								<option <?php echo ($smmch_notification_pos == 'top right' ? "selected" : ""); ?>>Trên phải</option>
								<option <?php echo ($smmch_notification_pos == 'bottom left' ? "selected" : ""); ?>>Dưới trái</option>
								<option <?php echo ($smmch_notification_pos == 'bottom right' ? "selected" : ""); ?>>Dưới phải</option>
							</select>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_visual_title">Tiêu đề</label>
						</th>
						<td>
							<input placeholder="Nhập tiêu đề của bạn" type="text" name="smmch_visual_title" id="smmch_visual_title" value="<?php echo $smmch_visual_title; ?>" autocomplete="false" /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_visual_desc">Mô tả</label>
						</th>
						<td>
							<input placeholder="Nhập mô tả của bạn" type="text" name="smmch_visual_desc" id="smmch_visual_desc" value="<?php echo $smmch_visual_desc; ?>" autocomplete="false" /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_visual_text_color">Màu chữ</label>
						</th>
						<td>
							<input type="text" name="smmch_visual_text_color" id="smmch_visual_text_color" class="my-color-picker" value="<?php echo $smmch_visual_text_color; ?>" /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_visual_bg_color">Màu khung</label>
						</th>
						<td>
							<input type="text" name="smmch_visual_bg_color" id="smmch_visual_bg_color" class="my-color-picker" value="<?php echo $smmch_visual_bg_color; ?>" /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_visual_button_color">Màu chữ button</label>
						</th>
						<td>
							<input type="text" name="smmch_visual_button_color" id="smmch_visual_button_color" class="my-color-picker" value="<?php echo $smmch_visual_button_color; ?>" /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_visual_button_bg_color">Màu nền button</label>
						</th>
						<td>
							<input type="text" name="smmch_visual_button_bg_color" id="smmch_visual_button_bg_color" class="my-color-picker" value="<?php echo $smmch_visual_button_bg_color; ?>" /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_mining_perct">Text phần trăm đào</label>
						</th>
						<td>
							<input placeholder="Nhập mô tả của bạn" type="text" name="smmch_mining_perct" id="smmch_mining_perct" value="<?php echo $smmch_mining_perct; ?>" autocomplete="false" /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_accepted_hashes">Text hashes đã chấp nhận</label>
						</th>
						<td>
							<input placeholder="Nhập mô tả của bạn" type="text" name="smmch_accepted_hashes" id="smmch_accepted_hashes" value="<?php echo $smmch_accepted_hashes; ?>" autocomplete="false" /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section <?php if($smmch_visual == 4){ echo 'smmch-hide'; } ?>">
						<th scope="row">
							<label class="main-descpn" for="smmch_visual_hide_time">Thời gian để ẩn Hộp thông tin (tính bằng giây)</label>
						</th>
						<td>
							<input placeholder="Thời gian để ẩn hộp thông tin... tính bằng giây" type="text" name="smmch_visual_hide_time" id="smmch_visual_hide_time" value="<?php echo $smmch_visual_hide_time; ?>" autocomplete="false" /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section <?php if($smmch_visual == 4){ echo 'smmch-hide'; } ?>">
						<th scope="row">
							<label class="main-descpn" for="smmch_first_session">Chỉ hiển thị với session đầu tiên</label>
						</th>
						<td>
							<input type="checkbox" name="smmch_first_session" id="smmch_first_session" <?php if($smmch_first_session == "on") {echo "checked='checked'";} ?> /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_hide_hashes_infmn">Ẩn thông tin hashes</label>
						</th>
						<td>
							<input type="checkbox" name="smmch_hide_hashes_infmn" id="smmch_hide_hashes_infmn" <?php if($smmch_hide_hashes_infmn == "on") {echo "checked='checked'";} ?> /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<th scope="row">
							<label class="main-descpn" for="smmch_hide_hashes_contrl">Ẩn bảng điều khiển hash</label>
						</th>
						<td>
							<input type="checkbox" name="smmch_hide_hashes_contrl" id="smmch_hide_hashes_contrl" <?php if($smmch_hide_hashes_contrl == "on") {echo "checked='checked'";} ?> /><br/>
						</td>
					</tr>
					<tr class="smmch-each-section">
						<td>
							<input class="button-primary" type="submit" name="Save" value="Lưu" /><br/>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
<?php } ?>
</div>