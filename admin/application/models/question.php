<?php

class question extends CI_Model {

    public function Insertquestion($data) {
//        $query = "insert into question_master(main_cat_id,sub_cat_id,country_id,state_id,image,tag_id,question,option_a,option_b,option_c,option_d,answer,user)values($main_cat_id, $sub_cat_id, $country_id, $state_id, '$image', '$tag_id',' $question', '$option_a', '$option_b', '$option_c', '$option_d', '$answer', $user)";
//        $this->db->query($query);
        $this->db->insert('question_master', $data);
    }

    public function getquestionLastId() {
        $id = $this->db->query("SELECT * FROM question_master ORDER BY id DESC LIMIT 1");
        return $id->result();
    }

    public function update_question($id) {
        $query = $this->db->query("SELECT * FROM question_master where id=" . $id);
        return $query->result_array();
    }

    public function update_state($county_id) {
        $query = $this->db->query("SELECT * FROM states where country_id=" . $county_id);
        return $query->result();
    }

    function update_question_master($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("question_master", $data);
//UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'  
    }

    public function delete_question($id) {

        $this->db->where('id', $id);
        $this->db->delete('question_master');
    }

    public function fetch_main_category_data() {
        $query = $this->db->query("SELECT * FROM main_category where status='1'");
        return $query->result();
    }

    public function fetch_sub_category_data() {
        $query = $this->db->query("SELECT * FROM sub_category where status='1'");
        return $query->result();
    }

    public function fetch_country() {
        $query = $this->db->query("SELECT * FROM countries where 1");
        return $query->result();
    }

    public function get_state($countries) {
        $query = $this->db->query("SELECT * FROM states where country_id=" . $countries);
        return $query->result();
    }

    public function get_tag() {
        $query = $this->db->query("SELECT * FROM tag_list where 1");
        return $query->result();
    }

    public function fetch_data() {
        $query = $this->db->query("select question_master.id,main_category.main_cat_name,sub_category.sub_cat_name,countries.cname,states.state_name,question_master.image,question_master.question,question_master.option_a,question_master.option_b,question_master.option_c,question_master.option_d,question_master.answer from question_master INNER JOIN main_category ON question_master.main_cat_id=main_category.id LEFT JOIN sub_category ON question_master.sub_cat_id=sub_category.id INNER JOIN countries ON question_master.country_id=countries.id INNER JOIN states ON question_master.state_id=states.id");
        return $query->result();
    }

    public function getscat($main_cat_id) {
        $query = $this->db->query("SELECT * FROM sub_category where main_cat_id='" . $main_cat_id . "' and status='1'");
        return $query->result();
    }

    public function quest_valid($add_question, $id) {
        if (!empty($id)) {
            $query1 = $this->db->query("SELECT question FROM question_master where id=" . $id);
            $d = $query1->result_array();

            if ($d[0]['question'] != $add_question) {
                $this->db->select('question');
                $this->db->from('question_master');
                $this->db->where('question', $add_question);
                $query = $this->db->get();

                if ($query->num_rows() >= 1) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            $this->db->select('question');
            $this->db->from('question_master');
            $this->db->where('question', $add_question);
            $query = $this->db->get();

            if ($query->num_rows() >= 1) {
                return 1;
            } else {
                return 0;
            }
        }
    }

//----------------------------View User--------------------------------//
    public function fetch_user_data() {
        $query = $this->db->query("select user_master.id,user_master.username,user_master.address,user_master.mobile_no,countries.cname,states.state_name,user_master.city,user_master.user_type,user_master.image,user_master.display_name from user_master LEFT JOIN countries ON user_master.country_id=countries.id LEFT JOIN states ON user_master.state_id=states.id");
        return $query->result();
    }

//------------------------View Quize Schedule-------------------------------//

    public function fetch_main_category() {
        $query = $this->db->query("SELECT * FROM main_category where status='1'");
        return $query->result();
    }

    public function fetch_sub_category() {
        $query = $this->db->query("SELECT * FROM sub_category where status='1'");
        return $query->result();
    }

    public function fetch_quize_schedule($sid, $mid) {
        $query = $this->db->query("SELECT quiz_schedule.id,quiz_schedule.title,quiz_schedule.schedule_date,main_category.main_cat_name,sub_category.sub_cat_name,countries.cname,states.state_name,quiz_schedule.description FROM quiz_schedule INNER JOIN main_category ON quiz_schedule.main_cat_id=main_category.id LEFT JOIN sub_category ON quiz_schedule.sub_cat_id=sub_category.id INNER JOIN countries ON quiz_schedule.country_id=countries.id INNER JOIN states ON quiz_schedule.state_id=states.id where quiz_Schedule.main_cat_id='" . $mid . "' AND quiz_schedule.sub_cat_id='" . $sid . "'");
        return $query->result();
    }

    public function fetch_quize1_schedule($mid) {
        $query = $this->db->query("SELECT quiz_schedule.id,quiz_schedule.title,quiz_schedule.schedule_date,main_category.main_cat_name,sub_category.sub_cat_name,countries.cname,states.state_name,quiz_schedule.description FROM quiz_schedule INNER JOIN main_category ON quiz_schedule.main_cat_id=main_category.id LEFT JOIN sub_category ON quiz_schedule.sub_cat_id=sub_category.id INNER JOIN countries ON quiz_schedule.country_id=countries.id INNER JOIN states ON quiz_schedule.state_id=states.id where quiz_schedule.main_cat_id='" . $mid . "'");
        return $query->result();
    }

    public function delete_schedule($id) {

        $this->db->where('id', $id);
        $this->db->delete('quiz_schedule');
    }

//----------------------------View Category Wise Question---------------------------------//
    public function fetch_question($sid, $mid) {
        $query = $this->db->query("SELECT question_master.id,main_category.main_cat_name,sub_category.sub_cat_name,countries.cname,states.state_name,question_master.question,question_master.option_a,question_master.option_b,question_master.option_c,question_master.option_d,question_master.answer FROM question_master INNER JOIN main_category ON question_master.main_cat_id=main_category.id INNER JOIN countries ON question_master.country_id=countries.id INNER JOIN states ON question_master.state_id=states.id inner join sub_category on question_master.sub_cat_id=sub_category.id where question_master.main_cat_id='" . $mid . "' AND question_master.sub_cat_id='" . $sid . "'");
        return $query->result();
    }

    public function fetch_question1($mid) {
        $query = $this->db->query("SELECT question_master.id,main_category.main_cat_name,sub_category.sub_cat_name,countries.cname,states.state_name,question_master.question,question_master.option_a,question_master.option_b,question_master.option_c,question_master.option_d,question_master.answer FROM question_master INNER JOIN main_category ON question_master.main_cat_id=main_category.id INNER JOIN countries ON question_master.country_id=countries.id INNER JOIN states ON question_master.state_id=states.id inner join sub_category on question_master.sub_cat_id=sub_category.id where question_master.main_cat_id='" . $mid . "'");
        return $query->result();
    }

//----------------------------View Result----------------------------------------------//
    public function Insertschedule($data) {
//        $query = "insert into quiz_schedule(title,schedule_date,country_id,state_id,main_cat_id,sub_cat_id,description)values('$title', '$schedule_date', $country_id, $state_id, $main_cat_id, $sub_cat_id, '$description')";
//        $this->db->query($query);
//        return $this->db->last_query();
        $this->db->insert('quiz_schedule', $data);
    }

    public function update_schedule($id) {
        $query = $this->db->query("SELECT * FROM quiz_schedule where id=" . $id);
        return $query->result_array();
    }

    function update_schedule_data($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("quiz_schedule", $data);
//UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'  
    }

//-------------------------------------Result---------------------------------//
    public function fetch_result() {
        $query = $this->db->query("SELECT store_result.id,main_category.main_cat_name,sub_category.sub_cat_name,user_master.username,store_result.right_question,store_result.wrong_question,store_result.point,store_result.coin FROM store_result INNER JOIN main_category ON store_result.main_cat_id=main_category.id INNER JOIN sub_category ON store_result.sub_cat_id=sub_category.id INNER JOIN user_master ON store_result.user_id=user_master.id");
        return $query->result();
    }

//--------------------------------------Edit Question--------------------------------------------//
    public function fetch_sub_category_data1($id) {
        $query1 = $this->db->query("SELECT main_cat_id FROM question_master where id=" . $id);
        $s = $query1->result();
        $query = $this->db->query("SELECT * FROM sub_category where status='1' And main_cat_id=" . $s[0]->main_cat_id);
        return $query->result();
    }

}

?>
