<?php 
class M_masyarakat extends CI_Model
{
	public function lihat_masyarakat($no_kk='')
	{
		if ($no_kk=='') {
			return $this->db->query("SELECT masyarakat.no_kk, masyarakat.nama_kepala, masyarakat.alamat, masyarakat.id_barcode, masyarakat.file_barcode, desa.id_desa, masyarakat.rt, desa.id_desa, desa.desa, akun.id_akun, akun.username FROM akun JOIN masyarakat on akun.id_akun=masyarakat.id_akun JOIN desa on desa.id_desa=masyarakat.id_desa")->result();
		} else {
			return $this->db->query("SELECT masyarakat.no_kk, masyarakat.nama_kepala, masyarakat.alamat, masyarakat.id_barcode, masyarakat.file_barcode, desa.id_desa, masyarakat.rt, desa.desa, akun.id_akun, akun.username FROM akun JOIN masyarakat on akun.id_akun=masyarakat.id_akun JOIN desa on desa.id_desa=masyarakat.id_desa where masyarakat.no_kk='$no_kk'")->row();
		}
		
	}

	public function proses_tambah_masyarakat($data,$masyarakat)
	{
		$this->db->insert('akun', $data);
		$id_akun = $this->db->insert_id();
		$masyarakat['id_akun'] = $id_akun;
		return $this->db->insert('masyarakat',$masyarakat);
	}

	public function proses_edit_masyarakat($data, $id_akun, $masyarakat, $no_kk)
	{
		$this->db->where('id_akun', $id_akun);
		$this->db->update('akun', $data);

		$this->db->where('no_kk', $no_kk);
		return $this->db->update('masyarakat', $masyarakat);
	}

	public function hapus_masyarakat($id_akun,$no_kk)
	{
		$this->db->where('id_akun', $id_akun);
		$this->db->delete('akun');

		$this->db->where('no_kk', $no_kk);
		return $this->db->delete('masyarakat');
	}
}
