<?php

//The first letter of the class(Controller Name) is always Capital. like Add_question
class Add_question extends CI_Controller {

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
        $this->load->model('question');
        //Get Data 
        $data['all_data'] = $this->question->fetch_data();
        $data['tag'] = $this->question->get_tag();
        $data['main_category'] = $this->question->fetch_main_category_data();
        $data['sub_category'] = $this->question->fetch_sub_category_data();
        $data['countries'] = $this->question->fetch_country();
        $this->load->model('HomeModel');
        $data['setting'] = $this->HomeModel->get_setting();
        $this->load->view('add_question', $data);
    }

    function InsertQuestion() {
        //Insert Question
        //Load Model
        $this->load->model('question');
        $action = $this->input->post('action');
        //Add Question
        if ($action == 'add') {
            if ($_FILES["image"]["name"]) {
                $filename = $_FILES["image"]["name"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data = $this->question->getquestionLastId(); //Get Last Id
                if (!empty($data)) {
                    $image = (($data[0]->id) + 1) . "." . $ext; //Rename Image
                } else {
                    $image = 1 . "." . $ext; //Rename Image
                }

                $tpath1 = './Images/question/' . $image;
                if ($ext != 'png') {

                    $pic1 = $this->compress_image($_FILES["image"]["tmp_name"], $tpath1, 80);
                } else {
                    $tmp = $_FILES['image']['tmp_name'];
                    move_uploaded_file($tmp, $tpath1);
                }
                //Get Records
                $data = array(
                    'main_cat_id' => $this->input->post('main_cat_id'),
                    'sub_cat_id' => $this->input->post('sub_cat_id'),
                    'country_id' => $this->input->post('country_id'),
                    'state_id' => $this->input->post('state_id'),
                    "image" => $image,
                    'tag_id' => implode(",", $this->input->post('tag_id')),
                    'question' => $this->input->post('question'),
                    'option_a' => $this->input->post('option_a'),
                    'option_b' => $this->input->post('option_b'),
                    'option_c' => $this->input->post('option_c'),
                    'option_d' => $this->input->post('option_d'),
                    'answer' => $this->input->post('answer'),
                    'user' => $this->input->post('user'),
                    'type' => $this->input->post('type')
                );
            } else {
                $data = array(
                    'main_cat_id' => $this->input->post('main_cat_id'),
                    'sub_cat_id' => $this->input->post('sub_cat_id'),
                    'country_id' => $this->input->post('country_id'),
                    'state_id' => $this->input->post('state_id'),
                    'tag_id' => implode(",", $this->input->post('tag_id')),
                    'question' => $this->input->post('question'),
                    'option_a' => $this->input->post('option_a'),
                    'option_b' => $this->input->post('option_b'),
                    'option_c' => $this->input->post('option_c'),
                    'option_d' => $this->input->post('option_d'),
                    'answer' => $this->input->post('answer'),
                    'user' => $this->input->post('user'),
                    'type' => $this->input->post('type')
                );
            }
            //call saverecords method question and pass variables as parameter
            $this->question->Insertquestion($data);
            redirect(base_url('Add_question'));
            //Edit Question
        } else if ($action == 'edit') {
            //image upload in folder
            $id = $this->input->post("id");
            if ($_FILES['image']['name']) {
                $filename = $_FILES["image"]["name"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $image = ($id) . "." . $ext;
                $tpath1 = './Images/question/' . $image;
                if ($ext != 'png') {
                    $pic1 = $this->compress_image($_FILES["image"]["tmp_name"], $tpath1, 80);
                } else {
                    $tmp = $_FILES['image']['tmp_name'];
                    move_uploaded_file($tmp, $tpath1);
                }
                $data = array(
                    "main_cat_id" => $this->input->post('main_cat_id'),
                    "sub_cat_id" => $this->input->post('sub_cat_id'),
                    "country_id" => $this->input->post('country_id'),
                    "state_id" => $this->input->post('state_id'),
                    "image" => $image,
                    "tag_id" => implode(",", $this->input->post('tag_id')),
                    "question" => $this->input->post('question'),
                    "option_a" => $this->input->post('option_a'),
                    "option_b" => $this->input->post('option_b'),
                    "option_c" => $this->input->post('option_c'),
                    "option_d" => $this->input->post('option_d'),
                    "answer" => $this->input->post('answer'),
                    "user" => $this->input->post('user'),
                    'type' => $this->input->post('type')
                );
                $this->question->update_question_master($data, $this->input->post("id"));
                redirect(base_url('Add_question'));
            } else {
                $data = array(
                    "main_cat_id" => $this->input->post('main_cat_id'),
                    "sub_cat_id" => $this->input->post('sub_cat_id'),
                    "country_id" => $this->input->post('country_id'),
                    "state_id" => $this->input->post('state_id'),
                    "tag_id" => implode(",", $this->input->post('tag_id')),
                    "question" => $this->input->post('question'),
                    "option_a" => $this->input->post('option_a'),
                    "option_b" => $this->input->post('option_b'),
                    "option_c" => $this->input->post('option_c'),
                    "option_d" => $this->input->post('option_d'),
                    "answer" => $this->input->post('answer'),
                    "user" => $this->input->post('user'),
                    'type' => $this->input->post('type')
                );
                $this->question->update_question_master($data, $this->input->post("id"));
                redirect(base_url('add_question'));
            }
        }
    }

    public function update_data() {
        //Update Question Data
        $id = $this->uri->segment(3); //Id
        //Load Model
        $this->load->model('question');
        //Get data
        $data = $this->question->update_question($id);
        $data['edit_question'] = $this->question->update_question($id);
        $data['all_data'] = $this->question->fetch_data();
        $data['tag'] = $this->question->get_tag();
        $data['main_category'] = $this->question->fetch_main_category_data();
        $data['sub_category'] = $this->question->fetch_sub_category_data1($id);
        $data['countries'] = $this->question->fetch_country();
        $county_id = $data[0]['country_id'];
        $data['update_state'] = $this->question->update_state($county_id);
        $this->load->model('HomeModel');
        $data['setting'] = $this->HomeModel->get_setting();
        $this->load->view('add_question', $data);
    }

    public function delete_data() {
        //Delete Question
        $id = $this->uri->segment(3); //id
        //load model
        $this->load->model('question');
        //get image
        $query_get_image = $this->db->get_where('question_master', array('id' => $id));
        foreach ($query_get_image->result() as $record) {
            if (!empty($record->image)) {
                // delete file, if exists...
                $filename = "./Images/question/" . $record->image;
                if (file_exists($filename)) {
                    unlink($filename);
                }
            }
            $this->question->delete_question($id);
        }
        redirect(base_url('Add_question'));
    }

    public function get_scat() {
        //load model
        $this->load->model('question');
        $main_cat_id = $this->input->post('main_cat_id');
        //get sub category
        $val = $this->question->getscat($main_cat_id);
        
        $output = '<option>Select Sub Category</option>';
        foreach ($val as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->sub_cat_name . '</option>';
        }

        echo $output;
    }

    public function getstate() {
        //Load model
        $this->load->model('question');

        $countries = $this->input->post('countries');
        //get state
        $val = $this->question->get_state($countries);

        $output = '<option>Select State</option>';
        foreach ($val as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->state_name . '</option>';
        }

        echo $output;
    }

    function compress_image($source_url, $destination_url, $quality) {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_url);
        imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }

    public function __destruct() {
        $this->db->close();
    }

}

?>