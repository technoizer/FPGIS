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

    <div id="panel">
        <center><b>TOOLS</b></center>
        <hr>
        <button onclick="zoomObject()" style="width:150px">Zoom To Object</button><br>
        <hr>
        <button onclick="setPlaceMarker()" style="width:150px" id="point">Add Point Mode : OFF</button><br>
        <hr>
        <button onclick="deleteLast()" style="width:150px">Delete Last Marker</button><br>
        <hr>
        Color : <br>
        <!-- <input type="text" placeholder="#rgba" id="polyColor" style="width:100px"> -->
        <input onchange= "changeColor()" type="color" id="polyColor" style="width:150px">
        <br>
        <hr>
        Nama Tempat : <br>
        <input type="text" id="nama_tempat" style="width:150px"><br><br>
        Kategori : <br>
        <select style="width:150px" id="kategori">
            <option value="Building">Building</option>
            <option value="House">House</option>
        </select><br><br>
        Deskripsi : <br>
        <textarea id="des_tempat" style="width:148px" ></textarea><br><br>
        <input type="hidden" id="koordinat"><br>
        <button onclick="savePolygon()" style="width:150px">Save Polygon</button><br>
    </div>
    <div id="mapContainer"></div>

    <script>
        nokia.Settings.set("app_id", "sGRBEyHKij3A9ZGTNsB2");
        nokia.Settings.set("app_code", "7KJaKsSK-66fcpqDsqy3dQ");

        $(document).ready(function(){
              init();
        });
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
                zoomLevel: 10,
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

        function placeInit(lat,lng){
            i++;
            var coord = new nokia.maps.geo.Coordinate(lat,lng);
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
            var id = "<?php echo $id;?>"
            var coord = polyCoord;
            var nama_tempat = $('#nama_tempat').val();
            var deskripsi = $('#des_tempat').val();
            var color = $('#polyColor').val();
            var kategori = $('#kategori').val();
            $.post( "<?php echo base_url(); ?>map/update_poly", 
                { 
                    id : id,
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
       function init(){
            $.ajax({
               url : "<?php echo base_url();?>map/getDataById/<?php echo $id;?>",
               type : 'post',
               dataType : 'json',
               success : function(result)
               {    
                    var coordinates = result['tempat'][0]['koordinat'].split('#');
                    for (var j = 0; j< coordinates.length-1; j++) {
                        var lat = parseFloat(coordinates[j].split('!')[0]);
                        var lng = parseFloat(coordinates[j].split('!')[1]);
                        placeInit(lat,lng);
                    };

                    
                    $('#polyColor').val(result['tempat']['0']['color']);
                    color = result['tempat']['0']['color']+"88";
                    polygons[0].set({
                        brush: { color : color}
                    });

                    $('#nama_tempat').val(result['tempat']['0']['nama_tempat']);
                    $('#des_tempat').val(result['tempat']['0']['deskripsi_tempat']);
                    $('#kategori').val(result['tempat']['0']['kategori']); 
               },
               error : function(res)
               {
               }
           });
        }

        function zoomObject(){
            map.zoomTo(polygons[0].getBoundingBox());
        }
        
    </script>
</body>