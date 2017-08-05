<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$images = $this->image_m->get_by_address_id($address_m->id);
?>

<style>
  .thumbnail {
    height: auto;
  }

  .thumbnail img {
    width: 100%;
  }

  .featured .thumbnail {
    border-color: #ac2925;
  }

  .pagination {
    margin: 0;
  }

  #image-list .featured .set-featured {
    display: none;
  }

  .view .mask {
    padding-bottom: 100px;
  }

  .view .tools {
    margin-top: 10px;
  }
</style>

<div class="x_panel">
  <div class="x_title">
    <h2>Images<small></small></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="row" id="image-list">
      <?php if ($images): ?>
        <?php foreach ($images as $image) : ?>
          <div class="col-md-3 col-sm-4 <?php echo ($image->is_feature ? "featured" : ""); ?>" id="image-<?php echo $image->id; ?>">
            <div class="thumbnail">
              <div class="image view view-first">
                <img src="<?php echo base_url(PICS_UPLOAD_DIRECTORY . $image->image) ?>" alt="image" />
                <div class="mask">
                  <p><?php echo $image->image; ?></p>
                  <div class="tools tools-bottom">
                    <a href="javascript:set_feature_image(<?php echo $image->id; ?>);" data-toggle="tooltip" title="Set feature" class="set-featured">
                      <i class="fa fa-check"></i>
                    </a>
                    <a href="javascript:delete_image(<?php echo $image->id; ?>);" data-toggle="tooltip" title="Delete image"><i class="fa fa-times"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="x_panel">
  <div class="x_title">
    <h2>Choose image<small></small></h2>
    <ul class="navbar-right pagination pagination-split">
      <li><a href="#" data-page="0">Recommend</a></li>
      <?php
      $file_list = scandir(FCPATH . PICS_UPLOAD_DIRECTORY);
      $filecount = count($file_list) - 2;

      $page_count = ceil($filecount / 20);
      for ($p = 0; $p < $page_count; $p ++) {
        echo '<li><a href="javascript:" data-page="' . ($p + 1) . '">' . ($p + 1) . '</a></li>';
      }
      ?>  
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="row">
      <div id="resource-list"></div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<div class="x_panel">
  <div class="x_title">
    <h2>Upload new image</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li>
        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">		
    <?php
    $address_m->form_add_element("image");
    $address_m->bs_form->form_elements(TRUE);
    ?>
  </div>
</div>

<script>
  $(function () {
    $(".pagination a").click(function () {
      get_choose_images($(this).attr('data-page'));
    });

    get_choose_images(0);
  });

  function get_choose_images(page_num) {
    $.getJSON("<?php echo base_url("admin/address/ajax_get_resouce_images/" . $this->address_m->id) ?>/" + page_num, function (images) {
      var html = '';
      for (i = 0; i < images.length; i++) {
        html += '<div class="col-md-3 col-sm-4 image-thumb">';
        html += '<div class="thumbnail">';
        html += '<div class="image view view-first">';
        html += '<img src="<?php echo base_url(PICS_UPLOAD_DIRECTORY) ?>/' + encodeURI(images[i]) + '" alt="image" id="preview-image"/>';
        html += '<div class="mask">';
        html += '<p>' + images[i] + '</p>';
        html += '<div class="tools tools-bottom">';
        html += '<a href="javascript:add_image(\'' + images[i] + '\')" data-toggle="tooltip" title="Add image"><i class="fa fa-plus"></i></a>';
        html += '<a href="javascript:delete_resource(' + i + ', \'' + images[i] + '\')" data-toggle="tooltip" title="Delete image"><i class="fa fa-times"></i></a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
      }

      $("#resource-list").html(html);

      tooltip_init();
    });
  }

  function add_image(image) {
    $.post("<?php echo base_url("admin/address/ajax_add_image/" . $this->address_m->id) ?>",
            {
              image: image
            },
            function (image_id) {
              var html = '';
              html += '<div class="col-md-3 col-sm-4 image-thumb" id="image-' + image_id + '">';
              html += '<div class="thumbnail">';
              html += '<div class="image view view-first">';
              html += '<img src="<?php echo base_url(PICS_UPLOAD_DIRECTORY) ?>/' + encodeURI(image) + '" alt="image" />';
              html += '<div class="mask">';
              html += '<p>' + image + '</p>';
              html += '<div class="tools tools-bottom">';
              html += '<a href="javascript:set_feature_image(' + image_id + ');" data-toggle="tooltip" title="Set feature" class="set-featured"><i class="fa fa-check"></i></a>';
              html += '<a href="javascript:delete_image(' + image_id + ');" data-toggle="tooltip" title="Delete image"><i class="fa fa-times"></i></a>';
              html += '</div>';
              html += '</div>';
              html += '</div>';
              html += '</div>';
              html += '</div>';

              $("#image-list").append(html);

              tooltip_init();
            });
  }

  function delete_image(image_id) {
    if (!confirm("Are you sure delete this image?")) {
      return false;
    }
    $.get("<?php echo base_url("admin/address/ajax_delete_image"); ?>/" + image_id, function () {
      $("#image-" + image_id).fadeOut("fast", function () {
        $(this).remove();
      })
    });
  }

  function set_feature_image(image_id) {
    $.get("<?php echo base_url("admin/address/ajax_set_feature_image"); ?>/" + image_id, function () {
      $("#image-list .featured").removeClass("featured");
      $("#image-" + image_id).addClass("featured");
    });
  }

  function delete_resource(index, resource) {
    if (!confirm("Are you sure delete this image?\nIf you continue delete, this image will remove from server.")) {
      return false;
    }

    $.post("<?php echo base_url("admin/address/ajax_delete_resource"); ?>", {file: resource}, function () {
      $("#resource-list .image-thumb").eq(index).fadeOut();
    });
  }
</script>