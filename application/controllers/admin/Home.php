<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Controller {
	public $page_title = "Home"; 
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->view('admin/home/dashboard');
	}
}
