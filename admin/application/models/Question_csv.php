<?php

class Question_csv extends CI_Model {

    function insertRecord($record) {

        if (count($record) > 0) {

            // Check user
//      $this->db->select('*');
//      $this->db->where('username', $record[0]);
//      $q = $this->db->get('users');
//      $response = $q->result_array();
// 
//      // Insert record
//      if(count($response) == 0){
            $newuser = array(
                "main_cat_id" => trim($record[1]),
                "sub_cat_id" => trim($record[2]),
                "tag_id" => trim($record[3]),
                "country_id" => trim($record[4]),
                "state_id" => trim($record[5]),
                "image" => trim($record[6]),
                "question" => trim($record[7]),
                "option_a" => trim($record[8]),
                "option_b" => trim($record[9]),
                "option_c" => trim($record[10]),
                "option_d" => trim($record[11]),
                "answer" => trim($record[12]),
                "user" => trim($record[13]),
                "type" => trim($record[14]),
            );
//            print_r($newuser);
            $this->db->insert('question_master', $newuser);
//      }
        }
    }

}