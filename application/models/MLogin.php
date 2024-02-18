<?php
class MLogin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GoLogin($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $row = $query->row();

            // Verify the entered password using password_verify
            if (password_verify($password, $row->password)) {
                $this->load->library('session');

                $this->session->set_userdata('userid', $row->userid);
                $this->session->set_userdata('username', $row->username);
                $this->session->set_userdata('Login', 'Aktif');

                return $row->username;
            }
        }

        return false;
    }
}
?>