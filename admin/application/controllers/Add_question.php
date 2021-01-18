<?php

class Add_question extends CI_Controller {

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
        $this->load->model('question');

        $data['all_data'] = $this->question->fetch_data();
        $data['tag'] = $this->question->get_tag();
        $data['main_category'] = $this->question->fetch_main_category_data();
        $data['sub_category'] = $this->question->fetch_sub_category_data();
        $data['countries'] = $this->question->fetch_country();
        $this->load->view('add_question', $data);
    }

    //Check submit button 
    function InsertQuestion() {

        $this->load->model('question');
        $action = $this->input->post('action');
        //Add Business
        if ($action == 'add') {
            $filename = $_FILES["image"]["name"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $data = $this->question->getquestionLastId();
            $image = (($data[0]->id) + 1) . "." . $ext;
            $config['upload_path'] = './Images/question/'; //The path where the image will be save
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; //Images extensions accepted
            $config['file_name'] = $image;
            $this->load->library('upload', $config); //Load the upload CI library
            $this->upload->overwrite = true; //image overwrite
            if (!$this->upload->do_upload('image')) {
                $uploadError = array('upload_error' => $this->upload->display_errors());
            }
//Get Records
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
//            call saverecords method of Hello_Model and pass variables as parameter
            $this->question->Insertquestion($data);
            redirect(base_url(Add_question));
            //Edit Business
        } else if ($action == 'edit') {
            //image upload in folder
            $id = $this->input->post("id");
            if ($_FILES['image']['name']) {
                $filename = $_FILES["image"]["name"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $image = ($id) . "." . $ext;
                $config['upload_path'] = './Images/question/'; //The path where the image will be save
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; //Images extensions accepted
                $config['file_name'] = $image;
                $this->load->library('upload', $config); //Load the upload CI library
                $this->upload->overwrite = true; //image overwrite
                if (!$this->upload->do_upload('image')) {
                    $uploadError = array('upload_error' => $this->upload->display_errors());
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
                redirect(base_url(Add_question));
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
                redirect(base_url(add_question));
            }
        }
    }

    public function update_data() {
        $id = $this->uri->segment(3);
        $this->load->model('question');
        $data = $this->question->update_question($id);
        $data['edit_question'] = $this->question->update_question($id);
        $data['all_data'] = $this->question->fetch_data();
        $data['tag'] = $this->question->get_tag();
        $data['main_category'] = $this->question->fetch_main_category_data();
        $data['sub_category'] = $this->question->fetch_sub_category_data1($id);
        $data['countries'] = $this->question->fetch_country();
        $county_id = $data[0]['country_id'];
        $data['update_state'] = $this->question->update_state($county_id);
        $this->load->view('add_question', $data);
    }

    public function delete_data() {
        $id = $this->uri->segment(3);
        $this->load->model('question');
        $query_get_image = $this->db->get_where('question_master', array('id' => $id));
        foreach ($query_get_image->result() as $record) {
            // delete file, if exists...
            $filename = "./Images/question/" . $record->image;
            if (file_exists($filename)) {
                unlink($filename);
            }
            $this->question->delete_question($id);
            redirect(base_url(Add_question));
        }
    }

    public function get_scat() {

        $this->load->model('question');
        $main_cat_id = $this->input->post('main_cat_id');

        $val = $this->question->getscat($main_cat_id);
        $output = '<select class="form-control select2 chosen" name="sub_cat_id" id="sub_cat_id" required="">';
        $output .= '<option>Select Sub Category</option>';
        foreach ($val as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->sub_cat_name . '</option>';
        }
        $output .= '</select>';
        echo $output;
    }

    public function getstate() {

        $this->load->model('question');
        $countries = $this->input->post('countries');

        $val = $this->question->get_state($countries);
        $output = '<select name = "state_id" id = "states" class = "form-control select2 chosen" required>';
        $output .= '<option>Select State</option>';
        foreach ($val as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->state_name . '</option>';
        }
        $output .= '</select>';
        echo $output;
    }

}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.chosen').select2();
    });
</script>