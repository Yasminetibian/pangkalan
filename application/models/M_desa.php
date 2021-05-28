<?php 
class M_desa extends CI_Model
{
	public function lihat_desa($id_desa='')
	{
		if ($id_desa=='') {
			return $this->db->get('desa')->result();
		} else {
			$this->db->where('id_desa',$id_desa);
			return $this->db->get('desa')->row();
		}	
	}

	public function proses_tambah_desa($data)
	{
		return $this->db->insert('desa',$data);
	}

	public function proses_edit_desa($data, $id_desa)
	{
		$this->db->where('id_desa', $id_desa);
		return $this->db->update('desa', $data);
	}

	public function hapus_desa($id_desa)
	{
		$this->db->where('id_desa', $id_desa);
		return $this->db->delete('desa');
	}
}