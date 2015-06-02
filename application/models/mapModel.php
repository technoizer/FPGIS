<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MapModel extends CI_Model {
	

	public function insert($coord, $nama, $deskripsi, $color, $idUser)
	{
		$data = array(
           'color' => $color,
           'nama_tempat' => $nama,
           'deskripsi_tempat' => $deskripsi,
           'koordinat' => $coord,
           'id_user' => $idUser
        );

        $this->db->insert('tempat', $data); 
	}

	public function getTempat(){
		$this->db->select('*');
		$this->db->from('tempat');
		$this->db->join('akun', 'akun.id_user = tempat.id_user');
		$query = $this->db->get();
		return $query->result();
	}

	public function getTempatById($id){
		$this->db->select('*');
		$this->db->from('tempat');
		$this->db->join('akun', 'akun.id_user = tempat.id_user');
		$this->db->where('id_tempat',$id);
		$query = $this->db->get(); 
		return $query->result();
	}
}
