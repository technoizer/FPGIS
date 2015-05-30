<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {
	public function index(){
		$this->load->view('home2');
	}
	
	public function addPolygon(){
		$this->load->view('demo');
	}

	public function kmlViewer(){
		$this->load->view('kmlViewer');
	}
	public function insert_poly()
	{
		$coord = $_POST['coord']; 
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $color = $_POST['color'];
        $this->load->model('mapModel');
        $this->mapModel->insert($coord, $nama, $deskripsi, $color);
		
	}
	public function edit($id){
		echo $id;
	}

	public function getData()	
	{
		$this->load->model('mapModel');
		$data['tempat'] = $this->mapModel->getTempat();
		echo json_encode($data);
	}

	public function writeKML($id){

		$this->load->model('mapModel');
		$data = $this->mapModel->getTempatById($id);
		// print_r($data[0]->koordinat);

		$coordinates = explode( '#', $data[0]->koordinat);
		$str = "";
		for($i = 0; $i < sizeof($coordinates) - 1; $i++){
			$coord = explode( '!', $coordinates[$i]);
			$str .= $coord[1];
			$str .= ",";
			$str .= $coord[0];
			$str .= " ";
		}
		//$color = ;
		$tmp = str_split(explode( '#', $data[0]->color)[1], 2);
		$color = "88".$tmp[2].$tmp[1].$tmp[0];

        $kml = 
"<?xml version='1.0' encoding='utf-8'?>
<kml xmlns='http://www.opengis.net/kml/2.2'>
  <Style id='globalStyles'>
      <LineStyle id='line'>
        <color>".$color."</color>
        <width>3</width>
      </LineStyle>
      <PolyStyle id='poly'>
        <color>".$color."</color>
        <fill>0</fill>
        <outline>1</outline>
      </PolyStyle>
      <BalloonStyle>
        <textColor>99ffa000</textColor>
        <text>
          <![CDATA[
            <span style='color:#1080DD; font-size:16px; font-weight:bold;'>$[name]</span>
            <br/><br/>
            <span style='font-family:Courier; font-size:12px;'>$[description]</span>
            <br/><br/>
          ]]>
        </text>
      </BalloonStyle>
  </Style>
  <Placemark>
    <name>".$data[0]->nama_tempat."</name>
    <description>
        <![CDATA[
          ".$data[0]->deskripsi_tempat."
        ]]>
    </description>
    <styleUrl>#globalStyles</styleUrl>
    <Style>
      <PolyStyle>
        <color>".$color."</color>
      </PolyStyle>
    </Style>
    <Polygon>
      <outerBoundaryIs>
        <LinearRing>
          <coordinates>
            ".$str."
          </coordinates>
        </LinearRing>
      </outerBoundaryIs>
    </Polygon>
  </Placemark>
</kml>";
		$myfile = fopen($data[0]->nama_tempat.'.kml',"w") or die("Unable to open file!");
		fwrite($myfile, $kml);
		fclose($myfile);

		$file = $data[0]->nama_tempat.'.kml';

		if (file_exists($file)) 
		{
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}
	}
}