<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$formConfig = array(
    "name" => "editAddress",
    "autocomplete" => false,
    "is_fileupload" => true
);
$address_m->form_create($formConfig);

$address_m->bs_form->form_start(TRUE);
?>

<div class="page-title">
  <div class="title_left">
    <h3>
      <?php echo $this->page_title ?>
    </h3>
  </div>
  <div class="title_right">
    <div class="pull-right">
      <button type="button" class="btn btn-info" onclick="location.href = '<?php echo base_url('admin/address/add'); ?>'">New Address</button>
    </div>
  </div>
</div>
<div class="clearfix"></div>

<?php
$address_m->show_msgs();

$address_m->show_errors();
?>

<div class="row">
  <div class="col-md-4 col-sm-12">
    <?php include_once("edit_info.php"); ?>
  </div>

  <?php if ($this->address_m->is_exists()) : ?>
    <div class="col-md-6 col-sm-12">
      <?php include_once("edit_image.php"); ?>
    </div>

    <?php if (count($address_list_ids) > 1) : ?>
      <div class="col-md-2">
        <?php include_once("nav_address_list.php"); ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>
</div>

<?php echo my_load_js("plugins/imageloaded.min.js"); ?>

<script>
  $(function () {
    $("#em-itude_lat").change(function () {
      show_google_map();
    });

    $("#em-itude_long").change(function () {
      show_google_map();
    });
<?php if ($redirect_url): ?>
      setTimeout(function () {
        location.href = '<?php echo $redirect_url; ?>';
      }, 1500);
<?php endif; ?>
    show_google_map();
  })
  function show_google_map() {
    var lat_itude = $("#em-itude_lat").val();
    var long_itude = $("#em-itude_long").val();

    if (lat_itude && long_itude) {
      //$("#location_image").attr("src", "https://maps.googleapis.com/maps/api/staticmap?center=" + lat_itude + "," + long_itude + "&zoom=17&maptype=hybrid&size=600x400");

      //$("#location_image").attr("src", "https://maps.googleapis.com/maps/api/staticmap?center=" + lat_itude + "," + long_itude + "&zoom=15&scale=false&size=450x300&maptype=roadmap&format=jpg&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7C" + lat_itude + "," + long_itude + "");
      //$("#location_image").attr("src", "https://dev.virtualearth.net/REST/v1/Imagery/Map/Aerial/" + lat_itude + "," + long_itude + "/17?mapSize=480,320&key=Au7rlsDVn0-CG7wNZOyP72-Ka-XfbNT1UqVHArNnPj1KSh9CFvvO8TNv_vgi6M1r");

      $("#location_image").attr("src", "<?php echo base_url("picsnow/google_map_image"); ?>?lat=" + lat_itude + "&long=" + long_itude);

      $("#collapse-location-contents").imagesLoaded(function () {
        //$container.isotope('layout');
      });
    }
  }

  function delete_address() {
    if (confirm("Are you sure delete this address?")) {
      location.href = "<?php echo base_url("admin/address/delete/" . $address_m->id) ?>";
    }
  }
</script>

<?php
$address_m->bs_form->form_start(TRUE);
