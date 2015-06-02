<?php

class Akun extends CI_Model
{
	//admin
	public function login($username, $password)
	{
		//select * from user where username = $username and password = $password
		$sql = "SELECT username FROM akun where Username = '$username' and Pass = MD5('$password')";
        $query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $username;
		}
		else
		{
			return FALSE;
		}
	}

	public function register($username, $password,$name,$job,$email)
	{
		//select * from user where username = $username and password = $password
		$result = $this->db->get_where('akun',
			array
			(
				'username' => $username,
				'pass' => MD5($password),
				'nama_lengkap' => $name,
				'jabatan' => $job,
				'email' => $email
			)
		);
		
		if ($result->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			$sql = "INSERT INTO akun (Username, Pass,nama_lengkap,email,jabatan) VALUES ('$username',MD5('$password'),'$name','$email','$job')";
			$this->db->query($sql);
			return False;
		}
	}
	
	public function getIdUser($username)
	{
		$query = $this->db->query("SELECT id_user FROM akun WHERE username = '$username'");
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   return $row->id_user;
		}
		else
		{
			return NULL;
		}
	}

}

/* End of file akun.php */