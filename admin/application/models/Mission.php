<?php

class mission extends CI_Model {

    public function Insertmission($data) {
        $this->db->insert('daily_mission', $data);
    }

    public function fetch_main_category_data() {
        $query = $this->db->query("SELECT * FROM main_category where status='1'");
        return $query->result();
    }

    public function fetch_sub_category_data() {
        $query = $this->db->query("SELECT * FROM sub_category where status='1'");
        return $query->result();
    }

    public function fetch_data() {
        $query = $this->db->query("select daily_mission.id,main_category.main_cat_name,sub_category.sub_cat_name,daily_mission.time,daily_mission.score from daily_mission INNER JOIN main_category ON daily_mission.main_cat_id=main_category.id LEFT JOIN sub_category ON daily_mission.sub_cat_id=sub_category.id");
        return $query->result();
    }

    public function getscat($main_cat_id) {
        $query = $this->db->query("SELECT * FROM sub_category where main_cat_id='" . $main_cat_id . "' and status='1'");
        return $query->result();
    }

    public function update_dlymission($id) {
        $query = $this->db->query("SELECT * FROM daily_mission where id=" . $id);
        return $query->result_array();
    }

    public function fetch_sub_category_data1($id) {
        $query1 = $this->db->query("SELECT main_cat_id FROM question_master where id=" . $id);
        $s = $query1->result();
        $query = $this->db->query("SELECT * FROM sub_category where status='1' And main_cat_id=" . $s[0]->main_cat_id);
        return $query->result();
    }

    function update_mission($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("daily_mission", $data);
    }

    public function delete_mission($id) {

        $this->db->where('id', $id);
        $this->db->delete('daily_mission');
    }

}

?>
