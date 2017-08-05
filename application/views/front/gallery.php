<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- gallery -->
<div class="gallery">
  <div class="container">
    <h3><span>Gallery</span></h3>
    <?php if ($addresses['count'] == 0) : ?>
      <p class="autem">Find not address</p>
    <?php else: ?>
      <p class="autem">
        <?php echo $addresses['count']; ?> counts address
        <?php if ($search_params['state'] || $search_params['city'] || $search_params['address']) : ?>
          by <?php if ($search_params['address']) echo "," . $search_params['address']; ?> in <?php if ($search_params['city']) echo $search_params['city']; ?> <?php if ($search_params['state']) echo ($search_params['city'] ? ", " : "") . $search_params['state']; ?>
        <?php endif; ?>
      </p>
    <?php endif; ?>
    <form method="post" name="gallerySearchForm" class="gallerySearchForm">
      <input type="hidden" name="page" value="<?php echo $search_params['page']; ?>" />
      <div class="col-md-12">
        <div class="col-md-3 col-sm-6">
          <div class="section_room">
            <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
            <select id="search-state" name="state" onchange="this.form.submit();" class="frm-field">
              <option value="">State</option>
              <?php foreach ($states as $key => $value): ?>
                <option value="<?php echo $key; ?>" <?php if ($search_params['state'] == $key) echo "selected"; ?>><?php echo $value; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="section_room">
            <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
            <select id="search-city" name="city" class="frm-field">
              <option value="">City</option>
              <?php foreach ($cities as $key => $value): ?>
                <option value="<?php echo $key; ?>" <?php if ($search_params['city'] == $key) echo "selected"; ?>><?php echo $value; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-4 col-sm-sm-8">
          <div class="keywords">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
          </div>
        </div>
        <div class="col-md-2 col-sm-sm-4">
          <div class="keywords">
            <input type="submit" value="Search">
          </div>
        </div>
      </div>
      <?php if ($addresses['count'] > 0) : ?>
        <!---728x90--->
        <div class="gallery-grids carouselGallery-grid hidden-xs">
          <?php
          $index = -1;
          foreach ($addresses['result'] as $address):
            ?>

            <?php
            $image = my_get_address_image($address, 350, 350, 16);
            $index ++;
            ?>

            <div class="col-md-4 gallery-grid">
              <a href="<?php echo my_get_address_link($address); ?>">
                <div class="carouselGallery-col-1 carouselGallery-carousel" 
                     data-index="<?php echo $index; ?>" 
                     data-imagetext="<?php echo $address->legal_description1; ?>"
                     data-location="<?php echo my_address_display($address, false); ?>"
                     data-state="<?php echo $address->state; ?>"
                     data-city="<?php echo $address->city; ?>"
                     data-zipcode="<?php echo $address->zipcode; ?>"
                     data-imagepath="<?php echo $image ?>" 
                     data-posturl="<?php echo my_get_address_link($address); ?>" 
                     style="background-image:url('<?php echo $image ?>');">
                  <div class="carouselGallery-item">
                    <div class="carouselGallery-item-meta">
                      <?php echo my_address_display($address); ?>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
          <div class="clearfix"> </div>

          <?php
          $page_nums = 8;

          $page_all_count = ceil($addresses['count'] / $search_params['page_count']);
          $page = $search_params['page'];
          ?>
          <?php if ($page_all_count > 1) : ?>

            <?php
            $first_page = floor(($page - 1) / $page_nums) * $page_nums + 1;
            ?>
            <div class="col-md-12 text-center">
              <ul class="pagination">
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


      <?php endif; ?>
    </form>
  </div>
</div>
<!-- //gallery -->

<script>
  $(function () {
    $(".pagination a").click(function () {
      document.gallerySearchForm.page.value = $(this).attr('page');
      document.gallerySearchForm.submit();
    });
  })
</script>

<!-- Custom Theme Scripts -->
<?php // my_load_js('js/gallery.js?v' . ASSETS_VERSION); ?>


