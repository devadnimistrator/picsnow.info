<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for profile
 *
 * - Change Profile
 */
class Users extends My_Controller {

  public $page_title = "Users";

  public function __construct() {
    parent::__construct();

    $this->load->model("userinfo_m");

    if ($this->uri->segment(3) == 'add') {
      $this->page_title = "Add New User";
    } elseif ($this->uri->segment(3) == 'edit') {
      $this->userinfo_m->get_by_id($this->uri->segment(4));
      $this->user_m->get_by_id($this->userinfo_m->user_id);
      $this->page_title = "Edit User: @" . $this->user_m->username;
    }
  }

  public function index() {
    $this->load->view("admin/users/list");
  }

  public function edit() {
    if ($this->input->post('action') == 'process') {
      if ($this->userinfo_m->form_validate($this->input->post()) == FALSE) {
        
      } else {
        if ($this->userinfo_m->save()) {
          $this->userinfo_m->add_msg("successfully saved user informations.");
        } else {
          $this->userinfo_m->add_error("id", "Failed save user informations.");
        }
      }
    }
    
    $this->load->view('admin/users/edit', array(
        'userinfo_m' => $this->userinfo_m,
    ));
  }

  public function ajax_delete() {
    $id = $this->uri->segment(4);
    $this->userinfo_m->get_by_id($id);
    if ($this->userinfo_m->is_exists()) {
      $this->user_m->get_by_id($this->userinfo_m->user_id);
      $this->user_m->delete();
      $this->userinfo_m->delete();
    }
  }

  public function ajax_find() {
    $draw = $this->input->get('draw');
    $start = $this->input->get('start');
    $length = $this->input->get('length');
    $order = $this->input->get('order');
    $search = $this->input->get('search');

    $all_users = $this->userinfo_m->count_all();
    $users = $this->userinfo_m->find($search['value'], $order, $start, $length);

    $returnData = array(
        'draw' => $draw,
        'recordsTotal' => $all_users,
        'recordsFiltered' => count($users),
        'data' => $users
    );

    header('Content-Type: application/json');
    echo json_encode($returnData);
  }

}
