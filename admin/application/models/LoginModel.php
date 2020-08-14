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

}
?>

