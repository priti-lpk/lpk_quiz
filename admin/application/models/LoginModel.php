<?php

class LoginModel extends CI_Model {

    function __construct() {

        parent::__construct();

        $this->load->library('session');
    }

    public function Loginn($username, $password) {

        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();

        return $query->result_array();
        if ($query->num_rows() == 1) {
            if ($row->user == $user_username && $row->pass == $user_pass) {

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function fetch_site_data() {
        $this->db->select('*');
        $this->db->from('setting');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function InsertSetting($record) {

        $query = $this->db->insert('setting', $record);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function updateSetting($record, $id) {
        $this->db->trans_start();
        $this->db->where("id", $id);
        $this->db->update("setting", $record);
        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }

}
?>

