<?php

class View_category_question extends CI_Controller {

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

        $data['main_category'] = $this->question->fetch_main_category();
        $data['sub_category'] = $this->question->fetch_sub_category();
        $sid = $this->input->get('sub_cat_id');
        $mid = $this->input->get('main_cat_id');
        $data['view_question'] = $this->question->fetch_question($sid, $mid);
        $data['view_question1'] = $this->question->fetch_question1($mid);
        $this->load->view('view_category_question', $data);
    }

}

?>