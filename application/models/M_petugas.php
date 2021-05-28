<?php 
class M_petugas extends CI_Model
{
	public function lihat_petugas($id_petugas='')
	{
		if ($id_petugas=='') {
			return $this->db->query("SELECT petugas.id_petugas, petugas.nama_petugas, desa.id_desa, desa.desa, akun.username, akun.password, akun.id_akun FROM akun JOIN petugas on akun.id_akun=petugas.id_akun JOIN desa on desa.id_desa=petugas.id_desa ")->result();
		} else {
			return $this->db->query("SELECT petugas.id_petugas, petugas.nama_petugas, desa.id_desa, desa.desa, akun.username, akun.password, akun.id_akun FROM akun JOIN petugas on akun.id_akun=petugas.id_akun JOIN desa on desa.id_desa=petugas.id_desa where petugas.id_petugas='$id_petugas'")->row();
		}
		
	}

	public function proses_tambah_petugas($data,$petugas)
	{
		$this->db->insert('akun', $data);
		$id_akun = $this->db->insert_id();
		$petugas['id_akun'] = $id_akun;
		return $this->db->insert('petugas',$petugas);
	}

	public function proses_edit_petugas($data, $id_akun, $petugas, $id_petugas)
	{
		$this->db->where('id_akun', $id_akun);
		$this->db->update('akun', $data);

		$this->db->where('id_petugas', $id_petugas);
		return $this->db->update('petugas', $petugas);
	}

	public function hapus_petugas($id_akun,$id_petugas)
	{
		$this->db->where('id_akun', $id_akun);
		$this->db->delete('akun');

		$this->db->where('id_petugas', $id_petugas);
		return $this->db->delete('petugas');
	}
}
