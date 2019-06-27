function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(window.location.search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

document.addEventListener('DOMContentLoaded', function() {
	var lis = document.querySelectorAll('.specimens li'),
		all = document.getElementById('all-specimens'),
		i,
		j;

	var search = document.getElementById('search');
	search.addEventListener('keyup', function(event) {
		var input = search.value;

		for (j = 0; j < lis.length; j++) {
			lis[j].style.display = 'block';
		}

		if (input && input.length > 2) {
			for (j = 0; j < lis.length; j++) {
				if (lis[j].getAttribute('data-keywords').indexOf(input) == -1) {
					lis[j].style.display = 'none';
				}
			}
		}
	});

	var type = document.getElementById('type');
	type.addEventListener('change', function(event) {
		var input = this.value;

		if (!input || input == 'all') {
			for (j = 0; j < lis.length; j++) {
				lis[j].style.display = 'block';
			}
			return;
		}

		for (j = 0; j < lis.length; j++) {
			lis[j].style.display = 'none';
		}

		for (j = 0; j < lis.length; j++) {
			if (lis[j].getAttribute('data-type').indexOf(input) > -1) {
				lis[j].style.display = 'block';
			}
		}
	});

	var t = getParameterByName('type');
	if (t) {
		type.value = t;
	}

	// Add event listener for filters
	var toggles = document.getElementsByClassName('toggle');
	for (i = 0; i < toggles.length; i++) {
		toggles[i].addEventListener('change', function(event) {
			event.preventDefault();

			var name = 'show-' + this.getAttribute('name');

			if (all.classList.contains(name)) {
				all.classList.remove(name);
			} else {
				all.classList.add(name);
			}
		});
	}

	var opts = document.querySelectorAll('.size-adjust a');
	for (i = 0; i < opts.length; i++) {
		opts[i].addEventListener('click', function (event) {
			event.preventDefault();

			for (z = 0; z < opts.length; z++) {
				if (opts[z].classList.contains('selected')) {
					opts[z].classList.remove('selected');
				}
				if (all.classList.contains(opts[z].getAttribute('data-size'))) {
					all.classList.remove(opts[z].getAttribute('data-size'));
				}
			}

			all.classList.add(this.getAttribute('data-size'));
			this.classList.add('selected');
		});
	}
});
