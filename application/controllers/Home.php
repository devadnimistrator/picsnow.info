<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Controller {
	public $pageTitle = "Home";
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
    $this->load->model("address_m");
    $all_count = $this->db->count_all($this->address_m->table);
    
    $view_params = array(
        "count_of_address" => $all_count,
        "states" => $this->address_m->get_states(),
        "cities" => $this->address_m->get_cities_by_state(),
    );
    
		$this->load->view('front/home', $view_params);
	}
}
