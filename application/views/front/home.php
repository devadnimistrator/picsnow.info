<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>  

<!-- banner -->
<div class="banner">
  <div class="container">
    <div class="banner-left">
      <h3>We have <?php echo $count_of_address; ?> address lists.</h3>
      <p>Please search for your request.</p>
    </div>
    <div class="banner-right">
      <h3><span>Search For Home</span></h3>
      <div class="reservation">
        <form action="<?php echo base_url("gallery"); ?>" method="post">
          <div class="reservation-grids">
            <div class="reservation-grid-left">
              <div class="section_room">
                <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
                <select id="search-state" name="state" onchange="change_state(this.value, 1)" class="frm-field">
                  <option value="">State</option>
                  <?php foreach ($states as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="reservation-grid-right">
              <div class="section_room">
                <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
                <select id="search-city" name="city" class="frm-field">
                  <option value="">City</option>
                  <?php foreach ($cities as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="clearfix"> </div>
          </div>
          <div class="keywords">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
            <input type="text" name="keyword" placeholder="Address or ZipCode" >
            <input type="submit" value="Search">
          </div>
        </form>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- //banner -->

<script>
  function change_state(state) {
    $.post("<?php echo base_url("picsnow/ajax_get_cities") ?>", {"state": state}, function (cities) {
      for (var i = 0; i < cities.length; i++) {
        $("#search-city").html('');
        $("#search-city").append('<option value="">City</option>');
        $("#search-city").append('<option value="' + cities[i] + '">' + cities[i] + '</option>');
      }
    }, 'json');
  }
</script>
