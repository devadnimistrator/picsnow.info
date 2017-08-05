<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends My_Controller {

  public $pageTitle = "Galley";

  public function __construct() {
    parent::__construct();

    $this->load->model("address_m");
    $this->load->model("image_m");
  }

  public function index() {
    $all_count = $this->db->count_all($this->address_m->table);

    $view_params = array(
        "count_of_address" => $all_count,
        "states" => $this->address_m->get_states(),
        "cities" => $this->address_m->get_cities_by_state($this->input->post('state')),
        "addresses" => array()
    );

    $page = $this->input->post('page');
    $search = array(
        "state" => $this->input->post('state'),
        "city" => $this->input->post('city'),
        "address" => $this->input->post('keyword'),
        "page" => $page ? $page : 1,
        "page_count" => 9
    );

    $view_params['addresses'] = $this->address_m->find($search, $search['page'], $search['page_count']);
    $view_params['search_params'] = $search;

    $this->save_list_ids("front_address_list", $view_params['addresses']['result']);
    
    $this->load->view('front/gallery', $view_params);
  }

  public function detail() {
    $address_link = $this->uri->segment(2);
    if ($address_link) {
      
    } else {
      redirect("gallery");
      return;
    }

    $address_link = urldecode($address_link);
    $temp = explode("_", $address_link);
    $address_id = $temp[count($temp) - 1];

    $this->address_m->get_by_id($address_id);
    if ($this->address_m->is_exists()) {
      $this->address_m->visit ++;
      $this->address_m->save();
    } else {
      redirect("gallery");
      return;
    }

    $images = $this->image_m->get_by_address_id($address_id);

    $view_type = $this->input->get("view");
    
    $this->load->view("front/address/detail", array("address" => $this->address_m, "images" => $images,
        'address_list_ids' => $this->get_list_ids("front_address_list"), "view_type" => ($view_type ? $view_type : 1)));
  }

}
