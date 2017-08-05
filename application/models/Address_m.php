<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Address_m extends My_Model {

  public $fields = array(
      "street_number" => array(
          'label' => 'Street Number'
      ),
      'address' => array(
          'label' => 'Address',
          'rules' => array('required')
      ),
      'city' => array(
          'label' => 'City',
          'rules' => array('required')
      ),
      'state' => array(
          'label' => 'State',
          'rules' => array('required')
      ),
      'zipcode' => array(
          'label' => 'Zipcode',
          'rules' => array('required')
      ),
      'owner_firstname' => array(
          'label' => 'Owner Firstname'
      ),
      'owner_lastname' => array(
          'label' => 'Owner Lastname'
      ),
      'mortgagee' => array(
          'label' => 'Mortgagee'
      ),
      'loan_year' => array(
          'label' => 'Loan Year'
      ),
      'loan_amount' => array(
          'label' => 'Loan Amount'
      ),
      'trustee_name' => array(
          'label' => 'Trustee Name'
      ),
      'itude_lat' => array(
          'label' => 'Lat Itude',
          'rules' => 'required'
      ),
      'itude_long' => array(
          'label' => 'Long Itude',
          'rules' => 'required'
      ),
      'image' => array(
          'label' => "Choose Image",
          "type" => "file"
      ),
      'legal_description1' => array(
          'label' => "Short Description",
          "type" => "textarea",
          'rules' => 'required'
      ),
      'legal_description2' => array(
          'label' => "Detail description",
          "type" => "textarea"
      ),
      'url' => array(
          'label' => "URL",
          "type" => "url",
          "description" => "URL(Ex:http://www.zillow.com/91167341/)",
          'rules' => 'valid_url'
      )
  );

  public function display() {
    $address = $this->street_number . " " . $this->address . "<br>";
    $address.= $this->city . ", " . $this->state . " " . $this->zipcode . "<br>";

    return $address;
  }

  public function find($search, $page = 1, $limit = 12) {
    $this->set_filter($search);

    $address_count = $this->db->count_all_results();

    if ($address_count == 0) {
      return array(
          "count" => 0,
          "result" => array()
      );
    }

    $this->set_filter($search);
    $this->db->order_by("modified", "desc");
    $this->db->limit($limit, ($page - 1) * $limit);

    $query = $this->db->get();

    return array(
        "count" => $address_count,
        "result" => $query->result()
    );
  }

  private function set_filter($search) {
    $this->db->from($this->table);
    if (!empty($search['address'])) {
      $this->db->group_start();
      $this->db->like("address", $search['address']);
      $this->db->or_like("street_number", $search['address']);
      $this->db->or_like("zipcode", $search['address']);
      $this->db->group_end();
    }
    if (!empty($search['city'])) {
      if (is_array($search['city'])) {
        $this->db->where_in("city", $search['city']);
      } else {
        $this->db->where("city", $search['city']);
      }
    }
    if (!empty($search['state'])) {
      if (is_array($search['state'])) {
        $this->db->where_in("state", $search['state']);
      } else {
        $this->db->where("state", $search['state']);
      }
    }
    if (isset($search['owner']) && !empty($search['owner'])) {
      $this->db->where("owner_firstname", $search['owner'][0]);
      $this->db->where("owner_lastname", $search['owner'][1]);
    }
    if (isset($search['trustee']) && !empty($search['trustee'])) {
      $this->db->where("trustee_name", $search['trustee']);
    }
    if (isset($search['loan']) && !empty($search['loan'])) {
      $this->db->where("loan_year", $search['loan']);
    }
    
  }

  public function get_states() {
    $this->db->select("state");
    $this->db->group_by("state");
    $query = $this->db->get($this->table);

    $result = $query->result();

    $states = array();
    foreach ($result as $state) {
      $states[$state->state] = $state->state;
    }

    return $states;
  }

  public function get_cities_by_state($states = FALSE, $out_type = "object") {
    $this->db->select("city");
    if ($states) {
      if (is_array($states)) {
        $this->db->where_in("state", $states);
      } else {
        $this->db->where("state", $states);
      }
    }
    $this->db->group_by("city");
    $query = $this->db->get($this->table);

    $result = $query->result();

    $cities = array();
    foreach ($result as $city) {
      if ($out_type == 'object') {
        $cities[$city->city] = $city->city;
      } else {
        $cities[] = $city->city;
      }
    }

    return $cities;
  }

  public function get_new_address($limit = 3) {
    $this->db->order_by("modified", 'desc');
    $this->db->limit($limit);
    return $this->db->get($this->table)->result();
  }

  public function get_hot_address($limit = 4) {
    $this->db->order_by("visit", 'desc');
    $this->db->limit($limit);
    return $this->db->get($this->table)->result();
  }

}
