<?php

class View_Yearly_Leaderboard_Report extends CI_Controller {

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
        $year = date('Y');
        $data['Yearly_Leaderboard'] = $this->api_quiz->View_Yearly_Leaderboard_Report($year);
        $this->load->view('Yearly_Leaderboard', $data);
    }

}

?>