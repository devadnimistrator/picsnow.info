<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
  form label {
    font-weight: 400 !important;
  }

  .radio-groups {
    padding-top: 8px;
  }

  .image img {
    width: 100%;
  }
</style>

<div class="col-md-3 col-sm-4 col-xs-12 image-filter">
  <div class="x_panel">
    <div class="x_title">
      <h2>Filters</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li>
          <a class="collapse-link" href="<?php echo base_url("admin/address"); ?>">
            <button type="button" class="btn btn-round btn-primary btn-xs">
              &nbsp;&nbsp;Reset Filter&nbsp;&nbsp;
            </button>
          </a>
        </li>
        <li>
          <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <?php $this->my_bs_form->form_start(TRUE); ?>
      <div class="input-group col-md-12">
        <input type="text" class="form-control" name="search_address" value="<?php echo $search['address']; ?>" placeholder="address or zipcode...">
      </div>
      <strong>Choose state:</strong>
      <?php
      $this->my_bs_form->add_element("page", BSFORM_HIDDEN, $search['page']);
      $this->my_bs_form->add_element("search_state", BSFORM_CHECKBOX, $search['state'], array("lavel" => "State", "isMulty" => true, "options" => $filters['states']));
      $this->my_bs_form->form_elements(TRUE);
      ?>
      <?php if (count($search['state']) > 0) : ?>
        <strong>Choose city:</strong>
        <?php
        $this->my_bs_form->add_element("search_city", BSFORM_CHECKBOX, $search['city'], array("lavel" => "City", "isMulty" => true, "options" => $filters['cities']));
        $this->my_bs_form->form_elements(TRUE);
        ?>  
      <?php endif; ?>

      <button class="btn btn-primary col-md-12" type="submit">Search</button>

      <?php $this->my_bs_form->form_end(TRUE); ?>
    </div>
  </div>

  <div class="x_panel">
    <div class="x_title">
      <h2>Import from CSV</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <?php
      $this->my_bs_form = new My_bs_form(array(
          "name" => "importCsv",
          "col_width" => 0,
          "action" => base_url("admin/address/importcsv"),
          "is_fileupload" => true
      ));
      $this->my_bs_form->form_start(TRUE);
      $this->my_bs_form->add_element("csv", BSFORM_FILE);
      $this->my_bs_form->form_elements(TRUE);
      ?>

      <button class="btn btn-primary col-md-12" type="submit">Import</button>

      <?php $this->my_bs_form->form_end(TRUE); ?>
    </div>
  </div>
</div>

<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="photo-filter x_panel">
    <div class="x_title">
      <h2>
        Addresses
        <small>
          <?php if (ceil($addresses['count'] / $search['page_count']) > 1) : ?>
            <select id="pagenum">
              <?php for ($page = 1; $page <= ceil($addresses['count'] / $search['page_count']); $page ++) : ?>
                <option value="<?php echo $page; ?>" <?php if ($page == $search['page']) echo "selected"; ?>><?php echo $page; ?></option>
              <?php endfor; ?>
            </select> page
            &nbsp;/&nbsp;
          <?php endif; ?>
          <?php echo $addresses['count']; ?> count(s)
        </small>
      </h2>
      <ul class="nav navbar-right panel_toolbox">
        <li>
          <a class="collapse-link" href="<?php echo base_url("admin/address/add"); ?>">
            <button type="button" class="btn btn-round btn-primary btn-xs">
              &nbsp;&nbsp;New Address&nbsp;&nbsp;
            </button>
          </a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <?php foreach ($addresses['result'] as $address) : ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <?php $this->load->view('admin/address/thumb', array('address' => $address)); ?>
        </div>
      <?php endforeach; ?>
      <div class="clearfix"></div>

      <?php
      $page_nums = 8;

      $page_all_count = ceil($addresses['count'] / $search['page_count']);

      $page = $search['page'];
      ?>
      <?php if ($page_all_count > 1) : ?>

        <?php
        $first_page = floor(($page - 1) / $page_nums) * $page_nums + 1;
        ?>
        <div class="col-md-12">
          <ul class="pagination ">
            <?php if ($page_all_count > $page_nums && $page > 1): ?>
              <li><a href="#1" page="1">&laquo;</a></li>
              <li><a href="#<?php echo $page - 1; ?>" page="<?php echo $page - 1; ?>">&lt;</a></li>
            <?php endif; ?>
            <?php for ($p = $first_page; $p < $first_page + $page_nums && $p <= $page_all_count; $p ++) : ?>
              <li class="<?php if ($p == $page) echo "active"; ?>"><a href="#<?php echo $p; ?>" page="<?php echo $p; ?>"><?php echo $p; ?></a></li>
            <?php endfor; ?>
            <?php if ($page_all_count > $page_nums && $page < $page_all_count): ?>
              <li><a href="#<?php echo $page + 1; ?>" page="<?php echo $page + 1; ?>">&gt;</a></li>
              <li><a href="#<?php echo $page_all_count; ?>" page="<?php echo $page_all_count; ?>">&raquo;</a></li>
            <?php endif; ?>
          </ul>
        </div>

      <?php endif; ?>
    </div>
  </div>
</div>

<script>
  $("#pagenum").change(function () {
    $("#em-page").val($(this).val());
    $("#form-searchAddress").submit();
  })

  $(".pagination a").click(function () {
    document.searchAddress.page.value = $(this).attr('page');
    document.searchAddress.submit();
  });
</script>