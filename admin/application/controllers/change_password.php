<?php

class change_password extends CI_Controller {

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

        $this->load->model('HomeModel');
        $this->load->view('change_pass');
    }

    function update_password() {
        $this->load->model('HomeModel');
        $data = array(
            "password" => md5($this->input->post('new')),
        );
        $this->HomeModel->update_pass($data, $this->input->post('change'));
        if ($this->HomeModel->update_pass($data,$this->input->post('change')) == true) {
            echo '1';
        } else {
            echo '0';
        }
     
    }

    function check_pass() {
        $old_pwd = md5($this->input->post('old'));
        $username = $this->input->post('id');
        $que = $this->db->query("select * from admin where username='$username'");
        $row = $que->row();
        $pass = $row->password;
        if ($pass == $old_pwd) {
            echo "1";
        } else {
            echo "0";
        }
    }

}

?>