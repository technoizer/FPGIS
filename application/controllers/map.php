<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {
	public function index(){
		$this->load->view('demo');
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
}
