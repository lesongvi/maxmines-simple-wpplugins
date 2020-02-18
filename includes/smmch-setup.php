<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// html to show popup and ask to create maxmines account and copy the public key and private key.
// 

?>
<div class="smmch-popup">
	<div class="smmch-popup-inner">
		<div class="smmch-popup-row">
			<h2>Cài đặt nhanh</h2>
			<form method="post" action="options.php">
				<?php settings_fields('smmch_skip'); ?>
				<input type="hidden" name="smmch_setup" value="1">
				<input class="skip-primary" type="submit" name="Skip" value="BỎ QUA" />
			</form>
		</div>
		<div class="smmch-popup-row">Tạo tài khoản MaxMines - Nhấp <a href="https://maxmines.com/account/signup" target="_blank">đây</a></div>
		<div class="smmch-popup-row">Sau khi đăng nhập > Chép Public Key - Nhấp <a href="https://maxmines.com/settings/sites" target="_blank">đây</a></div>
		<div class="smmch-popup-row">Dán nó vào <b>'MaxMines Public Key'</b> Cài đặt & Lưu</div>
		<div class="smmch-popup-row">Đến <b>Visual Control Settings</b>, Cập nhật & Lưu</div>
		<div class="smmch-popup-row">
			<span style="float: left;">Yeah, xong rồi đó, bắt đầu đào thôi!</span>
			<form method="post" action="options.php">
				<?php settings_fields('smmch_skip'); ?>
				<input type="hidden" name="smmch_setup" value="1">
				<input class="skip-primary" type="submit" name="Skip" value="XONG" />
			</form>
		</div>
	</div>
</div>