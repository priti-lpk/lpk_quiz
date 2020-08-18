<?php

class Daily_mission extends CI_Controller {

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
        $this->load->model('Mission');
        $data['all_data'] = $this->Mission->fetch_data();
        $data['main_category'] = $this->Mission->fetch_main_category_data();
        $data['sub_category'] = $this->Mission->fetch_sub_category_data();
        $this->load->view('daily_mission', $data);
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

    function Insert_mission() {
        $this->load->model('Mission');
        $action = $this->input->post('action');
        if ($action == 'add') {
            $data = array(
                'main_cat_id' => $this->input->post('main_cat_id'),
                'sub_cat_id' => $this->input->post('sub_cat_id'),
                'time' => $this->input->post('time'),
                'score' => $this->input->post('score'),
            );
            $this->Mission->Insertmission($data);
            redirect(base_url(daily_mission));
        } else if ($action == 'edit') {
            $id = $this->input->post("id");

            $data = array(
                "main_cat_id" => $this->input->post('main_cat_id'),
                "sub_cat_id" => $this->input->post('sub_cat_id'),
                "time" => $this->input->post('time'),
                "score" => $this->input->post('score'),
            );
            $this->Mission->update_mission($data, $id);
            redirect(base_url(daily_mission));
        }
    }

    public function update_data($id) {
//        $id = $this->uri->segment(3);
        $this->load->model('Mission');
        $data = $this->Mission->update_dlymission($id);
        $data['edit_question'] = $this->Mission->update_dlymission($id);
        $data['all_data'] = $this->Mission->fetch_data();
        $data['main_category'] = $this->Mission->fetch_main_category_data();
        $data['sub_category'] = $this->Mission->fetch_sub_category_data1($id);
        $this->load->view('daily_mission', $data);
    }

    public function delete_data() {
        $id = $this->uri->segment(3);
        $this->load->model('Mission');
        $this->Mission->delete_mission($id);
        redirect(base_url(daily_mission));
    }

}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.chosen').select2();
    });
</script>