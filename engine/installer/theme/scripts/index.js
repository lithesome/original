if (!defined(window.indexObject)) {
	window.indexObject = {
		languages: [],
		lang: function (controller, key, arguments) {
			if (indexObject.languages.length === 0) {
				indexObject.languages = JSON.parse(htmlspecialchars_decode($('.widget.widget-languages.languages-data').html()));
			}
			let lang_res = isset(indexObject.languages[controller][key]) ? indexObject.languages[controller][key] : '';
			if (lang_res && arguments) {
				lang_res = str_replace(array_keys(arguments), array_values(arguments), lang_res);
			}
			return lang_res;
		},
		renderDate: function(){
			let selector = $('.date-timestamp');
			$.each(selector, function(i, v){
				let timestamp = $(this).attr('data-time');
				let resultTime = timestamp ? indexObject.renderTimestamp(timestamp) : indexObject.lang('Home','render.date_never');
				$(this).html(resultTime);
			});
		},
		renderTimestamp: function(timestamp){
			timestamp = parseInt(timestamp) * 1000;
			let date = new Date(timestamp);
			return indexObject.getDate(
				date.getDate(),
				date.getMonth(),
				date.getFullYear(),
				date.getHours(),
				date.getMinutes(),
				date.getSeconds(),
			);
		},
		getDate: function(day, month, year, hours, minutes, seconds){
			let date = new Date();
			let time = {"%date%": indexObject.formatTime(hours) + ':' + indexObject.formatTime(minutes)/* + ':' + indexObject.formatTime(seconds)*/};
			if(equal(year, date.getFullYear())){
				if(equal(month, date.getMonth())){
					if(equal(day, date.getDate())){
						if(equal(hours, date.getHours())){
							if(equal(minutes, date.getMinutes())){
								if(equal(seconds, date.getSeconds())){
									return indexObject.lang('Home','render.date_now');
								}
								if(seconds > date.getSeconds()){
									return indexObject.lang('Home','render.date_seconds_after', {"%time%": seconds-date.getSeconds()});
								}else{
									return indexObject.lang('Home','render.date_seconds_ago', {"%time%": date.getSeconds()-seconds});
								}
							}
							if(minutes > date.getMinutes()){
								return indexObject.lang('Home','render.date_minutes_after', {"%time%": minutes-date.getMinutes()});
							}else{
								return indexObject.lang('Home','render.date_minutes_ago', {"%time%": date.getMinutes()-minutes});
							}
						}
						return indexObject.lang('Home','render.date_today', time);
					}
					if(equal(day, date.getDate()-1)){
						return indexObject.lang('Home','render.date_yesterday', time);
					}
					if(equal(day+1, date.getDate())){
						return indexObject.lang('Home','render.date_tomorrow', time);
					}
				}
				month = indexObject.formatMonth(month,'uc','long');
				return day + ' ' + month + ', ' + indexObject.lang('Home','render.uc_in', time);
			}
			month = indexObject.formatMonth(month,'uc','long');
			return day + ' ' + month + ' ' + year + ', ' + indexObject.lang('Home','render.uc_in', time);
		},
		formatTime: function(number){
			return (number < 10) ? "0" + number : number;
		},
		formatMonth: function(month, word_case = 'uc', format = 'short'){
			month = month+1;
			return indexObject.lang('Home','render.date_month_' + word_case + '_' + format + '_' + month);
		},
		loadMore: function (self, selector) {
			event.preventDefault();

			let onclick = $(self).attr('onclick');
			$(self).removeAttr('onclick');
			let parent = $(self).closest('.load-more');

			$(self).hide();
			$(parent).append(
				'<div class="progress loader-bar">\n' +
				'<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>\n' +
				'</div>'
			);

			let link = $(self).attr('href');
			let selectorObject = $(selector);
			let offsetVal = $(self).attr('data-offset');
			let limitVal = $(self).attr('data-limit');
			let totalVal = $(self).attr('data-total');
			let offset = parseInt(offsetVal);
			let limit = parseInt(limitVal);
			let total = parseInt(totalVal);

			offset = offset + limit;

			if (offset >= total) {
				return false;
			}

			$.ajax({
				url: link,
				method: 'GET',
				dataType: 'frame',
				complete: function (response) {
					response = response.responseText;
					let html = $(selector, response).html();
					selectorObject.append(html);
					$(self).attr('data-offset', offset);
					if (offset + limit >= total) {
						$(self).remove();
					}
					$('.loader-bar', parent).remove();
					$(self).show();
					$(self).attr('onclick', onclick);
					$(self).attr('href', $('.load-more a', response).attr('href'));
				}
			});
		},
		getNewCaptcha: function (self, link) {
			let action = $(self).attr('onclick');
			$(self).attr('onclick', '');
			$(self).css('cursor', 'default')
				.css('opacity', 0.15);

			$(self).parent().prepend('<div class="progress" style="width: 80%;left:10%;right:10%;margin: auto;position: absolute;top: 50%;height: 5px;">\n' +
				'  <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>\n' +
				'</div>');

			$.ajax({
				url: link,
				method: 'GET',
				dataType: 'JSON',
				complete: function (response) {
					response = response.responseJSON;
					$(self).attr('src', response.content.captcha);
					$(self).attr('onclick', action);
					$(self).css('cursor', 'pointer')
						.css('opacity', 1);
					$('.progress', $(self).parent()).remove();
				}
			});
		},
	};

	$.ajaxSetup({
		accepts: {
			frame: 'application/frame',
		},
		converters: {
			'application frame': function (result) {
				return result;
			},
		},
	});
	
	$(document).ready(indexObject.renderDate);
	$(document).ajaxComplete(indexObject.renderDate);
	setInterval(indexObject.renderDate, 60000);
}
