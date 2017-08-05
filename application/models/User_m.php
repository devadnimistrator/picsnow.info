<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends My_Model {

  public $fields = array(
      'username' => array(
          'label' => 'Username',
          'rules' => array('required', 'min_length[3]', 'alpha_numeric', 'is_unique[users.username]')
      ),
      'password' => array(
          'label' => 'Password',
          'rules' => array('required', 'min_length[6]')
      ),
      'group' => array(
          'label' => 'Group',
          'rules' => array('required')
      )
  );

  public function signin() {
    $error_code = 0;

    $original_password = $this->password;
    $this->get_by_username($this->username);

    if ($this->is_exists()) {
      if (my_validate_password($original_password, $this->password)) {
        return $error_code;
      } else {
        return -2;
      }
    } else {
      return -1;
    }
  }

  public function signin_admin() {
    $error_code = $this->signin();
    if ($error_code == 0) {
      if ($this->group == 'admin') {
        return 0;
      } else {
        return -3;
      }
    }

    return $error_code;
  }

}
