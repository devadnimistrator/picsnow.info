<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php my_load_css("plugins/jquery.royalslider/slider.css?v=" . time()); ?>
<?php my_load_js("plugins/jquery.royalslider/slider.min.js"); ?>

<?php
$pos = array_search($this->address_m->id, $address_list_ids);
?>

<style>
  #address-gallery {
    border: 1px solid #ccc;
    margin-bottom: 3em;
  }

  .rsDefaultInv, .rsDefaultInv .rsOverflow, .rsDefaultInv .rsSlide, .rsDefaultInv .rsVideoFrameHolder, .rsDefaultInv .rsThumbs{
    background: #fff;
  }

  .rsDefaultInv .rsThumbs {
    border-top: 1px solid #ccc;
  }

  .categories h3 {
    line-height: 1.1em;
  }

  .categories {
    margin-bottom: 2em;
  }

  @media (min-width: 992px) {
    .view-type-2 .single-left,
    .view-type-2 .single-right {
      float: right !important;
    }
  }
</style>
<!-- breadcrumbs -->
<div class="services-top-breadcrumbs">
  <div class="container">
    <div class="services-top-breadcrumbs-right">
      <ul>
        <li><a href="<?php echo base_url('gallery'); ?>">Gallery</a> <i>/</i></li>
        <li>Picture</li>
      </ul>
    </div>
    <div class="services-top-breadcrumbs-left">
      <h3><?php echo $pos + 1; ?>/<?php echo count($address_list_ids) ?></h3>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- //breadcrumbs -->
<!--single -->
<div class = "single view-type-<?php echo $view_type; ?>">
  <div class = "container">
    <div class = "col-md-8 single-left">
      <?php include_once 'images.php' ?>
      <div class="single-left3">
        <p><?php echo str_replace("\n", "</p><p>", $address->legal_description2); ?></p>
      </div>
    </div>
    <div class="col-md-4 single-right">
      <div class="categories">
        <?php include_once('info.php'); ?>
      </div>
      <?php if (count($address_list_ids) > 1) : ?>
        <div class="related-posts">
          <h3>Related</h3>
          <?php
          for ($i = 0; $i < count($address_list_ids) - 1; $i ++) {
            if ($i == $pos || ($i < $pos - 2) || ($i > $pos + 2)) {
              continue;
            }

            $address_id = $address_list_ids[$i];
            $address = new Address_m($address_id);
            ?>
            <div class="related-post">
              <div class="related-post-left">
                <a href="<?php echo my_get_address_link($address) ?>">
                  <img src="<?php echo my_get_address_image($address, 120, 90) ?> " alt=" " class="img-responsive" />
                </a>
              </div>
              <div class="related-post-right">
                <h4><a href="<?php echo my_get_address_link($address) ?>"><?php echo my_address_display($address); ?></a></h4>
              </div>
              <div class="clearfix"> </div>
            </div>
            <?php
          }
          ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- //single -->