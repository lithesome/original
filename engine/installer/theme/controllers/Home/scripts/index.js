if (!defined(window.HomeObject)) {
	window.HomeObject = {
		copyQueryToClipBoard: function (incoming) {
			let div = $(incoming).parent();
			let li = div.parent();

			let copyText = $('.query-block>.query>pre', li).text();
			let textarea = $("<textarea>", li);
			$(li).append(textarea);
			textarea.val(copyText).select();
			document.execCommand("copy");
			textarea.remove();
			$(li).fadeOut(500).fadeIn(500, function () {
				$('.clipper .success').remove();
				$(div).prepend('<div class="success"><i class="fa fa-check text-success" aria-hidden="true"></i></div>');
			});
		},
		showSidebar: function () {
			let sidebar = $('.sidebar-panel');
			sidebar.removeClass('d-none');
			sidebar.addClass('d-block');
			sidebar.addClass('fixed');
			sidebar.css('left', '-400px').animate({left: '0'}, 500, function () {
			});
			sidebar.prepend("<div class='col-12'>" +
				"<a href=\"javascript:HomeObject.hideSidebar()\" class='side-bar-hider row'>" +
				"<div class=\"text col-10\">" + indexObject.lang('Home', 'button.close_sidebar_panel') + "</div>" +
				"<i class=\"fas fa-angle-double-left col-2\"></i>" +
				"</a>" +
				"</div>");
			$('body')
				.append('<div class="sidebar-fon" onclick="HomeObject.hideSidebar()"></div>')
				.css('overflow-y', 'hidden');
			$('.sidebar', sidebar).append('<div class="empty-widget-position p-4"></div>');
		},
		hideSidebar: function () {
			let sidebar = $('.sidebar-panel');
			sidebar.addClass('d-none');
			sidebar.removeClass('d-block');
			sidebar.removeClass('fixed');
			$('.sidebar-fon').remove();
			let logo = $('.sidebar-panel .logo');
			$('body').css('overflow-y', 'auto');
			logo.remove();
			$('.side-bar-hider').parent().remove();
			$('.empty-widget-position', sidebar).remove();
		},
	};

	$(window).resize(function () {
		HomeObject.hideSidebar();
	});
}
