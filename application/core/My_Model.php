<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Basic My Model
 */
class My_Model extends CI_Model {

  public $table = "";
  private $db_fields = array();
  public $fields = array();
  public $errors = array();
  public $msgs = array();

  public function __construct($id = null) {
    parent::__construct();
// Your own constructor code

    $this->_init();

    if ($id) {
      $this->get_by_id($id);
    }
  }

  private function _init() {
    if ($this->table) {
      
    } else {
      $model_name = strtolower(get_class($this));
      if (substr($model_name, strlen($model_name) - 2) == '_m') {
        $model_name = substr($model_name, 0, strlen($model_name) - 2);
      }

      $this->table = plural($model_name);
    }

    $fields = $this->db->field_data($this->table);

    foreach ($fields as $field) {
      $this->db_fields[$field->name] = $field;

      if (isset($this->fields[$field->name])) {
        
      } else {
        $this->fields[$field->name] = array(
        );
      }

      if (!isset($this->fields[$field->name]['label'])) {
        $this->fields[$field->name]['label'] = ucwords($field->name);
      }

      if (!isset($this->fields[$field->name]['type'])) {
        $this->fields[$field->name]['type'] = $field->type;
      }

      $this->fields[$field->name]['value'] = "";

      if ($field->default == 'CURRENT_TIMESTAMP') {
        $this->fields[$field->name]['value'] = date('Y-m-d H:i:s');
      } else {
        $this->fields[$field->name]['value'] = $field->default;
      }
    }
  }

  /**
   * Call
   *
   * Calls the watched method.
   *
   * @access	overload
   * @param	string
   * @param	string
   * @return	void
   */
  function __call($method, $arguments) {
    if (strpos($method, "get_by_") === 0) {
      return $this->_get_by(substr($method, 7), $arguments[0]);
    } elseif (isset($this->fields[$method])) {
      if (count($arguments) > 0) {
        $this->fields[$method] = $arguments;
      } else {
        return $this->fields[$method];
      }
    }
  }

  function __get($field) {
    if (isset($this->fields[$field])) {
      return $this->fields[$field]['value'];
    } elseif (isset($this->{$field})) {
      return $this->{$field};
    }

    return parent::__get($field);
  }

  function __set($field, $value) {
    if (isset($this->fields[$field])) {
      $this->fields[$field]['value'] = $value;
    } else {
      $this->{$field} = $value;
    }
  }

  private function _get_by($field, $value) {
    $this->db->where($field, $value);
    $result = $this->db->get($this->table)->result();

    if (!empty($result) && count($result) > 0) {
      foreach ($this->fields as $field => $infos) {
        if (isset($result[0]->{$field})) {
          $this->{$field} = $result[0]->{$field};
        }
      }
    } else {
      return false;
    }

    return $result;
  }

  public function get_table() {
    return $this->db->dbprefix($this->table);
  }

  public function is_exists() {
    if ($this->id) {
      return TRUE;
    } else {
      return false;
    }
  }

  function add_field($field, $options) {
    $options = array_merge(array("type" => "text", "value" => ""), $options);
    $this->fields[$field] = $options;
  }

  function validate($values = array()) {
    
  }

  public function count_all() {
    return $this->db->count_all($this->table);
  }

  public function save() {
    $data = array();
    foreach ($this->fields as $field_name => $field_data) {
      if (isset($this->db_fields[$field_name])) {
        $data[$field_name] = $field_data['value'];
      }
    }

    if ($this->is_exists()) {
      return $this->db->update($this->table, $data, array("id" => $this->id));
    } else {
      $status = $this->db->insert($this->table, $data);
      if ($status) {
        $new_id = $this->db->insert_id();
        if ($new_id) {
          $this->id = $new_id;
        }
      }

      return $status;
    }
  }

  public function delete() {
    if ($this->is_exists()) {
      $this->db->delete($this->table, array('id' => $this->id));
    }
  }

  public function add_error($field, $msg) {
    $this->errors[$field] = $msg;
  }

  public function show_errors() {
    my_show_form_validateion_errors($this->errors);
  }

  public function add_msg($msg, $type = 'info') {
    $this->msgs[] = array("type" => $type, "text" => $msg);
  }

  public function show_msgs() {
    foreach ($this->msgs as $msg) {
      my_show_msg($msg["text"], $msg['type']);
    }
  }

  /*   * ****************************************
   * 
   *    BS FORM
   * 
   * **************************************** */

  public $bs_form = null;

  public function form_create($config) {
    require_once (APPPATH . 'libraries/My_bs_form.php');
    $this->bs_form = new My_bs_form($config);

    $this->form_add_element('action', array(
        'type' => BSFORM_HIDDEN,
        'value' => 'process'
    ));
  }

  public function form_add_element($field, $add_options = FALSE) {
    $options = array();
    if (isset($this->fields[$field])) {
      $options = $this->fields[$field];
    }
    $options = array_merge(array("label" => ucwords($field), "value" => ""), $options);
    if ($add_options && is_array($add_options)) {
      $options = array_merge($options, $add_options);
    }
    $this->bs_form->add_element($field, $options['type'], $options['value'], $options);
  }

  public function form_generate($output = TRUE) {
    $html = $this->bs_form->generate(FALSE);
    if ($output) {
      echo $html;
    } else {
      return $html;
    }
  }

  public function form_validate($values) {
    $this->load->library('form_validation');

    foreach ($values as $field => $value) {
      if (isset($this->fields[$field])) {
        $this->fields[$field]['value'] = is_array($value) ? $value : trim($value);

        $this->form_validation->set_rules($field, $this->fields[$field]['label'], isset($this->fields[$field]['rules']) ? $this->fields[$field]['rules'] : array());
      }
    }

    if ($this->form_validation->run() == FALSE) {
      $this->errors = $this->form_validation->error_array();

      return FALSE;
    }
    return TRUE;
  }

}
