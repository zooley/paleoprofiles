function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(window.location.search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

jQuery(document).ready(function($) {
	var lis = $(".specimens li"),
		typer = $('#type');

	$('#search').on("keyup", function() {
		var input = $(this).val();

		lis.show();

		if (input && input.length > 2) {
			lis.not('[data-keywords*="'+ input +'"]').hide();
		}
	});

	$('.toggle').on("change", function() {
		console.log('toggle');
		$('#all-specimens').toggleClass('show-' + $(this).attr('name'));
	});

	typer.on("change", function() {
		var input = $(this).val();

		lis.hide();

		if (!input || input == 'all') {
			lis.show();
			return;
		}

		lis.filter('[data-type*="'+ input +'"]').show();
	});

	var type = getParameterByName('type');
	if (type) {
		typer.val(type);
	}

	var opts = $('.size-adjust a');

	opts.on('click', function (e) {
		e.preventDefault();

		var opt = $(this);
		//var container = $('#all-icons');
		var container = $('#' + opt.parent().attr('data-container'));

		$('.specimens').fadeOut(200, function(){
			opts.each(function (i, el) {
				container.removeClass($(el).attr('data-size'));
				$(el).removeClass('selected');
			});

			container.addClass(opt.attr('data-size'));
			$('.specimens').fadeIn();

			opt.addClass('selected');
		});
	});
});
