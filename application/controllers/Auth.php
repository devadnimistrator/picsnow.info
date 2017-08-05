<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for authontication
 *
 * - Signin
 * - Sugnout
 */
class Auth extends My_Controller {

  public $pageTitle = "Welcome";

  public function __construct() {
    parent::__construct();
    $this->load->model("user_m");
    $this->load->model("userinfo_m");
  }

  public function signin() {
    $error_msgs = FALSE;

    if ($this->input->post('action') == 'signin') {
      $this->load->library('form_validation');

      $valid_config = array(
          array(
              'field' => 'email',
              'label' => 'Email',
              'rules' => 'required'
          ),
          array(
              'field' => 'password',
              'label' => 'Password',
              'rules' => 'required',
          )
      );

      $this->form_validation->set_rules($valid_config);

      $this->user_m->username = $this->input->post('email');
      $this->user_m->password = $this->input->post('password');

      $error_msgs = array();
      if ($this->form_validation->run() == FALSE) {
        $error_msgs = $this->form_validation->error_array();
      } else {
        $error_code = $this->user_m->signin();

        if ($error_code == 0) {
          $this->session->set_userdata("logined_user_id", $this->user_m->id);

          redirect();
        } else {
          $error_msgs = "Name or Password is not validate.";
        }
      }
    }

    $this->load->view('front/signin', array("error_msgs" => $error_msgs));
  }

  public function signup() {
    $error_msgs = FALSE;
    $this->load->model("user_m");
    if ($this->input->post('action') == 'signup') {
      $this->load->library('form_validation');

      $valid_config = array(
          array(
              'field' => 'fullname',
              'label' => 'Fullname',
              'rules' => 'required'
          ),
          array(
              'field' => 'email',
              'label' => 'Email',
              'rules' => array('required', 'valid_email'),
          ),
          array(
              'field' => 'phone',
              'label' => 'Phone',
              'rules' => array('required'),
          ),
          array(
              'field' => 'password',
              'label' => 'Password',
              'rules' => array('required', 'min_length[6]'),
          )
      );

      $this->form_validation->set_rules($valid_config);

      $this->user_m->username = $this->input->post('username');
      $this->user_m->password = $this->input->post('password');

      $error_msgs = array();
      if ($this->form_validation->run() == FALSE) {
        $error_msgs = $this->form_validation->error_array();
      } else {
        $this->db->where("email", $this->input->post('email'));
        $count = $this->db->count_all_results($this->userinfo_m->table);

        if ($count) {
          $error_msgs = "Your email is aleady used.";
        } else {
          $user_m = new User_m();
          $user_m->username = $this->input->post("email");
          $user_m->password = my_encrypt_password($this->input->post("password"));

          if ($user_m->save()) {
            $this->userinfo_m->user_id = $user_m->id;
            $this->userinfo_m->fullname = $this->input->post("fullname");
            $this->userinfo_m->email = $this->input->post("email");
            $this->userinfo_m->phone = $this->input->post("phone");
            $this->userinfo_m->save();
            
            $this -> session -> set_userdata("logined_user_id", $user_m -> id);
            
            redirect("");
          } else {
            $error_msgs = "Failed signup. Please re-signup.";
          }
        }
      }
    }

    $this->load->view('front/signup', array("error_msgs" => $error_msgs));
  }

  public function signout() {
    $this->session->sess_destroy();
    redirect("");
  }
  
  public function success() {
    $this->load->view('front/signup_success');
  }

}
