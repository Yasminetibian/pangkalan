<?php
class M_login extends CI_Model
{
	public function proses_login($username,$password)
	{
		$this->db->where(['username'=>$username, 'password' =>$password]);
		{
				return $this->db->get('akun');
		}
	}

	public function get($id = null)
    {
        $this->db->from('akun');
        if($id != null) {
            $this->db->where('id_akun', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}

?>
