<?php 
class M_masyarakat extends CI_Model
{
	public function lihat_masyarakat($no_kk='')
	{
		if ($no_kk=='') {
			return $this->db->query("SELECT masyarakat.no_kk, masyarakat.nama_kepala, masyarakat.alamat, masyarakat.id_barcode, masyarakat.file_barcode, desa.id_desa, masyarakat.rt, desa.id_desa, desa.desa FROM masyarakat JOIN desa on desa.id_desa=masyarakat.id_desa")->result();
		} else {
			return $this->db->query("SELECT masyarakat.no_kk, masyarakat.nama_kepala, masyarakat.alamat, masyarakat.id_barcode, masyarakat.file_barcode, desa.id_desa, masyarakat.rt, desa.desa FROM masyarakat JOIN desa on desa.id_desa=masyarakat.id_desa where masyarakat.no_kk='$no_kk'")->row();
		}
		
	}

	public function proses_tambah_masyarakat($data)
	{
		return $this->db->insert('masyarakat', $data);
	}

	public function proses_edit_masyarakat($data, $no_kk)
	{
		$this->db->where('no_kk', $no_kk);
		return $this->db->update('masyarakat', $data);
	}

	public function proses_detail_masyarakat($data, $no_kk)
	{
		$this->db->where('no_kk', $no_kk);
		return $this->db->update('masyarakat', $data);
	}

	public function hapus_masyarakat($no_kk)
	{
		$this->db->where('no_kk', $no_kk);
		return $this->db->delete('masyarakat');
	}
}
