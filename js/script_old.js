
var ww = document.body.clientWidth;

$(document).ready(function() {
	$(".nav li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		};
	})

	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".nav").toggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	$(".toggleMenu").css("display", "inline-block");
	if (!$(".toggleMenu").hasClass("active")) {
		$(".nav").hide();
	} else {
		$(".nav").show();
	}
	$(".nav li").unbind('mouseenter mouseleave');

	$("#menuBebe a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
		e.preventDefault();
		$(this).parent("li").toggleClass("hover");
		if ($("#menuGirls").hasClass("hover")) {
			$("#menuGirls").toggleClass("hover");
		}
		if ($("#menuBoys").hasClass("hover")) {
			$("#menuBoys").toggleClass("hover");
		}
	});
	$("#menuGirls a.parent").unbind('click').bind('click', function(e) {
		// must be attached to anchor element to prevent bubbling
		e.preventDefault();

		$(this).parent("li").toggleClass("hover");
		if ($("#menuBebe").hasClass("hover")) {
			$("#menuBebe").toggleClass("hover");
		}
		if ($("#menuBoys").hasClass("hover")) {
			$("#menuBoys").toggleClass("hover");
		}
	});
	$("#menuBoys a.parent").unbind('click').bind('click', function(e) {
		// must be attached to anchor element to prevent bubbling
		e.preventDefault();
		$(this).parent("li").toggleClass("hover");
		if ($("#menuBebe").hasClass("hover")) {
			$("#menuBebe").toggleClass("hover");
		}
		if ($("#menuGirls").hasClass("hover")) {
			$("#menuGirls").toggleClass("hover");
		}
	});
}


