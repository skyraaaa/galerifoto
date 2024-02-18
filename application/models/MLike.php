<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlike extends CI_Model {

    public function get_all_data_foto() {
        $query = $this->db->select('foto.*, COUNT(likefoto.likeid) AS jumlah_like')
                          ->from('foto')
                          ->join('likefoto', 'likefoto.fotoid = foto.fotoid', 'left')
                          ->group_by('foto.fotoid')
                          ->get();

        return $query->result();
    }

    public function tambahLike($data) {
        // Pastikan tidak ada nilai NULL untuk 'userid'
        if ($data['userid'] !== null) {
            $this->db->insert('likefoto', $data);
        }
    }
}
?>