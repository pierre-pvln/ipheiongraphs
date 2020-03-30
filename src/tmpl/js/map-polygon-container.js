(function () {
	  var map;
        map = new mapboxgl.Map({
            container: "map-polygon",
            style: "mapbox://styles/mapbox/streets-v11",
            center: [window.longitude, window.latitude],
            zoom: 14,
        }),
		
        map.on("load", function () {
			map.addSource('polygon', {
				type: 'geojson',
				data: polygon_data_url
			});
			map.addLayer({
				'id': 'polygon',
				'type': 'fill',
				'source': 'polygon',
				'layout': {},
				'paint': {'fill-color': '#088',  'fill-opacity': 0.8}
				});
        })
		
}).call(this);

