<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Geo_state_m extends My_Model {
  public function get_states_by_country($country_code) {
    $this->db->select(array("subdivision_1_iso_code", "subdivision_1_name"));
    $this->db->where("country_iso_code", $country_code);
    $this->db->order_by("subdivision_1_iso_code");
    $query = $this->db->get($this->table);

    $result = $query->result();
    
    $states = array();
    foreach ($result as $state) {
      $states[$state->subdivision_1_iso_code] = $state->subdivision_1_name;
    }
    
    return $states;
  }

}
