<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/jsl.js?with=all"></script> 
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ie-emulation-modes-warning.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=7; IE=EmulateIE9; IE=10" />
    
    <script charset="UTF-8" src="./../../../..//examples/templates/js/exampleHelpers.js"></script>
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
            float:right;
            right:10px;
            z-index: 1;
            top:72px;
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

        hr{
            margin-top: 7px;
            margin-bottom:7px;
        }
    </style>
    <title>Community Web Mapping</title>
</head>
<body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="<?php echo base_url(); ?>">Community Web Mapping</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url(); ?>map/">Maps</a></li>
            <li><a href="<?php echo base_url(); ?>map/addPolygon">Create New Place</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>map/kmlViewer">View KML</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a>Welcome, <?php echo $_SESSION["username"]; ?></a></li>
            <li><a href="<?php echo base_url(); ?>map/help">Help</a></li>
            <li><a href="<?php echo base_url() ?>auth/doLogout">Log Out</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div id="panel">
        <center><b>Upload KML</b></center>
        <hr>
        File : <br>
        <input type="file" id="file" style="width:200px;"><br>
        <button onclick="doUpload()" style="width:200px">Upload</button><br>
    </div>

    <div id="mapContainer"></div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted"> GIS 2015 - Teknik Informatika FTIf ITS</p>
      </div>
    </footer>

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
                center: [52.51, 13.4],
                baseMapType: nokia.maps.map.Display.TERRAIN
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

        function doUpload(){
            var data = new FormData();
            jQuery.each(jQuery('#file')[0].files, function(i, file) {
                data.append('file-'+i, file);
            });

            jQuery.ajax({
                url: '<?php echo base_url();?>map/upload',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data){
                    alert("success");
                    kml.parseKML("<?php echo base_url()?>/assets/kml/baca.kml");
                }
            });
        }
        
    </script>
</body>