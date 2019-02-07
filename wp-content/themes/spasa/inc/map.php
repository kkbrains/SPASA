<?php if(get_field('map_address')): ?>
	<div class="map" id="map"></div>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhu-PxxANXaTOoGml4LrDNWjQvTqZfkm4"></script>
	<script type="text/javascript">
	jQuery(document).ready(
		function() {
			var geocoder = new google.maps.Geocoder();
			var location = document.getElementById('map');
			geocoder.geocode(
				{'address': '<?php the_field('map_address'); ?>'}, 
				function (results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						var lat = results[0].geometry.location.lat();
						var lng = results[0].geometry.location.lng();
						var mapOptions = {
							zoom: 13,
							backgroundColor: '#eee',
							center: new google.maps.LatLng(lat, lng),
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							disableDefaultUI: false,
							mapTypeControl: false,
							scaleControl: true,
							zoomControl: true,
							draggable: false,
							scrollwheel: true
						};
						var map = new google.maps.Map(location, mapOptions);
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(lat, lng),
							map: map,
							animation: google.maps.Animation.BOUNCE, 
							clickable: false,
						});
						var resizeTimer;
						var center;
						function calculatecenter() {
							center = map.getCenter();
						}
						google.maps.event.addDomListener(map, 'idle', 
							function() {
								calculatecenter();
							}
						);
						jQuery(window).on('resize', 
							function(e) {
								clearTimeout(resizeTimer);
								resizeTimer = setTimeout(
									function() {
										map.setCenter(center);
									}, 
								250);
							}
						);
					}
				}
			);
		}
	);
	</script>
<?php endif; ?>

