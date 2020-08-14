<?php

class View_user extends CI_Controller {

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
//
        $data['all_data'] = $this->question->fetch_user_data();
//        $data['tag'] = $this->question->get_tag();
//        $data['main_category'] = $this->question->fetch_main_category_data();
//        $data['sub_category'] = $this->question->fetch_sub_category_data();
//        $data['countries'] = $this->question->fetch_country();
        $this->load->view('view_user', $data);
    }

}

?>