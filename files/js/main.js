jQuery(document).ready(function(){
	jQuery('.article_head').click(function(){
		jQuery(this).toggleClass('active');
		jQuery(this).parents('.article').find('.article_body').toggleClass('active');

		return false;
	});

	jQuery('.volume button').click(function(){
		jQuery('.volume button').removeClass('active');
		jQuery(this).addClass('active');
	});

	jQuery('.product-description_head').click(function(){
		jQuery(this).toggleClass('active');
		jQuery(this).parents('.product-description').find('.product-description_body').toggleClass('active');

		return false;
	});

	jQuery('.quantity .plus').click(function(){
		var q = jQuery(this).parents('.quantity'),
		 	input = q.find('input');
		
		if(input.val()) {
			var val = parseInt(input.val());
		} else {
			var val = 0;
		}

		input.val(val+1);
	});

	jQuery('.quantity .minus').click(function(){
		var q = jQuery(this).parents('.quantity'),
		 	input = q.find('input');
		
		if(input.val()-1 > 0) {
			var val = parseInt(input.val()-1);
		} else {
			var val = 1;
		}

		input.val(val);
	});

	jQuery(window).scroll(function(){
		var offset = jQuery('.sidebar').offset().top;
		if(jQuery(window).scrollTop()+40 >= offset) {
			jQuery('.actions').addClass('sticky');
		} else {
			jQuery('.actions').removeClass('sticky');
		}
		var offset = jQuery('.sub-header').offset().top;
		if(jQuery(window).scrollTop() >= offset) {
			jQuery('.sub-header').addClass('fixed');
			
		} else {
			jQuery('.sub-header').removeClass('fixed');

		}
	});
});

function share() {
	jQuery('.action.social').toggleClass('active');
}

function up() {
	jQuery('html, body').animate({scrollTop:0}, '300');
}

function down() {
	jQuery('html, body').animate({scrollTop:jQuery(document).height()}, '300');
}

  jQuery(function (jQuery) {
    var objToStick = jQuery(".section-right"); //Получаем нужный объект
    var topOfObjToStick = jQuery(objToStick).offset().top -40; //Получаем начальное расположение нашего блока
    jQuery(window).scroll(function () {
      var windowScroll = jQuery(window).scrollTop();
        jQuery(objToStick)[
            (jQuery(this).scrollTop() > topOfObjToStick ? "add" : "remove") + "Class"
            ]("fix");
    });
});


