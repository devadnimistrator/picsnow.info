<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller for profile
 *
 * - Change Profile
 */
class Address extends My_Controller {

  public $page_title = "Address";

  public function __construct() {
    parent::__construct();

    $this->load->model("address_m");
    $this->load->model("image_m");

    if ($this->uri->segment(3) == 'add') {
      $this->page_title = "Add New Address";
    } elseif ($this->uri->segment(3) == 'edit') {
      $this->address_m->get_by_id($this->uri->segment(4));
      $this->page_title = "Edit Address: #" . $this->address_m->id;
    }

    $this->load->model('geo_state_m');

    $this->geo_states = $this->geo_state_m->get_states_by_country(DEFAULT_COUNTRY);
  }

  public function index() {
    $formConfig = array(
        "name" => "searchAddress",
        "col_width" => 0
    );
    $this->load->library('my_bs_form', $formConfig);

    $search = array(
        "address" => $this->input->post('search_address'),
        "state" => $this->input->post('search_state') ? $this->input->post('search_state') : array(),
        "city" => $this->input->post('search_city'),
        "page" => $this->input->post('page'),
        "page_count" => 20
    );

    if ($search['page']) {
      
    } else {
      $search['page'] = 1;
    }

    $filters = array();
    $filters['states'] = $this->address_m->get_states();
    if (count($search['state']) > 0) {
      $filters['cities'] = $this->address_m->get_cities_by_state($search['state']);
    }

    $addresses = $this->address_m->find($search, $search['page'], $search['page_count']);
    $this->save_list_ids("admin_address_list", $addresses['result']);

    $this->load->view("admin/address/list", array("addresses" => $addresses,
        "search" => $search,
        "filters" => $filters));
  }

  public function add() {
    $this->edit();
  }

  public function edit() {

    $formConfig = array(
        "name" => "editUser",
        "autocomplete" => false,
        "is_fileupload" => true,
    );
    $this->load->library('my_bs_form', $formConfig);

    $redirect_url = "";
    if ($this->input->post('action') == 'process') {
      $config = $this->config->item("address_pic");
      $this->load->library('upload', $config);

      if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
        if (!$this->upload->do_upload('image')) {
          $this->address_m->add_error("image", $this->upload->display_errors());
        } else {
          $upload_data = $this->upload->data();

          $image_m = new Image_m();
          $image_m->address_id = $this->address_m->id;
          $image_m->image = $upload_data['file_name'];
          $image_m->save();
        }
      }

      if ($this->address_m->form_validate($this->input->post()) == FALSE) {
        
      } else {
        if ($this->address_m->is_exists()) {
          $this->address_m->modified = date('Y-m-d H:i:s');
        }
        if ($this->address_m->save()) {
          $this->address_m->add_msg("Successfully saved user informations.");

          /* if ($new_image && $old_image) {
            @unlink(FCPATH . $old_image);
            } */

          if ($this->address_m->is_exists()) {
            
          } else {
            $redirect_url = base_url("admin/address/edit/" . $this->address_m->id);
          }
        } else {
          $this->address_m->add_error("id", "Failed save user informations.");
        }
      }
    }

    $this->load->view('admin/address/edit', array(
        'address_m' => $this->address_m,
        'redirect_url' => $redirect_url,
        'address_list_ids' => $this->get_list_ids("admin_address_list")
    ));
  }

  public function delete() {
    $id = $this->uri->segment(4);
    $this->address_m->get_by_id($id);
    if ($this->address_m->is_exists()) {
      @unlink(FCPATH . $this->address_m->image);
      $this->address_m->delete();
    }

    redirect("admin/address");
  }

  public function importcsv() {
    $error_msg = "";
    $success_msg = "";
    if (isset($_FILES['csv']) && $_FILES['csv']['tmp_name']) {
      if ($_FILES['csv']['type'] != 'application/vnd.ms-excel') {
        $error_msg = "This is not csv file. Please upload csv file.";
      } else {
        $handle = fopen($_FILES['csv']['tmp_name'], "r");
        $row = 0;

        $meta_fields = array();

        while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
          $row ++;
          if ($row == 1) {
            foreach ($data as $field) {
              $meta_fields[] = $field;
            }
            continue;
          }

          $address_id = $data[0];
          $address_m = new Address_m();
          $address_m->get_by_id($address_id);
          if ($address_m->is_exists()) {
            
          } else {
            $this->db->where("city", $data[1]);
            $this->db->where("street_number", $data[3]);
            $this->db->where("address", $data[4]);
            $this->db->where("zipcode", $data[6]);
            $temp = $this->db->get($address_m->table)->result();
            if (!empty($temp)) {
              $address_m->id = $temp[0]->id;
              $address_id = $temp[0]->id;
            }
          }
          $address_info = array();
          $address_info['city'] = $data[1];
          $address_info['street_number'] = $data[3];
          $address_info['address'] = $data[4];
          $address_info['zipcode'] = $data[6];
          $address_info['legal_description1'] = $data[7];
          $address_info['legal_description2'] = $data[8];
          $address_info['itude_lat'] = $data[14];
          $address_info['itude_long'] = $data[15];
          $address_info['owner_firstname'] = $data[16];
          $address_info['owner_lastname'] = $data[17];
          $address_info['mortgagee'] = $data[18];
          $address_info['loan_year'] = $data[19];
          $address_info['loan_amount'] = $data[20];
          $address_info['trustee_name'] = $data[21];
          $address_info['modified'] = date('Y-m-d H:i:s');

          $address_meta = array();
          for ($i = 0; $i < count($meta_fields); $i ++) {
            $address_meta[$meta_fields[$i]] = "";
            if (isset($data[$i]) && !empty($data[$i])) {
              $address_meta[$meta_fields[$i]] = $data[$i];
            }
          }
          $address_info['info'] = json_encode($address_meta);

          if ($address_m->is_exists()) {
            $this->db->update($address_m->table, $address_info, array("id" => $address_id));
          } else {
            $address_info['created'] = date('Y-m-d H:i:s');
            $address_info['id'] = $address_id;
            $this->db->insert($address_m->table, $address_info);

            $address_m->get_by_id($address_id);
            $images = my_find_images_by_address($address_m);
            if (!empty($images)) {
              for ($i = 0; $i < count($images); $i ++) {
                $image_m = array();
                $image_m['address_id'] = $address_id;
                $image_m['image'] = $images[$i];
                $image_m['is_feature'] = 0;
                if ($i == 0) {
                  $image_m['is_feature'] = 1;
                }
                
                $this->db->insert($this->image_m->table, $image_m);
              }
            }
          }
        }
        fclose($handle);
        @unlink($_FILES['csv']['tmp_name']);

        $success_msg = "Successfully imported data: " . ($row - 1) . " count[s]";
      }
    } else {
      $error_msg = "Please choose csv file.";
    }

    $this->load->view("admin/address/importcsv", array("success" => $success_msg, "error" => $error_msg));
  }

  public function ajax_get_resouce_images() {
    $address_id = $this->uri->segment(4);
    $page = $this->uri->segment(5);

    $this->address_m->get_by_id($address_id);

    if ($page == 0) {
      $images = my_find_images_by_address($this->address_m);
    } else {
      $images = my_get_images_from_folder($page);
    }

    header('Content-Type: application/json');
    echo json_encode($images);
  }

  public function ajax_add_image() {
    $this->image_m->address_id = $this->uri->segment(4);
    $this->image_m->image = $this->input->post('image');
    $this->image_m->save();

    echo $this->image_m->id;
  }

  public function ajax_delete_image() {
    $image_id = $this->uri->segment(4);

    $this->image_m->get_by_id($image_id);
    if ($this->image_m->is_exists()) {
      $this->image_m->delete();
    }
  }

  public function ajax_set_feature_image() {
    $image_id = $this->uri->segment(4);

    $this->image_m->get_by_id($image_id);
    if ($this->image_m->is_exists()) {
      $this->image_m->is_feature = 1;
      $this->image_m->save();

      $this->db->set('is_feature', 0);
      $this->db->where('address_id', $this->image_m->address_id);
      $this->db->where('`id` !=', $image_id);
      $this->db->update($this->image_m->table);
    }
  }

  public function ajax_view_map() {
    $latitude = $this->input->get("lat");
    $longitude = $this->input->get("long");

    $mapimgage = file_get_contents(my_get_google_map_image($latitude, $longitude));

    header('Content-Type:image/jpeg');
    //header('Content-Length: ' . filesize($mapimgage));
    echo $mapimgage;
  }

  function ajax_delete_resource() {
    $file = $this->input->post('file');

    $this->db->where("image", $file);
    $this->db->delete($this->image_m->table);

    @unlink(FCPATH . PICS_UPLOAD_DIRECTORY . $file);

    exit;
  }

}
