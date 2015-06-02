<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-ui.js"  type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="http://js.api.here.com/v3/3.0/mapsjs-ui.css" />
    <script src="http://js.api.here.com/v3/3.0/mapsjs-pano.js" type="text/javascript" charset="utf-8"></script> 
    <script src="http://js.api.here.com/v3/3.0/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ie-emulation-modes-warning.js"></script>
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

        button{
            font-size: 10pt;
            margin-left: 11pt;
            color:black;
            border:none;
        }
        button:hover{
            background-color: white;
        }

        .footer {
          position: absolute;
          bottom: 0;
          width: 100%;
          height: 2.5%;
          font-size: 9pt;
          text-align: right;
          background-color: #00001F;
          color:black;
        }

        #mapContainer {
            margin-top: 60px;
            width: 100%;
            height: 90%;
            left: 0;
            top: 0;
            position: absolute;
        }
        #panel {
            position: absolute;
            top: 1%;
            left: 10px;
            z-index: 5;
            color:white;
            background-color:#00001F;
            padding: 15px;
            border: 1px solid #999;
        }
        .bubble {
            padding: 5px;
        }
        .bubble .text {
            font-size: 10pt;
            padding-left: 23px;
        }

        .navbar{
            z-index: 1;
        }

    </style>
</head>
<body>

    
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="#">Community Web Mapping</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url(); ?>map/">Maps <span class="sr-only">(current)</span></a></li>
            <li><a href="<?php echo base_url(); ?>map/addPolygon">Create New Place</a></li>
            <li><a href="<?php echo base_url(); ?>map/kmlViewer">View KML</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a><?php echo $_SESSION["username"]; ?></a></li>
            <li><a href="../auth/doLogout">Log Out</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <input type="hidden" value="<?php echo $_SESSION["username"]; ?>" id="user">

    <div id="mapContainer"></div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted"> GIS 2015 - Teknik Informatika FTIf ITS</p>
      </div>
    </footer>
    
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
                        var username = result['tempat'][i]['username'];
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

                        draw(path, color, name, kategori, deskripsi, contributor,id,username);
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

        function draw(coor, color, name, kategori, deskripsi, contributor,id_tempat,username){
            var warna = "rgba("+hexToRgb(color).r+","+hexToRgb(color).g+","+hexToRgb(color).b+",0.5)";
            var polygon = new H.map.Polygon(coor, { 
                style: { 
                    lineWidth: 1,
                    fillColor : warna
                }
            });
            map.addObject(polygon);
            var str = "<center style='padding-left:23px;'><h3>INFORMATION</h3></center>"+
                    "<table style='font-size:13pt;margin-left:23px;'>"+
                    "<div class ='text'><tr><td style='vertical-align: text-top'><b>Contributor</td> <td style='vertical-align: text-top'>&nbsp:</td></b><td style='width:200px;'>&nbsp" + contributor + "</td></tr></div>"+
                    "<div class ='text'><tr><td style='vertical-align: text-top'><b>Category</td> <td style='vertical-align: text-top'>&nbsp:</td></b><td>&nbsp" + kategori + "</td></tr></div>"+
                    "<div class ='text'><tr><td style='vertical-align: text-top'><b>Name</td> <td style='vertical-align: text-top'>&nbsp:</td></b><td>&nbsp" + name + "</td></tr></div>"+
                    "<div class ='text'><tr><td style='vertical-align: text-top'><b>Description</td> <td style='vertical-align: text-top'>&nbsp:</td></b><td>&nbsp" + deskripsi + "</td></tr></div></table>"+
                    "<center style='margin-top:10px;margin-bottom:15px;text-align:right;'>";
            if (username == $("#user").val()){
                str+="<a href=<?php echo base_url();?>map/edit/"+id_tempat+"><button>Edit</button></a>"+
                    "<a href=<?php echo base_url();?>map/edit/"+id_tempat+"><button>Delete</button></a>";
            }
            str+= "<a href=<?php echo base_url();?>map/writeKML/"+id_tempat+"><button>Download</button></a></center>";
            polygon.setData(
                    str
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</body>