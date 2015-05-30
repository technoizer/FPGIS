<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="http://js.api.here.com/se/2.5.4/jsl.js" type="text/javascript" charset="utf-8"></script>
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
            refreshPolygon();
        });
        nokia.Settings.set("app_id", "sGRBEyHKij3A9ZGTNsB2");
        nokia.Settings.set("app_code", "7KJaKsSK-66fcpqDsqy3dQ");

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