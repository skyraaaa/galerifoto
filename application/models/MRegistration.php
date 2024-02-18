<?php
class MRegistration extends CI_Model {
    
    public function insert_user($data) {
        return $this->db->insert('user', $data);
    }
    
    public function check_username($username) {
        return $this->db->get_where('user', ['username' => $username])->row();
    }
    
    public function check_email($email) {
        return $this->db->get_where('user', ['email' => $email])->row();
    }

    public function get_user_by_username($username) {
        // Your database query to retrieve user by username
        $this->db->get_where('user', array('username' => $username))->row_array();
    }
}
?>