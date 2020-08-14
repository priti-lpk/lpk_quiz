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

    public function fetch_main_category_data($user_id) {

        $query = $this->db->query("SELECT main_category.id, main_category.main_cat_name FROM add_newuser inner join main_category on add_newuser.main_cat_id=main_category.id where add_newuser.id=" . $user_id);
        return $query->result();
    }

    public function fetch_sub_category_data($user_id) {
        $query = $this->db->query("SELECT sub_cat_id FROM add_newuser where id=" . $user_id);
        $data = $query->result_array();
        $val = $data[0]['sub_cat_id'];
        $userarray = explode(',', $val);
        $sub_category = array();
        foreach ($userarray as $val) {
            $query1 = $this->db->query("SELECT id,sub_cat_name FROM sub_category where id=" . $val);
            $q = $query1->result_array();
            $sub_category[] = $q;
        }
        return array(
            'sub' => $sub_category
        );
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

    public function fetch_data($user_id) {
        $query = $this->db->query("select question_master.id,main_category.main_cat_name,sub_category.sub_cat_name,countries.cname,states.state_name,question_master.image,question_master.question,question_master.option_a,question_master.option_b,question_master.option_c,question_master.option_d,question_master.answer from question_master INNER JOIN main_category ON question_master.main_cat_id=main_category.id LEFT JOIN sub_category ON question_master.sub_cat_id=sub_category.id INNER JOIN countries ON question_master.country_id=countries.id INNER JOIN states ON question_master.state_id=states.id where question_master.user=" . $user_id);
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

}

?>
