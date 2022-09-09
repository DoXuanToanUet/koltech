jQuery(document).ready(function() {

	jQuery('.coupon-box').hide();
	jQuery('#search-coupon').click(function(){
		jQuery('.coupon-box').hide();
		var txt = jQuery('#search-criteria').val();
		jQuery('.coupon-box table:contains("'+txt+'")').show().parent().show();
	});
    jQuery('#search-criteria').keyup(function(event) {
		jQuery('.coupon-box').hide();
		var txt = jQuery('#search-criteria').val();
		jQuery('.coupon-box table:contains("'+txt+'")').show().parent().show();
    });
	jQuery('#search-coupon-all').click(function(){
		jQuery('.coupon-box').toggle();
	});

	/*
	jQuery('.wcusage-show-last-all').show();
	jQuery('.wcusage-show-last-7').delay(1).fadeOut('fast');
	jQuery('.wcusage-show-last-30').delay(1).fadeOut('fast');
	jQuery('.wcusage-show-last-all-30').show();
	*/

	jQuery('#wcusage-last-days7').click(function(){
		jQuery('.wcusage-show-last-7').show();
		jQuery('#wcusage-last-days7').css("color", "#333");
		jQuery('.wcusage-show-last-30').hide();
		jQuery('#wcusage-last-days30').css("color", "#a6a6a6");
		jQuery('.wcusage-show-last-all').hide();
		jQuery('#wcusage-last-days-all').css("color", "#a6a6a6");
		jQuery('.wcusage-show-last-all-30').hide();
	});

	jQuery('#wcusage-last-days30').click(function(){
		jQuery('.wcusage-show-last-7').hide();
		jQuery('#wcusage-last-days7').css("color", "#a6a6a6");
		jQuery('.wcusage-show-last-30').show();
		jQuery('#wcusage-last-days30').css("color", "#333");
		jQuery('.wcusage-show-last-all').hide();
		jQuery('#wcusage-last-days-all').css("color", "#a6a6a6");
		jQuery('.wcusage-show-last-all-30').show();
	});

	jQuery('#wcusage-last-days-all').click(function(){
		jQuery('.wcusage-show-last-7').hide();
		jQuery('#wcusage-last-days7').css("color", "#a6a6a6");
		jQuery('.wcusage-show-last-30').hide();
		jQuery('#wcusage-last-days30').css("color", "#a6a6a6");
		jQuery('.wcusage-show-last-all').show();
		jQuery('#wcusage-last-days-all').css("color", "#333");
		jQuery('.wcusage-show-last-all-30').show();
	});

	if( jQuery( '.entry-content' ).width() < 850 ) {
		jQuery(".wcusage-info-box").css("padding", "25px 35px 25px 25px");
		jQuery('head').append('<style>.wcusage-info-box::before{display: none !important;}</style>');
	}

	/* Password Toggle */
	jQuery( document ).ready(function() {
		jQuery(".wcu-toggle-password").click(function() {
			jQuery(this).toggleClass("fa-eye fa-eye-slash");
			var input = jQuery(jQuery(this).attr("toggle"));
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	});

});

function wcusage_copyToClipboard(elementId, elementId2) {
	var aux = document.createElement("input");
	aux.setAttribute("value", document.getElementById(elementId).innerText);
	if(elementId2) {
		if(document.getElementById(elementId2).innerText) {
			aux.setAttribute("value", document.getElementById(elementId2).innerText);
		}
	}
	document.body.appendChild(aux);
	aux.select();
	document.execCommand("copy");
	document.body.removeChild(aux);
	jQuery("#wcu-copy-" + elementId).removeClass("fa-copy");
	jQuery("#wcu-copy-" + elementId).addClass("fa-check-circle");
	setTimeout(function() { wcu_reset_copy(elementId); }, 1000);
}
function wcu_reset_copy(elementId) {
	jQuery("#wcu-copy-" + elementId).removeClass("fa-check-circle");
	jQuery("#wcu-copy-" + elementId).addClass("fa-copy");
}
