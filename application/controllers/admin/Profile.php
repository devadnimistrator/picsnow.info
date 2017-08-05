<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for profile
 *
 * - Change Profile
 */
class Profile extends My_Controller {

  public $page_title = "Change Password";

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    redirect("admin/profile/change_password");
  }

  public function change_password() {
    $this->logined_user->add_field('old_password', array(
        'type' => 'password',
        'label' => 'Old Password',
        'rules' => array('required')
    ));
    $this->logined_user->add_field('new_password', array(
        'type' => 'password',
        'label' => 'New Password',
        'rules' => array(
            'required',
            'min_length[6]'
        )
    ));
    $this->logined_user->add_field('re_password', array(
        'type' => 'password',
        'label' => 'Repeat Password',
        'rules' => array(
            'required',
            'matches[new_password]'
        )
    ));

    if ($this->input->post('action') == 'process') {
      if ($this->logined_user->form_validate($this->input->post()) == FALSE) {
        
      } else {
        $old_password = $this->logined_user->old_password;
        if (my_validate_password($old_password, $this->logined_user->password)) {
          $this->logined_user->password = my_encrypt_password($this->logined_user->new_password);
          if ($this->logined_user->save()) {
            $this->logined_user->add_msg("You have successfully changed password. After next login, you can use the new password.");
          } else {
            $this->logined_user->add_error('old_password', "Failed change password.");
          }
        } else {
          $this->logined_user->add_error('old_password', "Incorrect old password.");
        }
      }
    }

    $this->load->view('admin/profile/change_password', array(
        "user_m" => $this->logined_user
    ));
  }

}
