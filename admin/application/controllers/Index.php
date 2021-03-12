<?php

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {

        $this->load->view('index');
    }

    function verifyUser() {

        $username = $this->input->post('user_username');
        $password = md5($this->input->post('user_pass'));

        $this->load->model('LoginModel');

        if ($this->LoginModel->Loginn($username, $password)) {
            $this->session->set_userdata('username', $username);
            redirect(base_url('Index/dashboard'));
        } else {

            $data = array(
                'msg' => 'Authentication Fail!'
            );
            $this->session->set_flashdata('msg', 'Authentication Fail!');
            redirect(base_url('Index'));
        }
    }

    public function dashboard() {
        $this->load->view('Dashboard');
    }

//    public function check_question() {
//        $this->load->model('question');
//        $add_question = $this->input->post('add_question');
//        $id = $this->input->post('main_cat');
//        $data = $this->question->quest_valid($add_question, $id);
//        if ($this->question->quest_valid($add_question, $id) == true) {
//            echo "0";
//        } else {
//            echo "1";
//        }
//    }

    public function check_question() {
        $this->load->model('question');
        $add_question = $this->input->post('add_question');
        $id = $this->input->post('main_cat');
        $data = $this->question->quest_valid($add_question, $id);
        
        if ($this->question->quest_valid($add_question, $id) == 0) {
            echo "0";
        } else {
            echo "1";
        }
    }

}

?>