<?php

class Add_sub_category extends CI_Controller {

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
        $data['main_category'] = $this->HomeModel->fetch_sub_main_category_data();
        $data['sub_category'] = $this->HomeModel->fetch_sub_category_data();
        $this->load->view('sub_category', $data);
    }

    function InsertsubCategory() {

        $this->load->model('HomeModel');
        $action = $this->input->post('action');
        //Add Business
        if ($action == 'add') {
            // upload Image
            $filename = $_FILES["sub_image"]["name"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $data = $this->HomeModel->getSubCategoryLastId();
            $image = (($data[0]->id) + 1) . "." . $ext;
            $img = "sub/" . (($data[0]->id) + 1) . "." . $ext;

            $config['upload_path'] = './Images/sub/'; //The path where the image will be save
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; //Images extensions accepted
            $config['file_name'] = $image;
            $this->load->library('upload', $config); //Load the upload CI library
            $this->upload->overwrite = true; //image overwrite
            if (!$this->upload->do_upload('sub_image')) {
                $uploadError = array('upload_error' => $this->upload->display_errors());
            }
//Get Records
            $main_cat_id = $this->input->post('main_cat_id');
            $sub_cat_name = $this->input->post('sub_cat_name');
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

            //            call saverecords method of Hello_Model and pass variables as parameter
            $this->HomeModel->InsertSubcategory($main_cat_id, $sub_cat_name, $img, $status);
            redirect(base_url(add_sub_category));
            //Edit Business
        } else if ($action == 'edit') {
            if ($_FILES['sub_image']['name']) {

                $id = $this->input->post("id");
                $filename = $_FILES["sub_image"]["name"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data = $this->HomeModel->getSubCategoryLastId();
                $image = ($id) . "." . $ext;
                $img = "sub/" . ($id) . "." . $ext;

                $config['upload_path'] = './Images/sub/'; //The path where the image will be save
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; //Images extensions accepted
                $config['file_name'] = $image;
                $this->load->library('upload', $config); //Load the upload CI library
                $this->upload->overwrite = true; //image overwrite
                if (!$this->upload->do_upload('sub_image')) {
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
                    "main_cat_id" => $this->input->post('main_cat_id'),
                    "sub_cat_name" => $this->input->post('sub_cat_name'),
                    "status" => $status,
                    "sub_image" => $img,
                );
                $this->HomeModel->update_sub_category($data, $id);
                redirect(base_url(add_sub_category));
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
                    "main_cat_id" => $this->input->post('main_cat_id'),
                    "sub_cat_name" => $this->input->post('sub_cat_name'),
                    "status" => $status
                );
                $this->HomeModel->update_sub_category($data, $id);
                redirect(base_url(add_sub_category));
            }
        }
    }

    public function update_sub_category() {
        $id = $this->uri->segment(3);
        $this->load->model('HomeModel');
        $data['subcategory_edit_data'] = $this->HomeModel->update_subcategory_data($id);
        $data['main_category'] = $this->HomeModel->fetch_sub_main_category_data();
        $data['sub_category'] = $this->HomeModel->fetch_sub_category_data();
        $this->load->view('sub_category', $data);
    }

    public function delete_sub_categoty() {
        $id = $this->uri->segment(3);

        $this->load->model('HomeModel');
        $query_get_image = $this->db->get_where('sub_category', array('id' => $id));
        foreach ($query_get_image->result() as $record) {

            // delete file, if exists...
            $filename = "./Images/" . $record->sub_image;
            echo $filename;
            if (file_exists($filename)) {
                unlink($filename);
            }
            $this->HomeModel->delete_sub_cat($id);
            redirect(base_url(add_sub_category));
        }
    }

    public function change_status() {
        $id = $this->input->post("cid");

        $this->load->model('HomeModel');
        $data = array(
            "status" => $this->input->post('status'),
        );

        $this->HomeModel->update_sub_cat_status($data, $id);
    }

}

?>