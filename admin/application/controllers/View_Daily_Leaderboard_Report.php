<?php

class View_Daily_Leaderboard_Report extends CI_Controller {

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
        $date = $date = date('Y-m-d');
        $data['Daily_Leaderboard'] = $this->api_quiz->View_Daily_Leaderboard_Report($date);
        $this->load->view('Daily_Leaderboard', $data);
    }

}

?>