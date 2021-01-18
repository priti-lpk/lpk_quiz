<?php

class Add_question_csv extends CI_Controller {

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
        $this->load->view('csv_question');
    }

//Check submit button 
    function InsertQuestion() {
        $this->load->model('Question_csv');
        if ($this->input->post('upload') != NULL) {
            $data = array();
            if (!empty($_FILES['file']['name'])) {
//                print_r($_FILES['file']['name']);
                $config['upload_path'] = 'csv_file/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000'; // max_size in kb 
                $config['file_name'] = $_FILES['file']['name'];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    $file = fopen("csv_file/" . $filename, "r");
                    $i = 0;
                    $numberOfFields = 16; // Total number of fields
                    $importData_arr = array();

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
//                        print_r($filedata);
                        $num = count($filedata);
//                        print_r($num);
                        if ($numberOfFields == $num) {
                            for ($c = 0; $c < $num; $c++) {
                                $importData_arr[$i][] = $filedata [$c];
                            }
                        }
                        $i++;
                    }
                    fclose($file);

                    $skip = 0;
//                    print_r($importData_arr);
                    foreach ($importData_arr as $userdata) {
//                        print_r($userdata);
                        if ($skip != 0) {
                            $this->Question_csv->insertRecord($userdata);
                        }
                        $skip ++;
                    }
                    $data['response'] = 'successfully uploaded ' . $filename;
                } else {
                    $data['response'] = 'failed';
                }
            } else {
                $data['response'] = 'failed';
            }
// load view 
//            print_r($data);
            $this->load->view('csv_question');
        } else {
// load view 
            $this->load->view('csv_question');
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