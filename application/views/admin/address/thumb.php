<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<a href="<?php echo base_url("admin/address/edit/" . $address->id); ?>">
  <div class="thumbnail">
    <div class="image view view-first">
      <?php if ($this->image_m->get_feature_image_by_address($address->id)): ?>
        <img src="<?php echo base_url(PICS_UPLOAD_DIRECTORY . $this->image_m->image); ?>"/>
      <?php else: ?>
        <img src="<?php echo base_url("picsnow/google_map_image?lat=" . $address->itude_lat . "&long=" . $address->itude_long); ?>" />
      <?php endif; ?>
    </div>
    <div class="caption">
      <p><?php echo my_address_display($address); ?></p>
    </div>
  </div>
</a>