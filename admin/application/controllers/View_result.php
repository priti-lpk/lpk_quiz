<?php

class View_result extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
//         $this->load->model('HomeModel');
        if ($this->session->userdata('username')) {
            
        } else {
            redirect(base_url(index));
        }
    }

    public function index() {
        $this->load->model('question');
        $data['result'] = $this->question->fetch_result();
        $this->load->view('view_result', $data);
    }

}

?>