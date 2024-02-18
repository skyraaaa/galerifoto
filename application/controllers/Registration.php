<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MRegistration');
    }

    public function index() {
        $this->load->view('VRegistration');
    }

    public function register() {
        // Validasi form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('VLogin');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'email' => $this->input->post('email'),
                'namalengkap' => $this->input->post('namalengkap'),
                'alamat' => $this->input->post('alamat')
            );

            // Insert data ke database
            $result = $this->MRegistration->insert_user($data);

            if ($result) {
                $this->load->view('VRegistration');
            } else {
                echo "Registrasi gagal!";
            }
        }
    }
}
?>