<html><head>
		<meta http-equiv="X-UA-Compatible" content="IE=7; IE=EmulateIE9; IE=10">
		<base href="http://apidocs-legacy-documentations3bucket.s3-website-eu-west-1.amazonaws.com/apiexplorer/examples/public/api-for-js/events/map-coordinate-on-click.html">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>HERE Maps API for JavaScript Example: Get coordinate on mouse click or finger tap</title>
		<meta name="description" content="Combining display events with the InfoBubbles component">
		<meta name="keywords" content="coordinateonclick,Map Display and Object events">
		<!-- For scaling content for mobile devices, setting the viewport to the width of the device-->
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<!-- Styling for example container (NoteContainer & Logger)  -->
		<link rel="stylesheet" type="text/css" href="http://apidocs-legacy-documentations3bucket.s3-website-eu-west-1.amazonaws.com/apiexplorer/examples/templates/js/exampleHelpers.css">
		<!-- By default we add ?with=all to load every package available,
			it's better to change this parameter to your use case. 
			Options ?with=maps|positioning|places|placesdata|directions|datarendering|all -->
		<script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/jsl.js?with=all"></script><style type="text/css"></style><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/base.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/language-en-US.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/gfx-canvas.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/map-render-display.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/clustering-clustering.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/heatmap-heatmap.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/kml-kml.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/jsPlacesAPI.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/routing-nlp.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/positioning-w3c.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/ui-nokia_generic.js"></script><script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/behavior-all.js"></script>
		<!-- JavaScript for example container (NoteContainer & Logger)  -->
		<script type="text/javascript" charset="UTF-8" src="http://apidocs-legacy-documentations3bucket.s3-website-eu-west-1.amazonaws.com/apiexplorer/examples/templates/js/exampleHelpers.js"></script>
		<style type="text/css">
			html {
				overflow:hidden;
			}
			
			body {
				margin: 0;
				padding: 0;
				overflow: hidden;
				width: 100%;
				height: 100%;
				position: absolute;
			}
			
			#mapContainer {
				width: 100%;
				height: 100%;
				left: 0;
				top: 0;
				position: absolute;
			}
		</style>
	<style type="text/css"></style><style type="text/css"></style><style type="text/css">.ovi_mp_controls{font-family:Arial,Helvetica,sans-serif;}.ovi_mp_controls ul,.ovi_mp_controls li,.ovi_mp_controls dl,.ovi_mp_controls dd{padding:0;margin:0;list-style:none;font-size:1em;}.nm_crnode a:hover{color:#0BD!important;}.nm_hidden,.ovi_mp_controls [aria-hidden="true"],.nm_infoBubble[aria-hidden="true"],.nm_rcMenu[aria-hidden="true"]{display:none!important;}.nm_conceal{visibility:hidden;}.ovi_mp_controls [aria-role="button"],.ovi_mp_controls [aria-role="option"],.ovi_mp_controls [aria-role="menuitem"],.ovi_mp_controls [aria-role="menuitemradio"]{min-width:3.4em;min-height:3.4em;cursor:pointer;}[aria-role="menuitemradio"] .nm_firstBG{width:3.2em;height:2.6em;margin:.3em 0;}.nm_layout_horizontal [aria-role="menuitemradio"] .nm_firstBG{margin:.3em 0;}.ovi_mp_controls [aria-disabled="true"]{cursor:default;}.nm_gfx{position:absolute;top:0;}.nm_wrap{-webkit-transform:scale(1);}.nm_hover .nm_wrap{opacity:1;}.nm_wrap:hover,.nm_wrap:focus,.nm_wrap[aria-expanded="true"],[aria-role="menuitemradio"]:focus{outline:none;opacity:1;}.nm_wrap:hover .nm_firstBG,.nm_wrap:focus .nm_firstBG{border-color:#FFF;opacity:1;outline:none;}.nm_firstBG{color:#000F1A;border:.1em solid #E6E6E6;background-image:-webkit-gradient(linear,0% 0,0% 100%,from(#ECECEC),to(#CCC));background-image:-webkit-linear-gradient(top,#ECECEC,#CCC);background-image:-moz-linear-gradient(top,#ECECEC,#CCC);background-image:-ms-linear-gradient(top,#ECECEC,#CCC);background-image:-o-linear-gradient(#ececec,#ccc);background-image:linear-gradient(top,#ECECEC,#CCC);background-color:#DBDBDB;-webkit-border-radius:.3em;-moz-border-radius:.3em;-o-border-radius:.3em;-ms-border-radius:.3em;border-radius:.3em;border-radius:0 \0/;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ECECEC',endColorstr='#CCCCCC');}[aria-disabled="true"] .nm_firstBG,.nm_wrap[aria-disabled="true"]:hover .nm_firstBG,.nm_wrap[aria-disabled="true"]:active .nm_firstBG{background-image:none;background-color:#BFBFBF;filter:none;border-color:#E6E6E6;}.nm_firstBG:hover{color:#0BD;}.nm_notouch .nm_firstBG:focus,.nm_notouch .nm_secondBG:focus,.nm_notouch .nm_secondBG:hover{background-color:#0BD;color:white;}.nm_secondBG{color:#E6E6E6;background-color:#000F1A;-webkit-border-radius:.4em;-moz-border-radius:.4em;-o-border-radius:.4em;border-radius:.4em;white-space:nowrap;}.nm_hover [aria-role="button"]:hover .nm_secondBG,.nm_hover [aria-role="menuitem"]:hover .nm_secondBG,.nm_hover [aria-role="menuitemradio"]:hover .nm_secondBG,.ovi_mp_controls [aria-role="button"]:active .nm_secondBG,.ovi_mp_controls [aria-role="option"]:active .nm_secondBG,.ovi_mp_controls [aria-role="menuitem"]:active .nm_secondBG,.ovi_mp_controls [aria-role="menuitemradio"]:active .nm_secondBG,.ovi_mp_controls [aria-role="button"]:focus .nm_secondBG,.ovi_mp_controls [aria-role="option"]:focus .nm_secondBG,.ovi_mp_controls [aria-role="menuitem"]:focus .nm_secondBG,.ovi_mp_controls [aria-role="menuitemradio"]:focus .nm_secondBG,[aria-role="menuitem"][aria-selected="true"] .nm_secondBG,[aria-role="menuitem"][aria-selected="true"]:focus .nm_secondBG,[aria-role="menuitem"][aria-selected="true"]:hover .nm_secondBG,[aria-role="menuitemradio"][aria-checked="true"] .nm_secondBG,[aria-role="menuitemradio"][aria-checked="true"]:focus .nm_secondBG,[aria-role="menuitemradio"][aria-checked="true"]:hover .nm_secondBG{background-color:#0BD;color:#FFF;}[aria-role="menuitem"][aria-selected="true"] .nm_secondBG,[aria-role="menuitemradio"][aria-checked="true"] .nm_secondBG{font-weight:bold;}.ovi_mp_controls [aria-role="button"]:focus .nm_secondBG,.ovi_mp_controls [aria-role="option"]:focus .nm_secondBG,.ovi_mp_controls [aria-role="menuitem"]:focus .nm_secondBG,.ovi_mp_controls [aria-role="menuitemradio"]:focus .nm_secondBG{border:.1em solid #fff;margin:-0.1em;}.ovi_mp_controls [aria-role="button"]:hover .nm_secondBG,.ovi_mp_controls [aria-role="menuitem"]:hover .nm_secondBG,.ovi_mp_controls [aria-role="menuitemradio"]:hover .nm_secondBG{background-color:#0BD;}.nm_thirdBG{background-image:-webkit-gradient(linear,0% 0,0% 100%,from(#ECECEC),to(#CCC));background-image:-moz-linear-gradient(top,#ECECEC,#CCC);background-image:-o-linear-gradient(#ececec,#ccc);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ECECEC',endColorstr='#CCCCCC');background-color:#DBDBDB;}[aria-disabled="true"] .nm_thirdBG{background-image:none;background-color:#BFBFBF;}.ovi_mp_controls .nm_wrapperBG{background-color:#000F1A;-webkit-border-radius:.5em;-moz-border-radius:.5em;-o-border-radius:.5em;border-radius:.5em;padding:0 .7em;}.nm_wrapperBG li{border-bottom:.1em solid #4E575F;display:block;height:3.2em;}.nm_wrapperBG li:first-child{visibility:hidden;}.nm_contentBG{background-color:#000F1A;-webkit-border-radius:.4em;-moz-border-radius:.4em;-o-border-radius:.4em;border-radius:.4em;}.nm_singleButton{float:inherit;}.nm_singleButton .nm_firstBG{position:relative;width:2.6em;height:2.6em;margin:.3em;}.nm_buttonPair{position:relative;width:1.6em;height:6.8em;overflow:hidden;}.nm_buttonPair .nm_firstBG{width:1.4em;height:6.6em;margin:0 auto;}.nm_buttonPair .nm_zoomIn{margin-top:-6.6em;}.nm_buttonPair .nm_zoomOut{position:absolute;}[aria-expanded="true"] .nm_labelOpen{display:none!important;}[aria-expanded="false"] .nm_labelClose{display:none!important;}[aria-role="menuitemradio"] .nm_gfx{margin:-0.3em 0;}.nm_layout_horizontal [aria-role="menuitemradio"] .nm_gfx{margin:0;}.nm_arrangeableAnchor{position:absolute;width:100%;height:0;}.nm_arrangeableAnchor.nm_top{transition:all .5s;-moz-transition:all .5s;-webkit-transition:all .5s;-o-transition:all .5s;-ms-transition:all .5s;top:0;}.nm_adbar_top .nm_arrangeableAnchor.nm_top{top:28px;}.nm_arrangeableAnchor.nm_middle{top:50%;}.nm_arrangeableAnchor.nm_bottom{transition:all .5s;-moz-transition:all .5s;-webkit-transition:all .5s;-o-transition:all .5s;-ms-transition:all .5s;bottom:0;}.nm_adbar_bottom .nm_arrangeableAnchor.nm_bottom{bottom:28px;}.nm_bottom .nm_wrap{margin-top:-3.4em;}.nm_bottom .nm_gfx{top:auto;bottom:0;}.nm_left{float:left;}.nm_center{margin-left:50%;float:left;}.nm_right{float:right;}.nm_cover{position:absolute;top:0;width:3.4em;height:3.4em;}.nm_zoomHorAnchor{position:absolute;width:100%;top:50%;height:0;}.nm_zoomButtons{position:absolute;top:-3.4em;right:0;width:3.4em;-moz-transition:top 200ms linear,right 200ms linear,height 200ms linear;-webkit-transition:top 200ms linear,right 200ms linear,height 200ms linear;-o-transition:top 200ms linear,right 200ms linear,height 200ms linear;transition:top 200ms linear,right 200ms linear,height 200ms linear;-webkit-transform:scale(1);}.nm_zoomButtons .nm_firstBG{-moz-transition:width 200ms linear,height 200ms linear;-webkit-transition:width 200ms linear,height 200ms linear;-o-transition:width 200ms linear,height 200ms linear;transition:width 200ms linear,height 200ms linear;}.nm_zoomWrap[aria-expanded="false"] .nm_zoomButtons{width:1.7em;height:3.4em;right:-0.2em;top:-1.7em;}.nm_zoomWrap[aria-expanded="false"].nm_left .nm_zoomButtons{left:-0.2em;right:auto;}.nm_zoomWrap[aria-expanded="false"]:active .nm_zoomButtons,.nm_zoomWrap[aria-expanded="false"].nm_active .nm_zoomButtons{top:-1.8em;height:3.6em;}.nm_zoomWrap[aria-expanded="false"]:active .nm_zoomButtons .nm_firstBG,.nm_zoomWrap[aria-expanded="false"].nm_active .nm_zoomButtons .nm_firstBG{height:3.6em;}.nm_zoomWrap[aria-expanded="false"] .nm_zoomButtons .nm_firstBG{width:.7em;height:3.4em;border:none;}.nm_zoomWrap[aria-expanded="false"] .nm_zoomButtons [aria-role="button"]{min-height:1.7em;min-width:1.7em;}.nm_zoomWrap[aria-expanded="false"] .nm_zoomIn{margin-top:-3.4em;}.nm_zoomLevels{position:absolute;display:none;right:2.5em;width:3.4em;-moz-transition:right 200ms ease-out,margin-top 200ms linear;-webkit-transition:right 200ms ease-out,margin-top 200ms linear;-o-transition:right 200ms ease-out,margin-top 200ms linear;transition:right 200ms ease-out,margin-top 200ms linear;-webkit-transform:scale(1);}.nm_zoomWrap[aria-expanded="false"] .nm_zoomLevels{right:0;margin-top:-1.7em;}.nm_zoomLevels[aria-expanded="false"]{margin-top:-3.3em;}.nm_zoomLevels[aria-expanded="true"]{margin-top:-6.7em;}.nm_zoomSlider{-webkit-transform:scale(1);}.nm_zoomSlider .nm_secondBG{position:relative;margin:0 auto;-moz-transition:width 200ms linear,height 200ms linear;-webkit-transition:width 200ms linear,height 200ms linear;-o-transition:width 200ms linear,height 200ms linear;transition:width 200ms linear,height 200ms linear;}.nm_zoomWrap[aria-expanded="false"] .nm_secondBG{width:.4em;height:3.3em;}.nm_zoomWrap[aria-expanded="true"] .nm_zoomLevels[aria-expanded="false"] .nm_secondBG{width:.6em;height:6.8em;}.nm_zoomWrap[aria-expanded="true"] .nm_zoomLevels[aria-expanded="false"]:active .nm_secondBG,.nm_zoomWrap[aria-expanded="true"] .nm_zoomLevels[aria-expanded="false"].nm_active .nm_secondBG{height:6.392em;width:.564em;margin-top:.3em;}.nm_zoomLevels[aria-expanded="true"] .nm_zoomSlider .nm_secondBG{width:1.2em;height:13.4em;}.nm_zoomLevels[aria-expanded="true"]:active .nm_secondBG,.nm_zoomLevels[aria-expanded="true"].nm_active .nm_secondBG{width:1.176em;height:13.132em;margin-top:.134em;}.nm_zoomSliderTrack{position:absolute;left:0;width:100%;background-color:transparent;}.nm_zoomWrap[aria-expanded="false"] .nm_zoomSliderTrack{top:.2em;height:2.8em;}.nm_zoomWrap[aria-expanded="true"] .nm_zoomSliderTrack{top:.4em;height:5.8em;}.nm_zoomLevels[aria-expanded="true"] .nm_zoomSliderTrack{height:11.3em;top:1.05em;}.nm_zoomSliderKnob{position:absolute;margin-top:-1.7em;margin-left:0;cursor:pointer;}.nm_zoomSliderKnob[aria-disabled="true"]{width:.4em;height:.2em;min-width:.4em;min-height:.2em;left:1.5em;margin-top:-0.1em;}.nm_zoomSliderKnob .nm_thirdBG{position:absolute;width:.2em;height:.4em;top:0;left:.1em;-webkit-border-radius:.1em;-moz-border-radius:.1em;-o-border-radius:.1em;border-radius:.1em;-moz-transition:width 200ms linear,height 200ms linear;-webkit-transition:width 200ms linear,height 200ms linear;-o-transition:width 200ms linear,height 200ms linear;transition:width 200ms linear,height 200ms linear;}.nm_zoomWrap[aria-expanded="true"] .nm_zoomSliderKnob[aria-disabled="true"]{margin-top:-0.3em;left:1.4em;min-width:0;min-height:0;}.nm_zoomWrap[aria-expanded="true"] .nm_zoomSliderKnob .nm_thirdBG{width:.4em;height:.8em;top:0;left:.1em;-webkit-border-radius:.2em;-moz-border-radius:.2em;-o-border-radius:.2em;border-radius:.2em;}.nm_zoomLevels[aria-expanded="true"] .nm_zoomSliderKnob .nm_thirdBG{width:.8em;height:1.8em;top:.8em;left:1.3em;-webkit-border-radius:.4em;-moz-border-radius:.4em;-o-border-radius:.4em;border-radius:.4em;}.nm_zoomLevels[aria-expanded="true"] .nm_zoomSliderKnob:active .nm_thirdBG{width:.784em;height:1.72em;background-color:red;}.nm_zoomBookmarks{position:absolute;top:0;list-style:none;margin:0;padding:0;-webkit-transform:scale(1);}.nm_right .nm_zoomBookmarks{text-align:right;right:3.4em;}.nm_zoomLevels[aria-expanded="false"] .nm_zoomBookmarks{display:none;}.nm_zoomBookmark{padding:0;line-height:3.4em;}.nm_zoomBookmark .nm_secondBG{width:100%;padding:.1em .6em;white-space:pre;}.nm_left .nm_zoomButtons{left:0;right:auto;}.nm_left .nm_zoomLevels{left:0;right:auto;margin-left:2.5em;}.nm_left .nm_zoomBookmarks{margin-left:3.4em;}.nm_left[aria-expanded="false"] .nm_zoomLevels{margin-left:0!important;margin-top:-1.6em!important;}.nm_positioningWrap{width:3.4em;overflow:hidden;}.nm_positioningWrap[aria-pressed="true"] .nm_pos_icon_normal{display:none;}.nm_positioningWrap[aria-pressed="false"] .nm_pos_icon_pressed{display:none;}.nm_positioningWrap[aria-busy="false"] .nm_pos_icon_busy{display:none;}.nm_positioningWrap[aria-busy="true"] .nm_pos_icon_normal,.nm_positioningWrap[aria-busy="true"] .nm_pos_icon_pressed{display:none;}.nm_positioningWrap:active .nm_firstBG{background-image:none;filter:none;background-color:#333;}.nm_infoBubble{cursor:default;position:absolute;left:400px;top:100px;white-space:normal;outline:none;margin:8px;color:white;-webkit-transform:scale(1);box-shadow:0 0 1px #ccc;z-index:100;}.nm_bubble{font-family:arial,helvetica,sans;-webkit-border-radius:.4em;-moz-border-radius:.4em;-o-border-radius:.4em;border-radius:.4em;}.nm_infoBubble .nm_bubble_bg{position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;}.nm_noborder{border:0!important;}.nm_bubble_lp0{padding-left:0!important;}.nm_bubble_content{padding:1.5em;font-size:1em;}.nm_bubble_sidelinks{right:1.5em;position:absolute;text-align:right;}.nm_bubble_sidelinks a{color:#595;text-decoration:none;}.nm_hover .nm_bubble_sidelinks a:hover{text-decoration:underline;}.nm_bubble_content a,.nm_bubble_content a:visited{color:white;}.nm_bubble_content p{margin:0 0 .5em 0;}.nm_bubble_controls{position:absolute;top:-0.3em;right:.3em;}.nm_bubble_control_close{cursor:pointer;}.nm_bubble_controls a,.nm_bubble_control_close{color:#999;text-decoration:none;font-size:2em;}.nm_bubble_linksbar{display:none;margin:0 1.5em;padding:1.0em 0 1.0em 0;border-top:.1em solid #d2d2d2;}.nm_bubble_linksbar a{text-decoration:none;color:#595;padding:0 .7em 0 .5em;border-right:.1em solid #cfcfcf;}.nm_hover .nm_bubble_linksbar a:hover{text-decoration:underline;}.nm_bubble_tail{position:absolute;z-index:-10;}.nm_right[aria-role="menubar"]{margin-right:.3em;}.nm_left[aria-role="menubar"]{margin-left:.3em;}.ovi_mp_controls .nm_mapSelectorWrap{position:relative;}.nm_ie78 .nm_mapSelectorWrap{position:relative;float:right;}.nm_mapSettingsWrap{-webkit-transform:scale(1);}.nm_layout_horizontal[aria-role="menubar"] .nm_wrapperBG{height:2.8em;margin-top:.3em;margin-bottom:-3.1em;}.nm_openVertSelector[aria-role="menubar"] .nm_wrapperBG{height:13.5em;margin-bottom:-13.8em;}.nm_openVertSelector.nm_has3D[aria-role="menubar"] .nm_wrapperBG{height:16.5em;margin-bottom:-16.8em;}.nm_openVertSelector[aria-role="menubar"] .nm_dropDownMenu .nm_globe,.nm_openVertSelector[aria-role="menubar"] .nm_wrapperBG .nm_3DBG,.nm_layout_horizontal[aria-role="menubar"] .nm_wrapperBG li,.nm_layout_horizontal[aria-role="menubar"] .nm_wrapperBG li.nm_3DBG{display:none;visibility:hidden;}.nm_openVertSelector.nm_has3D[aria-role="menubar"] .nm_dropDownMenu .nm_globe,.nm_openVertSelector.nm_has3D[aria-role="menubar"] .nm_wrapperBG .nm_3DBG{display:block;visibility:visible;}[aria-role="menubar"][aria-expanded="false"] .nm_wrapperBG{display:none;visibility:hidden;}[aria-role="menubar"] [aria-role="menuitem"] .nm_firstBG,[aria-role="menubar"] [aria-role="menuitemradio"] .nm_firstBG{-webkit-border-radius:0;-moz-border-radius:0;-o-border-radius:0;border-radius:0;}.nm_left[aria-role="menubar"] [aria-role="menu"]:first-child .nm_firstBG,.nm_left[aria-role="menubar"] [aria-role="menuitem"]:first-child .nm_firstBG,.nm_left[aria-role="menubar"] [aria-role="menuitemradio"]:first-child .nm_firstBG,.nm_right[aria-role="menubar"] [aria-role="menu"]:nth-child(2) .nm_firstBG,.nm_right[aria-role="menubar"] [aria-role="menuitem"]:nth-child(2) .nm_firstBG,.nm_right[aria-role="menubar"] [aria-role="menuitemradio"]:nth-child(2) .nm_firstBG,.nm_right[aria-role="menubar"] .nm_lastInGroup[aria-role="menu"] .nm_firstBG,.nm_right[aria-role="menubar"] .nm_lastInGroup[aria-role="menuitem"] .nm_firstBG,.nm_right[aria-role="menubar"] .nm_lastInGroup[aria-role="menuitemradio"] .nm_firstBG,.nm_left[aria-role="menubar"] .nm_firstInGroup[aria-role="menu"] .nm_firstBG,.nm_left[aria-role="menubar"] .nm_firstInGroup[aria-role="menuitem"] .nm_firstBG,.nm_left[aria-role="menubar"] .nm_firstInGroup[aria-role="menuitemradio"] .nm_firstBG{-webkit-border-top-right-radius:.4em;-webkit-border-bottom-right-radius:.4em;-moz-border-radius-topright:.4em;-moz-border-radius-bottomright:.4em;-o-border-top-right-radius:.4em;-o-border-bottom-right-radius:.4em;border-top-right-radius:.4em;border-bottom-right-radius:.4em;border-radius:0 \0/;}.nm_left[aria-role="menubar"] [aria-role="menu"]:nth-child(2) .nm_firstBG,.nm_left[aria-role="menubar"] [aria-role="menuitem"]:nth-child(2) .nm_firstBG,.nm_left[aria-role="menubar"] [aria-role="menuitemradio"]:nth-child(2) .nm_firstBG,.nm_right[aria-role="menubar"] [aria-role="menu"]:first-child .nm_firstBG,.nm_right[aria-role="menubar"] [aria-role="menuitem"]:first-child .nm_firstBG,.nm_right[aria-role="menubar"] [aria-role="menuitemradio"]:first-child .nm_firstBG,.nm_right[aria-role="menubar"] [aria-role="menu"]:nth-child(1)+li .nm_firstBG,.nm_right[aria-role="menubar"] [aria-role="menuitem"]:nth-child(1)+li .nm_firstBG,.nm_right[aria-role="menubar"] [aria-role="menuitemradio"]:nth-child(1)+li .nm_firstBG,.nm_right[aria-role="menubar"] .nm_firstInGroup[aria-role="menu"] .nm_firstBG,.nm_right[aria-role="menubar"] .nm_firstInGroup[aria-role="menuitem"] .nm_firstBG,.nm_right[aria-role="menubar"] .nm_firstInGroup[aria-role="menuitemradio"] .nm_firstBG,.nm_left[aria-role="menubar"] .nm_lastInGroup[aria-role="menu"] .nm_firstBG,.nm_left[aria-role="menubar"] .nm_lastInGroup[aria-role="menuitem"] .nm_firstBG,.nm_left[aria-role="menubar"] .nm_lastInGroup[aria-role="menuitemradio"] .nm_firstBG{-webkit-border-top-left-radius:.4em;-webkit-border-bottom-left-radius:.4em;-moz-border-radius-topleft:.4em;-moz-border-radius-bottomleft:.4em;-o-border-top-left-radius:.4em;-o-border-bottom-left-radius:.4em;border-top-left-radius:.4em;border-bottom-left-radius:.4em;border-radius:0 \0/;}.nm_right>[aria-role="menu"],.nm_right>[aria-role="menuitem"],.nm_right>[aria-role="menuitemradio"]{float:right;}.nm_left>[aria-role="menu"],.nm_left>[aria-role="menuitem"],.nm_left>[aria-role="menuitemradio"]{float:left;}.nm_layout_horizontal[aria-role="menubar"] .nm_dropDownMenu{height:auto;margin:0;}.nm_layout_horizontal[aria-role="menubar"] .nm_dropDownMenu.nm_layout_horizontal{display:inline;float:inherit;height:auto;background:none;margin:0;}.nm_left .nm_ie78.nm_dropDownMenu{float:left;}.nm_right .nm_ie78.nm_dropDownMenu{float:right;}.nm_left [aria-role="menu"].nm_layout_horizontal dt{float:left;text-align:left;}.nm_right [aria-role="menu"].nm_layout_horizontal dt{float:right;text-align:right;}.nm_dropDownMenu{margin:0;}.nm_dropDownMenu dt .nm_firstBG{display:block;line-height:2.6em;margin:.3em 0;padding:0 1em;font-weight:bold;min-height:2.6em;}.nm_dropDownMenu.nm_layout_horizontal [aria-role="menuitemradio"]{display:inline;float:left;}.nm_right .nm_dropDownMenu.nm_layout_horizontal [aria-role="menuitemradio"]{float:right;}.nm_dropDownMenu[aria-expanded="false"] [aria-role="menuitemradio"]{display:none;}.nm_dropDownMenu dd{line-height:3.4em;margin:0 .6em;white-space:nowrap;}.nm_ie78 .nm_layout_horizontal.nm_dropDownMenu dd{margin:0 .6em;}.nm_mapSelectorWrap.nm_layout_horizontal .nm_dropDownMenu dd{border-bottom:none;}.nm_dropDownMenu dd.nm_last{border-bottom:none;}.nm_dropDownMenu dd .nm_secondBG{display:inline;padding:.5em 1em;margin:0;}.nm_dropDownMenu dd .nm_icon{display:none;position:absolute;left:1.3em;color:white;margin:.6em 0 0;width:2.3em;height:2.3em;background-color:orange;*margin:0;}.nm_right .nm_icon{position:relative;float:left;left:0;}.nm_dropDownMenu .nm_labelClose{color:#00BBDC;font-weight:bold;line-height:3.4em;padding:0 1.2em;}.nm_dropDownMenu[aria-expanded="false"]{background:none;}.nm_dropdown_arrow{width:0;height:0;border:0;border-top:.4em solid #333;border-right:.4em solid transparent;border-left:.4em solid transparent;display:inline-block;padding:.1em 0 0 0;margin:0 .4em 0;}.nm_layout_horizontal .nm_dropdown_arrow{border-right:.3em solid #333;border-top:.3em solid transparent;border-bottom:.3em solid transparent;border-left:0;padding:0;}.nm_layout_horizontal .nm_dropDownMenu:focus .nm_dropdown_arrow,.nm_layout_horizontal .nm_dropDownMenu:hover .nm_dropdown_arrow{border-right-color:#00BBDC;}.nm_rcMenu{font-family:arial,helvetica,sans;padding-bottom:8px;background-color:#000F1A;zoom:1;position:absolute;z-index:3;width:158px;-moz-border-radius:.4em;-webkit-border-radius:.4em;-o-border-radius:.4em;border-radius:.4em;}.nm_rcMenu,.nm_rcMenu span{color:#fff;font-weight:normal;}.nm_rcMenu .nm_rcMenuItemHeader{zoom:1;padding:10px!important;-moz-border-radius-topleft:.4em;-moz-border-radius-topright:.4em;-webkit-border-top-left-radius:.4em;-webkit-border-top-right-radius:.4em;-o-border-top-left-radius:.4em;-o-border-top-right-radius:.4em;border-top-left-radius:.4em;border-top-right-radius:.4em;color:#fff!important;}.nm_rcMenu .nm_rcMenuItem.top{margin-top:8px;}.nm_rcMenu .nm_rcMenuItem{overflow:hidden;text-align:left;padding:1px 10px 0 10px;cursor:default;}.clickable:hover,.nm_rcMenu.nm_hover .clickable:hover{background-color:#00BBDC;zoom:1;color:#FFF;cursor:pointer;color:#888;}.nm_rcMenu .nm_rcMenuItem.clickable{color:#fff;}.nm_rcMenu .nm_rcMenuSeparator{height:0;margin:8px 10px;border-top:1px solid #333;border-bottom:1px solid #666;line-height:0;font-size:0;}.nm_rcMenu .nm_rcMenuSeparatorHeader{margin-left:0;margin-right:0;margin-top:0;line-height:0;}.nm_rcMenuPin{width:32px;height:32px;background:url("http://js.cit.api.here.com/se/2.5.4/assets/ovi/mapsapi/ui/images/ovi_web/controls.png") no-repeat -76px -60px;position:absolute;}.nm_overviewAnchor{margin:.4em;margin-right:0;float:right;margin-top:-29px;}.nm_overviewWrap,.nm_rulerWrap,.nm_zoomRectWrap{margin-bottom:.3em;overflow:hidden;bottom:inherit;width:3.4em;height:3.4em;-webkit-transition:width .3s ease-in-out,height .3s ease-in-out,margin-top .3s ease-in-out;-moz-transition:width .3s ease-in-out,height .3s ease-in-out,margin-top .3s ease-in-out;-o-transition:width .3s ease-in-out,height .3s ease-in-out,margin-top .3s ease-in-out;-ms-transition:width .3s ease-in-out,height .3s ease-in-out,margin-top .3s ease-in-out;transition:width .3s ease-in-out,height .3s ease-in-out,margin-top .3s ease-in-out;}.nm_overviewWrap.anim{width:300px;height:200px;}.nm_overviewMap{width:0;height:0;border:.1em solid #333;background-color:#EEE;}.nm_overviewButton,.nm_rulerButton_icon_normal,.nm_rulerButton_icon_pressed,.nm_zoomRectButton_icon_normal,.nm_zoomRectButton_icon_pressed{position:absolute;float:none;bottom:0;}.nm_left .nm_overviewButton{left:0;}.nm_right .nm_overviewButton{right:0;}.nm_ie78 .nm_overviewButton .nm_gfx,.nm_ie78 .nm_rulerButton_icon_normal .nm_gfx,.nm_ie78 .nm_rulerButton_icon_pressed .nm_gfx,.nm_ie78 .nm_zoomRectButton_icon_normal .nm_gfx,.nm_ie78 .nm_zoomRectButton_icon_pressed .nm_gfx{top:0;}.nm_overviewWrap[aria-expanded="false"] .nm_overviewMap{display:none;}.nm_bottom .nm_scalebarTemplate .nm_gfx{margin-top:1.3em;bottom:auto;position:static;}.nm_rulerWrap,.nm_zoomRectWrap{margin-bottom:.3em;}.nm_rulerWrap[aria-pressed="true"] .nm_rulerButton_icon_normal,.nm_zoomRectWrap[aria-pressed="true"] .nm_zoomRectButton_icon_normal{display:none;}.nm_rulerWrap[aria-pressed="false"] .nm_rulerButton_icon_pressed,.nm_zoomRectWrap[aria-pressed="false"] .nm_zoomRectButton_icon_pressed{display:none;}.nm_streetLevelWrap[aria-pressed="true"] .nm_firstBG{background-color:#09b;background-image:none;}.nm_streetLevelWrap[aria-hidden="true"],.nm_streetLevelWrap .nm_street_level_leave,.nm_streetLevelWrap[aria-pressed="false"] .nm_street_level_icon_pressed,.nm_streetLevelWrap[aria-pressed="false"] .nm_street_level_icon_hover,.nm_streetLevelWrap[aria-pressed="true"] .nm_street_level_icon,.nm_streetLevelWrap[aria-pressed="true"] .nm_street_level_icon_hover,.nm_streetLevelWrap[aria-pressed="true"]:hover .nm_street_level_icon_hover,.nm_streetLevelWrap:hover .nm_street_level_icon,.nm_streetLevelWrap.nm_street_level_running .nm_street_level_icon,.nm_streetLevelWrap.nm_street_level_running:hover .nm_street_level_icon_hover{display:none;}.nm_streetLevelWrap[aria-pressed="true"] .nm_street_level_icon_pressed,.nm_streetLevelWrap:hover .nm_street_level_icon_hover,.nm_streetLevelWrap.nm_street_level_running .nm_street_level_leave{display:block;}.nm_streetLevelWrap .nm_street_level_leave{font-weight:bold;margin:6px 0;}.nm_streetLevelWrap.nm_street_level_running .nm_firstBG{width:auto;padding:0 5px;}.nm_miniman,.nm_miniman_point{display:none;width:30px;background-image:url("http://js.cit.api.here.com/se/2.5.4/assets/ovi/mapsapi/ui/images/panorama/miniman.png");position:absolute;pointer-events:none;}.nm_miniman{background-position:0 -37px;height:38px;width:30px;z-index:1000;}.nm_miniman.nm_miniman_moving{background-position:0 0;}.nm_miniman.nm_is_covered{background-position:0 -75px;}.nm_miniman_point{height:14px;background-position:0 -134px;z-index:999;}.nm_miniman_point.nm_miniman_point_animate{transition:opacity .5s ease-out;-webkit-transition:opacity .5s ease-out;-moz-transition:opacity .5s ease-out;-o-transition:opacity .5s ease-out;-ms-transition:opacity .5s ease-out;}</style></head>
	<body>
		<div id="mapContainer"><div tabindex="0" style="position: relative; width: 100%; height: 100%; overflow: hidden; outline: none; font-size: 10px !important;"><div style="position: absolute; z-index: 0; width: 100%; height: 100%; overflow: hidden; -webkit-transition: opacity 0.5s linear, -webkit-transform 0.15s linear; transition: opacity 0.5s linear, -webkit-transform 0.15s linear;"><div style="position: absolute; z-index: 0;"><div class="nma_p2d_0MapLayer" style="position: absolute; z-index: 0; -webkit-transform: matrix(1, 0, 0, 1, 683, 145);"><div style="position: absolute; z-index: -97; display: none;"></div><div style="position: absolute; z-index: -95; display: none;"></div><div style="position: absolute; z-index: -93; display: none;"></div><div style="position: absolute; display: none; z-index: -91;"></div><div style="position: absolute; display: none; z-index: -89;"></div><div style="position: absolute; display: none; z-index: -87;"></div><div style="position: absolute; display: none; z-index: -85;"></div><div style="position: absolute; display: none; z-index: -83;"></div><div style="position: absolute; display: none; z-index: -81;"></div><div style="position: absolute; z-index: -80;"><img src="http://3.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/274/168/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -228, 60); width: 256px; height: 256px; opacity: 1;"><img src="http://4.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/275/168/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 28, 60); width: 256px; height: 256px; opacity: 1;"><img src="http://3.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/275/167/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 28, -196); width: 256px; height: 256px; opacity: 1;"><img src="http://4.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/276/167/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 284, -196); width: 256px; height: 256px; opacity: 1;"><img src="http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/277/167/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 540, -196); width: 256px; height: 256px; opacity: 1;"><img src="http://2.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/274/167/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -228, -196); width: 256px; height: 256px; opacity: 1;"><img src="http://2.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/273/168/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -484, 60); width: 256px; height: 256px; opacity: 1;"><img src="http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/276/168/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 284, 60); width: 256px; height: 256px; opacity: 1;"><img src="http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/273/167/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -484, -196); width: 256px; height: 256px; opacity: 1;"><img src="http://4.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/272/167/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -740, -196); width: 256px; height: 256px; opacity: 1;"><img src="http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/272/168/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -740, 60); width: 256px; height: 256px; opacity: 1;"><img src="http://2.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/9/277/168/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 540, 60); width: 256px; height: 256px; opacity: 1;"></div><div style="position: absolute; z-index: -82; display: none;"><img src="http://2.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/549/336/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -100, 60); width: 128px; height: 128px; opacity: 1;"><img src="http://3.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/551/335/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 156, -68); width: 128px; height: 128px; opacity: 1;"><img src="http://4.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/551/336/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 156, 60); width: 128px; height: 128px; opacity: 1;"><img src="http://2.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/550/335/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 28, -68); width: 128px; height: 128px; opacity: 1;"><img src="http://4.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/548/335/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -228, -68); width: 128px; height: 128px; opacity: 1;"><img src="http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/548/336/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -228, 60); width: 128px; height: 128px; opacity: 1;"><img src="http://3.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/550/336/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 28, 60); width: 128px; height: 128px; opacity: 1;"><img src="http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/549/335/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -100, -68); width: 128px; height: 128px; opacity: 1;"><img src="http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/552/336/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 284, 60); width: 128px; height: 128px; opacity: 1;"><img src="http://4.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/547/336/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -356, 60); width: 128px; height: 128px; opacity: 1;"><img src="http://4.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/552/335/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 284, -68); width: 128px; height: 128px; opacity: 1;"><img src="http://3.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/547/335/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -356, -68); width: 128px; height: 128px; opacity: 1;"><img src="http://3.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/552/334/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 284, -196); width: 128px; height: 128px; opacity: 1;"><img src="http://2.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/551/334/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 156, -196); width: 128px; height: 128px; opacity: 1;"><img src="http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/550/334/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, 28, -196); width: 128px; height: 128px; opacity: 1;"><img src="http://4.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/549/334/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -100, -196); width: 128px; height: 128px; opacity: 1;"><img src="http://3.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/548/334/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -228, -196); width: 128px; height: 128px; opacity: 1;"><img src="http://2.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/10/547/334/256/png8?lg=ENG&amp;app_id=DemoAppId01082013GAL&amp;token=AJKnXv84fjrb0KIHawS0Tg&amp;xnlp=CL_JSMv2.5.4,SID_D828CAAE-74E1-44C9-A0B6-6785D627C7F1" class="nma_p2d_0Tile" style="position: absolute; -webkit-transform: matrix(1, 0, 0, 1, -356, -196); width: 128px; height: 128px; opacity: 1;"></div><div style="position: absolute; display: none; z-index: -84;"></div><div style="position: absolute; display: none; z-index: -86;"></div><div style="position: absolute; display: none; z-index: -88;"></div><div style="position: absolute; display: none; z-index: -90;"></div><div style="position: absolute; display: none; z-index: -92;"></div><div style="position: absolute; display: none; z-index: -94;"></div><div style="position: absolute; display: none; z-index: -96;"></div><div style="position: absolute; display: none; z-index: -98;"></div><div style="position: absolute; display: none; z-index: -99;"></div><div style="position: absolute; display: none; z-index: -100;"></div></div><div style="position: absolute; z-index: 0; -webkit-transform: matrix(1, 0, 0, 1, 683, 145);"><div class="nma_p2d_0SpatialTileLayer" style="position: absolute; z-index: 0;"></div><div class="nma_p2d_0_markerLayer" style="position: absolute; z-index: 0;"></div></div></div></div><div style="position: absolute; z-index: 0; width: 100%; height: 100%; overflow: hidden;"><div style="-webkit-user-select: none; -webkit-user-drag: element; position: absolute; z-index: 0; width: 100%; height: 100%; overflow: hidden;"></div><div><div class="nm_infoBubble nm_alignRightBelow" role="tooltip" aria-hidden="false" style="color: rgb(255, 255, 255); white-space: nowrap; right: auto; left: 684px; bottom: auto; top: 183px;" tabindex="0">
			<div class="nm_bubble">
				<div class="nm_bubble_bg nm_contentBG" style="background-color: rgb(0, 15, 26);"></div>
				<div class="nm_bubble_controls">
					<span class="nm_bubble_control_close">×</span>
				</div>
				<div class="nm_bubble_content">Clicked at 52° 31' 8" N, 13° 17' 2" E</div>
				<div class="nm_bubble_linksbar"></div>
				<div class="nm_bubble_tail" style="left: -8px; right: auto; top: -8px; bottom: auto;"><canvas width="20" height="16" style="width: 20px; height: 16px; opacity: 1;"></canvas></div>
			</div>
		</div></div><div style="position: absolute; z-index: 500; bottom: -7px; left: -4px;"><div class="nm_crimg" style="display: block; position: absolute; bottom: 20px; left: 4px; width: 33px; height: 24px; margin: 6px; cursor: pointer; background-image: url(http://js.cit.api.here.com/se/2.5.4/assets/ovi/mapsapi/here_logo.png); background-position: 0px 0px; background-repeat: no-repeat;" title="HERE"></div> 
<div class="nm_crnode" style="position: relative; top: 0px; padding-left: 10px; padding-bottom: 8px; height: 13px; font-size: 10px; font-family: arial, sans-serif; color: rgb(51, 51, 51); white-space: nowrap;"> 
	<span class="nm_crtext">© 1987 - 2015 HERE, Deutschland, EuroGeographics</span>&nbsp;<a class="nm_toulink" target="_blank" style="text-decoration: underline; color: rgb(51, 51, 51);" title="Terms of Use" href="http://here.com/terms?locale=en-US">Terms of Use</a>
	&nbsp;<a class="nm_rilink" target="_blank" title="Report Image" style="text-decoration: none; display: none; color: rgb(51, 51, 51);" href="http://here.com/0,0,70,0,0,panorama.day,report">Report Image</a>
</div></div></div><div class="" style="z-index: 0;"><div class="ovi_mp_controls" style="z-index: 0; font-size: 1em;">
		<!-- Icon (actually pictograph) resources are added as SVG comments in faux script tags (<script type="text/foobar">). This hack insures that browsers
		which are capable of parsing inline SVG do not begin to parse the cdata content, as webkit browsers are prone to do.
		<svg> tags are added to tags which have these been consciously omitted as they measure up to the 34x34 standard dimensions-->
		<!-- hiddenListener START -->
		<div class="nm_hiddenListener nm_hidden">
		</div>
		<!-- hiddenListener END -->
		
		<!--info bubble START -->
		<div class="nm_infoBubble" role="tooltip" aria-hidden="true" style="color: rgb(255, 255, 255);">
			<div class="nm_bubble">
				<div class="nm_bubble_bg nm_contentBG" style="background-color: rgb(0, 15, 26);"></div>
				<div class="nm_bubble_controls">
					<span class="nm_bubble_control_close">×</span>
				</div>
				<div class="nm_bubble_content">
				</div>
				<div class="nm_bubble_linksbar"></div>
				<div class="nm_bubble_tail">
					<script type="CDATA" charset="infobubble">
						<![CDATA[
							<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='16' width='20'>
								<g>
									<path style="color:darkpink;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" id="path3069" d="m -35,52 l 10,16 l 0,-2 c 0,-2.216 1.784,-4 4,-4 l 6,0 L -35,52 z" transform="translate(35,-52)" />
								</g>
							</svg>
						]]>
					</script>
				</div>
			</div>
		</div>
		<!-- info bubble END -->
		
		<!-- miniman START -->
		<div class="nm_miniman">
		</div>
		<div class="nm_miniman_point">
		</div>
		<!-- miniman END -->
		
		
		<div class="nm_arrangeableAnchor nm_top">
			<!-- Positioning START -->
			<div class="nm_positioningWrap nm_wrap nm_left nm_singleButton" aria-role="button" aria-pressed="false" aria-busy="false" aria-hidden="true">
				<div class="nm_firstBG"></div>
				<div class="nm_pos_icon_normal">
					<script type="CDATA" charset="positioning_normal">
						<![CDATA[
						 <path style="color:#000000;fill:none;stroke:darkgold;stroke-width:0.75;stroke-miterlimit:4;stroke-dasharray:none;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" id="path3988" d="m -21,31  c 0.0000 3.3137 -2.6863 6.0000 -6.0000 6.0000 c -3.3137 0.0000 -6.0000 -2.6863 -6.0000 -6.0000 c -0.0000 -3.3137 2.6863 -6.0000 6.0000 -6.0000 c 3.3137 -0.0000 6.0000 2.6863 6.0000 6.0000 z" transform="matrix(1.4117647,0,0,1.4117647,55.117647,-26.764706)"/>
						 <path style="color:#000000;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:3;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" id="path3218" d="m -21,31  c 0.0000 3.3137 -2.6863 6.0000 -6.0000 6.0000 c -3.3137 0.0000 -6.0000 -2.6863 -6.0000 -6.0000 c -0.0000 -3.3137 2.6863 -6.0000 6.0000 -6.0000 c 3.3137 -0.0000 6.0000 2.6863 6.0000 6.0000 z" transform="translate(44,-14)"/>
						]]>
					</script>
				</div>
				<div class="nm_pos_icon_pressed">
					<!-- The pressed icon is the same as above for now but will probably change in the future. -->
					<script type="CDATA" charset="positioning_pressed">
						<![CDATA[
						 <path style="color:#000000;fill:none;stroke:darkgold;stroke-width:0.75;stroke-miterlimit:4;stroke-dasharray:none;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" id="path3988" d="m -21,31  c 0.0000 3.3137 -2.6863 6.0000 -6.0000 6.0000 c -3.3137 0.0000 -6.0000 -2.6863 -6.0000 -6.0000 c -0.0000 -3.3137 2.6863 -6.0000 6.0000 -6.0000 c 3.3137 -0.0000 6.0000 2.6863 6.0000 6.0000 z" transform="matrix(1.4117647,0,0,1.4117647,55.117647,-26.764706)"/>
						 <path style="color:#000000;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:3;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" id="path3218" d="m -21,31  c 0.0000 3.3137 -2.6863 6.0000 -6.0000 6.0000 c -3.3137 0.0000 -6.0000 -2.6863 -6.0000 -6.0000 c -0.0000 -3.3137 2.6863 -6.0000 6.0000 -6.0000 c 3.3137 -0.0000 6.0000 2.6863 6.0000 6.0000 z" transform="translate(44,-14)"
						 />]]>
					</script>
				</div>
				<div class="nm_pos_icon_busy">
					<!-- The pressed icon is the same as above for now but will probably change in the future. -->
					<script type="CDATA" charset="positioning_busy">
						<![CDATA[
						 <path style="color:#000000;fill:none;stroke:darkgold;stroke-width:0.75;stroke-miterlimit:4;stroke-dasharray:none;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" id="path3988" d="m -21,31  c 0.0000 3.3137 -2.6863 6.0000 -6.0000 6.0000 c -3.3137 0.0000 -6.0000 -2.6863 -6.0000 -6.0000 c -0.0000 -3.3137 2.6863 -6.0000 6.0000 -6.0000 c 3.3137 -0.0000 6.0000 2.6863 6.0000 6.0000 z" transform="matrix(1.4117647,0,0,1.4117647,55.117647,-26.764706)"/>
						 <path style="color:#000000;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:3;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" id="path3218" d="m -21,31  c 0.0000 3.3137 -2.6863 6.0000 -6.0000 6.0000 c -3.3137 0.0000 -6.0000 -2.6863 -6.0000 -6.0000 c -0.0000 -3.3137 2.6863 -6.0000 6.0000 -6.0000 c 3.3137 -0.0000 6.0000 2.6863 6.0000 6.0000 z" transform="translate(44,-14)"
						 />]]>
					</script>
				</div>
			</div>
			<!-- Positioning END -->
			
			<!-- MapSettings START-->
			<ul class="nm_mapSettingsWrap nm_right nm_layout_horizontal" aria-role="menubar" aria-expanded="false">
				<ul class="nm_wrapperBG">
					<li></li>
					<li></li>
					<li></li>
					<li class="nm_3DBG"></li>
				</ul>
				<li class="nm_publicTransport nm_wrap" aria-hidden="true" aria-role="menuitemradio">
					<div class="nm_firstBG"></div>
						<script type="CDATA" charset="publicTransport">
							<![CDATA[
							<path d="m 20.445561,26 h 2.58417 v -1.292085 h -2.58417 V 26 z" id="path3113" style="fill:darkaqua;stroke:none" />
							<path d="m 10.970269,26 h 2.58417 v -1.292085 h -2.58417 V 26 z" id="path3111" style="fill:darkaqua;stroke:none" />
							<path d="m 21.061847,22.26838 c -0.771141,0 -1.396706,-0.628111 -1.396706,-1.401796 c 0,-0.771649 0.625565,-1.401794 1.396706,-1.401794 c 0.77572,0 1.402812,0.627601 1.402812,1.401794 c 0,0.772667 -0.626074,1.401796 -1.402812,1.401796 z m -8.126238,-0.0056 c -0.774194,0 -1.400777,-0.623529 -1.400777,-1.396196 c 0,-0.769103 0.626583,-1.399759 1.400777,-1.399759 c 0.772667,0 1.398741,0.625566 1.398741,1.399759 c 0,0.772667 -0.626074,1.396196 -1.398741,1.396196 z M 11.989901,13.002736 C 11.988506,12.450978 12.271014,12 12.815647,12 l 8.347497,0 C 21.710832,12 21.998605,12.450978 22,13.002736 l 0.0101,3.995546 C 22.011499,17.551567 21.718387,18 21.173244,18 l -8.347498,0 C 12.280095,18 12.001398,17.551567 12,16.998282 z M 13,10 l 8,0 l 0,1 l -8,0 z m 6.584161,-2.0000001 l -5.155636,0 C 11.825325,7.9999999 10,9.4973374 10,10.986027 l 0,11.482166 C 10,23.844028 10.718665,24 11.463846,24 l 11.07129,0 C 23.27879,24 24,23.857495 24,22.481656 L 24,11 C 24,9.4917667 22.149293,7.9999999 19.584161,7.9999999 z" id="path3075" style="fill:darkaqua;stroke:none" />
							]]>
						</script>
				</li>
				<li class="nm_trafficIncidents nm_wrap" aria-hidden="true" aria-role="menuitemradio">
					<div class="nm_firstBG"></div>
						<script type="CDATA" charset="trafficIncidents">
							<![CDATA[
							<path style="fill:darkaqua;stroke:none" d="m 17,10 l 8.5,8.5 l -8.5,8.5 l -8.5,-8.5 z" />
							<path fill="#ccc" d="m 16,13.5 l 2,0 l 0,6 l -2,0 z" />
							<path fill="#ccc" d="m 16,21 l 2,0 l 0,2 l -2,0 z" />
							]]>
						</script>
				</li>
				<li class="nm_traffic nm_wrap" aria-hidden="true" aria-role="menuitemradio">
					<div class="nm_firstBG"></div>
						<script type="CDATA" charset="traffic">
							<![CDATA[
							<path d="m 13.999309,24.730567 l 0,1.269433 L 12,26 l 0,-1.590264 c 0.283371,0.201199 0.625954,0.320831 1.002374,0.320831 z" id="path6066" style="fill:darkaqua" />
							<path d="m 13.126235,18.456519 c 0.129904,-0.381254 0.925036,-2.773294 0.925036,-2.773294 c 0.133529,-0.409652 0.514781,-0.681542 0.947392,-0.681542 l 8.000258,0 c 0.430193,0 0.815675,0.272496 0.951017,0.681542 c 0,0 0.793923,2.39204 0.921409,2.773294 c 0.233827,0.237452 0.835614,0.838029 0.835614,0.838029 C 25.893661,19.478831 26,19.733805 26,20.000258 l 0,3.001079 c 0,0.551639 -0.446507,0.999352 -0.999352,0.999352 l -12.000087,0 c -0.554659,0 -1.00177,-0.447713 -1.00177,-0.999352 l 0,-3.001683 c 0,-0.266454 0.104527,-0.521428 0.29606,-0.705709 c -6.04e-4,0 0.601183,-0.60058 0.831384,-0.837426 z M 22.527038,16 l -7.049847,0 l -0.780631,2.999698 l 8.607484,0 z m 1.301455,6.719778 c 0.734107,0 1.327434,-0.600579 1.327434,-1.338311 c 0,-0.742565 -0.591514,-1.33831 -1.327434,-1.33831 c -0.733504,0 -1.330457,0.59514 -1.330457,1.33831 c 0,0.737732 0.596953,1.338311 1.330457,1.338311 z m -9.656381,0 c 0.732899,0 1.32683,-0.600579 1.32683,-1.338311 c 0,-0.742565 -0.593931,-1.33831 -1.32683,-1.33831 c -0.736525,0 -1.331061,0.59514 -1.331061,1.33831 c 6.04e-4,0.737732 0.592724,1.338311 1.331061,1.338311 z" id="path6058" style="fill:darkaqua" />
							<path d="m 25.998188,24.409736 l 0,1.590264 l -1.997497,0 l 0,-1.269433 l 0.998144,0 c 0.372794,0 0.717189,-0.119632 0.999353,-0.320831 z" id="path6038" style="fill:darkaqua" />
							<path d="m 10.1875,16.03125 c 0.732899,0 1.3125,0.601185 1.3125,1.34375 c 0,0.737732 -0.579601,1.34375 -1.3125,1.34375 c -0.738337,0 -1.343146,-0.606018 -1.34375,-1.34375 c 0,-0.74317 0.607225,-1.34375 1.34375,-1.34375 z M 11,11 c -0.432611,0 -0.803971,0.277848 -0.9375,0.6875 c 0,0 -0.807596,2.399996 -0.9375,2.78125 c -0.230201,0.236846 -0.844354,0.8125 -0.84375,0.8125 C 8.089717,15.465531 8,15.733546 8,16 l 0,3 c 0,0.551639 0.445341,1 1,1 l 2.03125,0 c 0,-0.482549 0.17439,-1.002768 0.59375,-1.40625 c 0.0029,-0.0028 -0.0026,-0.02875 0,-0.03125 c 0.0053,-0.005 0.02255,0.0082 0.03125,0 c 0.01731,-0.01633 0.03226,-0.03395 0.0625,-0.0625 c 0.06048,-0.0571 0.12906,-0.13335 0.21875,-0.21875 c 0.121577,-0.11576 0.240203,-0.210852 0.34375,-0.3125 c 0.196435,-0.580002 0.875,-2.59375 0.875,-2.59375 c 0.04476,-0.137321 0.115265,-0.25348 0.1875,-0.375 l -2.65625,0 l 0.78125,-3 l 7.0625,0 l 0.53125,2 l 1.65625,0 C 20.460535,13.223655 19.9375,11.6875 19.9375,11.6875 C 19.802158,11.278454 19.430193,11 19,11 l -8,0 z" id="path6071" style="fill:darkaqua" />
							<path d="M 8,20.40625 L 8,22 l 2,0 l 0,-1.28125 l -1,0 c -0.37642,0 -0.716629,-0.111301 -1,-0.3125 z" id="path6040" style="fill:darkaqua"/>
							]]>
						</script>
				</li>
				<dl class="nm_dropDownMenu  nm_mapSelectorWrap nm_wrap nm_firstInGroup nm_lastInGroup nm_layout_horizontal" aria-expanded="false" aria-haspopup="true" aria-role="menu" aria-hidden="false" style="-webkit-user-select: none;" tabindex="0">
				    <dt class="nm_menuItemMapType" aria-role="menuitem">
				        <span class="nm_labelOpen nm_firstBG" aria-role="label" title="Switch map mode">Map view</span>
				        <span class="nm_labelClose" aria-role="label">Close</span>
				    </dt>
				    <dd class="nm_normal nm_first" aria-role="menuitemradio" tabindex="-1" aria-checked="true">
				        <span class="nm_secondBG">Map view</span>
				        <span class="nm_icon">⌘</span>
				    </dd>
				    <dd class="nm_satellite" aria-role="menuitemradio" tabindex="-1">
				        <span class="nm_secondBG">Satellite</span>
				        <span class="nm_icon">⌘</span>
				    </dd>
				    <dd class="nm_terrain" aria-role="menuitemradio" tabindex="-1" aria-hidden="false">
				        <span class="nm_secondBG">Terrain</span>
				        <span class="nm_icon">⌘</span>
				    </dd>
				    
				</dl>
			</ul>
			<!-- StreetLevel START -->
            <div class="nm_streetLevelWrap nm_right nm_wrap nm_singleButton" aria-role="button" aria-pressed="false" aria-hidden="true">
                <div class="nm_firstBG">
                    <span class="nm_street_level_leave">
                        __i18n_streetlevel.leave__
                    </span>
                </div>
                <div class="nm_street_level_icon">
                    <script type="CDATA" charset="street_level_normal">
                        <![CDATA[
                        <path
                             d="m 18.404447,12.32586 c -0.64114,-1.317068 -1.724616,-1.858807 -2.340904,-2.137131 -0.621259,-0.2832926 -1.217669,-0.2435326 -1.27234,-0.2435326 -0.02485,0 -2.231562,0 -2.256412,0 -0.05467,0 -0.621259,-0.03977 -1.242518,0.2435326 -0.616288,0.278324 -1.6600041,0.820063 -2.3011441,2.137131 -0.457246,0.944313 -0.487066,2.748451 -0.492035,3.886596 -0.005,0.685871 0.586467,0.964195 0.949282,0.964195 0.367786,0.005 0.8548541,-0.303175 0.8548541,-0.984075 -0.005,-2.857791 0.939343,-2.733539 0.994014,-2.733539 v 8.866609 c 0,0.402574 0.377725,0.725629 0.889642,0.725629 0.472158,0 0.924433,-0.178923 0.924433,-0.725629 l 0.412517,-5.278217 c 0.05964,0.005 0.253473,0.005 0.308143,0 l 0.412517,5.278217 c 0,0.516887 0.467187,0.73557 0.964194,0.74054 0.457247,0 0.839942,-0.337966 0.839942,-0.74054 v -8.866609 c 0.05964,0 0.944314,-0.08946 0.959224,2.773299 0,0.566589 0.526828,0.954254 0.889642,0.949284 0.367786,0 0.989045,-0.283293 0.989045,-0.929402 0.005,-1.138147 -0.02485,-2.982045 -0.482096,-3.926358 z"
                             id="path3125"
                             style="fill:#333333" 
                             transform="translate(3,3)"/>
                          <path
                             clip-rule="evenodd"
                             d="m 16.267316,6.3170443 c 0,1.4164701 -1.143117,2.5645561 -2.564558,2.5645561 -1.416471,0 -2.564557,-1.148086 -2.564557,-2.5645561 0,-1.4164705 1.153057,-2.5595866 2.569528,-2.5595866 1.41647,0 2.559587,1.1480857 2.559587,2.5595866 z"
                             id="path3127"
                             style="fill:#333333;fill-rule:evenodd"
                             transform="translate(3,3)"/>
                        />]]>
                    </script>
                </div>
                <div class="nm_street_level_icon_hover">
                    <script type="CDATA" charset="street_level_hover">
                     <![CDATA[
                     <g fill="none" stroke="white">
                        <path
                         clip-rule="evenodd"
                         d="m 19.226644,9.9210099 c 0,1.4150861 -1.14602,2.5611071 -2.561107,2.5611071 -1.415086,0 -2.561107,-1.146021 -2.561107,-2.5611071 0,-1.4150866 1.146021,-2.5611076 2.561107,-2.5611076 1.415087,0 2.561107,1.146021 2.561107,2.5611076 z"
                         id="path3205"
                         style="fill:#0099bb;fill-rule:evenodd" />
                      <path
                         d="m 12.041592,15.810561 c 0.886921,-1.54962 1.659239,-1.823668 2.306991,-2.092733 0.652733,-0.274049 1.669204,-0.199309 1.728995,-0.199309 0.0299,0 1.10616,0.01 1.519724,-0.01 0.518201,-0.02989 0.657716,0.005 1.185883,-0.03986 0.702561,-0.06478 2.04789,-0.632802 2.765398,-1.873495 0.373702,-0.652733 0.42353,-0.921799 0.697578,-1.230726 0.264084,-0.303945 0.712526,-0.5680283 1.190866,-0.318894 0.478339,0.249136 0.478339,0.832111 0.38865,1.131073 -0.154464,0.49827 -0.607889,1.554603 -0.906852,2.017993 -1.998062,3.059379 -3.796816,3.258686 -3.85661,3.258686 v 9.487061 c 0,0.38865 -0.318892,0.717509 -0.857023,0.717509 -0.498271,0 -0.966645,-0.323876 -0.966645,-0.717509 l -0.318892,-5.301592 c -0.05979,0.005 -0.36872,0.005 -0.428512,0 l -0.393634,5.301592 c 0,0.38865 -0.383667,0.717509 -0.906852,0.722492 -0.478339,0.005 -0.916816,-0.333842 -0.916816,-0.722492 v -8.894118 c -0.01993,0 -0.971627,0.01495 -0.971627,2.969688 0,0.353772 -0.104636,1.051349 -0.901868,1.051349 -0.782283,0 -1.036401,-0.722491 -1.031419,-1.101176 0.02991,-1.464914 0.08969,-3.11917 0.672665,-4.155572 z"
                         id="path3207"
                         style="fill:#0099bb" />
                        </g>
                        />]]>
                    </script>
                </div>
                <div class="nm_street_level_icon_pressed">
                    <script type="CDATA" charset="street_level_pressed">
                    <![CDATA[
                     <path
                             d="m 18.404447,12.32586 c -0.64114,-1.317068 -1.724616,-1.858807 -2.340904,-2.137131 -0.621259,-0.2832926 -1.217669,-0.2435326 -1.27234,-0.2435326 -0.02485,0 -2.231562,0 -2.256412,0 -0.05467,0 -0.621259,-0.03977 -1.242518,0.2435326 -0.616288,0.278324 -1.6600041,0.820063 -2.3011441,2.137131 -0.457246,0.944313 -0.487066,2.748451 -0.492035,3.886596 -0.005,0.685871 0.586467,0.964195 0.949282,0.964195 0.367786,0.005 0.8548541,-0.303175 0.8548541,-0.984075 -0.005,-2.857791 0.939343,-2.733539 0.994014,-2.733539 v 8.866609 c 0,0.402574 0.377725,0.725629 0.889642,0.725629 0.472158,0 0.924433,-0.178923 0.924433,-0.725629 l 0.412517,-5.278217 c 0.05964,0.005 0.253473,0.005 0.308143,0 l 0.412517,5.278217 c 0,0.516887 0.467187,0.73557 0.964194,0.74054 0.457247,0 0.839942,-0.337966 0.839942,-0.74054 v -8.866609 c 0.05964,0 0.944314,-0.08946 0.959224,2.773299 0,0.566589 0.526828,0.954254 0.889642,0.949284 0.367786,0 0.989045,-0.283293 0.989045,-0.929402 0.005,-1.138147 -0.02485,-2.982045 -0.482096,-3.926358 z"
                             id="path3125"
                             style="fill:#ffffff" 
                             transform="translate(3,3)"/>
                          <path
                             clip-rule="evenodd"
                             d="m 16.267316,6.3170443 c 0,1.4164701 -1.143117,2.5645561 -2.564558,2.5645561 -1.416471,0 -2.564557,-1.148086 -2.564557,-2.5645561 0,-1.4164705 1.153057,-2.5595866 2.569528,-2.5595866 1.41647,0 2.559587,1.1480857 2.559587,2.5595866 z"
                             id="path3127"
                             style="fill:#ffffff;fill-rule:evenodd"
                             transform="translate(3,3)"/>
                    />]]>
                    </script>
                </div>
            </div>
            <!-- StreetLevel END -->
			
			<!-- MapSettings END -->
		</div>
		<!-- Positioning END -->
		
		<!-- Zoombar START -->
		<div class="nm_arrangeableAnchor nm_middle">
			<div class="nm_zoomWrap nm_wrap nm_right" aria-expanded="true" aria-hidden="false" tabindex="0">
				<!-- Aria-expanded states set to true are required here (both above and below) as measurements are taken based on this state at initialisation-->
					<div class="nm_zoomButtons nm_buttonPair">
						<div class="nm_firstBG nm_background">&nbsp;</div>
						<div class="nm_zoomIn" aria-role="button" title="Zoom in" style="width: 34px; height: 34px; overflow: hidden;">
							<canvas width="34" height="34" class="nm_gfx nm_gfx_zoomin" style="width: 34px; height: 34px; opacity: 1;"></canvas>
						<div style="width: 100%; height: 100%; position: absolute; top: 0px; left: 0px; opacity: 0; background-color: white;"></div></div>
						<div class="nm_zoomOut" aria-role="button" title="Zoom out" style="width: 34px; height: 34px; overflow: hidden;">
							<canvas width="34" height="34" class="nm_gfx nm_gfx_zoomout" style="width: 34px; height: 34px; opacity: 1;"></canvas>
						 <div style="width: 100%; height: 100%; position: absolute; top: 0px; left: 0px; opacity: 0; background-color: white;"></div></div>
					</div>
					<div class="nm_zoomLevels" aria-expanded="false" aria-hidden="false" role="application" aria-valuemin="0" aria-valuemax="20" aria-valuenow="10">
						<div class="nm_zoomSlider" aria-role="button">
							<div class="nm_secondBG nm_background"></div>
							<div class="nm_zoomSliderTrack">
								<div aria-role="button" class="nm_zoomSliderKnob" title="__i18n_ovi.service.map._t42__" draggable="true" unselectable="on">
									<span class="nm_thirdBG"></span>
								</div>
							</div>
							<!-- Dynamically created according to map zoom levels-->
						</div>
						<ul class="nm_zoomBookmarks nm_notouch" aria-role="listbox">
							<li class="nm_zoomBookmark nm_zoomBookmark_street" aria-role="option">
									<span class=" nm_secondBG nm_background">__i18n_ovi.service.map._t46__</span>
							</li>
							<li class="nm_zoomBookmark nm_zoomBookmark_city" aria-role="option">
									<span class="nm_secondBG">__i18n_ovi.service.map._t45__</span>
							</li>
							<li class="nm_zoomBookmark nm_zoomBookmark_state" aria-role="option">
									<span class="nm_secondBG">__i18n_ovi.service.map._t44__</span>
							</li>
							<li class="nm_zoomBookmark nm_zoomBookmark_country" aria-role="option">
									<span class="nm_secondBG">__i18n_ovi.service.map._t43__</span>
							</li>
						</ul>
					</div>
			</div>
		</div>
		<!-- zoomBar END -->
		
		<div class="nm_arrangeableAnchor nm_bottom">
			<!-- Overview START -->
			<div class="nm_overviewWrap nm_wrap nm_right" aria-expanded="false" unselectable="on" aria-hidden="true">
				<div class="nm_overviewMap" unselectable="on"></div>
				<div class="nm_overviewButton nm_singleButton" aria-role="button" unselectable="on">
					<div class="nm_firstBG"></div>
					<script type="CDATA" charset="overview">
						<![CDATA[
							<path d="m 8,10 l 0,14 l 18,0 l 0,-14 z m 1,1 l 16,0 l 0,12 L 9,23 z" id="rect3114" style="color:#000000;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" />
							<path d="m 10,12 l 0,10 l 6,0 l 0,-6 l 8,0 l 0,-4 z" id="rect3119" style="color:#000000;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" />
						]]>
					</script>
				</div>
			</div>
			<!-- Overview END -->

			<!-- Distance Measurement START -->
			<div class="nm_rulerWrap nm_wrap nm_right" aria-expanded="false" unselectable="on" aria-hidden="true">
				<div class="nm_rulerButton_icon_normal nm_singleButton" aria-role="button" unselectable="on">
					<div class="nm_firstBG"></div>
					<script type="CDATA" charset="ruler_normal">
						<![CDATA[
							<path d="m15,1H2C1.447,1,1,1.448,1,2v5.001C1,7.553,1.447,8,2,8h13c0.553,0,1-0.447,1-1V2C16,1.448,15.553,1,15,1z M15,5.999v0.91v0.09V7H2l0,0V3h1v3h2V5h1v1h2V4h1v2h2V5h1v0.999h2V3h1V5.999z"  transform="translate(8,15)" style="color:#000000;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" />
						]]>
					</script>
				</div>
				<div class="nm_rulerButton_icon_pressed nm_singleButton" aria-role="button" unselectable="on">
					<div class="nm_firstBG"></div>
					<script type="CDATA" charset="ruler_pressed">
						<![CDATA[
							<path d="m15,1H2C1.447,1,1,1.448,1,2v5.001C1,7.553,1.447,8,2,8h13c0.553,0,1-0.447,1-1V2C16,1.448,15.553,1,15,1z M15,5.999v0.91v0.09V7H2l0,0V3h1v3h2V5h1v1h2V4h1v2h2V5h1v0.999h2V3h1V5.999z"  transform="translate(8,15)" style="color:darkaqua;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" />
						]]>
					</script>
				</div>
			</div>	
			<!-- Distance Measurement END -->

			<!-- Zoom rectangle START -->
			<div class="nm_zoomRectWrap nm_wrap nm_right" aria-expanded="false" unselectable="on" aria-hidden="true">
				<div class="nm_zoomRectButton_icon_normal nm_singleButton" aria-role="button" unselectable="on">
					<div class="nm_firstBG"></div>
					<script type="CDATA" charset="zoomRect_normal">
						<![CDATA[
							<path d="m 8,10 l 0,14 l 18,0 l 0,-14 z m 1,1 l 16,0 l 0,12 L 9,23 z" id="rect3114" style="color:#000000;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" />
						]]>
					</script>
				</div>
				<div class="nm_zoomRectButton_icon_pressed nm_singleButton" aria-role="button" unselectable="on">
					<div class="nm_firstBG"></div>
					<script type="CDATA" charset="zoomRect_pressed">
						<![CDATA[
							<path d="m 8,10 l 0,14 l 18,0 l 0,-14 z m 1,1 l 16,0 l 0,12 L 9,23 z" id="rect3114" style="color:darkaqua;fill:darkaqua;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate" />
						]]>
					</script>
				</div>
			</div>	
			<!-- Zoom rectangle END -->

			<!-- Scalebar START -->
			<!--<div class="nm_scalebarAnchor" aria-hidden="true">-->
				<div class="nm_scalebarWrap nm_wrap nm_metric nm_right" aria-hidden="true">
					<div class="nm_scalebarTemplate" aria-role="button">
						<div class="nm_scaleBarExpandableElement"></div>
					</div>
					<span class="nm_scalebarUnitinfo" aria-hidden="true">__i18n_ovi.service.map._t26__</span>
					<!--Style definition below is here because it reset everything and in CSS file should be easily changed without any warning.-->
					<span class="nm_scalebarTextTester" style="text-align: left; font-weight: normal; font-size: 10px; font-family: Arial; font-style: normal; font-variant: normal; text-transform: none; text-decoration: none; visibility: hidden;"></span>
				</div>
			<!--</div>-->
			<!-- Scalebar END -->
		</div>
		
		<!-- RightClick menu START -->
		<div class="nm_rcMenu nm_wrap" aria-hidden="true" aria-role="menu">
			<div class="nm_rcMenuItem"></div>
			<div class="nm_rcMenuSeparator"></div>
			<div class="nm_rcMenuPin"></div>
		</div>
		<!-- RightClick menu END -->
	</div></div></div></div>
		<div id="uiContainer"><div id="positionLogger" class="log log_not_msie78"><a role="button" class="button close">x</a><div role="button" class="clear button">clear</div><div class="inner"><div class="consoleElt"><p>Clicked at position: <br>latitude: 52.51877519633745<br> longitude: 13.283956909179864</p></div></div></div><div id="coordinateOnClickUi" class="note note_not_msie7" aria-hidden="true"><a role="button" class="button close">x</a><div class="title"><h1>Get coordinate on click</h1></div><div class="inner"><p>This example shows how to get geographical coordinates on mouse click / finger tap.</p><p>Click anywhere on the map will show an infoBubble with coordinate information.</p></div></div></div>
		<script type="text/javascript" id="exampleJsSource">
/*	Setup authentication app_id and app_code 
*	WARNING: this is a demo-only key
*	please register for an Evaluation, Base or Commercial key for use in your app.
*	Just visit http://developer.here.com/get-started for more details. Thank you!
*/
nokia.Settings.set("app_id", "sGRBEyHKij3A9ZGTNsB2"); 
nokia.Settings.set("app_code", "7KJaKsSK-66fcpqDsqy3dQ");
// Use staging environment (remove the line for production environment)
nokia.Settings.set("serviceMode", "cit");

// Get the DOM node to which we will append the map
var mapContainer = document.getElementById("mapContainer");

// We create a new instance of InfoBubbles bound to a variable so we can call it later on
var infoBubbles = new nokia.maps.map.component.InfoBubbles();

// Create a map inside the map container DOM node
var map = new nokia.maps.map.Display(mapContainer, {
	// Initial center and zoom level of the map
	center: [52.51, 13.4],
	zoomLevel: 10,
	components: [
		infoBubbles, 
		// ZoomBar provides a UI to zoom the map in & out
		new nokia.maps.map.component.ZoomBar(), 
		// We add the behavior component to allow panning / zooming of the map
		new nokia.maps.map.component.Behavior(),
		// Creates UI to easily switch between street map satellite and terrain mapview modes
		new nokia.maps.map.component.TypeSelector()
	]
});

/* We create a new UI Loggger to display log messages
 * Logger is a UI helper function and not part of the Maps API for JavaScript
 * See exampleHelpers.js for implementation details 
 */
var positionLogger = new Logger({
	id: "positionLogger",
	parent: document.getElementById("uiContainer"),
	title: "Clicked position log"
});

/* We would like to add event listener on mouse click or finger tap so we check
 * nokia.maps.dom.Page.browser.touch which indicates whether the used browser has a touch interface.
 */
var TOUCH = nokia.maps.dom.Page.browser.touch,
	CLICK = TOUCH ? "tap" : "click";

/* Attach an event listener to map display
 * push info bubble with coordinate information to map
 */
map.addListener(CLICK, function (evt) {
	var coord = map.pixelToGeo(evt.displayX, evt.displayY);
	/* We create an infobubble using infoBubbles.openBubble.
	 * 
	 * openBubble(content, coordinate, onUserClose, hideCloseButton) takes for parameters 
	 * 		- content: to be shown in the info bubble;
	 * 		 	it can be an HTML string or an instance of nokia.maps.search.Location
	 * 		- coordinate: An object containing the geographic coordinates 
	 * 			of the location, where the bubble's anchor is to be placed
	 * 		- onUserClose: A callback method which is called when bubble is closed
	 * 		- hideCloseButton: Hides close button if set to true.
	 */
	infoBubbles.openBubble("Clicked at " + coord, coord);
	
	// Clear the logger
	positionLogger.clear();
	
	// We now print the latitude & longitude to the logger
	positionLogger.log(
		"Clicked at position: <br />latitude: " + 
		coord.latitude + "<br /> longitude: " + coord.longitude);
});

/* We create a UI notecontainer for example description
 * NoteContainer is a UI helper function and not part of the Maps API for JavaScript
 * See exampleHelpers.js for implementation details 
 */
var noteContainer = new NoteContainer({
	id: "coordinateOnClickUi",
	parent: document.getElementById("uiContainer"),
	title: "Get coordinate on click",
	content:
		'<p>This example shows how to get geographical coordinates on mouse click / finger tap.</p>' +
		'<p>Click anywhere on the map will show an infoBubble with coordinate information.</p>'
});

		</script>
	
<iframe style="visibility: hidden; position: absolute; left: -9999px;"></iframe></body></html>