<?php

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');

        if ($this->session->userdata('username')) {
            
        } else {
            redirect(base_url('index'));
        }
    }

    public function index() {
        $this->load->model('LoginModel'); //load model

        $data['site_setting'] = $this->LoginModel->fetch_site_data();
        $this->load->model('HomeModel'); //load model
        $data['setting'] = $this->HomeModel->get_setting();
        $this->load->view('setting', $data); //view with data
    }

    public function InsertSetting() {
        $this->load->model('LoginModel'); //load model
        if ($this->input->post('rtl_ltr')) {
            $status = $this->input->post('rtl_ltr');
            if (isset($status) == "on") {

                $status = "rtl";
            } else {

                $status = "ltr";
            }
        } else {
            $status = "ltr";
        }
        if ($_FILES["image"]["name"]) {
            $filename = $_FILES["image"]["name"];
            $img = "logo/" . $filename; //Rename Image
            $config['upload_path'] = './Images/logo/'; //The path where the image will be save
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; //Images extensions accepted
            $config['file_name'] = $filename;
            $this->load->library('upload', $config); //Load the upload CI library
            $this->upload->overwrite = true; //image overwrite
            if (!$this->upload->do_upload('image')) {
                $uploadError = array('upload_error' => $this->upload->display_errors());
            }

            $record = array(
                "title" => $this->input->post('title'),
                "description" => $this->input->post('description'),
                "company_name" => $this->input->post('company_name'),
                "contact" => $this->input->post('contact'),
                "address" => $this->input->post('address'),
                "email" => $this->input->post('email'),
                "rtl_ltr" => $status,
                "image" => $img
            );
        } else {
            $record = array(
                "title" => $this->input->post('title'),
                "description" => $this->input->post('description'),
                "company_name" => $this->input->post('company_name'),
                "contact" => $this->input->post('contact'),
                "address" => $this->input->post('address'),
                "email" => $this->input->post('email'),
                "rtl_ltr" => $status
            );
        }
        //call saverecords method of HomeModel and pass variables as parameter
        $this->LoginModel->InsertSetting($record);
        redirect(base_url('setting'));
    }

    public function EditSetting() {
        $this->load->model('LoginModel'); //load model
         if ($this->input->post('rtl_ltr')) {
            $status = $this->input->post('rtl_ltr');
            if (isset($status) == "on") {

                $status = "rtl";
            } else {

                $status = "ltr";
            }
        } else {
            $status = "ltr";
        }
        if ($_FILES["image"]["name"]) {
            $filename = $_FILES["image"]["name"];
            $img = "logo/" . $filename; //Rename Image
            $config['upload_path'] = './Images/logo/'; //The path where the image will be save
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; //Images extensions accepted
            $config['file_name'] = $filename;
            $this->load->library('upload', $config); //Load the upload CI library
            $this->upload->overwrite = true; //image overwrite
            if (!$this->upload->do_upload('image')) {
                $uploadError = array('upload_error' => $this->upload->display_errors());
            }
            $record = array(
                "title" => $this->input->post('title'),
                "description" => $this->input->post('description'),
                "company_name" => $this->input->post('company_name'),
                "contact" => $this->input->post('contact'),
                "address" => $this->input->post('address'),
                "email" => $this->input->post('email'),
                "rtl_ltr" => $status,
                "image" => $img
            );
        } else {
            $record = array(
                "title" => $this->input->post('title'),
                "description" => $this->input->post('description'),
                "company_name" => $this->input->post('company_name'),
                "contact" => $this->input->post('contact'),
                "address" => $this->input->post('address'),
                "email" => $this->input->post('email'),
                "rtl_ltr" => $status,
            );
        }
        $id = $this->input->post('id');
        $this->LoginModel->updateSetting($record, $id);
        redirect(base_url('setting'));
    }

}
