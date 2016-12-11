$(function() {
	var $addresses = $('.contact-wrapper[data-lat]'),
		$map = $('.contact-map');

	if ($addresses.length == 0)
		return;

	var addresses = [];
	$addresses.each(function() {
		var $this = $(this),
			v = [parseFloat($this.data('lat')), parseFloat($this.data('lng'))];
		addresses.push(v);
		$this.data('pos', v);
	});

	$map.removeClass('hidden');	

	ymaps.ready(function() {
		var map = new ymaps.Map($map[0], {
			'center': addresses[0],
			'zoom': 16,
			'controls': ['zoomControl']
		});

		$.each(addresses, function(i, v) {
			var placemark = new ymaps.Placemark(v, {});
			map.geoObjects.add(placemark);		
		});

		$('.contact-address').on('click', function(e) {
			e.preventDefault();
			map.panTo($(this).closest('.contact-wrapper').data('pos'));
		});

	});
});



