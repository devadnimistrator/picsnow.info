<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Basic My Controller
 */
class My_Controller extends CI_Controller {

  public $logined_user = FALSE;
  public $is_admin_page = FALSE;

  public function __construct() {
    parent::__construct();
    // Your own constructor code
    
    $this->_define_system_values();
    
    if ($this->uri->rsegment(1) == 'picsnow') {
      return;
    }
    
    if ($this->session->userdata('logined_user_id')) {
      $this->load->model("user_m");
      $this->load->model("userinfo_m");
      $this->logined_user = $this->user_m;
      $this->logined_user->get_by_id($this->session->userdata('logined_user_id'));

      $this->logined_userinfo = new Userinfo_m();
      $this->logined_userinfo->get_by_user_id($this->logined_user->id);


      $this->logined_user->last_access = date('Y-m-d H:i:s');
      $this->logined_user->save();
    }

    $this->_check_role();

    if ($this->uri->segment(1) == 'admin') {
      $this->is_admin_page = TRUE;
    }
  }

  /**
   * Check user for signin and role
   */
  private function _check_role() {
    $no_logined_pages = $this->config->item('no_login_pages');
    $current_path = uri_string();
    if (in_array($current_path, $no_logined_pages)) {
      // Page is that don't need signin
    } else {
      if ($this->logined_user === FALSE) {// if user didn't signin
        if ($this->uri->segment(1) == 'admin') {
          redirect('admin/auth/signin');
        } else {
          redirect('auth/signin');
        }
      } else {// if current page is admin panel
        if ($this->uri->segment(1) == 'admin' && $this->logined_user->group != 'admin') {
          redirect('admin/auth/signin');
        }
      }
    }
  }

  /**
   * Design system configurations
   */
  public function _define_system_values() {
    $configs = $this->config_m->get_all();
    foreach ($configs as $config) {
      if (defined($config->name)) {
        
      } else {
        define($config->name, $config->value);
      }
    }
  }

  /**
   * Utilizing the CodeIgniter's _remap function
   * to call extra functions with the controller action
   */
  public function _remap($method, $args) {
    if (strpos($method, "ajax") !== 0) {
      // Call before action
      $this->_before();
    }

    if (method_exists($this, $method)) {
      //  Call the method
      call_user_func_array(array(
          $this,
          $method
          ), $args);
    } else {
      show_404();
    }

    if (strpos($method, "ajax") !== 0) {
      // Call after action
      $this->_after();
    }
  }

  private function _before() {
    if ($this->is_admin_page) {
      if ($this->uri->segment(2) == 'auth') {
        
      } else {
        $this->load->view('admin/common/header');
      }
    } else {
      $this->load->view('front/common/header');
    }
  }

  private function _after() {
    if ($this->is_admin_page) {
      if ($this->uri->segment(2) == 'auth') {
        
      } else {
        $this->load->view('admin/common/footer');
      }
    } else {
      $this->load->view('front/common/footer');
    }
  }

  public function save_list_ids($path, $model_list) {
    $ids = array();
    foreach ($model_list as $model) {
      $ids[] = $model->id;
    }

    $this->session->set_userdata($path, $ids);
  }

  public function get_list_ids($path) {
    $ids = $this->session->userdata($path);
    if ($ids) {
      return $ids;
    } else {
      return false;
    }
  }

}
