if (!defined(window.scrollObject)) {
	window.scrollObject = {
		upToTop: function () {
			scrollObject.scrolling = $(window).scrollTop();
			let panel = $('.scroll-bar');
			let opacity = scrollObject.scrolling / 10000;
			opacity = (opacity < 0.1) ? 0.1 : opacity;
			opacity = (opacity > 0.2) ? 0.2 : opacity;
			panel.css('background', 'rgba(74, 118, 166, ' + opacity + ')');
			if (scrollObject.scrolling > 0) {
				panel.show();
				$('#up', panel).show();
				$('#down', panel).hide();
			} else {
				if (!isset(scrollObject.backScroll)) {
					panel.hide();
				}
				$('#up', panel).hide();
				$('#down', panel).show();
			}
			return false;
		},
		upToTopClick: function () {
			let scroll_speed = 250;
			if (scrollObject.scrolling > 0) {
				scrollObject.backScroll = scrollObject.scrolling;
				$("html, body").stop().animate({scrollTop: 0}, scroll_speed, 'swing');
			} else {
				if (isset(scrollObject.backScroll)) {
					$("html, body").stop().animate({scrollTop: scrollObject.backScroll}, scroll_speed, 'swing');
				}
			}
			return false;
		},
		modifyScrollBarPanel: function () {
			let panel = $('.scroll-bar');
			let width = $(window).width();
			if (width < 1171) {
				panel.addClass('modified-bar');
				return this;
			}
			if (width > 1200 && width < 1351) {
				panel.addClass('modified-bar');
				return this;
			}
			return this;
		}
	};
	$(window).scroll(scrollObject.upToTop);
	$(document).ready(scrollObject.upToTop);
	// $(document).ready(scrollObject.modifyScrollBarPanel);
}