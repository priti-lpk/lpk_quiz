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
                $file = base_url('Images/');
                if ($datas) {
                    echo json_encode(array("status" => TRUE, "data" => $datas, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            // Get All Question....
            if ($_POST['name'] == 'all_question') {
                $this->load->model('api_quiz');

                $data = $this->api_quiz->all_question();
                $file = base_url('/Images/question/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            // Get All Question with max selected answer...
            if ($_POST['name'] == 'count_selected_answer') {
                $this->load->model('api_quiz');
                $data = $this->api_quiz->count_selected_answer();
                $file = base_url('Images/question/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
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
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            // Get All User...
            if ($_POST['name'] == 'view_user') {
                $this->load->model('api_quiz');
                $data = $this->api_quiz->view_user();
                $file = base_url('Images/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            // Get User Result With Particular Main Category...
            if ($_POST['name'] == 'main_category_result') {
                $this->load->model('api_quiz');
                $main_cat_id = $_POST['main_cat_id'];
                $limit = $_POST['limit'];
                $data = $this->api_quiz->main_category_result($main_cat_id, $limit);
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully"));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            // Get User Result With Particular Main category & Sub category...
            if ($_POST['name'] == 'main_sub_question') {
                if (isset($_POST['main_cat_id'])) {
                    $this->load->model('api_quiz');
                    $main_cat_id = $_POST['main_cat_id'];
                    $limit = $this->input->post('limit');
                    $data = $this->api_quiz->main_category_result($main_cat_id, $limit);
                    if ($data) {
                        echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully"));
                    } else {
                        echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                    }
                    die();
                } elseif (isset($_POST['sub_cat_id'])) {
                    $this->load->model('api_quiz');
                    $sub_cat_id = $_POST['sub_cat_id'];
                    $limit = $this->input->post('limit');
                    $data = $this->api_quiz->sub_category_result($sub_cat_id, $limit);
                    if ($data) {
                        echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully"));
                    } else {
                        echo json_encode(array("status" => TRUE, "msg" => "data not found"));
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
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            if ($_POST['name'] == 'view_mission') {
                $this->load->model('api_quiz');
                $data = $this->api_quiz->quiz_mission();
                $file = base_url('Images/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }

            if ($_POST['name'] == 'get_mission_question') {
                $this->load->model('api_quiz');
                $id = $this->input->post('mission_id');
                $data = $this->api_quiz->get_mission_question($id);
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
                    echo json_encode(array("status" => TRUE, "msg" => "data not foound"));
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
                    $result = $this->api_quiz->get_user($username);

                    if ($result) {
                        echo json_encode(array("status" => TRUE, "user_id" => $result[0]->id, "username" => $result[0]->username, "address" => $result[0]->address, "mobile_no" => $result[0]->mobile_no, "user_type" => $result[0]->user_type, "image" => $result[0]->image, "display_name" => $result[0]->display_name, "msg" => "Data get Successfully"));
                    } else {
                        echo json_encode(array("status" => FALSE, "msg" => "error"));
                    }
                } else {

                    $record = array(
                        "username" => $this->input->post('username'),
                        "address" => $this->input->post('address'),
                        "mobile_no" => $this->input->post('mobile_no'),
                        "user_type" => $this->input->post('user_type'),
                        "image" => $this->input->post('image'),
                        "display_name" => $this->input->post('display_name')
                    );
                    $data = $this->api_quiz->InsertUser($record);
                    $result = $this->api_quiz->get_user($username);

                    if ($result == true) {
                        echo json_encode(array("status" => TRUE, "user_id" => $result[0]->id, "username" => $result[0]->username, "address" => $result[0]->address, "mobile_no" => $result[0]->mobile_no, "user_type" => $result[0]->user_type, "image" => $result[0]->image, "display_name" => $result[0]->display_name, "msg" => "Data Insert Successfully"));
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
                        "image" => $image,
                    );

                    $result = $this->api_quiz->updateUserImage($record, $data[0]->id);
                    if ($result == true) {
                        echo json_encode(array("status" => TRUE, "id" => $data[0]->id, "ImageURL" => base_url('Images/'.$image), "msg" => "Data Update Successfully"));
                    } else {
                        echo json_encode(array("status" => FALSE, "msg" => "error"));
                    }
                }
                die();
            }
            if ($_POST['name'] == 'update_user_profile') {
                $this->load->model('api_quiz');
                $username = $_POST['username'];
                $data = $this->api_quiz->get_user($username);
                if (isset($data[0]->username) == $_POST['username']) {
                    $record = array(
                        "mobile_no" => $this->input->post('mobile_no'),
                        "display_name" => $this->input->post('display_name')
                    );

                    $result = $this->api_quiz->updateUserProfile($record, $data[0]->id);
                    if ($result == true) {
                        echo json_encode(array("status" => TRUE, "id" => $data[0]->id, "msg" => "Data Update Successfully"));
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
                $user_id = $this->input->post('user_id');
                $main_cat_id = $this->input->post('main_cat_id');
                $sub_cat_id = $this->input->post('sub_cat_id');
                $record = array(
                    'user_id' => $this->input->post('user_id'),
                    'main_cat_id' => $this->input->post('main_cat_id'),
                    'sub_cat_id' => $this->input->post('sub_cat_id'),
                    'right_question' => $this->input->post('right_question'),
                    'wrong_question' => $this->input->post('wrong_question'),
                    'point' => $this->input->post('point'),
                    'coin' => $this->input->post('coin'),
                    'datetime' => date('Y-m-d')
                );
                $data = $this->api_quiz->Store_result($record, $user_id, $main_cat_id, $sub_cat_id);
                if ($data == true) {
                    echo json_encode(array("status" => TRUE, "msg" => "Data Insert Successfully"));
                } else {
                    echo json_encode(array("status" => FALSE, "msg" => "error"));
                }
                die();
            }
            if ($_POST['name'] == 'view_point_coin') {
                $this->load->model('api_quiz');
                $userid = $this->input->post('user_id');
                $data = $this->api_quiz->view_point_coin($userid);
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully"));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            //Insert User Quiz Question Answer...
            if ($_POST['name'] == 'user_answer') {

                unset($_POST['name']);
                unset($_POST['username']);
                $this->load->model('api_quiz');

                $record = array(
                    "user_id" => $this->input->post('user_id'),
                    "question_id" => $this->input->post('question_id'),
                    "selected_ans" => $this->input->post('selected_ans')
                );
                $data = $this->api_quiz->user_answer($record);
                if ($data == true) {
                    echo json_encode(array("status" => TRUE, "msg" => "Data Insert Successfully"));
                } else {
                    echo json_encode(array("status" => FALSE, "msg" => "error"));
                }
                die();
            }
         
            // Insert User Result...
            if ($_POST['name'] == 'add_token') {
                unset($_POST['name']);
                unset($_POST['username']);
                $this->load->model('api_quiz');
                $device_id = $this->input->post('device_id');
                $device_token = $this->input->post('device_token');
                $token = array("device_id" => $device_id,
                    "device_token" => $device_token,
                );
                $data = $this->api_quiz->add_token($token);
                if ($data == true) {
                    echo json_encode(array("status" => TRUE, "msg" => "Data Insert Successfully"));
                } else {
                    echo json_encode(array("status" => FALSE, "msg" => "error"));
                }
                die();
            }
            // view leaderboard
            if ($_POST['name'] == 'view_leaderboard') {
                $this->load->model('api_quiz');
                $data = $this->api_quiz->view_leaderboard();
                $file = base_url('Images/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            //  View_Daily_Leaderboard_Report
            if ($_POST['name'] == 'View_Daily_Leaderboard_Report') {
                $this->load->model('api_quiz');
                $date = $date = date('Y-m-d');
                $data = $this->api_quiz->View_Daily_Leaderboard_Report($date);
                $file = base_url('Images/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            //View Yearly Leaderboard Report
            if ($_POST['name'] == 'View_Yearly_Leaderboard_Report') {
                $this->load->model('api_quiz');
                $year = date('Y');
                $data = $this->api_quiz->View_Yearly_Leaderboard_Report($year);
                $file = base_url('Images/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            //View Monthly Leaderboard Report
            if ($_POST['name'] == 'View_Monthly_Leaderboard_Report') {
                $this->load->model('api_quiz');
                $month = date('m');
                $year = date('Y');
                $data = $this->api_quiz->View_Monthly_Leaderboard_Report($month, $year);
                $file = base_url('Images/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            if ($_POST['name'] == 'score_history') {
                $this->load->model('api_quiz');
                $id = $this->input->post('user_id');
                $data = $this->api_quiz->get_Score($id);
                $file = base_url('Images/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            //get user wise data
            if ($_POST['name'] == 'get_user_data') {
                $this->load->model('api_quiz');
                $id = $this->input->post('user_id');
                $data = $this->api_quiz->get_user_data($id);
                $file = base_url('Images/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
                }
                die();
            }
            if ($_POST['name'] == 'get_site_setting') {
                $this->load->model('api_quiz');
              
                $data = $this->api_quiz->get_setting();
                $file = base_url('Images/');
                if ($data) {
                    echo json_encode(array("status" => TRUE, "data" => $data, "msg" => "data get successfully", "imageurl" => $file));
                } else {
                    echo json_encode(array("status" => TRUE, "msg" => "data not found"));
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

    function sendPushNotificationToGCMSever($tokenArray, $message, $title, $body) {

        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => $tokenArray,
            'data' => $message,
            'notification' => $message,
        );
        //echo json_encode($fields);
        $headers = array(
            'Authorization:key=AAAAHD-LUrQ:APA91bETRZjKDZsZaWTiEaw3xJY2KeFPdXcg15OHxBd3WMLzL9W02hXyBK5ecGyzp-oHhUQ3ti3Xs2Qsn5DZc46rS5qbZHNfrf8Z7sYkCqVepNTrBbasr-8IgqIWMEVzsbn0wxFrS_rs',
            'Content-Type:application/json'
        );
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

}

?>