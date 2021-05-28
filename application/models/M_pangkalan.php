<?php 
class M_pangkalan extends CI_Model
{
	public function lihat_pangkalan($id_pangkalan='')
	{
		if ($id_pangkalan=='') {
			return $this->db->query("SELECT pangkalan.id_pangkalan, pangkalan.nama_pangkalan, pangkalan.no_telp_pangkalan, pangkalan.alamat_pangkalan, pangkalan.penangung_jawab, desa.id_desa, desa.desa, akun.id_akun, akun.username, pemilik.id_pemilik, pemilik.nama_pemilik from  akun JOIN pangkalan on akun.id_akun=pangkalan.id_akun JOIN desa on desa.id_desa=pangkalan.id_desa JOIN pemilik on pemilik.id_pemilik=pangkalan.id_pemilik")->result();
		} else {
			$this->db->where('id_pangkalan',$id_pangkalan);
			return $this->db->get('pangkalan')->row();
		}	
	}

	public function proses_tambah_pangkalan($data)
	{
		return $this->db->insert('pangkalan',$data);
	}

	public function proses_edit_pangkalan($data, $id_pangkalan)
	{
		$this->db->where('id_pangkalan', $id_pangkalan);
		return $this->db->update('pangkalan', $data);
	}

	public function hapus_pangkalan($id_pangkalan)
	{
		$this->db->where('id_pangkalan', $id_pangkalan);
		return $this->db->delete('pangkalan');
	}
}