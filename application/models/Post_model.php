<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Post_model extends CI_Model {
    function __constructor() {
	    parent::__constructor();
    }

    function get_all() {
        return $this->db->get("post")->result();
    }

    function get($id) {
        return $this->db->get_where("post", ["id" => $id])->row();
    }

    function add($photoUrl, $description, $userId) {
        $data = [
            "photo_url" => $photoUrl,
            "description" => $description,
            "user_id" => $userId
        ];

        if ($this->db->insert("post", $data)) {
            return $this->db->insert_id();
        }

        return NULL;
    }

    function remove($id) {
        if ($this->db->query("DELETE FROM post WHERE id = ?", [$id])) {
            return $this->db->affected_rows();
        }

        return NULL;
    }
}
