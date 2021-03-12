<?php

class View_Monthly_Leaderboard_Report extends CI_Controller {

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
        $this->load->model('api_quiz');
        $month = date('m');
        $year = date('Y');
        $data['Monthly_Leaderboard'] = $this->api_quiz->View_Monthly_Leaderboard_Report($month, $year);
        $this->load->view('Monthly_Leaderboard', $data);
    }

}

?>