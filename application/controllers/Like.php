<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Like extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('MSudi');
	}

    public function likeFoto($fotoid) {
        
        date_default_timezone_set("Asia/Bangkok");
    
        $userid = $this->session->userdata('userid');
        $fotoid = $this->uri->segment('3');
    
       
        $alreadyLiked = $this->MSudi->hitung_like($userid, $fotoid);
    
        if ($alreadyLiked->jumlah == 0) {
            // If the user hasn't liked the photo yet, proceed to like it
            $add['likeid'] = '';
            $add['fotoid'] = $fotoid;
            $add['userid'] = $userid;
            $add['tanggallike'] = date('Y-m-d');
    
            // Panggil fungsi tambahKomentar dari model
            $this->MSudi->AddData('likefoto', $add);
    
            // Redirect to the homepage or any other desired page
            redirect('Welcome/beranda');
        } else {
            // If the user has already liked the photo, remove the like (unlike)
            $this->MSudi->DeleteData('likefoto', 'fotoid', $fotoid, $userid);
    
            // Redirect to the homepage or any other desired page
            redirect('Welcome/beranda');
        }
    }
    
    
}