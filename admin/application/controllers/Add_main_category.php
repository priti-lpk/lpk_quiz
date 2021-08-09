<?php

//The first letter of the class(Controller Name) is always Capital. like Add_main_category
class Add_main_category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        //Check the Session is start otherwise redirect to index page.
        if ($this->session->userdata('username')) {
            
        } else {
            redirect(base_url('index'));
        }
    }

    public function index() {
        //Load Model
        $this->load->model('HomeModel');
        //Get Main Category Data
        $data['main_category'] = $this->HomeModel->fetch_main_category_data();
        $data['setting'] = $this->HomeModel->get_setting();
        $this->load->view('main_category', $data);
    }

    function InsertmainCategory() {
        // Load Model
        $this->load->model('HomeModel');
        $action = $this->input->post('action');
        //Add Main Category Data
        if ($action == 'add') {
            if ($this->input->post('status')) {
                $status = $this->input->post('status');
                if (isset($status) == "on") {

                    $status = "1";
                } else {

                    $status = "0";
                }
            } else {
                $status = "0";
            }
            // upload Image
            $filename = $_FILES["main_image"]["name"];
            if ($_FILES["main_image"]["name"]) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data = $this->HomeModel->getCategoryLastId(); //Get Last Id

                if (!empty($data)) {
                    $image = (($data[0]->id) + 1) . "." . $ext;
                    $img = "main/" . (($data[0]->id) + 1) . "." . $ext; //Rename Image
                } else {
                    $image = (1) . "." . $ext;
                    $img = "main/" . (1) . "." . $ext; //Rename Image
                }
                $config['upload_path'] = './Images/main/'; //The path where the image will be save
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; //Images extensions accepted
                $config['file_name'] = $image;
                $this->load->library('upload', $config); //Load the upload CI library
                $this->upload->overwrite = true; //image overwrite
                if (!$this->upload->do_upload('main_image')) {
                    $uploadError = array('upload_error' => $this->upload->display_errors());
                }
                $record = array(
                    "main_cat_name" => $this->input->post('main_cat_name'),
                    "main_image" => $img,
                    "status" => $status
                );
            } else {
                $record = array(
                    "main_cat_name" => $this->input->post('main_cat_name'),
                    "status" => $status
                );
            }

            //Get Records
            $main_cat_name = $this->input->post('main_cat_name');


            //call saverecords method of HomeModel and pass variables as parameter
            $this->HomeModel->InsertMaincategory($record);
            redirect(base_url('add_main_category'));
            //Edit Main Category Data
        } else if ($action == 'edit') {

            if ($_FILES['main_image']['name']) {

                $id = $this->input->post("id");
                $filename = $_FILES["main_image"]["name"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data = $this->HomeModel->getCategoryLastId();
                $image = ($id) . "." . $ext;
                $img = "main/" . ($id) . "." . $ext; //Rename Image Name

                $config['upload_path'] = './Images/main/'; //The path where the image will be save
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; //Images extensions accepted
                $config['file_name'] = $image;
                $this->load->library('upload', $config); //Load the upload CI library
                $this->upload->overwrite = true; //image overwrite
                if (!$this->upload->do_upload('main_image')) {
                    $uploadError = array('upload_error' => $this->upload->display_errors());
                }
                if ($this->input->post('status')) {
                    $status = $this->input->post('status');
                    if (isset($status) == "on") {

                        $status = "1";
                    } else {

                        $status = "0";
                    }
                } else {
                    $status = "0";
                }
                $data = array(
                    "main_cat_name" => $this->input->post('main_cat_name'),
                    "status" => $status,
                    "main_image" => $img,
                );
                $res = $this->HomeModel->update_main_category($data, $id);
                redirect(base_url('add_main_category'));
            } else {
                $id = $this->input->post("id");
                if ($this->input->post('status')) {
                    $status = $this->input->post('status');
                    if (isset($status) == "on") {

                        $status = "1";
                    } else {

                        $status = "0";
                    }
                } else {
                    $status = "0";
                }
                $data = array(
                    "main_cat_name" => $this->input->post('main_cat_name'),
                    "status" => $status
                );
                $this->HomeModel->update_main_category($data, $id);
                redirect(base_url('add_main_category'));
            }
        }
    }

    public function update_main_category() {

        $id = $this->uri->segment(3); //Id
       
        //Load Model
        $this->load->model('HomeModel');
     //Get Update Data 
        $data['setting'] = $this->HomeModel->get_setting();
        $data['maincategory_edit_data'] = $this->HomeModel->update_maincategory_data($id);
        $data['main_category'] = $this->HomeModel->fetch_main_category_data();
        $this->load->view('main_category', $data);
    }

    public function delete_cat() {
        $id = $this->uri->segment(3); //Id
        //Load Model
        $this->load->model('HomeModel');
        //Get Image
        $query_get_image = $this->db->get_where('main_category', array('id' => $id));
        foreach ($query_get_image->result() as $record) {
            if (!empty($record->main_image)) {
                // delete file, if exists...
                $filename = "./Images/" . $record->main_image;

                if (file_exists($filename)) {
                    unlink($filename);
                }
            }
            $this->HomeModel->delete_category($id);
        }
        redirect(base_url('add_main_category'));
    }

    public function change_status() {
        //Update Main Category Status
        $id = $this->input->post("cid");
        //load model
        $this->load->model('HomeModel');
        //Record
        $data = array(
            "status" => $this->input->post('status'),
        );

        $this->HomeModel->update_main_cat_status($data, $id);
    }

    public function __destruct() {
        $this->db->close();
    }

}

?>