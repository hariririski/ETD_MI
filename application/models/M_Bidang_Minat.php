<?php
class M_Bidang_Minat extends CI_Model{
    function lihat()
    {
        $query=$this->db->query("SELECT * FROM `bidang_minat` left join prodi on prodi.id_prodi=bidang_minat.id_prodi");
        return $query->result();
    }
    function lihat_bidang_minat_prodi($id)
    {
        $query=$this->db->query("SELECT * FROM `bidang_minat` left join prodi on prodi.id_prodi=bidang_minat.id_prodi where bidang_minat.id_prodi='$id'");
        return $query->result();
    }

    function lihat_prodi($prodi)
    {
        $query=$this->db->query("SELECT * FROM `bidang_minat` left join prodi on prodi.id_prodi=bidang_minat.id_prodi where bidang_minat.id_prodi='$prodi'");
        return $query->result();
    }

    function lihat_edit($id)
    {
        $query=$this->db->query("SELECT * FROM `bidang_minat` left join prodi on prodi.id_prodi=bidang_minat.id_prodi where id_bidang_minat='$id'");
        return $query->result();
    }


    function tambah()
    {
      $data = array(
          'nama_bidang_minat'=>$this->input->post('bidang_minat'),
          'id_prodi'=>$this->session->userdata('prodi')

      );
      $cek=$this->db->insert('bidang_minat',$data);
      return $cek;
    }

    function edit($id)
    {

      $data = array(
          'nama_bidang_minat'=>$this->input->post('bidang_minat')
      );

          $this->db->where('id_bidang_minat',$id);
          $cek=$this->db->update('bidang_minat',$data);
          return $cek;

    }



    function hapus($id)
    {
      $query=$this->db->where('id_bidang_minat', $id);
      $cek=$this->db->delete('bidang_minat');
      return $cek;
    }


}
