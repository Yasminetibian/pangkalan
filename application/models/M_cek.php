<?php
class M_cek extends CI_Model
{
	public function cek_data_masyarakat($no_kk)
	{
		$this->db->where('no_kk',$no_kk);
        return $this->db->get('masyarakat');
	}
}

?>