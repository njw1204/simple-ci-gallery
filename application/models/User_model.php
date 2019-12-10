<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User_model extends CI_Model {
    function __constructor() {
	    parent::__constructor();
    }

    function get_all() {
        return $this->db->get("user")->result();
    }

    function get($id) {
        return $this->db->get_where("user", ["id" => $id])->row();
    }

    function get_by_username($username, $password=NULL) {
        if ($password === NULL) {
            return $this->db->get_where("user", ["username" => $username])->row();
        }
        else {
            return $this->db->query("SELECT * FROM user WHERE username = ? AND password = SHA2(?, 256)", [$username, $password])->row();
        }
    }

    function add($username, $password) {
        if ($this->db->query("INSERT INTO user(username, password) VALUES(?, SHA2(?, 256))", [$username, $password])) {
            return $this->db->insert_id();
        }

        return NULL;
    }
}
