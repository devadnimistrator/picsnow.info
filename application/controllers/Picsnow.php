<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for authontication
 *
 * - Signin
 * - Sugnout
 */
class Picsnow extends My_Controller {

  public $pageTitle = "Welcome";

  public function __construct() {
    parent::__construct();

    if ($this->uri->rsegment(2) == 'contactus') {
      $this->pageTitle = "Contact US";
    }
  }

  public function contactus() {
    $this->load->view('front/contactus');
  }

  public function google_map_image() {
    $latitude = $this->input->get("lat");
    $longitude = $this->input->get("long");
    $w = $this->input->get("w");
    $h = $this->input->get("h");
    $zoom = $this->input->get("zoom");

    if ($w) {
      
    } else {
      $w = 450;
    }

    if ($h) {
      
    } else {
      $h = 300;
    }

    if ($zoom) {
      
    } else {
      $zoom = 300;
    }

    $mapimgage = file_get_contents(my_get_google_map_image($latitude, $longitude, $w, $h, $zoom));

    header('Content-Type:image/jpeg');
    //header('Content-Length: ' . strlen($mapimgage));
    echo $mapimgage;
  }

  public function resize_imag() {
    $image = urldecode($this->input->get("image"));
    $w = $this->input->get("w");
    $h = $this->input->get("h");

    my_resize_image(APPPATH . "../" . PICS_UPLOAD_DIRECTORY . $image, $w, $h, "c");
  }

  function ajax_get_cities() {
    $state = $this->input->post('state');

    $this->load->model("address_m");
    $cities = $this->address_m->get_cities_by_state($state, "array");

    header('Content-Type: application/json');
    echo json_encode($cities);
  }

  function error_404() {
    $this->_define_system_values();

    $this->load->view("errors/html/error_404");
  }

}
