<?php
class M_login extends CI_Model
{
	public function proses_login($username,$password)
	{
		return $this->db->get('akun');
	}
}

?>
