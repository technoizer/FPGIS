<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <!--<script src="http://js.api.here.com/se/2.5.4/jsl.js" type="text/javascript" charset="utf-8"></script>-->
    <script charset="UTF-8" src="https://js.cit.api.here.com/ee/2.5.4/jsl.js?with=all"></script> 
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=7; IE=EmulateIE9; IE=10" />
    <style type="text/css">
        html {
            overflow:hidden;
        }

        body {
            margin: 0;
            padding: 0;
            position: absolute;
            overflow:hidden;
            width: 100%;
            height: 100%;
        }

        #mapContainer {
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            position: absolute;
        }
        #panel {
            position: absolute;
            top: 1%;
            left: 10px;
            z-index: 5;
            background-color: #fff;
            padding: 15px;
            border: 1px solid #999;
        }
    </style>
</head>
<body>
    <div id="mapContainer"></div>

    <script>
        $(document).ready(function(){
            // refreshPolygon();
        });
        nokia.Settings.set("app_id", "sGRBEyHKij3A9ZGTNsB2");
        nokia.Settings.set("app_code", "7KJaKsSK-66fcpqDsqy3dQ");
        nokia.Settings.set("serviceMode", "cit");
		(document.location.protocol == "https:") && nokia.Settings.set("secureConnection", "force");

        var map = new nokia.maps.map.Display(
            document.getElementById("mapContainer"), {
                components: [
                    new nokia.maps.map.component.zoom.DoubleClick(),
                    // Needed for marker drag
                    new nokia.maps.map.component.objects.DragMarker(),
                    new nokia.maps.map.component.Behavior(),
                    new nokia.maps.map.component.ZoomBar(),
                    new nokia.maps.map.component.Overview(),
                    new nokia.maps.map.component.TypeSelector(),
                    new nokia.maps.map.component.ScaleBar(),
                    new nokia.maps.map.component.InfoBubbles()],
                zoomLevel: 15,
                center: [52.51, 13.4]
            }
        );


        var kml = new nokia.maps.kml.Manager();

		// We define a callback function for parsing kml file,
		// and then push the parsing result to map display
		var onParsed = function (kmlManager) {
			var resultSet,
				container,
				boundingBox;
			
			// KML file was successfully loaded
			if (kmlManager.state == "finished") {
				// KML file was successfully parsed
				resultSet = new nokia.maps.kml.component.KMLResultSet(kmlManager, map);
				resultSet.addObserver("state", function (resultSet) {
					if (resultSet.state == "finished") {
						boundingBox = container.getBoundingBox();
						// Here we check whether we have valid bounding box or no. 
						// In case if KML document does not contain any supported displayable element, bounding box will be a null, 
						// therefore it will not be possible to zoom to the not existing object. 
						if (boundingBox) {
							// Switch the viewport of the map to show all KML map objects within the container
							map.zoomTo(boundingBox);
						}
					}
				});
				// Add the container to the map's object collection so it will be rendered onto the map.
				map.objects.add(container = resultSet.create());
			}
		};
		// Add an observer to KML manager
		kml.addObserver("state", onParsed);

		// Trigger parsing the earthquake kml file, when the map emmits the "displayready" event
		// Note: please adapt the following path to the file you want to parse.
		map.addListener("displayready", function () {
		   kml.parseKML("<?php echo base_url()?>/assets/kml/coba.kml");
		});


        var polygons = new Array();

        function refreshPolygon(){
           $.ajax({
               url : 'map/getData',
               type : 'post',
               dataType : 'json',
               success : function(result)
               {      
                   for (var i in result['tempat']) {
                        var coor = result['tempat'][i]['koordinat'];
                        var color = result['tempat'][i]['color']+"88";
                        var coordinates = result['tempat'][i]['koordinat'].split('#');
                        var path = new Array();
                        for (var j = 0; j< coordinates.length-1; j++) {
                            var lat = parseFloat(coordinates[j].split('!')[0]);
                            var lng = parseFloat(coordinates[j].split('!')[1]);
                            var point = new nokia.maps.geo.Coordinate(lat, lng);
                            //alert(point);
                            path.push(point);
                            //console.log(lat + " " + lng);
                        };

                        draw(path, color);
                   }

               },
               error : function(res)
               {
               }
           });
         }

        function draw(coor, color){
            var geoStrip = new nokia.maps.geo.Strip(coor,'auto');
            var polygon = new nokia.maps.map.Polygon(geoStrip, {
                precision: 36,
                simplify: 16,
                pen: { strokeColor: "#000", lineWidth: 1 },
                brush: { color: color },
                width: 1
            })
            map.objects.add(polygon);
            polygons.push(polygon);
        }

        
    </script>
</body>