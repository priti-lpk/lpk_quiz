<?php

class api_quiz extends CI_Model {

    function main_category() {
        $query = $this->db->query("SELECT main_category.id,main_category.main_cat_name as name,main_category.main_image as image, main_category.status,COUNT(question_master.id) as countqus,question_master.main_cat_id as mid,(SELECT COUNT(id) FROM sub_category WHERE main_cat_id=mid GROUP BY main_cat_id) as subcatCount from sub_category RIGHT JOIN question_master ON sub_category.id=question_master.sub_cat_id INNER JOIN main_category ON question_master.main_cat_id=main_category.id GROUP BY question_master.main_cat_id ");
        $main_cat = $query->result_array();
        $data = array();
        $c = count($main_cat);
        for ($i = 0; $i < $c; $i++) {
            $data = $main_cat[$i];
            $mid = $main_cat[$i]['mid'];
            $query1 = $this->db->query("select sub_category.id,sub_category.sub_cat_name as name,sub_category.sub_image as image,COUNT(question_master.sub_cat_id) as countsubqus from sub_category LEFT JOIN question_master ON sub_category.id=question_master.sub_cat_id where sub_category.main_cat_id='" . $mid . "' GROUP BY sub_category.id");
            $sub_cat = $query1->result();
            unset($mid);
            $temp = array();
            foreach ($sub_cat as $row) {
                $temp[] = $row;
            }
            $data['subdata'] = $temp;
            $datas[] = $data;
        }
        return $datas;
    }

    function all_question() {
        $query = $this->db->query("SELECT q.id,m.main_cat_name,s.sub_cat_name,t.tag_name,c.cname,st.state_name,q.image,q.question,q.option_a,q.option_b,q.option_c,q.option_d,q.answer,q.date,IFNULL(u.username,'Admin') as username from question_master q inner join main_category m on q.main_cat_id=m.id inner join sub_category s on q.sub_cat_id=s.id INNER join countries c on q.country_id=c.id INNER join tag_list t on q.tag_id=t.id INNER JOIN states st on q.state_id=st.id left join user_master u on q.user=u.id");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    function count_selected_answer() {
        $query = $this->db->query("SELECT id,main_cat_id,sub_cat_id,tag_id,country_id,state_id,image,question,option_a,option_b,option_c,option_d,answer,qdate, MAX(count_selectans),qid,selected_ans FROM (SELECT question_master.id as id,question_master.main_cat_id as main_cat_id,question_master.sub_cat_id as sub_cat_id,question_master.tag_id as tag_id,question_master.country_id as country_id,question_master.state_id as state_id,question_master.image as image,question_master.question as question,question_master.option_a as option_a,question_master.option_b as option_b,question_master.option_c as option_c,question_master.option_d as option_d,question_master.answer as answer,question_master.date as qdate,question_master.user as quser,(question_id) as qid,selected_ans,COUNT(selected_ans) as count_selectans FROM `user_quiz` RIGHT JOIN question_master ON question_master.id=user_quiz.question_id GROUP BY question_id,selected_ans ORDER by count_selectans DESC) AS derived_alias GROUP BY qid");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    function country_state() {
        $query = $this->db->query("select * from countries");
        $country = $query->result_array();
        $data = array();
        $c = count($country);
        for ($i = 0; $i < $c; $i++) {
            $data = $country[$i];
            $id = $country[$i]['id'];
            $query1 = $this->db->query("select * from states where country_id=" . $id);
            $sub_cat = $query1->result();
            unset($mid);
            $temp = array();
            foreach ($sub_cat as $row) {
                $temp[] = $row;
            }
            $data['subdata'] = $temp;
            $datas[] = $data;
        }
        return $datas;
    }

    function view_user() {
        $query = $this->db->query("SELECT user_master.id,user_master.username,user_master.address,user_master.mobile_no,countries.cname,states.state_name,user_master.city,user_master.user_type,user_master.image,user_master.display_name FROM user_master LEFT JOIN countries ON user_master.country_id=countries.id LEFT JOIN states ON user_master.state_id=states.id");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    function main_category_result($main_cat_id) {
        $query = $this->db->query("SELECT question_master.id,main_category.main_cat_name,countries.cname,states.state_name,question_master.question,question_master.answer FROM question_master INNER JOIN main_category ON question_master.main_cat_id=main_category.id INNER JOIN countries ON question_master.country_id=countries.id INNER JOIN states ON question_master.state_id=states.id where question_master.main_cat_id='" . $main_cat_id . "'");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    function sub_category_result($sub_cat_id) {
        $query = $this->db->query("SELECT question_master.id,main_category.main_cat_name,countries.cname,states.state_name,question_master.question,question_master.answer FROM question_master INNER JOIN main_category ON question_master.main_cat_id=main_category.id INNER JOIN countries ON question_master.country_id=countries.id INNER JOIN states ON question_master.state_id=states.id where question_master.sub_cat_id='" . $sub_cat_id . "'");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    function user_quiz_get() {
        $query = $this->db->query("SELECT * from user_quiz");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    function question_result() {
        $query = $this->db->query("SELECT question_master.id,main_category.main_cat_name,countries.cname,states.state_name,question_master.question,question_master.answer FROM question_master INNER JOIN main_category ON question_master.main_cat_id=main_category.id INNER JOIN countries ON question_master.country_id=countries.id INNER JOIN states ON question_master.state_id=states.id order by rand() limit 10");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    public function InsertUser($username, $address, $mobile_no, $country_id, $state_id, $city, $user_type, $image, $display_name) {
        $query = "insert into user_master(username,address,mobile_no,country_id,state_id,city,user_type,image,display_name)values('$username','$address',$mobile_no,$country_id, $state_id,'$city','$user_type','$image','$display_name')";
        $data = $this->db->query($query);
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    function updateUser($record, $id) {
        $this->db->trans_start();
        $this->db->where("id", $id);
        $this->db->update("user_master", $record);
        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }

    function get_user($username) {
        $query = $this->db->query("SELECT id,username from user_master where username='" . $username . "'");
        $result = $query->result();
        return $result;
    }

    function last_id() {
        $query = $this->db->query("SELECT id from user_master GROUP BY id DESC LIMIT 1");
        $result = $query->result();
        return $result;
    }

    function updateUserImage($record, $id) {
        $this->db->trans_start();
        $this->db->where("id", $id);
        $this->db->update("user_master", $record);
        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public function Store_result($main_cat_id, $sub_cat_id, $user_id, $right_question, $wrong_question, $score) {
        $query = "insert into store_result(main_cat_id,sub_cat_id,user_id,right_question,wrong_question,score)values($main_cat_id, $sub_cat_id, $user_id, $right_question, $wrong_question, $score)";
        $data = $this->db->query($query);
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function user_answer($question_id, $user_id, $selected_ans) {
        $query = "insert into user_quiz(question_id, user_id, selected_ans)values($question_id, $user_id, '$selected_ans')";
        $data = $this->db->query($query);
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    function quiz_mission() {
        $query = $this->db->query("SELECT mc.main_cat_name,sc.sub_cat_name,daily_mission.time,daily_mission.score FROM `daily_mission` INNER JOIN main_category mc ON daily_mission.main_cat_id=mc.id INNER JOIN sub_category sc ON daily_mission.sub_cat_id=sc.id ");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

}
