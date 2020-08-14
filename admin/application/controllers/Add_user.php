<?php

class Add_user extends CI_Controller {

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
//        $data = array();
//        $users = $this->HomeModel->fetch_user_data();
//        print_r($users);
//        $data['sub_cat_name'] = $users['sub_cat_name'];
//
//        $data['sub_data'] = $users['sub_data'];

        $data['user_data'] = $this->HomeModel->fetch_user_data();
        $data['main_category'] = $this->HomeModel->fetch_user_main_category_data();
        $data['sub_category'] = $this->HomeModel->fetch_user_sub_category_data();
        $this->load->view('add_user', $data);
    }

    //Check submit button 
    function InsertUser() {

        $this->load->model('HomeModel');
        $action = $this->input->post('action');
        //Add Business
        if ($action == 'add') {
            //Get Records
            $main_cat_id = $this->input->post('main_cat_id');
            $sub_cat_id = implode(",", $this->input->post('sub_cat_id'));
            $user = $this->input->post('user');
            $pass = $this->input->post('pass');
//            call saverecords method of Hello_Model and pass variables as parameter
            $this->HomeModel->Insertuser($user, $pass, $main_cat_id, $sub_cat_id);
            redirect(base_url(add_user));
            //Edit Business
        } else if ($action == 'edit') {

            $sub_cat_id = implode(",", $this->input->post('sub_cat_id'));

            //image upload in folder
            $id = $this->input->post("id");
            $data = array(
                "user" => $this->input->post('user'),
                "pass" => $this->input->post('pass'),
                "main_cat_id" => $this->input->post('main_cat_id'),
                "sub_cat_id" => $sub_cat_id
            );

            $this->HomeModel->update_user_data($data, $this->input->post("id"));
            redirect(base_url(add_user));
        }
    }

    public function update_data() {
        $id = $this->uri->segment(3);
        $this->load->model('HomeModel');
        $data['$user_data'] = $this->HomeModel->fetch_user_data();
//        $data = array();
//        $users = $this->HomeModel->fetch_user_data();
//        print_r($users);
//        $data['sub_cat_name'] = $users['sub_cat_name'];
//
//        $data['sub_data'] = $users['sub_data'];
        $data['edit_user'] = $this->HomeModel->update_user($id);
        $data['user_data'] = $this->HomeModel->fetch_user_data();
        $data['main_category'] = $this->HomeModel->fetch_user_main_category_data();
        $data['sub_category'] = $this->HomeModel->fetch_user_sub_category_data();
        $this->load->view('add_user', $data);
    }

    public function delete_data() {
        $id = $this->uri->segment(3);
        $this->load->model('HomeModel');
        $this->HomeModel->delete_user($id);
        redirect(base_url(add_user));
    }

    public function get_scat() {

        $this->load->model('HomeModel');
        $main_cat_id = $this->input->post('main_cat_id');

        $val = $this->HomeModel->getscat($main_cat_id);
        $output = '<select name="sub_cat_id[]" id="sub_list" class="form-control select2 chosen" multiple="multiple" data-placeholder="Choose ...">';

        foreach ($val as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->sub_cat_name . '</option>';
        }
        $output .= '</select>';
        echo $output;
    }

}

?>
