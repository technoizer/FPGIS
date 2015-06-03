<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('login') != TRUE)
		{
			redirect('auth');
		}
	}

	public function index(){
		$this->load->view('home2');
	}

	public function help(){
		$this->load->view('help');
	}
	
	public function addPolygon(){
		$this->load->view('createplace');
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
        $kategori = $_POST['kategori'];
        $this->load->model('mapModel');
        $this->load->model('akun');
        $idUser = $this->akun->getIdUser($this->session->userdata('username'));
        $this->mapModel->insert($coord, $nama, $deskripsi, $color, $idUser,$kategori);
	}
	public function update_poly()
	{
		$id = $_POST['id'];
		$kategori = $_POST['kategori'];
		$coord = $_POST['coord']; 
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $color = $_POST['color'];
        $this->load->model('mapModel');
        $this->load->model('akun');
        $this->mapModel->update($coord, $nama, $deskripsi, $color, $id, $kategori);
	}
	public function edit($id)
	{
		$data['id'] = $id;
		$this->load->view('edit',$data);
	}

	public function getData()	
	{
		$this->load->model('mapModel');
		$data['tempat'] = $this->mapModel->getTempat();
		echo json_encode($data);
	}

	public function getDataById($id)	
	{
		$this->load->model('mapModel');
		$data['tempat'] = $this->mapModel->getTempatById($id);
		echo json_encode($data);
	}

	public function upload(){
		$data=$_FILES['file-0'];
		$target_dir = "./assets/kml/";
		$target_file = $target_dir . "baca.kml";
		$uploadOk = 1;
		$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check file size
		if ($data["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($fileType != "kml") {
		    echo "Sorry, only kml files are allowed.";
		    $uploadOk = 0;
		}
		echo json_encode($data["tmp_name"]);
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 1){
		    if (move_uploaded_file($data["tmp_name"], $target_file)) {
		        echo "The file ". basename( $data["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}

	public function delete($id){
		// echo $id;
		$this->load->model('mapModel');
        $this->mapModel->delete($id);
        redirect(base_url()."map");
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
		$file = 'download.kml';
		$myfile = fopen($file,"w") or die("Unable to open file!");
		fwrite($myfile, $kml);
		fclose($myfile);
		$str = $data[0]->nama_tempat.'.kml';
		if (file_exists($file)) 
		{
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($str));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}
	}
}
