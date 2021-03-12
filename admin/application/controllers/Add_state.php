<?php

class Add_state extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        if ($this->session->userdata('username')) {
            
        } else {
            redirect(base_url(index));
        }
    }

    public function index() {

        $this->load->model('HomeModel');
        $data['country'] = $this->HomeModel->fetch_country();
        $data['state'] = $this->HomeModel->fetch_state_data();
        $this->load->view('states', $data);
    }

    function InsertState() {

        $this->load->model('HomeModel');
        $action = $this->input->post('action');
        //Add Business
        if ($action == 'add') {

//Get Records
            $country_id = $this->input->post('country_id');
            $state_name = $this->input->post('state_name');

            $this->HomeModel->Insertstate($country_id, $state_name);
            redirect(base_url(add_state));
            //Edit Business
        } else if ($action == 'edit') {


            $id = $this->input->post("id");

            $data = array(
                "country_id" => $this->input->post('country_id'),
                "state_name" => $this->input->post('state_name')
            );
            $this->HomeModel->update_state_data($data, $id);
            redirect(base_url(add_state));
        }
    }

    public function update_data() {
        $id = $this->uri->segment(3);
        $this->load->model('HomeModel');
        $data['edit_state'] = $this->HomeModel->update_state($id);
        $data['country'] = $this->HomeModel->fetch_country();
        $data['state'] = $this->HomeModel->fetch_state_data();
        $this->load->view('states', $data);
    }

    public function delete_data() {
        $id = $this->uri->segment(3);

        $this->load->model('HomeModel');

        $this->HomeModel->delete_state($id);
        redirect(base_url(Add_state));
    }


}

?>