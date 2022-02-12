<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Variable label placement</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
<style>
body { margin: 0; padding: 0; }
#map { position: relative; height:700px ; border-radius: 0px; width: 100%; padding-top: 100px; border: 1px solid black; }
</style>
</head>
<body>
    <div class="container p-5">
        <div id="map"></div>
    </div>
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiaXp6YXRoYWphciIsImEiOiJja3ppa2l1NWM0Y3J2MnZwaGZpeWdmZWxuIn0.bFgN9Dg77Y-NDN8Kh7bL5Q';
    const map = new mapboxgl.Map({
        container: 'map',

        style: 'mapbox://styles/mapbox/light-v9',
        center: [20, 20],
        zoom: 0
    });

    const coordinates = @json($coordinate);
    console.log(coordinates)
    // const latitude = @json($latitude);
    // const longitude = 

    // console.log(latitude);

    // This GeoJSON contains features that include an "icon"
    // property. The value of the "icon" property corresponds
    // to an image in the Mapbox Light style's sprite.

    const data = [];

    for (let i = 0; i < coordinates.length; i++) {
        
        console.log(coordinates[i])
        var latitude = coordinates[i]['latitude'];
        var longitude = coordinates[i]['longitude'];
        var timezone_id = coordinates[i]['timezone_id'];

        data[i] = {
                'type': 'Feature',
                'properties': {
                    'description': timezone_id,
                    'icon': 'theatre-15'
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [latitude, longitude]
                }
            };
    }
    console.log(data)

    const places = {
        'type': 'FeatureCollection',
        'features': data
    };

    map.on('load', () => {
        // Add a GeoJSON source containing place coordinates and information.
        map.addSource('places', {
            'type': 'geojson',
            'data': places
        });

        map.addLayer({
            'id': 'poi-labels',
            'type': 'symbol',
            'source': 'places',
            'layout': {
                'text-field': ['get', 'description'],
                'text-variable-anchor': ['top', 'bottom', 'left', 'right'],
                'text-radial-offset': 0.5,
                'text-justify': 'auto',
                'icon-image': ['get', 'icon']
            }
        });

        map.rotateTo(180, { duration: 10000 });
    });
</script>

</body>
</html>