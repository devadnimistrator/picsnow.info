<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for set system config
 *
 */
class Config extends My_Controller {
	public $page_title = "Home"; 
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->page_title = "System Configuration";
		
		if ($this->input->post('action') == 'process') {
			$configs = array(
				'SITE_TITLE' => $this->input->post('site_title'),
				'CONTACT_EMAIL' => $this->input->post('contact_email'),
				'CONTACT_PHONE' => $this->input->post('contact_phone'),
				'CONTACT_STREET' => $this->input->post('contact_street'),
				'FRONT_SKIN' => $this->input->post('front_skin')
			);
			
			$this->config_m->set_config($configs);
			
			redirect('admin/config');
		}
		
		$this->load->view('admin/config');
	}
}
