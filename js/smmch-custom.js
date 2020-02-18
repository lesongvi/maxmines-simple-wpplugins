jQuery(document).ready(function(){
	
	/*append the dom popup if present to show the quick setup nicely*/
	if(jQuery('.smmch-popup').length > 0){
		var smmchPopup = jQuery('.smmch-popup').detach();
		jQuery('#wpwrap').before(smmchPopup);
		jQuery('.smmch-popup').fadeIn();
	}
	if(jQuery('.smmch-each-section').length > 0){
		jQuery('.smmch-each-section .my-color-picker').wpColorPicker();
	}
	
	jQuery('#smmchUpdateMaxMinesScripts').click(function(e){
		e.preventDefault();
		jQuery.ajax({
			type : "post",
			dataType : "json",
			url : ajaxurl,
			data : {action: "smmch_process"},
			beforeSend: function() {
				jQuery('#smmch_self_host .am-load').show();
			},
			success: function(response) {
				jQuery('#smmch_self_host .am-load').hide();
				jQuery('#smmch_self_host > p.firstp').addClass('h-green').text('Updated on ' + response.success);
				setTimeout(function(){
					jQuery('#smmch_self_host > p.firstp').removeClass('h-green');
				},1000);
			}
		});
	});
});