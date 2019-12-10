<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Main extends CI_Controller {
    function __constructor() {
        parent::__constructor();
    }

	function index() {
        $data = [];

        $data["user"] = $this->User_model->get($this->session->userPK);
        $data["posts"] = $this->Post_model->get_all();
		$this->load->view("index", $data);
	}

    function login() {
        $data = [];

        if ($this->input->method() === "get") {
            $this->load->view("login", $data);
        }
        else if ($this->input->method() === "post") {
            $user = $this->User_model->get_by_username($this->input->post("username"), $this->input->post("password"));
            if (!$user) {
                $data["message"] = "로그인에 실패했습니다.";
                $this->load->view("login", $data);
            }
            else {
                $this->session->userPK = $user->id;
                redirect("/");
            }
        }
        else {
            set_status_header(405);
        }
    }

    function logout() {
        unset($_SESSION["userPK"]);
        redirect("/");
    }

    function signup() {
        $data = [];

        if ($this->input->method() === "get") {
            $this->load->view("signup", $data);
        }
        else if ($this->input->method() === "post") {
            if ($this->input->post("password") !== $this->input->post("password2")) {
                $data["message"] = "비밀번호가 일치하지 않습니다.";
                return $this->load->view("signup", $data);
            }

            $userPK = $this->User_model->add($this->input->post("username"), $this->input->post("password"));
            if (!$userPK) {
                $data["message"] = "회원가입에 실패했습니다.";
                $this->load->view("signup", $data);
            }
            else {
                $this->session->userPK = $userPK;
                redirect("/");
            }
        }
        else {
            set_status_header(405);
        }
    }

    function newPost() {
        $data = [];

        if (!$this->session->userPK) {
            set_status_header(403);
            return redirect("/");
        }

        if ($this->input->method() === "get") {
            $this->load->view("new-post", $data);
        }
        else if ($this->input->method() === "post") {
            $config["upload_path"] = "uploads/";
            $config["allowed_types"] = "gif|jpg|png";
            $config["max_size"] = 10 * 1024;
            $config["encrypt_name"] = TRUE;
            $this->upload->initialize($config);

            if ($this->upload->do_upload("file")) {
                $photoUrl = $config["upload_path"].$this->upload->data("file_name");
                if ($this->Post_model->add($photoUrl, $this->input->post("description"), $this->session->userPK)) {
                    redirect("/");
                }
                else {
                    unlink($photoUrl);
                    $data["message"] = "등록에 실패했습니다.";
                    $this->load->view("new-post", $data);
                }
            }
            else {
                $data["message"] = "사진 업로드에 실패했습니다.";
                $this->load->view("new-post", $data);
            }
        }
        else {
            set_status_header(405);
        }
    }

    function removePost() {
        if ($this->input->method() === "post") {
            $post = $this->Post_model->get($this->input->post("post_id"));

            if (!$this->session->userPK || $this->session->userPK !== $post->user_id) {
                set_status_header(403);
                return redirect("/");
            }

            unlink($post->photo_url);
            $this->Post_model->remove($post->id);
            return redirect("/");
        }
        else {
            set_status_header(405);
        }
    }
}
