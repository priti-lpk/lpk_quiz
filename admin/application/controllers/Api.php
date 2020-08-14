<?php

class Api extends CI_Controller {

    public function index() {
        $request_auth = getallheaders();
        if (!empty($request_auth['Authorization'])) {
            if (!isset($_POST['username'])) {
                $response['status'] = false;
                $response['message'] = "Unknown user request";
                echo json_encode($response);
                die();
            }
            if (!isset($_POST['name'])) {
                $response['status'] = false;
                $response['message'] = "Unknown request";
                echo json_encode($response);
                die();
            }
            $tmp = $this->Auth($_POST['name'], $_POST['username']);
            if (!$tmp) {
                $response['status'] = false;
                $response['message'] = "Unauthorised request";
                echo json_encode($response);
                die();
            }
            if ($_POST['name'] == 'main_category') {
                $this->load->model('api_quiz');
                $datas = $this->api_quiz->main_category();
                $file = 'http://quiz.lpktechnosoft.com/admin/Images/';
                if ($datas) {
                    echo json_encode(array("status" => TRUE, "data" => $datas, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("msg" => "data not found"));
                }
                die();
            }
            // Get All Question....
            if ($_POST['name'] == 'all_question') {
                $this->load->model('api_quiz');
                $data = $this->api_quiz->all_question();
                $file = 'http://quiz.lpktechnosoft.com/admin/Images/question/';
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("msg" => "data not found"));
                }
                die();
            }
            // Get All Question with max selected answer...
            if ($_POST['name'] == 'count_selected_answer') {
                $this->load->model('api_quiz');
                $data = $this->api_quiz->count_selected_answer();
                $file = 'http://quiz.lpktechnosoft.com/admin/Images/question/';
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("msg" => "data not found"));
                }
                die();
            }
            // Get All Country...
            if ($_POST['name'] == 'country') {
                $this->load->model('api_quiz');
                $datas = $this->api_quiz->country_state();
                if ($datas) {
                    echo json_encode(array("status" => TRUE, "data" => $datas, "msg" => "data get successfully"));
                } else {
                    echo json_encode(array("msg" => "data not found"));
                }
                die();
            }
            // Get All User...
            if ($_POST['name'] == 'view_user') {
                $this->load->model('api_quiz');
                $data = $this->api_quiz->view_user();
                $file = 'http://quiz.lpktechnosoft.com/admin/Images/';
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("msg" => "data not found"));
                }
                die();
            }
            // Get User Result With Particular Main Category...
            if ($_POST['name'] == 'main_category_result') {
                $this->load->model('api_quiz');
                $main_cat_id = $_POST['main_cat_id'];
                $data = $this->api_quiz->main_category_result($main_cat_id);
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully"));
                } else {
                    echo json_encode(array("msg" => "data not found"));
                }
                die();
            }
            // Get User Result With Particular Main category & Sub category...
            if ($_POST['name'] == 'main_sub_question') {
                if (isset($_POST['main_cat_id'])) {
                    $this->load->model('api_quiz');
                    $main_cat_id = $_POST['main_cat_id'];
                    $data = $this->api_quiz->main_category_result($main_cat_id);
                    if ($data) {
                        echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully"));
                    } else {
                        echo json_encode(array("msg" => "data not found"));
                    }
                    die();
                } elseif (isset($_POST['sub_cat_id'])) {
                    $this->load->model('api_quiz');
                    $sub_cat_id = $_POST['sub_cat_id'];
                    $data = $this->api_quiz->sub_category_result($sub_cat_id);
                    if ($data) {
                        echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully"));
                    } else {
                        echo json_encode(array("msg" => "data not found"));
                    }
                    die();
                }
            }
            // Get user Quiz Result....
            if ($_POST['name'] == 'user_quiz_get') {
                $this->load->model('api_quiz');
                $data = $this->api_quiz->user_quiz_get();
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully"));
                } else {
                    echo json_encode(array("msg" => "data not found"));
                }
                die();
            }
            // Get random 10 question...
            if ($_POST['name'] == 'question_result') {
                $this->load->model('api_quiz');
                $data = $this->api_quiz->question_result();
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully"));
                } else {
                    echo json_encode(array("msg" => "data not foound"));
                }
                die();
            }
            // Insert User...
            if ($_POST['name'] == 'add_user') {
                unset($_POST['name']);
                $this->load->model('api_quiz');
                $username = $_POST['username'];
                $data = $this->api_quiz->get_user($username);
                if (isset($data[0]->username) == $_POST['username']) {
                    $record = array(
                        "username" => $this->input->post('username'),
                        "address" => $this->input->post('address'),
                        "mobile_no" => $this->input->post('mobile_no'),
                        "country_id" => $this->input->post('country_id'),
                        "state_id" => $this->input->post('state_id'),
                        "city" => $this->input->post('city'),
                        "image" => $_FILES["image"]["name"],
                        "display_name" => $this->input->post('display_name')
                    );
                    $result = $this->api_quiz->updateUser($record, $data[0]->id);
                    if ($result) {
                        echo json_encode(array("status" => TRUE, "id" => $data[0]->id, "msg" => "Data Update Successfully"));
                    } else {
                        echo json_encode(array("status" => FALSE, "msg" => "error"));
                    }
                } else {
                    $username = $this->input->post('username');
                    $address = $this->input->post('address');
                    $mobile_no = $this->input->post('mobile_no');
                    $country_id = $this->input->post('country_id');
                    $state_id = $this->input->post('state_id');
                    $city = $this->input->post('city');
                    $user_type = $this->input->post('user_type');
                    $image = $_FILES["image"]["name"];
                    $display_name = $this->input->post('display_name');
                    $lastID = $this->api_quiz->last_id();
                    $data = $this->api_quiz->InsertUser($username, $address, $mobile_no, $country_id, $state_id, $city, $user_type, $image, $display_name);
                    if ($data == true) {
                        echo json_encode(array("status" => TRUE, "id" => $lastID[0]->id + 1, "msg" => "Data Insert Successfully"));
                    } else {
                        echo json_encode(array("status" => FALSE, "msg" => "error"));
                    }
                }
                die();
            }
            //add user image
            if ($_POST['name'] == 'user_image') {
                $this->load->model('api_quiz');
                $image_name = "";
                $k = 1;
                $filename = $_FILES["image"]["name"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $imgefolder = "user/" . ($filename);
                $file = array("jpg", "jpeg", "png");
                move_uploaded_file($_FILES['image']['tmp_name'], 'Images/' . $imgefolder);
                if ($_FILES['image']['name']) {

                    $image = $imgefolder;
                } else {

                    $image = "";
                }

                $username = $_POST['username'];
                $data = $this->api_quiz->get_user($username);

                if (isset($data[0]->username) == $_POST['username']) {
                    $record = array(
                        "image" => $image
                    );

                    $result = $this->api_quiz->updateUserImage($record, $data[0]->id);
                    if ($result == true) {
                        echo json_encode(array("status" => TRUE, "id" => $data[0]->id, "ImageURL" => $image, "msg" => "Data Update Successfully"));
                    } else {
                        echo json_encode(array("status" => FALSE, "msg" => "error"));
                    }
                }
                die();
            }
            // Insert User Result...
            if ($_POST['name'] == 'store_result') {
                unset($_POST['name']);
                unset($_POST['username']);
                $this->load->model('api_quiz');
                $main_cat_id = $this->input->post('main_cat_id');
                $sub_cat_id = $this->input->post('sub_cat_id');
                $user_id = $this->input->post('user_id');
                $right_question = $this->input->post('right_question');
                $wrong_question = $this->input->post('wrong_question');
                $score = $this->input->post('score');
                $data = $this->api_quiz->Store_result($main_cat_id, $sub_cat_id, $user_id, $right_question, $wrong_question, $score);
                if ($data == true) {
                    echo json_encode(array("status" => TRUE, "msg" => "Data Insert Successfully"));
                } else {
                    echo json_encode(array("status" => FALSE, "msg" => "error"));
                }
                die();
            }
            //Insert User Quiz Question Answer...
            if ($_POST['name'] == 'user_answer') {

                unset($_POST['name']);
                unset($_POST['username']);
                $this->load->model('api_quiz');
                $question_id = $this->input->post('question_id');
                $user_id = $this->input->post('user_id');
                $selected_ans = $this->input->post('selected_ans');

                $data = $this->api_quiz->user_answer($question_id, $user_id, $selected_ans);
                if ($data == true) {
                    echo json_encode(array("status" => TRUE, "msg" => "Data Insert Successfully"));
                } else {
                    echo json_encode(array("status" => FALSE, "msg" => "error"));
                }
                die();
            }
        } else {
            $response['status'] = false;
            $response['message'] = "Unknown request";
            echo json_encode($response);
            die();
        }
    }

    function Auth($apiname, $username) {
        $request_auth = getallheaders();
        $request_auth = $request_auth['Authorization'];
        $Id = '260898';
        $jwt = hash('sha256', $Id . $apiname . $username);
        echo $jwt;
//$request_auth = 857b5bd1cf4b590032a9fb152a23c7f95c274b83f6554f2571c89dea9721db69
        if ($request_auth == $jwt) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>