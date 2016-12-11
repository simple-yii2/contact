function initContactAddressMap()
{
	var $addresses = $('.contact-wrapper[data-lat]'),
		$map = $('.contact-map');

	if ($addresses.length == 0)
		return;

	var addresses = [];
	$addresses.each(function() {
		var $this = $(this),
			v = {
				'lat': parseFloat($this.data('lat')),
				'lng': parseFloat($this.data('lng'))
			};
		addresses.push(v);
		$this.data('latLng', v);
	});

	$map.removeClass('hidden');

	var map = new google.maps.Map($map[0], {
		'center': addresses[0],
		'zoom': 16
	});

	$.each(addresses, function(i, v) {
		new google.maps.Marker({
			'position': v,
			'map': map
		});
	});

	$('.contact-address').on('click', function(e) {
		e.preventDefault();
		map.panTo($(this).closest('.contact-wrapper').data('latLng'));
	});

}
