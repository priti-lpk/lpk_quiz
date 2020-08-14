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

        $this->load->model('LoginModel');

        $user_username = $this->input->post('user_username');
        $user_pass = $this->input->post('user_pass');
        $data = $this->LoginModel->Loginn($user_username, $user_pass);
//        print_r($this->db->select('*')->from('add_newuser')->where("user=$user_username,pass=$user_pass"));



        if ($this->LoginModel->Loginn($user_username, $user_pass)) {
            $data = array(
                'user_logged_in' => TRUE,
                'user_id' => $data[0]['id'],
                'user_name' => $data[0]['user']);

            $this->session->set_userdata($data);
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