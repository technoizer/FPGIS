<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ie-emulation-modes-warning.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=7; IE=EmulateIE9; IE=10" />
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url("<?php echo base_url(); ?>assets/images/here.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
        }

        .podbar {
            bottom:0;
            position:fixed;
            z-index:150;
            _position:absolute;
            _top:expression(eval(document.documentElement.scrollTop+
                (document.documentElement.clientHeight-this.offsetHeight)));
            height:35px;
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
          position: fixed;
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

        .top{
            top:60px;
        }

        ul{ 
          list-style-type: none;
          border-left: 1px;
        }

        hr { 
            display: block;
            border-color:black;
            border-width: 3px;
        } 

        .box{
            padding:10px;
            margin-bottom: 10px;
            color:black;
            background-color: white;
            padding-left:30px; padding-right:30px;
        }

    </style>
    <title>Community Web Mapping</title>
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

          <a class="navbar-brand" href="<?php echo base_url(); ?>">Community Web Mapping</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url(); ?>map/">Maps</a></li>
            <li><a href="<?php echo base_url(); ?>map/addPolygon">Create New Place</a></li>
            <li><a href="<?php echo base_url(); ?>map/kmlViewer">View KML</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a>Welcome, <?php echo $_SESSION["username"]; ?></a></li>
            <li class="active"><a href="<?php echo base_url(); ?>map/help">Help</a></li>
            <li><a href="<?php echo base_url() ?>auth/doLogout">Log Out</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    
    <input type="hidden" value="<?php echo $_SESSION["username"]; ?>" id="user">
    <div class="row">
        <style type="text/css">
        </style>
        <div class="col-md-1">
        </div>
        <div class="top col-md-7"  style="padding-top:15px;">
            <section class="box" id="a">
                <h3 style="margin-bottom:0px;font-weight:bold;">How to create new place</h3><br>
                <hr style="margin-top:0px;">
                <img src="<?php echo base_url() ?>assets/help/create-map.png" style="width: 100%; padding-bottom:10px" align="center"><br>
                <ol>
                    <li>Select menu "Create New Place"</li>
                    <li>Make sure the button "Add Point Mode" in the ON position</li>
                    <li>Start&nbsp;drawing points for your new place. You can click as many as you want, and drag the marker too</li>
                    <li>Default&nbsp;color is red, but you can change it as you like by click Color box</li>
                    <li>Choose your color then click OK button</li>
                    <li>The next step is&nbsp;fill in data like its name, category, and description</li>
                    <li>Click Save Polygon to save your new area</li>
                </ol>
            </section>
            <section class="box" id="b">
                <h3 style="margin-bottom:0px;font-weight:bold;">How to edit place</h3><br>
                <hr style="margin-top:0px;" >
                <p>To edit your area, you can follow these steps :</p>
                <ol>
                    <li>Click Map menu</li>
                    <li>Find your area and right click on area you want to edit. <strong>Remember</strong> : you can only edit your area, not someone else's</li>
                    <li>Click Edit button</li>
                    <img src="<?php echo base_url() ?>assets/help/edit1.png" style="width: 30%; padding-bottom:10px;" align="center" >
                    <li>Find your area by clicking "Zoom to Object" button on Toolbox</li>
                    <img src="<?php echo base_url() ?>assets/help/edit2.png" style="width: 30%; padding-bottom:10px;" align="center" >
                    <li>Don't forget to set Add Point in ON mode</li>
                    <img src="<?php echo base_url() ?>assets/help/edit3.png" style="width: 30%; padding-bottom:10px;" align="center" >
                    <li>You can start to edit by click "Delete Last Marker" to delete the last marker, or just add another marker</li>
                    <img src="<?php echo base_url() ?>assets/help/edit4_1.png" style="width: 30%; padding-bottom:10px;" align="center" >
                    <img src="<?php echo base_url() ?>assets/help/edit4.png" style="width: 30%; padding-bottom:10px;" align="center" >
                    <li>You can edit the color and description of your area too, as easily as when adding a new area</li>
                    <img src="<?php echo base_url() ?>assets/help/edit5.png" style="width: 100%; padding-bottom:10px;" align="center" >
                    <li>Finish it by clicking Save Polygon button, and now you have successfully edit your area</li>
                    <img src="<?php echo base_url() ?>assets/help/edit6.png" style="width: 100%; padding-bottom:10px;" align="center" >
                </ol>
            </section>
            <section class="box" id="c">
                <h3 style="margin-bottom:0px;font-weight:bold;">How to delete place</h3>
                <hr style="margin-top:20px;" >
                <p>To delete your area, you can follow these steps :</p>
                <ol>
                <li>Click Map menu</li>
                <li>Find your area and right click on area you want to delete. <strong>Remember</strong> : you can only delete your area, not someone else's</li>
                <li>Click Delete button</li>
                <img src="<?php echo base_url() ?>assets/help/delete1.png" style="width: 30%; padding-bottom:10px;" align="center" >
                <li>Confirm by clicking OK in dialog box if you want to continue, click Cancel if you don't want to delete</li>
                <img src="<?php echo base_url() ?>assets/help/delete2.png" style="width: 50%; padding-bottom:10px;" align="center" >
                <li>Your area successfully removed</li>
                <img src="<?php echo base_url() ?>assets/help/delete3.png" style="width: 50%; padding-bottom:10px;" align="center" >
                </ol>
            </section>
            <section class="box" id="d">
                <h3 style="margin-bottom:0px;font-weight:bold;">How to download KML place</h3>
                <hr style="margin-top:20px;" >
                <p>First, click Map menu. You can download either your area or other's using right-click on the area you want, then click Download button as shown in the picture below. And it will automatically downloaded to your folder</p>
                <img src="<?php echo base_url() ?>assets/help/donlot1.png" style="width: 100%; padding-bottom:10px;" align="center" >
            </section>
            <section class="box" id="e">
                <h3 style="margin-bottom:0px;font-weight:bold;">How to view KML</h3>
                <hr style="margin-top:20px;" >
                <p>To view KML file, follow these steps :</p>
                <ol>
                <li>Click View KML menu</li>
                <li>Select your KML file</li>
                <img src="<?php echo base_url() ?>assets/help/view1.png" style="width: 30%; padding-bottom:10px;" align="center" >
                <li>Click Open, then click Upload button on the right-side box</li>
                <img src="<?php echo base_url() ?>assets/help/view2.png" style="width: 100%; padding-bottom:10px;" align="center" >
                <li>KML will automatically loaded to the map</li>
                <img src="<?php echo base_url() ?>assets/help/view3.png" style="width: 100%; padding-bottom:10px;" align="center" >
                </ol>
            </section>
        </div>
        <div class="top col-md-3" style="padding-top:50px;">
            <ul class="nav" style="margin-top:60px;position:fixed;">
                    <li class="page-scroll" style="margin-bottom:10px;background-color:#fff;">
                        <a href="#a" style="color:black;">How to create new place</a>
                    </li>
                    <li class="page-scroll"  style="margin-bottom:10px;background-color:#fff;">
                        <a href="#b" style="color:black;">How to edit place</a>
                    </li>
                    <li class="page-scroll"  style="margin-bottom:10px;background-color:#fff;">
                        <a href="#c" style="color:black;">How to delete place</a>
                    </li>
                    <li class="page-scroll"  style="margin-bottom:10px;background-color:#fff;">
                        <a href="#d" style="color:black;">How to download KML place</a>
                    </li>
                    <li class="page-scroll"  style="margin-bottom:10px;background-color:#fff;">
                        <a href="#e" style="color:black;">How to view KML</a>
                    </li>
                </ul>
        </div>
    </div>

    <!-- <div class="podbar"> -->
        <div class="footer">
          <div class="container">
            <p class="text-muted"> GIS 2015 - Teknik Informatika FTIf ITS</p>
          </div>
        </div>
    <!-- </div> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/classie.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/freelancer.js"></script>
</body>