<?php

class Api_quiz extends CI_Model {

    function main_category() {
        $query = $this->db->query("SELECT main_category.id,main_category.main_cat_name as name,main_category.main_image as image, main_category.status from main_category");
        $main_cat = $query->result_array();
        $data = array();
        $c = count($main_cat);
        for ($i = 0; $i < $c; $i++) {
            $data = $main_cat[$i];
            $mid = $main_cat[$i]['id'];
            $query1 = $this->db->query("select sub_category.id,sub_category.sub_cat_name as name,sub_category.sub_image as image from sub_category LEFT JOIN question_master ON sub_category.id=question_master.sub_cat_id where sub_category.main_cat_id='" . $mid . "' GROUP BY sub_category.id");
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
        $query = $this->db->query("SELECT q.id,m.main_cat_name,s.sub_cat_name,t.tag_name,c.cname,st.state_name,q.image,q.question,q.option_a,q.option_b,q.option_c,q.option_d,q.answer,q.date,IFNULL(u.username,'Admin') as username,q.type from question_master q inner join main_category m on q.main_cat_id=m.id inner join sub_category s on q.sub_cat_id=s.id INNER join countries c on q.country_id=c.id INNER join tag_list t on q.tag_id=t.id INNER JOIN states st on q.state_id=st.id left join user_master u on q.user=u.id WHERE q.id ORDER BY RAND() LIMIT 15");
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

    function main_category_result($main_cat_id, $limit) {
        $query = $this->db->query("SELECT question_master.id,main_category.main_cat_name,countries.cname,states.state_name,question_master.question,question_master.option_a,question_master.option_b,question_master.option_c,question_master.option_d,question_master.type,question_master.answer,question_master.image FROM question_master INNER JOIN main_category ON question_master.main_cat_id=main_category.id INNER JOIN countries ON question_master.country_id=countries.id INNER JOIN states ON question_master.state_id=states.id where question_master.main_cat_id='" . $main_cat_id . "' order by rand() LIMIT " . $limit);
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    function sub_category_result($sub_cat_id, $limit) {
        $query = $this->db->query("SELECT question_master.id,main_category.main_cat_name,countries.cname,states.state_name,question_master.question,question_master.option_a,question_master.option_b,question_master.option_c,question_master.option_d,question_master.type,question_master.answer,question_master.image FROM question_master INNER JOIN main_category ON question_master.main_cat_id=main_category.id INNER JOIN countries ON question_master.country_id=countries.id INNER JOIN states ON question_master.state_id=states.id where question_master.sub_cat_id='" . $sub_cat_id . "' order by rand() LIMIT " . $limit);
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    function user_quiz_get() {
        $this->db->select('*');
        $this->db->from('user_quiz');
        $query = $this->db->get();
        return $query->result();
    }

    function question_result() {
        $this->db->select('question_master.id,main_category.main_cat_name,countries.cname,states.state_name,question_master.question,question_master.answer');
        $this->db->from('question_master');
        $this->db->join('main_category', 'question_master.main_cat_id = main_category.id');
        $this->db->join('countries', 'question_master.country_id = countries.id');
        $this->db->join('states', 'question_master.state_id = states.id');
        $this->db->order_by('rand()'); //get random question
        $this->db->limit(10);  //limit
        $query = $this->db->get();
        return $query->result();
    }

    public function InsertUser($record) {
        $query = $this->db->insert('user_master', $record);
        if ($query) {
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
        $this->db->select('id,username,address,mobile_no,country_id,state_id,city,user_type,image,display_name');
        $this->db->where("username", $username);
        $this->db->from('user_master');
        $query = $this->db->get();
        return $query->result();
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

    function updateUserProfile($record, $id) {
        $this->db->trans_start();
        $this->db->where("id", $id);
        $this->db->update("user_master", $record);
        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public function Store_result($record, $user_id, $main_cat_id, $sub_cat_id) {
        $this->db->select('*');
        $this->db->from('store_result');
        $this->db->where('user_id', $user_id);
        $this->db->where('main_cat_id', $main_cat_id);
        $this->db->where('sub_cat_id', $sub_cat_id);
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            $this->db->trans_start();
            $this->db->where('user_id', $user_id);
            $this->db->where('main_cat_id', $main_cat_id);
            $this->db->where('sub_cat_id', $sub_cat_id);
            $this->db->update("store_result", $record);
            if ($this->db->trans_status() === FALSE) {
                return false;
            } else {
                return true;
            }
        } else {
            $query = $this->db->insert('store_result', $record);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function user_answer($record) {
        $query = $this->db->insert('user_quiz', $record);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function quiz_mission() {
        $query = $this->db->query("SELECT daily_mission.id,daily_mission.main_cat_id,daily_mission.sub_cat_id,mc.main_cat_name,mc.main_image,sc.sub_cat_name,daily_mission.time,daily_mission.score,daily_mission.description FROM `daily_mission` INNER JOIN main_category mc ON daily_mission.main_cat_id=mc.id INNER JOIN sub_category sc ON daily_mission.sub_cat_id=sc.id ");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    function get_mission_question($id) {
        $query = $this->db->query("SELECT d.id,d.time,d.score,m.main_cat_name,m.main_image,s.sub_cat_name,s.sub_image,q.image,q.type,q.question,q.option_a,q.option_b,q.option_c,q.option_d,q.answer,q.date FROM daily_mission d inner join main_category m on m.id=d.main_cat_id inner join sub_category s on s.id=d.sub_cat_id left join question_master q on (q.main_cat_id=m.id and q.sub_cat_id=s.id) WHERE d.id=" . $id);
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    public function view_leaderboard() {
        $query = $this->db->query("SELECT user_master.id,user_master.display_name,user_master.image,store_result.point,FIND_IN_SET( store_result.point, (    
SELECT GROUP_CONCAT( store_result.point
ORDER BY store_result.point DESC ) 
FROM store_result )
) AS rank FROM `store_result`  left JOIN user_master ON store_result.user_id=user_master.id ORDER BY rank DESC");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    public function View_Daily_Leaderboard_Report($date) {
        $query = $this->db->query("SELECT store_result.id, store_result.user_id,u.username,u.display_name,u.image, sum(store_result.point) as point, FIND_IN_SET( sum(store_result.point),(SELECT CONCAT(GROUP_CONCAT(c1)) as point FROM (
  SELECT CONCAT(SUM(point)) c1 FROM store_result WHERE date(datetime)='" . $date . "' and user_id GROUP BY user_id ORDER BY SUM(point) DESC
 ) t)) AS rank 
FROM store_result INNER JOIN user_master u on u.id=store_result.user_id WHERE date(store_result.datetime)='" . $date . "' GROUP by store_result.user_id ORDER BY rank ASC");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    public function View_Yearly_Leaderboard_Report($year) {
        $query = $this->db->query("SELECT store_result.id, store_result.user_id,u.username,u.display_name,u.image, sum(store_result.point) as point, FIND_IN_SET( sum(store_result.point),(SELECT CONCAT(GROUP_CONCAT(c1)) as point FROM (
  SELECT CONCAT(SUM(point)) c1 FROM store_result WHERE year(datetime)='" . $year . "' and user_id GROUP BY user_id ORDER BY SUM(point) DESC
 ) t)) AS rank 
FROM store_result INNER JOIN user_master u on u.id=store_result.user_id WHERE year(store_result.datetime)='" . $year . "' GROUP by store_result.user_id ORDER BY rank ASC");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    public function View_Monthly_Leaderboard_Report($month, $year) {
        $query = $this->db->query("SELECT store_result.id, store_result.user_id,u.username,u.display_name,u.image, sum(store_result.point) as point, FIND_IN_SET( sum(store_result.point),(SELECT CONCAT(GROUP_CONCAT(c1)) as point FROM (
  SELECT CONCAT(SUM(point)) c1 FROM store_result WHERE (year(datetime)='" . $year . "' and month(datetime)='" . $month . "') and user_id GROUP BY user_id ORDER BY SUM(point) DESC
 ) t)) AS rank 
FROM store_result INNER JOIN user_master u on u.id=store_result.user_id WHERE (year(datetime)='" . $year . "' and month(datetime)='" . $month . "') GROUP by store_result.user_id ORDER BY rank ASC");
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    public function view_point_coin($userid) {
        $query = $this->db->query("SELECT store_result.right_question,store_result.wrong_question,store_result.point,store_result.coin,user_master.username FROM `store_result` INNER JOIN user_master ON store_result.user_id=user_master.id WHERE user_id=" . $userid);
        $result = $query->result();
        $data = array();
        foreach ($result as $rows) {
            $data[] = $rows;
        }
        return $data;
    }

    public function get_Score($id) {

//        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');
        if (!empty($id)) {
            $query = $this->db->query("SELECT s.id,s.user_id,s.main_cat_id,(case when (s.main_cat_id = '-1') 
 THEN
      'Mission Quiz'
 ELSE
      COALESCE(m.main_cat_name,'Random Quiz')
 END)
 as main_cat_name,(case when (s.sub_cat_id = '-1') 
 THEN
      'Mission Quiz'
 ELSE
      COALESCE(sc.sub_cat_name,'Random Quiz')
 END) as sub_cat_name,sum(s.point) as point,sum(s.right_question) as right_question,sum(s.wrong_question) as wrong_question,(case when (s.sub_cat_id = '-1') 
 THEN
      'Quiz_default/mission.png'
 ELSE
      COALESCE(sc.sub_image,'Quiz_default/random.png')
 END) as main_image FROM store_result as s left JOIN main_category m on m.id=s.main_cat_id left join sub_category sc on sc.id=s.sub_cat_id INNER join user_master u on u.id=s.user_id WHERE s.user_id=" . $id . " and (year(datetime)='" . $year . "' and month(datetime)='" . $month . "') GROUP by s.user_id,s.main_cat_id DESC LIMIT 50");
            $result = $query->result();
            return $query->result();
        } else {
            
        }
    }

    function get_user_data($id) {
        $this->db->select('id,username,address,mobile_no,country_id,state_id,city,user_type,image,display_name');
        $this->db->where("id", $id);
        $this->db->from('user_master');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_setting() {

        $this->db->select('*');
        $this->db->from('setting');
        $query = $this->db->get();
        return $query->result();
    }

}

?>