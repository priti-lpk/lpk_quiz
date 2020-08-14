<?php

class View_quiz_schedule extends CI_Controller {

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
        $data['view_quize1'] = $this->question->fetch_quize_schedule($sid, $mid);
        $data['view_quize2'] = $this->question->fetch_quize1_schedule($mid);
        $this->load->view('view_quiz_schedule', $data);
    }
}

?>