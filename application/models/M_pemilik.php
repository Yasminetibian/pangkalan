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

	// public function getpemilik($id='')
 //    {
 //        $id = $this->session->userdata['id_akun'];
 //        $this->db->select('*');
 //        $this->db->from('pemilik');
 //        $this->db->where('pemilik.id_pemilik', $id);
 //        //$this->db->join('penduduk', 'penduduk.nik = akun.nik');

 //        $query = $this->db->get();
 //        if($query->num_rows() != 0)
 //        {
 //            return $query;
 //        }else{
 //            return false;
 //        }

 //    }

    public function getpemilik()
    {
       
        $id_akun=$this->session->userdata['id_akun'];
        $query = $this->db->query("SELECT  * from	pemilik
        	join pangkalan on pangkalan.id_pemilik=pemilik.id_pemilik where id_akun='$id_akun'");
        $data1=$query->result_array();
        $data = array();
        foreach ($data1 as $dt) {
        	$data[] = array(
            'id_pemilik' => $dt['id_pemilik'],
            'nama_pangkalan' => $dt['nama_pangkalan'],
            'nama_pemilik' => $dt['nama_pemilik'],		
            'alamat_pemilik' => $dt['alamat_pemilik'],
            'no_telp_pemilik' => $dt['no_telp_pemilik'],

       		 );
        }
         return $data;
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