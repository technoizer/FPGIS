<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
        <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
        <script src="http://js.api.here.com/v3/3.0/mapsjs-ui.js"  type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="http://js.api.here.com/v3/3.0/mapsjs-ui.css" />
        <script src="http://js.api.here.com/v3/3.0/mapsjs-pano.js" type="text/javascript" charset="utf-8"></script> 
        <script src="http://js.api.here.com/v3/3.0/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>

        <style>
            html, body, #mapContainer {
                height: 100%;
                margin: 0px;
                padding: 0px;
            }
            #panel {
                position: absolute;
                top: 1%;
                left: 90%;
                z-index: 5;
                background-color: #fff;
                padding: 15px;
                border: 1px solid #999;
            }
        </style>
    </head>
    <body>
         <div id="panel">
          <center><b>TOOLS</b></center>
            <hr>
            <button onclick="draw()" style="position:fixed z-index:10">Draw Polygon</button>
        </div>
        <div style="width: 100%; height: 100%" id="mapContainer"></div>
        




        <script>
        // Initialize the platform object:
            var platform = new H.service.Platform({
                'app_id': 'sGRBEyHKij3A9ZGTNsB2',
                'app_code': '7KJaKsSK-66fcpqDsqy3dQ'
            });

            // Obtain the default map types from the platform object
            var maptypes = platform.createDefaultLayers();

            // Instantiate (and display) a map object:
            var map = new H.Map(
                document.getElementById('mapContainer'),
                maptypes.terrain.map,
                {
                zoom: 10,
                center: { lng: 13.4, lat: 52.51 },
                fixedCenter: false
            });
            var mapEvents = new H.mapevents.MapEvents(map);
            var behavior = new H.mapevents.Behavior(mapEvents);

            var ui = H.ui.UI.createDefault(map, maptypes);
            var zoom = ui.getControl('zoom');
            var scalebar = ui.getControl('scalebar');
            var panorama = ui.getControl('panorama');
            var mapSettings = ui.getControl('mapsettings');

            panorama.setAlignment('top-left');
            mapSettings.setAlignment('top-left');
            zoom.setAlignment('top-left');
            scalebar.setAlignment('top-left');

            var icon = new H.map.Icon(
                "<?php echo base_url();?>assets/marker.png",
                {
                size: { w:40, h:40}
            });
            var markers = new Array();
            var coordinates = new Array();
            map.addEventListener('tap', function(evt) {
                var lat = map.screenToGeo(evt.currentPointer.viewportX,evt.currentPointer.viewportY).lat
                var lng = map.screenToGeo(evt.currentPointer.viewportX,evt.currentPointer.viewportY).lng
                var coords = {lat: lat, lng: lng};
                var marker = new H.map.Marker(coords, {icon: icon});
                markers.push(marker);
                coordinates.push(coords);
                map.addObject(marker);
            });

            function draw(){
                var strip = new H.geo.Strip();
                for (x in coordinates){
                    //map.addObject(markers[x]);
                    strip.pushPoint(coordinates[x]);
                }
                var polygon = new H.map.Polygon(strip, { style: { lineWidth: 10 }});
                // Add the polyline to the map:
                map.addObject(polygon);
            }

        </script>
    </body>
</html>