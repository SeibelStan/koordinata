
function getRates() {
	$('[data-newrating]').each(function () {
		_self = $(this);
		var id = _self.attr('data-newrating');
		$.post(
			baseUrl + 'news/rate/' + id,
			{},
			function (data) {
				data = JSON.parse(data);
				$('[data-newrating="' + id + '"]').html(data.rating);
				$('[data-newraters="' + id + '"]').find('span').html(data.raters);
			}
		);
	});
}

getRates();

$('.news-vote')
	.click(function () {
		var id = $(this).attr('data-id');
		var variant = $(this).attr('data-var');

		$.ajax({
			method: 'POST',
			url: baseUrl + 'news/vote',
			data: {
				"id": id,
				"variant": variant
			},
			success: function (data) {
				if(data == 'ok') {
					getRates();
				}
				else {
					alert(data);
				}
			}
		});
	})
	.hover(function () {
		var id = $(this).attr('data-var');
		$('.news-vote')
			.removeClass('hover')
			.each(function () {
				if($(this).attr('data-var') <= id) {
					$(this).addClass('hover');
				}
			});
	});

$('.pin-remove').click(function () {
	var row = $(this).parent().parent().parent().parent();
	var id = $(this).attr('data-id');
	$.ajax({
		method: 'POST',
		url: baseUrl + 'pins/remove',
		data: {
			"id": id
		},
		success: function (data) {
			row.remove();
		}
	});
});

$('#adm-list-change').change(function () {
	$('#adm-list-link').attr('href', baseUrl + 'images/list?cat=' + $(this).val());
});

$('.get-reg').click(function () {
	$('#regpanel-toggle').click();
	$('body, html').animate({
		scrollTop: 0
	}, 300);

});

$('.get-login').click(function () {
	$('#logpanel-toggle').click();
	$('body, html').animate({
		scrollTop: 0
	}, 300);

});

$('input[name="capt"]').attr('pattern', capt);
$('input[name="cont"]')
	.val(capt)
	.attr('name', 'capt-cont');
$('.capt-code').html(capt);

$('.nav-pill-title').click(function () {
	if($(this).parent().find('.nav-pill-link').length) {
		$(this).parent().toggleClass('active');
	}
});

$(document).mouseup(function (e) {
	//checkHide(e, '#logpanel.active');
});

function checkHide(event, selector) {
	if($(selector).has(event.target).length === 0) {
		$(selector).removeClass('active');
	}
}