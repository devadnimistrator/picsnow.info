<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-title">
  <div class="title_left">
    <h3><?php echo $this->page_title ?></h3>
  </div>
</div>
<div class="clearfix"></div>

<?php
$userinfo_m->show_msgs()
?>

<div class="row">
  <div class="col-md-4">
    <div class="x_panel">
      <div class="x_title">
        <h2>Input User Informations</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <?php
          $userinfo_m->show_errors();

          $formConfig = array(
              "name" => "editUser",
              "autocomplete" => false
          );
          $userinfo_m->form_create($formConfig);
          $userinfo_m->form_add_element("fullname");
          $userinfo_m->form_add_element("email");
          $userinfo_m->form_add_element("phone");

          $userinfo_m->form_generate();
          ?>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="x_panel">
      <div class="x_title">
        <h2>Mebership Logs</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="table-users" class="table table-striped table-bordered" width="100%">
          <thead>
            <tr>
              <th class="nosort">No</th>
              <th>Date</th>
              <th>Type</th>
              <th>Informations</th>
              <th>Status</th>
              <th class="nosort">Actions</th>
            </tr>
          </thead>
        </table>				
      </div>
    </div>
  </div>
</div>