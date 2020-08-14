<?php

class Add_tag extends CI_Controller {

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
        $data['tag'] = $this->HomeModel->fetch_tag_data();
        $this->load->view('tag_list', $data);
    }

    //Check submit button 
    function InsertTag() {

        $this->load->model('HomeModel');
        $action = $this->input->post('action');
        //Add Business
        if ($action == 'add') {

//Get Records
            $tag_name = $this->input->post('tag_name');
//            call saverecords method of Hello_Model and pass variables as parameter
            $this->HomeModel->Inserttag($tag_name);
            redirect(base_url(add_tag));
            //Edit Business
        } else if ($action == 'edit') {
            //image upload in folder
            $id = $this->input->post("id");
            $data = array(
                "tag_name" => $this->input->post('tag_name')
            );
            $this->HomeModel->update_tag_data($data, $this->input->post("id"));
            redirect(base_url(add_tag));
        }
    }

    public function update_data() {
        $id = $this->uri->segment(3);
        $this->load->model('HomeModel');
        $data['edit_tag'] = $this->HomeModel->update_tag($id);
        $data['tag'] = $this->HomeModel->fetch_tag_data();
        $this->load->view('tag_list', $data);
    }

    public function delete_data() {
        $id = $this->uri->segment(3);
        $this->load->model('HomeModel');
        $this->HomeModel->delete_tag($id);
        redirect(base_url(add_tag));
    }

}

?>