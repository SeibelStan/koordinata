function dDigs(dig) {
	return dig < 10 ? '0' + dig : dig;
}

function rusDate(date, short, tag) {
	if(tag) {
		date = date.split(' ');
		date = date[0] + ' <' + tag + '>' + date[1] + '</' + tag + '>';
	}
	if(short) {
		return date
			.replace(/Dec/, 'Дек').replace(/Jan/, 'Янв').replace(/Feb/, 'Фев')
			.replace(/Mar/, 'Мар').replace(/Apr/, 'Апр').replace(/May/, 'Май')
			.replace(/Jun/, 'Июн').replace(/Jul/, 'Июл').replace(/Aug/, 'Авг')
			.replace(/Sen/, 'Сен').replace(/Okt/, 'Окт').replace(/Nov/, 'Ноя');
	}
	else {
		return date
			.replace(/Dec/, 'Декабря').replace(/Jan/, 'Января').replace(/Feb/, 'Февраля')
			.replace(/Mar/, 'Марта').replace(/Apr/, 'Апреля').replace(/May/, 'Мая')
			.replace(/Jun/, 'Июня').replace(/Jul/, 'Июля').replace(/Aug/, 'Августа')
			.replace(/Sen/, 'Сентября').replace(/Okt/, 'Октября').replace(/Nov/, 'Ноября');
	}
}

function checkReason(el) {
	return el.parent().parent().find('[name="reason"]').val();
}

function checkSubscribe() {
	$('.subscribe').each(function() {
		var self = $(this);
		$.ajax({
			method: 'POST',
			url: baseUrl + 'adds/checksubscribe',
			data: {
				"id": self.attr('data-id'),
				"type": self.attr('data-type')
			},
			success: function (data) {
				if(data == 1) {
					self.addClass('unsubscribe');
					self.removeClass('subscribe');
					btnTextDeactivate(self);
					$('.add-comments').show();
				}
			}
		});
	});
}

function btnTextActivate(el) {
	el.html(
		el.html()
			.replace(/Не пойду/i, 'Пойду')
			.replace(/Не интересно/i, 'Интересно')
	);
	console.log(el.html());
}
function btnTextDeactivate(el) {
	el.html(
		el.html()
			.replace(/Пойду/i, 'Не пойду')
			.replace(/Интересно/i, 'Не интересно')
	);
}

$(function () {

	baseUrl = $('#base-url').html();
	search = $('#main-search');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('[name="password"]').keyup(function () {
		$('[name="password_confirmation"]').val(
			$(this).val()
		);
	});

	search.keyup(function () {
		getAdds('#main-adds');
	});

	if($('#user-id').html()) {
		checkSubscribe();
	}

	var emailInput = $('#regpanel').find('[name=email]');
	emailInput.blur(function () {
		if(emailInput.val()) {
			$.ajax({
				method: 'POST',
				url: baseUrl + 'user/used',
				data: {
					"email": emailInput.val()
				},
				success: function (data) {
					if(data) {
						alert(data);
					}
				}
			});
		}
	});

	$('.navbar-tab').click(function () {
		var tid = $(this).attr('data-toggle');
		$(this).parent().find('.navbar-tab').removeClass('active');
		$(this).addClass('active');

		$(this).parent().parent().find('.panel').removeClass('active');
		$('#' + tid).addClass('active');
	});

	if($('#session-message').html().trim()) {
		alert($('#session-message').html());
	}

	function buildAdds(data, cont) {
		var obj = $(cont);
		obj.html('');
		for(var i in data) {
			var content =
				'<div class="card rolled" title="' + data[i].title + '">\
					<a href="' + baseUrl + 'adds/single/' + data[i].id + '">\
						<div class="card-image" style="background-image: url(' + data[i].image + ')"></div>\
					</a>\
					<div class="card-content">\
						<div class="card-info info-badges">' +
						(
							(data[i].age > 0 ? '<div class="info-age">' + data[i].age + '+</div>' : '') +
							(data[i].gender == 1 ? '<div class="info-gender male">для мужчин</div>' : '') +
							(data[i].gender == 2 ? '<div class="info-gender female">для женщин</div>' : '') +
							(data[i].ability == 1 ? '<div class="info-ability enabled">без огр. возм.</div>' : '') +
							(data[i].ability == 2 ? '<div class="info-ability disabled">для огр. возм.</div>' : '')
						) +
						'</div>\
						<h2 class="title card-title">\
							<a href="' + baseUrl + 'adds/single/' + data[i].id + '">' + data[i].title + '</a>\
						</h2>\
						<div class="card-caption caption">' + data[i].short + '</div>\
						<div class="info-start flex-m-col">\
							<span class="elapsed" data-time="' + data[i].date_start_canonic + '"></span>\
							<span class="date-rus">до начала ' + rusDate(data[i].date_start, false) + '</span>\
						</div>\
						<div class="add-price">\
							<span class="info-price">' + (data[i].price > 0 ? data[i].price + 'тг' : 'бесплатно') + '</span>' +
							(data[i].places > 0 ? '<span class="info-places">, ' + data[i].places + ' мест</span>' : '') +
						'</div>' +
						'<div class="card-actions">\
							<button class="btn btn-primary subscribe" data-type="meet" data-id="' + data[i].id + '">Пойду</button>\
							<button class="btn subscribe" data-type="subscribe" data-id="' + data[i].id + '">Интересно</button>\
						</div>\
					</div>\
				</div>';

			obj.append(content);
		}
	}

	function getAdds(cont) {
		$.post(
			baseUrl + 'adds/get',
			{
				"search": search.val(),
				"dates": search.attr('data-dates'),
				"selects": {
					"location": $('#select-location').val(),
					"category": $('#select-category').val()
				},
				"filters": {
					"location": $('#filter-location').find('.active').attr('data-value'),
					"payment": $('#filter-payment').find('.active').attr('data-value'),
					"gender": $('#filter-gender').find('.active').attr('data-value'),
					"age": $('#filter-age').find('.active').attr('data-value'),
					"ability": $('#filter-ability').find('.active').attr('data-value')
				}
			},
			function (data) {
				buildAdds(JSON.parse(data), cont);
				if($('#user-id').html()) {
					checkSubscribe();
				}
			}
		);
	}

	$('#main-adds').each(function () {
		getAdds('#' + $(this).attr('id'));
	});

	$('.search-filter').click(function () {
		if($(this).parent().hasClass('only-one')) {
			$(this).parent().find('.search-filter').removeClass('active');
		}
		$(this).toggleClass('active');

		if($(this).hasClass('all')) {
			$(this).css('opacity', 0);
		}
		else {
			$(this).parent().find('.all').css('opacity', 1);
		}

		getAdds('#main-adds');
	});

	$('#searchpanel-cont').find('.select').change(function () {
		getAdds('#main-adds');
	});

	function buildCalendar(data, cont) {
		var obj = $(cont);
		obj.html('');
		for(var i in data) {
			var content =
				'<div class="calendar-cell" data-value="' + data[i].date + '" title="' +
					rusDate(data[i].date_text, false, '') +
					(data[i].adds ? ', ' + data[i].adds + ' мероприятий" data-value="' : '') +
				'">\
					<div class="calendar-date ' +
						(data[i].next_month ? 'next' : '') +
						(data[i].adds ? 'evented' : '') +
					'">' + data[i].date_dig + '</div>' +
				'</div>';
			obj.append(content);
		}
	}

	function getCalendar(date, cont) {
		$.post(
			baseUrl + 'home/getCalendar?date=' + date,
			{},
			function (data) {
				buildCalendar(JSON.parse(data), cont);
			}
		);
	}

	$('#main-calendar').each(function () {
		getCalendar('', '#' + $(this).attr('id'));
	});

	$(document).on('click', '.calendar-cell', function () {
		if($(this).hasClass('active')) {
			var reg = new RegExp($(this).attr('data-value'), 'i');
			search.attr(
				'data-dates',
				search.attr('data-dates').replace(reg, '').trim()
			);
		}
		else {
			search.attr(
				'data-dates',
				(search.attr('data-dates') + ' ' + $(this).attr('data-value')).trim()
			);
		}
		$(this).toggleClass('active');
		getAdds('#main-adds');
	});

	setInterval(function () {
		var now = new Date();
		$('.elapsed').each(function () {
			var splitTime = $(this).attr('data-time').split(' ');
			var cellDate = new Date(splitTime[0], splitTime[1]-1, splitTime[2], splitTime[3], splitTime[4]);
			var elapsed = Math.round((cellDate.getTime() - now.getTime()) / 1000);

			var eD = Math.floor(elapsed / 86400);
			var eS = elapsed - eD * 86400;
			var eH = Math.floor(eS / 3600);
			eS = eS - eH * 3600;
			var eM = Math.floor(eS / 60);
			eS = eS - eM * 60;

			$(this).html((eD ? '<i>' + eD + ' д.</i> ' : '') + '<i>' + dDigs(eH) + '</i> <i>' + dDigs(eM) + '</i> <i>' + dDigs(eS) + '</i>');
		});
	}, 1000);

	$('.date-rus').each(function () {
		$(this).html(
			rusDate($(this).html(), true)
		);
	});

	$('.email-insert').click(function () {
		$('.email-target').val(
			$('.email-target').val() + ' ' + $(this).html().trim()
		);
	});

	$('.task-reason').keyup(function () {
		$(this).parent().parent().find('[name="reason"]').val($(this).val());
	});

	$('#get-expert')
		.removeProp('checked')
		.change(function () {
			$('#staff-expert').toggle();
		});

	$('#staff-content').keyup(function () {
		if(location.href.match(/\?json/)) {
			try {
				var data = JSON.parse($(this).val());
				$(this).removeClass('invalid');
				$('#staff-save').removeClass('invalid');
			}
			catch (err) {
				$(this).addClass('invalid');
				$('#staff-save').addClass('invalid');
			}
		}
	});

	$('.comment-go-reply').click(function () {
		$(this).parent().append($('#comment-form'));
		$('#comment-form').find('#reply_id').val($(this).parent().parent().attr('data-id'));
	});

	$('.comment-go-remove').click(function () {
		var comment = $(this).parent();

		$.ajax({
			method: 'POST',
			url: baseUrl + 'comment/remove',
			data: {
				"id": comment.attr('data-id')
			},
			success: function () {
				comment.parent().remove();
			}
		});
	});

	$(document).on('click', '.subscribe', function () {
		if(!$('#user-id').html()) {
			alert('Войдите или зарегистрируйтесь');
			return 0;
		}
		var self = $(this);
		$.ajax({
			method: 'POST',
			url: baseUrl + 'adds/subscribe',
			data: {
				"id": self.attr('data-id'),
				"type": self.attr('data-type')
			},
			success: function () {
				self.addClass('unsubscribe');
				self.removeClass('subscribe');
				btnTextDeactivate(self);
				$('.add-comments').show();
			}
		});
	});

	$(document).on('click', '.unsubscribe', function () {
		var self = $(this);
		$.ajax({
			method: 'POST',
			url: baseUrl + 'adds/unsubscribe',
			data: {
				"id": self.attr('data-id'),
				"type": self.attr('data-type')
			},
			success: function () {
				self.addClass('subscribe');
				self.removeClass('unsubscribe');
				btnTextActivate(self);
				$('.add-comments').hide();
			}
		});
	});

	$('.subscribers').each(function () {
		var self = $(this);
		$.ajax({
			method: 'POST',
			url: baseUrl + 'adds/getSubscribers',
			data: {
				"id": self.attr('data-id'),
				"type": self.attr('data-type')
			},
			success: function (data) {
				data = JSON.parse(data);
				for(var i in data) {
					self.append(
						'<p><a href="' + baseUrl + 'user/' + data[i].id + '">' + data[i].name + '</a>' +
							' <a class="subscriber-remove" data-id="' + data[i].id + '">&times</a>'
					);
				}
				if(self.html()) {
					self.parent().find('.subheading').show();
				}
			}
		});
	});

	$(document).on('click', '.subscriber-remove', function () {
		var self = $(this);
		$.ajax({
			method: 'POST',
			url: baseUrl + 'adds/removeSubscriber',
			data: {
				"id": self.attr('data-id')
			},
			success: function () {
				self.parent().remove();
			}
		});
	});

	$('#change-photo').click(function () {
		$('#profile-photo-inp').click();
	});

	$('#profile-photo-inp').change(function () {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#change-photo').css(
				'background-image',
				'url(' + e.target.result + ')'
			);
		};

		reader.readAsDataURL(this.files[0]);
	});

});