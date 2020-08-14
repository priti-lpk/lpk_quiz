<?php

class Add_country extends CI_Controller {

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
        $data['country'] = $this->HomeModel->fetch_country_data();
        $this->load->view('countries', $data);
    }

    //Check submit button 
    function InsertCountry() {

        $this->load->model('HomeModel');
        $action = $this->input->post('action');
        //Add Business
        if ($action == 'add') {

//Get Records
            $cname = $this->input->post('cname');
//            call saverecords method of Hello_Model and pass variables as parameter
            $this->HomeModel->Insertcountry($cname);
            redirect(base_url(add_country));
            //Edit Business
        } else if ($action == 'edit') {
            //image upload in folder
            $id = $this->input->post("id");
            $data = array(
                "cname" => $this->input->post('cname')
            );
            $this->HomeModel->update_country_data($data, $this->input->post("id"));
            redirect(base_url(add_country));
        }
    }

    public function update_data() {
        $id = $this->uri->segment(3);
        $this->load->model('HomeModel');
        $data['edit_country'] = $this->HomeModel->update_country($id);
        $data['country'] = $this->HomeModel->fetch_country_data();
        $this->load->view('countries', $data);
    }

    public function delete_data() {
        $id = $this->uri->segment(3);
        $this->load->model('HomeModel');
        $this->HomeModel->delete_country($id);
        redirect(base_url(add_country));
    }

}

?>