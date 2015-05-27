<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MapModel extends CI_Model {
	

	public function insert($coord, $nama, $deskripsi, $color)
	{
		$data = array(
           'color' => $color,
           'nama_tempat' => $nama,
           'deskripsi_tempat' => $deskripsi,
           'koordinat' => $coord,
        );

        $this->db->insert('tempat', $data); 
	}
}
