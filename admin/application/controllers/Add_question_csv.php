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

}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.chosen').select2();
    });
</script>