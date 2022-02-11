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
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<body>
<div id="map"></div>

<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiaXp6YXRoYWphciIsImEiOiJja3ppa2l1NWM0Y3J2MnZwaGZpeWdmZWxuIn0.bFgN9Dg77Y-NDN8Kh7bL5Q';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v9',
        center: [-77.04, 38.907],
        zoom: 11.15
    });

    // This GeoJSON contains features that include an "icon"
    // property. The value of the "icon" property corresponds
    // to an image in the Mapbox Light style's sprite.
    const places = {
        'type': 'FeatureCollection',
        'features': [
            {
                'type': 'Feature',
                'properties': {
                    'description': "Ford's Theater",
                    'icon': 'theatre-15'
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [-77.038659, 38.931567]
                }
            },
            {
                'type': 'Feature',
                'properties': {
                    'description': 'The Gaslight',
                    'icon': 'theatre-15'
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [-77.003168, 38.894651]
                }
            },
            {
                'type': 'Feature',
                'properties': {
                    'description': "Horrible Harry's",
                    'icon': 'bar-15'
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [-77.090372, 38.881189]
                }
            },
            {
                'type': 'Feature',
                'properties': {
                    'description': 'Bike Party',
                    'icon': 'bicycle-15'
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [-77.052477, 38.943951]
                }
            },
            {
                'type': 'Feature',
                'properties': {
                    'description': 'Rockabilly Rockstars',
                    'icon': 'music-15'
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [-77.031706, 38.914581]
                }
            },
            {
                'type': 'Feature',
                'properties': {
                    'description': 'District Drum Tribe',
                    'icon': 'music-15'
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [-77.020945, 38.878241]
                }
            },
            {
                'type': 'Feature',
                'properties': {
                    'description': 'Motown Memories',
                    'icon': 'music-15'
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [-77.007481, 38.876516]
                }
            }
        ]
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