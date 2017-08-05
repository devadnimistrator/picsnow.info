<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userinfo_m extends My_Model {

  public $fields = array(
      'user_id' => array(
          'label' => 'UserID',
          'rules' => array('required')
      ),
      'fullname' => array(
          'label' => 'Full Name',
          'rules' => array(
              'required',
              'min_length[6]'
          )
      ),
      'email' => array(
          'label' => 'Email',
          'rules' => array(
              'required',
              'min_length[6]',
              'valid_email')
      ),
      'phone' => array(
          'label' => 'Phone',
      )
  );

  public function find($search, $orders, $start, $length) {
    $user_m = new User_m();

    $this->db->reset_query();
    $this->db->select(array(
        $this->table . ".`id`",
        $this->table . ".`user_id`",
        $this->table . ".`fullname`",
        $this->table . ".`email`",
        $this->table . ".`phone`",
        "IF(" . $this->get_table() . ".`is_membership` = 1, 'Yes', 'No') as is_membership",
        $user_m->table . ".username",
        $user_m->table . ".last_access",
        "'' as action_str"
    ));
    $this->db->from($this->table);
    $this->db->join($user_m->table, $this->table . ".user_id=" . $user_m->table . ".`id`");
    if ($search != '') {
      $this->db->or_group_start();
      $this->db->like($user_m->table . ".`username`", $search);
      $this->db->or_like($this->table . ".`fullname`", $search);
      $this->db->or_like($this->table . ".`email`", $search);
      $this->db->or_like($this->table . ".`phone`", $search);
      $this->db->group_end();
    }
    $this->db->where($user_m->table . ".`group`='user'");

    foreach ($orders as $order) {
      switch ($order['column']) {
        case 1 :
          $order_field = $this->table . ".`fullname`";
          break;
        case 2 :
          $order_field = $this->table . ".`email`";
          break;
        case 3 :
          $order_field = $this->table . ".`phone`";
          break;
        case 4 :
          $order_field = "`is_membership`";
          break;
        case 5 :
          $order_field = $user_m->table . ".`last_access`";
          break;
      }
      $this->db->order_by($order_field, $order['dir']);
    }
    $this->db->limit($length, $start);
    $query = $this->db->get();

    return $query->result();
  }

}
