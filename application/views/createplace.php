<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://js.api.here.com/se/2.5.4/jsl.js" type="text/javascript" charset="utf-8"></script>
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

          <a class="navbar-brand" href="#">Community Web Mapping</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url(); ?>map/">Maps</a></li>
            <li class="active"><a href="#">Create New Place</a></li>
            <li><a href="<?php echo base_url(); ?>map/kmlViewer">View KML</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a><?php echo $_SESSION["username"]; ?></a></li>
            <li><a href="<?php echo base_url(); ?>auth/doLogout">Log Out</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div id="panel">
        <center><b>TOOLS</b></center>
        <hr>
        <button onclick="setPlaceMarker()" style="width:150px" id="point">Add Point Mode : OFF</button><br>
        <hr>
        <button onclick="deleteLast()" style="width:150px">Delete Last Marker</button><br><br>
        Color : <br>
            <!-- <input type="text" placeholder="#rgba" id="polyColor" style="width:100px"> -->
        <input onchange= "changeColor()" type="color" id="polyColor" style="width:150px;height:30px;">
        <br><br>
        Nama Tempat : <br>
        <input type="text" id="nama_tempat" style="width:150px;color:black;"><br><br>
        Kategori : <br>
        <select style="width:150px;color:black;" id="kategori">
            <option value="Building">Building</option>
            <option value="House">House</option>
        </select><br><br>
        Deskripsi : <br>
        <textarea id="des_tempat" style="width:148px;height:100px;color:black;" ></textarea><br>
        <input type="hidden" id="koordinat"><br>
        <button onclick="savePolygon()" style="width:150px">Save Polygon</button><br>
    </div>

    <div id="mapContainer"></div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted"> GIS 2015 - Teknik Informatika FTIf ITS</p>
      </div>
    </footer>
    
    <script>
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

        var markers = new Array();
        var coordinates = new Array();
        var polygons = new Array();
        var editMode = 0;
        var i=0;

        map.addListener("click", function (evt) {
            placeMarker(evt);
        });
        $('#polyColor').val("#FF0000")
        var color ="#FF000088";
        
        function draw(){
            var tmp = coordinates;
            var geoStrip = new nokia.maps.geo.Strip(tmp,'auto');
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

        function placeMarker(evt){
            if(editMode==1){
                i++;
                var coord = map.pixelToGeo(evt.displayX, evt.displayY);
                var lat = coord.latitude;
                var lng = coord.longitude;
                var marker = new nokia.maps.map.StandardMarker([lat, lng], {
                    text: i, 
                    draggable: true  // Make the marker draggable
                });
                markers.push(marker);
                coordinates.push(coord);
                map.objects.add(marker);
                marker.addListener("dragend", function (evt) {
                    update();
                });
                update();
            }
        }

        function deleteLast(){
            if (markers.length>0){
                markers[markers.length - 1].destroy();
                markers.pop();
                coordinates.pop();
                i--;
            }
            update();
        }

        function update(){
            for (i=0;i<markers.length;i++){
                coordinates[i] = markers[i].coordinate;
            }
            if (polygons.length>0){
                polygons[0].destroy();
                polygons.pop();
                draw();
            } else{
                draw();
            }
        }

        function changeColor(){
            if (polygons.length>0){
                color = $('#polyColor').val();
                //alert(color);
                color += "88";
                polygons[0].set({
                    brush: { color : color}
                });
            }
        }

        function setPlaceMarker(){
            if(editMode == 0){
                $('#point').html("Add Point Mode : ON")
                editMode = 1;
            }
            else if(editMode == 1){
                $('#point').html("Add Point Mode : OFF")
                editMode = 0;
            }
        }

        function savePolygon(){
            //$('#koordinat').val(coordinates.toString());
            var polyCoord = "";
            for (i = 0; i<coordinates.length;i++){
                polyCoord += coordinates[i].latitude;
                polyCoord += "!"
                polyCoord += coordinates[i].longitude;
                polyCoord += "#"
            }
            // alert(polyCoord);
            var coord = polyCoord;
            var nama_tempat = $('#nama_tempat').val();
            var deskripsi = $('#des_tempat').val();
            var color = $('#polyColor').val();
            var kategori = $('#kategori').val();
            $.post( "<?php echo base_url(); ?>map/insert_poly", 
                { 
                    coord : coord, 
                    nama : nama_tempat,
                    deskripsi : deskripsi,
                    color : color,
                    kategori : kategori
                },
                function(data){
                  alert('success');
                  window.location.reload();
            });
        }
        
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</body>