<?php 
class M_akun extends CI_Model
{
	public function lihat_akun($id_akun='')
	{
		if ($id_akun=='') {
			return $this->db->get('akun')->result();
		} else {
			$this->db->where('id_akun',$id_akun);
			return $this->db->get('akun')->row();
		}	
	}

	public function proses_tambah_akun($data)
	{
		return $this->db->insert('akun',$data);
	}

	public function proses_edit_akun($data, $id_akun)
	{
		$this->db->where('id_akun', $id_akun);
		return $this->db->update('akun', $data);
	}

	public function hapus_akun($id_akun)
	{
		$this->db->where('id_akun', $id_akun);
		return $this->db->delete('akun');
	}
}