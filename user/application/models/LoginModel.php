<?php

class LoginModel extends CI_Model {

    function __construct() {

        parent::__construct();

        $this->load->library('session');
    }

    public function Loginn($user_username, $user_pass) {
       
        $this->db->select('*');
        $this->db->from('add_newuser');
        $this->db->where('user', $user_username);
        $this->db->where('pass', $user_pass);
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

