<?php

class HomeModel extends CI_Model {

//--------------------Main category------------------------//
    public function InsertMaincategory($main_cat_name, $img, $status) {
        $query = "insert into main_category(main_cat_name,main_image,status)values('$main_cat_name','$img','$status')";
        $this->db->query($query);
    }

    public function getCategoryLastId() {
        $id = $this->db->query("SELECT * FROM main_category ORDER BY id DESC LIMIT 1");
        return $id->result();
    }

    function update_main_category($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("main_category", $data);
        //UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'  
    }

    public function fetch_main_category_data() {
        $query = $this->db->query("SELECT * FROM main_category where 1");
        return $query->result();
    }

    public function update_maincategory_data($id) {
        $query = $this->db->query("SELECT * FROM main_category where id=" . $id);
        return $query->result_array();
    }

    public function delete_category($id) {

        $this->db->where('id', $id);
        $this->db->delete('main_category');
    }

    function update_main_cat_status($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("main_category", $data);
    }

//---------------Sub_category------------------------//
    public function fetch_sub_main_category_data() {
        $query = $this->db->query("SELECT id,main_cat_name FROM main_category where status=1");
        return $query->result();
    }

    public function fetch_sub_category_data() {
        $query = $this->db->query("SELECT * FROM sub_category where 1");
        return $query->result();
    }

    public function InsertSubcategory($main_cat_id, $sub_cat_name, $img, $status) {
        $query = "insert into sub_category(main_cat_id,sub_cat_name,sub_image,status)values($main_cat_id, '$sub_cat_name', '$img', '$status')";
        $this->db->query($query);
    }

    public function getSubCategoryLastId() {
        $id = $this->db->query("SELECT * FROM sub_category ORDER BY id DESC LIMIT 1");
        return $id->result();
    }

    function update_sub_category($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("sub_category", $data);
        //UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'  
    }

    public function update_subcategory_data($id) {
        $query = $this->db->query("SELECT * FROM sub_category where id=" . $id);
        return $query->result_array();
    }

    public function delete_sub_cat($id) {

        $this->db->where('id', $id);
        $this->db->delete('sub_category');
    }

    function update_sub_cat_status($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("sub_category", $data);
    }

    //--------------------Tag------------------------//
    public function Inserttag($tag_name) {
        $query = "insert into tag_list(tag_name)values('$tag_name')";
        $this->db->query($query);
    }

    public function fetch_tag_data() {
        $query = $this->db->query("SELECT * FROM tag_list where 1");
        return $query->result();
    }

    public function update_tag($id) {
        $query = $this->db->query("SELECT * FROM tag_list where id=" . $id);
        return $query->result_array();
    }

    function update_tag_data($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("tag_list", $data);
        //UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'  
    }

    public function delete_tag($id) {

        $this->db->where('id', $id);
        $this->db->delete('tag_list');
    }

    //----------------------country-----------------------//
    public function Insertcountry($cname) {
        $query = "insert into countries(cname)values('$cname')";
        $this->db->query($query);
    }

    public function fetch_country_data() {
        $query = $this->db->query("SELECT * FROM countries where 1");
        return $query->result();
    }

    public function update_country($id) {
        $query = $this->db->query("SELECT * FROM countries where id=" . $id);
        return $query->result_array();
    }

    function update_country_data($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("countries", $data);
        //UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'  
    }

    public function delete_country($id) {

        $this->db->where('id', $id);
        $this->db->delete('countries');
    }

    //--------------------------State-----------------------------//
    public function fetch_country() {
        $query = $this->db->query("SELECT id,cname FROM countries where 1");
        return $query->result();
    }

    public function fetch_state_data() {
        $query = $this->db->query("SELECT states.*,countries.cname FROM states inner join countries on states.country_id=countries.id where 1");
        return $query->result();
    }

    public function Insertstate($country_id, $state_name) {
        $query = "insert into states(country_id,state_name)values('$country_id','$state_name')";
        $this->db->query($query);
    }

    function update_state_data($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("states", $data);
        //UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'  
    }

    public function update_state($id) {
        $query = $this->db->query("SELECT * FROM states where id=" . $id);
        return $query->result_array();
    }

    public function delete_state($id) {

        $this->db->where('id', $id);
        $this->db->delete('states');
    }

    //---------------------User-------------------------------//
    public function Insertuser($user, $pass, $main_cat_id, $sub_cat_id) {
        $query = "insert into add_newuser(user,pass,main_cat_id,sub_cat_id)values('$user','$pass','$main_cat_id','$sub_cat_id')";
        $this->db->query($query);
    }

    public function fetch_user_main_category_data() {
        $query = $this->db->query("SELECT * FROM main_category where status=1");
        return $query->result();
    }

    public function fetch_user_sub_category_data() {
        $query = $this->db->query("SELECT * FROM sub_category where status=1");
        return $query->result();
    }

    public function update_user($id) {
        $query = $this->db->query("SELECT * FROM add_newuser where id=" . $id);
        return $query->result_array();
    }

    function update_user_data($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("add_newuser", $data);
        //UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'  
    }

    public function delete_user($id) {

        $this->db->where('id', $id);
        $this->db->delete('add_newuser');
    }

    public function fetch_user_data() {
        $query = $this->db->query("SELECT add_newuser.id,add_newuser.user,main_category.main_cat_name,add_newuser.sub_cat_id,GROUP_CONCAT(DISTINCT sub_category.sub_cat_name) as sub_cat_name FROM add_newuser INNER JOIN main_category ON add_newuser.main_cat_id=main_category.id INNER join sub_category ON FIND_IN_SET(sub_category.ID, add_newuser.sub_cat_id) > 0 GROUP BY add_newuser.id");
//        SELECT a.sub_cat_id, GROUP_CONCAT(s.sub_cat_name) as name FROM add_newuser a INNER JOIN sub_category s ON FIND_IN_SET(s.ID, a.sub_cat_id) > 0 GROUP BY a.sub_cat_id 
        return $query->result();
    }

    public function getscat($main_cat_id) {
        $query = $this->db->query("SELECT * FROM sub_category where main_cat_id='" . $main_cat_id . "' and status='1'");
        return $query->result();
    }

    function update_pass($data, $id) {
        $this->db->where("id", $id);
        $this->db->update("add_newuser", $data);
        return true;
    }

    public function get_setting() {

        $this->db->select('*');
        $this->db->from('setting');
        $query = $this->db->get();
        return $query->result();
    }

}
?>