<?php

class Akun extends CI_Model
{
	//admin
	public function login($username, $password)
	{
		//select * from user where username = $username and password = $password
		$sql = "SELECT username FROM akun where Username = '$username' and Password = '$password'";
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
				'password' => $password,
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
			$sql = "INSERT INTO akun (Username, Password,nama_lengkap,email,jabatan) VALUES ('$username','$password','$name','email','jabatan')";
			$this->db->query($sql);
			return False;
		}
	}
	
}

/* End of file akun.php */