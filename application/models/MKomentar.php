<?php

class MKomentar extends CI_Model
{
    public function tambahKomentar($data)
    {
        
            $this->db->insert('komentarfoto', $data);
        }
    

    // Tambahkan fungsi-fungsi lain yang diperlukan untuk operasi komentar lainnya
}
?>