<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSudi extends CI_Model
{
    function AddData($tabel, $data=array())
    {
        $this->load->database();
        $this->db->insert($tabel,$data);
    }

    function UpdateData($tabel,$fieldid,$fieldvalue,$data=array())
    {
        $this->load->database();
        $this->db->where($fieldid,$fieldvalue)->update($tabel,$data);
    }

    function DeleteData($tabel,$fieldid,$fieldvalue, $userid = null)
    {
        $this->load->database();
        if ($userid !== null) {
            $this->db->where('userid', $userid);
        }
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }

    function GetData() {
        $this->load->database();
        $this->db->select('foto.*, user.namalengkap as namauser'); // Ambil nama dari tabel user
        $this->db->from('foto');
        $this->db->join('user', 'user.userid = foto.userid', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    

    function GetDataWhere($tabel, $id, $nilai)
    {
        $this->load->database();
        $this->db->select("$tabel.*, user.namalengkap as nama_user");
        $this->db->from($tabel);
        $this->db->join('user', 'user.userid = '.$tabel.'.userid', 'left');
        $this->db->where("$tabel.$id", $nilai); // Menambahkan nama tabel sebelum kolom pada klausa WHERE
        $query = $this->db->get();
        return $query;
    }

    public function relasialbum() {
        $this->db->select('namaalbum');
        $this->db->from('album');
        $query = $this->db->get();

        return $query->result();
    }

    // public function hitung_like($userid){
    //     $sql="select count(likeid) as jumlah from likefoto where userid='".$userid."'";
    //     return $this->db->query($sql)->row();
    // }

    public function hitung_like($userid, $fotoid = null){
        $sql = "SELECT COUNT(likeid) AS jumlah FROM likefoto WHERE fotoid = '{$fotoid}'";
        
        // If $fotoid is provided, include it in the query
        // if (!is_null($fotoid)) {
        //     $sql .= " AND fotoid = '{$fotoid}'";
        // }
        // var_dump($this->db->query($sql)->row());
    
        return $this->db->query($sql)->row();
    }

    public function getAlbumId() {
        return $this->input->post('album_id');
    }

    public function getAlbumIdByFotoId($fotoid)
    {
        // Lakukan query ke database untuk mendapatkan albumid berdasarkan fotoid
        $query = $this->db->select('albumid')->where('fotoid', $fotoid)->get('foto');
        
        // Ambil hasil query
        $result = $query->row();
        
        // Periksa jika hasil query ada
        if ($result) {
            return $result->albumid;
        } else {
            return null; // Atau tindakan yang sesuai jika tidak ada albumid ditemukan
        }
    }

	// TODO by HamsterKaget : get comment record by fotoid 
	public function getComment($fotoid)
    {
		$sql = "SELECT komentarfoto.*, user.username 
        FROM komentarfoto 
        LEFT JOIN user ON komentarfoto.userid = user.userid 
        WHERE komentarfoto.fotoid = '{$fotoid}'";

        
        // return var_dump($this->db->query($sql)->row());
		return $this->db->query($sql)->result();
    }
    
}
