<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-ui.js"  type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="http://js.api.here.com/v3/3.0/mapsjs-ui.css" />
    <script src="http://js.api.here.com/v3/3.0/mapsjs-pano.js" type="text/javascript" charset="utf-8"></script> 
    <script src="http://js.api.here.com/v3/3.0/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
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
        .bubble {
            padding: 5px;
        }
        .bubble .text {
            font-size: 10pt;
        }
    </style>
</head>
<body>
    <div id="mapContainer"></div>

    <script>
        $(document).ready(function(){
            refreshPolygon();
        });
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

        var polygons = new Array();

        function refreshPolygon(){
           $.ajax({
               url : '<?php echo base_url();?>map/getData',
               type : 'post',
               dataType : 'json',
               success : function(result)
               {      
                   for (var i in result['tempat']) {
                        var coor = result['tempat'][i]['koordinat'];
                        var contributor = result['tempat'][i]['nama_lengkap'];
                        var kategori = result['tempat'][i]['kategori'];
                        var deskripsi = result['tempat'][i]['deskripsi_tempat'];
                        var color = result['tempat'][i]['color'];
                        var name = result['tempat'][i]['nama_tempat'];
                        var id = result['tempat'][i]['id_tempat'];
                        var coordinates = result['tempat'][i]['koordinat'].split('#');
                        var path = new H.geo.Strip();
                        for (var j = 0; j< coordinates.length-1; j++) {
                            var lat = parseFloat(coordinates[j].split('!')[0]);
                            var lng = parseFloat(coordinates[j].split('!')[1]);
                            var point = new H.geo.Point(lat, lng);
                            //alert(point);
                            path.pushPoint(point);
                            //console.log(lat + " " + lng);
                        };

                        draw(path, color, name, kategori, deskripsi, contributor,id);
                   }

               },
               error : function(res)
               {
               }
           });
         }

        function hexToRgb(hex) {
            var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }

        function draw(coor, color, name, kategori, deskripsi, contributor,id_tempat){
            var warna = "rgba("+hexToRgb(color).r+","+hexToRgb(color).g+","+hexToRgb(color).b+",0.6)";
            var polygon = new H.map.Polygon(coor, { 
                style: { 
                    lineWidth: 1,
                    fillColor : warna
                }
            });
            map.addObject(polygon);
            polygon.setData(
                    "<center><h3>INFORMATION</h3></center>"+
                    "<div class ='text'><b>Contributor :</b> <br>==> " + contributor + "</div>"+
                    "<div class ='text'><b>Catagory :</b> <br>==> " + kategori + "</div>"+
                    "<div class ='text'><b>Place Name :</b> <br>==> " + name + "</div>"+
                    "<div class ='text'><b>Description :</b> <br>==> " + deskripsi + "</div>"+
                    "<hr><center><a href=<?php echo base_url();?>map/edit/"+id_tempat+"><button>Edit</button></a></center>"
            );
            polygon.addEventListener("tap",showBubble);

            function showBubble(evt){
                if( evt instanceof H.map.Polygon == false ) 
                    polygon=evt.target;
                try{ 
                    ui.removeBubble(bubble); 
                } catch(ex){};
                bubble = new H.ui.InfoBubble(polygon.getBounds().getCenter(),{content:polygon.getData()});
                bubble.addClass("bubble");
                ui.addBubble(bubble);
            }
        }

        
    </script>
</body>