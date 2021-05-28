<?php 
class M_pembelian extends CI_Model
{
	public function lihat_pembelian($id_pembelian='')
	{
		if ($id_pembelian=='') {
			return $this->db->query("SELECT pembelian.id_pembelian, pembelian.tgl_pembelian, pangkalan.id_pangkalan, pangkalan.nama_pangkalan, masyarakat.nama_kepala, masyarakat.no_kk FROM masyarakat JOIN pembelian on masyarakat.no_kk=pembelian.no_kk JOIN pangkalan on pangkalan.id_pangkalan=pembelian.id_pangkalan")->result();
		} else {
			$this->db->where('id_pembelian',$id_pembelian);
			return $this->db->get('pembelian')->row();
		}	
	}

	public function proses_tambah_pembelian($data)
	{
		return $this->db->insert('pembelian',$data);
	}

	public function proses_edit_pembelian($data, $id_pembelian)
	{
		$this->db->where('id_pembelian', $id_pembelian);
		return $this->db->update('pembelian', $data);
	}

	public function hapus_pembelian($id_pembelian)
	{
		$this->db->where('id_pembelian', $id_pembelian);
		return $this->db->delete('pembelian');
	}
}