<?php

class Quiz_schedule extends CI_Controller {

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
        $data['country'] = $this->question->fetch_country();
        $data['main_category'] = $this->question->fetch_main_category();
        $data['sub_category'] = $this->question->fetch_sub_category();
        $this->load->view('quiz_schedule', $data);
    }

    //Check submit button 
    function InsertSchedule() {

        $this->load->model('question');
        $action = $this->input->post('action');
        //Add Business
        if ($action == 'add') {

//Get Records
            $data = array(
                'title' => $this->input->post('title'),
                'schedule_date' => $this->input->post('schedule_date'),
                'country_id' => $this->input->post('country_id'),
                'state_id' => $this->input->post('state_id'),
                'main_cat_id' => $this->input->post('main_cat_id'),
                'sub_cat_id' => $this->input->post('sub_cat_id'),
                'description' => $this->input->post('description')
            );
//            call saverecords method of Hello_Model and pass variables as parameter
            $this->question->Insertschedule($data);
            redirect(base_url(Quiz_schedule));
            //Edit Business
        } else if ($action == 'edit') {
            //image upload in folder
            $id = $this->input->post("id");
            $data = array(
                "title" => $this->input->post('title'),
                "schedule_date" => $this->input->post('schedule_date'),
                "country_id" => $this->input->post('country_id'),
                "state_id" => $this->input->post('state_id'),
                "main_cat_id" => $this->input->post('main_cat_id'),
                "sub_cat_id" => $this->input->post('sub_cat_id'),
                "description" => $this->input->post('description')
            );
            $this->question->update_schedule_data($data, $this->input->post("id"));
            redirect(base_url(Quiz_schedule));
        }
    }

    public function update_data() {
        $id = $this->uri->segment(3);
        $this->load->model('question');
        $data = $this->question->update_schedule($id);
        $data['edit_schedule'] = $this->question->update_schedule($id);
        $data['country'] = $this->question->fetch_country();
        $data['main_category'] = $this->question->fetch_main_category();
        $data['sub_category'] = $this->question->fetch_sub_category();
        $county_id = $data[0]['country_id'];
        $data['update_state'] = $this->question->update_state($county_id);
        $this->load->view('quiz_schedule', $data);
    }

    public function delete_data() {
        $id = $this->uri->segment(3);
        $this->load->model('question');
        $this->question->delete_schedule($id);
        redirect(base_url(View_quiz_schedule));
    }

}

?>