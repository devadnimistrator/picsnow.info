<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
  .panel-body {
    padding: 15px 5px;
  }
</style>

<div class="x_panel">
  <div class="x_title">
    <h2>Input Informations</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li>
        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">		
    <div class="row accordion" id="address-informations" role="tablist" aria-multiselectable="true">
      <div class="panel">
        <a class="panel-heading" role="tab" id="collapse-basic" data-toggle="collapse" data-parent="#address-informations" href="#collapse-basic-contents" aria-expanded="true" aria-controls="collapseOne">
          <h4 class="panel-title">Address Informations</h4>
        </a>
        <div id="collapse-basic-contents" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapse-basic">
          <div class="panel-body">
            <?php
            $address_m->form_add_element("address");
            $address_m->form_add_element("street_number");
            $address_m->form_add_element("city");

            $state_options = $address_m->state();
            $state_options['type'] = 'select';
            $state_options['options'] = $this->geo_states;
            $address_m->form_add_element("state", $state_options);
            $address_m->form_add_element("zipcode");
            $address_m->bs_form->form_elements(TRUE);
            ?>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>

      <div class="panel">
        <a class="panel-heading collapsed" role="tab" id="collapse-other" data-toggle="collapse" data-parent="#address-informations" href="#collapse-other-contents" aria-expanded="false" aria-controls="collapseTwo">
          <h4 class="panel-title">Description</h4>
        </a>
        <div id="collapse-other-contents" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse-other">
          <div class="panel-body">
            <?php
            $address_m->bs_form->col_width = 0;
            $address_m->form_add_element("legal_description1", array("description" => "Short description", "rows" => 2));
            $address_m->form_add_element("legal_description2", array("description" => "Detail description", "rows" => 10));
            $address_m->form_add_element("url");
            $address_m->bs_form->form_elements(TRUE);
            ?>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>

      <div class="panel">
        <a class="panel-heading collapsed" role="tab" id="collapse-owner" data-toggle="collapse" data-parent="#address-informations" href="#collapse-owner-contents" aria-expanded="false" aria-controls="collapseTwo">
          <h4 class="panel-title">Other Informations</h4>
        </a>
        <div id="collapse-owner-contents" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse-owner">
          <div class="panel-body">
            <div class="col-md-12"><label>Owner</label></div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
              <input type="text" class="form-control" name="owner_firstname" placeholder="First Name" value="<?php echo $address_m->owner_firstname; ?>">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
              <input type="text" class="form-control" name="owner_lastname" placeholder="Last Name" value="<?php echo $address_m->owner_lastname; ?>">
            </div>
            <div class="col-md-12"><label>Mortgagee</label></div>
            <div class="col-md-12 form-group">
              <input type="text" class="form-control" name="mortgagee" placeholder="Mortgagee" value="<?php echo $address_m->mortgagee; ?>">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
              <label>Loan Year</label>
              <input type="text" class="form-control" name="loan_year" placeholder="Loan Year" value="<?php echo $address_m->loan_year; ?>">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
              <label>Loan Amount</label>
              <input type="text" class="form-control" name="loan_amount" placeholder="Loan Amount" value="<?php echo $address_m->loan_amount; ?>">
            </div>
            <div class="col-md-12"><label>Trustee</label></div>
            <div class="col-md-12 form-group">
              <input type="text" class="form-control" name="trustee_name" placeholder="Trustee" value="<?php echo $address_m->trustee_name; ?>">
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>

      <div class="panel">
        <a class="panel-heading collapsed" role="tab" id="collapse-location" data-toggle="collapse" data-parent="#address-informations" href="#collapse-location-contents" aria-expanded="false" aria-controls="collapseTwo">
          <h4 class="panel-title">Location Informations</h4>
        </a>
        <div id="collapse-location-contents" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse-location">
          <div class="panel-body">
            <?php
            $address_m->bs_form->col_width = 4;
            $address_m->form_add_element("itude_lat");
            $address_m->form_add_element("itude_long");
            $address_m->bs_form->form_elements(TRUE);
            ?>		
            <img src="" id="location_image" class="img-responsive" alt="Map Image" style="width:100%;" />
            <div class="clearfix"></div>
          </div>
        </div>
      </div>

      <div class="panel">
        <div class="panel-body">
          <?php
          $address_m->bs_form->add_element("created", BSFORM_HTML, "<label>Created in</label> " . $address_m->created);
          $address_m->bs_form->form_elements(TRUE);
          echo "<br />";
          $address_m->bs_form->add_element("modified", BSFORM_HTML, "<label>Last Modified in</label> " . $address_m->modified);
          $address_m->bs_form->form_elements(TRUE);
          ?>
        </div>
      </div>

      <div class="panel">
        <div class="panel-body">
          <?php
          $address_m->bs_form->add_buttons("button", "Delete", array('class' => 'btn btn-danger', 'onclick' => 'delete_address()'));
          $address_m->bs_form->form_buttons(TRUE);
          ?>
        </div>
      </div>
    </div>
    <!-- end of accordion -->
  </div>
</div>

