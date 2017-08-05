<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$pos = array_search($this->address_m->id, $address_list_ids);
?>

<div class="x_panel">
  <div class="x_title">
    <h2>Other Address<small></small></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <?php if ($pos > 0) : ?>
      <div class="row prev-address">
        <?php
        $prev_address = new Address_m();
        $prev_address->get_by_id($address_list_ids[$pos - 1]);
        $this->load->view('admin/address/thumb', array('address' => $prev_address));
        ?>
      </div>
    <?php endif; ?>
    <?php if ($pos < count($address_list_ids) - 1) : ?>
      <div class="row next-address">
        <?php
        $prev_address = new Address_m();
        $prev_address->get_by_id($address_list_ids[$pos + 1]);
        $this->load->view('admin/address/thumb', array('address' => $prev_address));
        ?>
      </div>
    <?php endif; ?>
  </div>
</div>
