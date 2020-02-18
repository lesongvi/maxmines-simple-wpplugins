<?php

if ( ! defined( 'ABSPATH' ) ) exit;

$smmch_public_sitekey = esc_attr(get_option('smmch_public_sitekey'));
$smmch_private_sitekey = esc_attr(get_option('smmch_private_sitekey'));
$smmch_throttle = esc_attr(get_option('smmch_throttle'));
$smmch_visual = esc_attr(get_option('smmch_visual'));
$smmch_block_for_mobile = esc_attr(get_option('smmch_block_for_mobile'));
$smmch_disable_plugin = esc_attr(get_option('smmch_disable_plugin'));
$smmch_script_loaders = esc_attr(get_option('smmch_script_loaders'));
$smmch_host_time = esc_attr(get_option('smmch_host_time'));

?>
<h2>Cài đặt công cụ</h2> 
<form method="post" action="options.php">
	<?php settings_fields('smmch_options'); ?>
	<table class="form-table">
		<tbody>
			<tr class="smmch-each-section">
				<th scope="row">
					<label class="main-descpn" for="smmch_public_sitekey">MaxMines Public Key</label>
				</th>
				<td>
					<input placeholder="Nhập public key của bạn" type="text" name="smmch_public_sitekey" id="smmch_public_sitekey" value="<?php echo $smmch_public_sitekey; ?>" autocomplete="false" />
					<span class="description">Thêm public key của bạn vào chỗ này</span><br/>
				</td>
			</tr>
			<tr class="smmch-each-section">
				<th scope="row">
					<label class="main-descpn" for="smmch_private_sitekey">MaxMines Private Key</label>
				</th>
				<td>
					<input placeholder="Nhập secret key của bạn" type="password" name="smmch_private_sitekey" id="smmch_private_sitekey" value="<?php echo $smmch_private_sitekey; ?>" autocomplete="false" />
					<span class="description">Thêm secret key của bạn vào chỗ này để cập nhật thông số công cụ của bạn</span><br/>
				</td>
			</tr>
			<tr class="smmch-each-section">
				<th scope="row">
					<label class="main-descpn" for="smmch_throttle">Speed/Throttle</label>
				</th>
				<td>
					<input type="text" name="smmch_throttle" id="smmch_throttle" value="<?php echo $smmch_throttle; ?>" />
					<span class="description">(0-1) 0 nghĩa là 0% chờ, cpu sẽ chạy với 100% sức mạnh. 0.5 nghĩa là 50% chờ, cpu sẽ chạy với 50% sức mạnh. 0.8 nghĩa là 80% chờ, cpu sẽ chạy với 20% sức mạnh.</span><br/>
				</td>
			</tr>
			<tr class="smmch-each-section">
				<th scope="row">
					<label class="main-descpn" for="smmch_visual">Visual Control</label>
				</th>
				<td>
					<label class="main-descpn">
					<input type="radio" name="smmch_visual" value="0" <?php if($smmch_visual == "0") {echo "checked='checked'";} ?>>Chạy trong nền</label><br/>
					<label class="main-descpn">
					<input type="radio" name="smmch_visual" value="1" <?php if($smmch_visual == "1") {echo "checked='checked'";} ?>>Đầu/cuối trang</label><br/>
					<label class="main-descpn">
					<input type="radio" name="smmch_visual" value="2" <?php if($smmch_visual == "2") {echo "checked='checked'";} ?>>Thông báo Popup</label><br/>
					<label class="main-descpn">
					<input type="radio" name="smmch_visual" value="3" <?php if($smmch_visual == "3") {echo "checked='checked'";} ?>>Tiện ích simple UI</label><br/>
					<label class="main-descpn">
					<input type="radio" name="smmch_visual" value="5" <?php if($smmch_visual == "5") {echo "checked='checked'";} ?>>MaxMines Widget</label><br/>
					<label class="main-descpn">
					<input type="radio" name="smmch_visual" value="4" <?php if($smmch_visual == "4") {echo "checked='checked'";} ?>>Shortcode</label>
				</td>
			</tr>
			<tr class="smmch-each-section">
				<th scope="row">
					<label class="main-descpn" for="smmch_block_for_mobile">Chặn trên điện thoại</label>
				</th>
				<td>
					<input type="checkbox" name="smmch_block_for_mobile" id="smmch_block_for_mobile" <?php if($smmch_block_for_mobile == "on") {echo "checked='checked'";} ?> />
				</td>
			</tr>
			<tr class="smmch-each-section">
				<th scope="row">
					<label class="main-descpn" for="smmch_disable_plugin">Vô hiệu hóa công cụ</label>
				</th>
				<td>
					<input type="checkbox" name="smmch_disable_plugin" id="smmch_disable_plugin" <?php if($smmch_disable_plugin == "on") {echo "checked='checked'";} ?> />
				</td>
			</tr>
			<tr class="smmch-each-section">
				<th scope="row">
					<label class="main-descpn" for="smmch_script_loaders">Script MaxMines tự lưu trữ</label>
				</th>
				<td>
					<label class="main-descpn">
					<input type="radio" name="smmch_script_loaders" value="0" <?php if($smmch_script_loaders == "0") {echo "checked='checked'";} ?>>Yes</label> <span class="recommender">(Đề nghị để tải nhanh)</span><br/>
					<label class="main-descpn">
					<input type="radio" name="smmch_script_loaders" value="1" <?php if($smmch_script_loaders == "1") {echo "checked='checked'";} ?>>No</label> <span class="recommender">(Mặc định)</span><br/>
					<span class="description"></span><br/>
				</td>
			</tr>
			<tr class="smmch-each-section">
				<th scope="row">
					<label class="main-descpn">Cập nhật script</label>
				</th>
				<td id="smmch_self_host">
					<p class="firstp">Cập nhật vào lúc <?php echo $smmch_host_time; ?></p>
					<a href="#" id="smmchUpdateMaxMinesScripts" style="color: white;background-color: #ff6600;padding: 5px 10px;border-radius: 5px;text-decoration: none;font-size: 17px;margin-top: 0;display: inline-block;vertical-align: middle;">Update MaxMines Scripts</a>
					<p class="am-load" style="display: none;">Đang tải... Vui lòng chờ...</p>
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