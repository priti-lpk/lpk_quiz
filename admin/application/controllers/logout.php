<?php

class logout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
    }

    function logoutt() {
        $username =$this->session->userdata('username');
        echo $username;
        $this->session->unset_userdata($username);
        $this->session->sess_destroy();
        redirect(base_url(index));
    }

}

?>