jQuery( document ).ready(function($) {
	
	'use strict';
	
	// Copy WooCommerce prices and discounts
	/*var intervalId = window.setInterval(function(){
		
		var a = $('#order_review .order-total .woocommerce-Price-amount bdi').html();
		var b = $('.shb-booking-your-stay-wrapper .shb-deposit-due h4:last-child').html(a);
		$('.shb-booking-your-stay-wrapper .shb-booking-total h4:last-child').html(a);
		
		if ($('.cart-discount')[0]){
			
			$('.shb-woocommerce-discount-wrapper').css('display','block');
			
			$('.cart-discount').each(function(i, obj) {	
				var a = $('#order_review tfoot').html();
				var b = $('.shb-booking-your-stay-wrapper .shb-woocommerce-discount').html(a);
			});
		} else {
			var b = $('.shb-booking-your-stay-wrapper .shb-woocommerce-discount h4:last-child').html('');
			$('.shb-woocommerce-discount-wrapper').css('display','none');
		}
		
	}, 1000);*/
	
	var shb_datepicker_altformat = 'yy-mm-dd';
	var shb_datepicker_firstday = 1;
	var shb_datepicker_format = 'dd/mm/yy'
	
	$('.shb-datepicker').attr('readonly', true);
	
	jQuery('.shb-datepicker').datepicker({
		minDate: new Date(),
		dateFormat: shb_datepicker_format,
		dayNamesMin: shb_datepicker_daynames,
		monthNames: shb_datepicker_monthnames,
		firstDay: shb_datepicker_firstday,
		altFormat: shb_datepicker_altformat,
		altField: '.shb-datepicker-alt',
	});
	
	$('.shb-expand-button, .shb-expand-button-hidden').click(function(){
		 $(this).parent().find('.shb-expand-small, .shb-expand-big').toggleClass('shb-expand-small shb-expand-big');
		 $(this).parent().find('.shb-expand-button, .shb-expand-button-hidden').toggleClass('shb-expand-button shb-expand-button-hidden');
		 return false;
	});
	
	$('.shb-booking-step a').click(function(){
			
		if ($(this).attr('href') == '#') {
			return false;
		}
		
	});
	
	if ($(".shb-booking-step-wrapper, .shb-booking-complete-wrapper").length > 0) {
		
		$('html,body').animate({
		   scrollTop: $(".shb-booking-step-wrapper, .shb-booking-complete-wrapper").offset().top - 60
		});
	
	}
	
	// Location select open
	$('.shb-location-selection').click(function(){
		
		$('.shb-location-selection').not(this).parent().find('.shb-location-select-dropdown').fadeOut(200);
		
		$(this).parent().find('.shb-location-select-dropdown').fadeIn(300);
		
		// Location drop down position
		var shb_location_position = shb_position(this);
	
		$('.shb-location-select-dropdown').css('top',shb_location_position['vert_position']);
		$('.shb-location-select-dropdown').css('left',shb_location_position['left']);
	
		$(window).on("load scroll resize", { selected : this }, function(event) {
			
			var data = event.data;
			var shb_location_position = shb_position(data.selected);
		
			$('.shb-location-select-dropdown').css('top',shb_location_position['vert_position']);
			$('.shb-location-select-dropdown').css('left',shb_location_position['left']);
		
		});
		
	});
	
	// Location select close
	$(document).mouseup(function(e) {

		var container = jQuery('.shb-location-selection,.shb-location-select-dropdown');

		if (!container.is(e.target) && container.has(e.target).length === 0) {
			$('.shb-location-select-dropdown').fadeOut(200);
		}

	});
	
	// Location select set fields
	$('.shb-location-select-dropdown ul li').click(function(){

		$(this).parent().parent().parent().find('.shb-location-display').html($(this).attr('data-name'));
		$(this).parent().parent().find('.shb-location').val($(this).attr('data-id'));
		$('.shb-location-select-dropdown').fadeOut(200);
		
	});
	
	// Guestclass select open
	$('.shb-guestclass-selection').click(function(){
		
		$('.shb-guestclass-selection').not(this).parent().find('.shb-guestclass-select-dropdown').fadeOut(200);
	
		$(this).parent().find('.shb-guestclass-select-dropdown').fadeIn(300);
		
		// Guestclass drop down position
		var shb_guestclass_position = shb_position(this);
	
		$('.shb-guestclass-select-dropdown').css('top',shb_guestclass_position['vert_position']);
		$('.shb-guestclass-select-dropdown').css('left',shb_guestclass_position['left']);
		
		$(window).on("load scroll resize", { selected : this }, function(event) {

			var data = event.data;
			var shb_guestclass_position = shb_position(data.selected);
		
			$('.shb-guestclass-select-dropdown').css('top',shb_guestclass_position['vert_position']);
			$('.shb-guestclass-select-dropdown').css('left',shb_guestclass_position['left']);
		
		});
		
	});
	
	// Guestclass select close
	$(document).mouseup(function(e) {

		var container = jQuery('.shb-guestclass-selection,.shb-guestclass-select-dropdown');

		if (!container.is(e.target) && container.has(e.target).length === 0) {
			$('.shb-guestclass-select-dropdown').fadeOut(200);
		}

	});

	//$('.shb-guestclass').val(0);
	//$('.shb-qty-display').html(0);
	
	// Guestclass select open
	$('.shb-qty-decrease,.shb-qty-increase').click(function(){
		var fieldType = $(this).parent().parent().find('input').attr('name');
		var shb_guestclass_qty = parseInt($(this).parent().parent().find('.shb-guestclass').val());

		if ($(this).hasClass('shb-qty-decrease')) {
			
			if (shb_guestclass_qty > 0) {
				var shb_new_guestclass_qty = shb_guestclass_qty - 1;
			} else {
				var shb_new_guestclass_qty = 0;
			}
			
		}
		
		if ($(this).hasClass('shb-qty-increase')) {			
			var shb_new_guestclass_qty = shb_guestclass_qty + 1;
			if(fieldType=='room_one_child'){
				if(shb_new_guestclass_qty>2 || (parseInt($('input[name="room_one_adult"]').val())+parseInt(shb_new_guestclass_qty)>4)){	
					return false;
				}
			}
			if(fieldType=='room_one_adult'){ 
				if(shb_new_guestclass_qty>3 || (parseInt($('input[name="room_one_child"]').val())+parseInt(shb_new_guestclass_qty)>4)){
					return false;
				}	
			}
		}
		if ($(this).hasClass('shb-qty-increase')) {			
			var shb_new_guestclass_qty = shb_guestclass_qty + 1;
			if(fieldType=='room_two_child'){
				if(shb_new_guestclass_qty>2 || (parseInt($('input[name="room_two_adult"]').val())+parseInt(shb_new_guestclass_qty)>4)){	
					return false;
				}
			}
			if(fieldType=='room_two_adult'){
				if(shb_new_guestclass_qty>3 || (parseInt($('input[name="room_two_child"]').val())+parseInt(shb_new_guestclass_qty)>4)){
					return false;
				}	
			}

		} 
		
		$(this).parent().parent().find('.shb-guestclass').val(shb_new_guestclass_qty);
		$(this).parent().parent().find('.shb-qty-display').html(shb_new_guestclass_qty);
		
		var shb_guestclass_total = 0;
		
		$(this).parent().parent().parent().find('.shb-guestclass').each(function(i, obj) {
			shb_guestclass_total = shb_guestclass_total + parseInt($(this).val());
		});
		
		$(this).parent().parent().parent().parent().find('.shb-guestclass-total').html(shb_guestclass_total);
		$(this).parent().parent().find('.shb-guestclass').val(shb_new_guestclass_qty);
		$(this).parent().parent().find('.shb-qty-display').html(shb_new_guestclass_qty);

		// var total = $('.shb-guestclass-total').html()
		// if ($(this).hasClass('shb-qty-decrease')) {
		// 	if(shb_new_guestclass_qty==0){
		// 		return false;
		// 	}
		// 	if (total > 0 && shb_guestclass_qty > 0) {
		// 		total--;  
		// 		$('.shb-guestclass-total').html(total);
		// 	}else{
		// 		$('.shb-guestclass-total').html(0);
		// 	}
		// }
		// if ($(this).hasClass('shb-qty-increase')) {	 
		// 	total++;   
		// 	$('.shb-guestclass-total').html(total); 
		// }

		var shb_guestclass_total = 0;
		
		// $(this).parent().parent().parent().find('.shb-guestclass').each(function(i, obj) {
		// 	shb_guestclass_total = shb_guestclass_total + parseInt($(this).val());
		// });
		
		// $(this).parent().parent().parent().parent().find('.shb-guestclass-total').html(shb_guestclass_total);
		// var shb_guestclass_total = 0;
		
		// $('.shb-guestclass').each(function(i, obj) {
		// 	console.log(parseInt($(this).val()));
		// 	shb_guestclass_total = shb_guestclass_total + parseInt($(this).val());
		// });
		// console.log(shb_guestclass_total);
		// //$('.shb-guestclass-total').html(shb_guestclass_total);
		
	});
	
	$('.shb-qty-done').click(function(){
	
		$('.shb-guestclass-select-dropdown').fadeOut(200);
	
	});
	
	// Booking form validation
	$('.shb-booking-form-button').click(function(){
		
		/*var shb_err_msg_dates = 'Please select a check in and check out date';
		var shb_err_msg_guests = 'Please select at least 1 guest';*/
		
		var shb_booking_form_error = [];
		
		if ( ($(this).parent().parent().find('.shbdp-checkin').val() == '') || $(this).parent().parent().find('.shbdp-checkout').val() == '' ) {
			alert(shb_err_msg_dates);
			shb_booking_form_error.push(true);
		}
		
		if ($(this).parent().parent().find('.shb-guestclass-total').html() == '0') {
			alert(shb_err_msg_guests);
			shb_booking_form_error.push(true);
		}
		
		if ($.inArray(true, shb_booking_form_error) !== -1) {
			return false;
		}
	
	});
	
	$('.shb-accommodation-listing-sorting select').on('change', function() {
		$(location).attr('href', this.value);
	});
	
	shb_booking_price_expand();
	shb_booking_your_stay_other_item_expand();
	
	$('.shb-lightbox-open').click(function(){
		
		var shb_accommodation_view_details = $(this).parent().parent().find('.shb-lightbox-html');
		$(shb_accommodation_view_details).clone().appendTo(document.body).addClass('shb-lightbox-wrapper').removeClass('shb-lightbox-html');
		$('.shb-lightbox-wrapper').fadeIn(300);
		$('body').css('overflow','hidden');
		$( ".shb-lightbox-content" ).wrap( '<form action="' + shb_booking_page_url + '" method="post"></form>' );
		shb_select_accommodation();
		shb_booking_price_expand();
		shb_booking_your_stay_other_item_expand();
		shb_load_wp_bakery_page_builder_js();
		
		$('.shb-lightbox-close, .shb-booking-cancel').click(function(){
			
			$('.shb-lightbox-wrapper').fadeOut(300, function() {
				$(this).remove();
			});
			
			$('body').css('overflow','scroll');
			
			shb_booking_price_expand();
			
			return false;
			
		});
		
		return false;
		
	});
	
	shb_select_accommodation();
	shb_select_additionalfee();
	
	$('.shb-booking-form-button-1').click(function(){
		
		//var shb_err_msg_dates = 'Please select a check in and check out date';
		var checkin = $(this).parent().find($('.shbdp-checkin')).val();
		var checkout = $(this).parent().find($('.shbdp-checkout')).val();
		
		if ( (checkin == '') || (checkout == '') ) {
			alert(shb_err_msg_dates);
			return false;
		}
		
	});

});

function shb_load_wp_bakery_page_builder_js() {
	
	vc_toggleBehaviour();
	vc_tabsBehaviour();
	vc_accordionBehaviour();
	vc_teaserGrid();
	vc_carouselBehaviour();
	vc_slidersBehaviour();
	vc_prettyPhoto();
	vc_pinterest();
	vc_progress_bar();
	vc_plugin_flexslider();
	vc_gridBehaviour();
	vc_rowBehaviour();
	vc_prepareHoverBox();
	vc_googleMapsPointer();
	vc_ttaActivation();
	
    jQuery('.flexslider').flexslider({
		animation: "fade",
		controlNav: false,
		slideshowSpeed: 7000,
		animationSpeed: 600,
		start: function(slider){
			jQuery('body').removeClass('loading');
		}
    });
	
}

function shb_select_additionalfee() {
	
	jQuery('.shb-select-additionalfee').click(function(){
		
		var shb_accommodation_key = jQuery(this).attr('data-accommodationkey');
		var shb_additionalfee_id = jQuery(this).attr('data-additionalfee');
		
		jQuery(this).parent().append('<input type="hidden" name="shb_accommodation_selected" value="' + shb_accommodation_key + '" />');
		jQuery(this).parent().append('<input type="hidden" name="shb_additionalfee_selected" value="' + shb_additionalfee_id + '" />');
		
	});
	
}

function shb_select_accommodation() {
	
	jQuery('.shb-booking-accommodation-select-room, .shb-booking-continue').click(function(){
		
		var shb_accommodation_id = jQuery(this).attr('data-accommodation');
		var shb_rate_id = jQuery(this).attr('data-rate');
		jQuery(this).parent().append('<input type="hidden" name="shb_accommodation_selected" value="' + shb_accommodation_id + '" />');
		jQuery(this).parent().append('<input type="hidden" name="shb_rate_selected" value="' + shb_rate_id + '" />');
		
	});
	
}

function shb_position(c) {
	
	var shb_p = jQuery(c).position();
	var shb_h = jQuery(c).outerHeight();
	var shb_t = shb_p.top;
	var shb_l = shb_p.left;
	
	var position = {};
	position['top'] = shb_t + 'px';
	position['left'] = shb_l + 'px';
	position['height'] = shb_h + 'px';
	position['vert_position'] = (shb_t + shb_h) + 'px';
	
	return position;
	
}

function shb_booking_price_expand() {
	
	jQuery('.shb-booking-price-expand').click(function(){
		jQuery(this).parent().find('.shb-booking-price-expanded').toggle();
		return false;
	});
	
}

function shb_booking_your_stay_other_item_expand() {
	
	jQuery('.shb-booking-your-stay-other-item-expand').click(function(){
		jQuery(this).parent().parent().find('.shb-booking-your-stay-other-item-expanded').toggle();
		return false;
	});
	
}