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

	

	 public function getpangkalan()
    {
       
        $id_akun=$this->session->userdata['id_akun'];
        $query = $this->db->query("SELECT pangkalan.id_pangkalan, pangkalan.nama_pangkalan, pangkalan.no_telp_pangkalan, pangkalan.alamat_pangkalan, pangkalan.penangung_jawab, desa.id_desa, desa.desa, akun.id_akun, akun.username, pemilik.id_pemilik, pemilik.nama_pemilik from  akun JOIN pangkalan on akun.id_akun=pangkalan.id_akun JOIN desa on desa.id_desa=pangkalan.id_desa JOIN pemilik on pemilik.id_pemilik=pangkalan.id_pemilik where akun.id_akun='$id_akun'");
        $data1=$query->result_array();
        $data = array();
        foreach ($data1 as $dt) {
        	$data[] = array(
            'id_pangkalan' => '',
            'nama_pangkalan' => $dt['nama_pangkalan'],
            'nama_pemilik' => $dt['nama_pemilik'],
            'username' => $dt['username'],		
            'alamat_pangkalan' => $dt['alamat_pangkalan'],
            'no_telp_pangkalan' => $dt['no_telp_pangkalan'],
            'penangung_jawab' => $dt['penangung_jawab'],
            'id_pemilik' => $dt['id_pemilik'],
            'id_akun' => $dt['id_akun'],
            'id_desa' => $dt['id_desa'],
            'desa' => $dt['desa'],
       		 );
        }
         return $data;
    }
	

	// public function getpangkalan($id='')
 //    {

 //        $id = $this->session->userdata['id_akun'];
 //        $this->db->select('*');
 //        $this->db->from('pangkalan');
 //        $this->db->where('pemilik.id_pemilik', $id);
 //        $this->db->join('pemilik', 'pemilik.id_pemilik = pangkalan.id_pemilik');

 //        $query = $this->db->get();
 //        if($query->num_rows() != 0)
 //        {
 //            return $query;
 //        }else{
 //            return false;
 //        }

 //        	echo "<pre>";
	//  	print_r($id);

 //    }

   


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