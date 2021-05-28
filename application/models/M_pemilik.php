<?php 
class M_pemilik extends CI_Model
{
	public function lihat_pemilik($id_pemilik='')
	{
		if ($id_pemilik=='') {
			return $this->db->get('pemilik')->result();
		} else {
			$this->db->where('id_pemilik',$id_pemilik);
			return $this->db->get('pemilik')->row();
		}	
	}

	public function proses_tambah_pemilik($data)
	{
		return $this->db->insert('pemilik',$data);
	}

	public function proses_edit_pemilik($data, $id_pemilik)
	{
		$this->db->where('id_pemilik', $id_pemilik);
		return $this->db->update('pemilik', $data);
	}

	public function hapus_pemilik($id_pemilik)
	{
		$this->db->where('id_pemilik', $id_pemilik);
		return $this->db->delete('pemilik');
	}
}