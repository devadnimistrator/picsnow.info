<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Image_m extends My_Model {
  function get_feature_image_by_address($address_id) {
    $this->reset_query();
    $this->db->order_by("is_feature", "desc");
    $this->db->order_by("id");
    $this->db->limit(1);
    return $this->get_by_address_id($address_id);
  }
}
