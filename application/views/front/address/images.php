<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($images)) : ?>
  <div class="royalSlider rsDefaultInv node-gallery" id="address-gallery" style="overflow: hidden;">
    <?php foreach ($images as $image): ?>
      <?php
      $image_url = base_url(PICS_UPLOAD_DIRECTORY . $image->image);
      $image_time = my_get_file_datetime(APPPATH . "../" . PICS_UPLOAD_DIRECTORY . $image->image);
      ?>
      <?php if ($image_time) : ?>
        <img class="rsTmb" src="<?php echo $image_url; ?>" data-rsTmb="<?php echo $image_url; ?>" alt="<?php echo $image_time; ?>" />
      <?php else: ?>
        <img class="rsTmb" src="<?php echo $image_url; ?>" data-rsTmb="<?php echo $image_url; ?>" />
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="border: 1px solid #ccc; margin-bottom: 50px;" src="https://maps.google.com/maps?q=<?php echo my_address_display($address, true, false); ?>&amp;ie=UTF8&amp;&amp;output=embed"></iframe>

<script type="text/javascript">
  function init_royalslider() {
    var $ = jQuery;
    var $slider = $('#address-gallery').royalSlider({
      keyboardNavEnabled: true,
      autoScaleSlider: true,
      //imgWidth: 720,
      //imgHeight: 540,
      fullscreen: {
        enabled: true,
        native: true
      },
      fadeInLoadedSlide: false,
      controlNavigation: 'thumbnails',
      autoScaleSliderWidth: 720,
      autoScaleSliderHeight: 628,
      loop: false,
      loopRewind: false,
      //imageScaleMode: 'fit-if-smaller',
      imageScaleMode: 'fill',
      imageScalePadding: 0,
      navigateByClick: true,
      numImagesToPreload: 2,
      arrowsNav: true,
      arrowsNavAutoHide: true,
      arrowsNavHideOnTouch: true,
      keyboardNavEnabled: true,
              fadeinLoadedSlide: true,
      globalCaption: true,
      globalCaptionInside: true,
      thumbs: {
        appendSpan: true,
        firstMargin: true,
        paddingBottom: 10,
        spacing: 10,
        arrowsAutoHide: true,
        paddingTop: 10
      },
      transitionType: 'fade',
      video: {
        // video options go gere
        autoHideBlocks: true,
        autoHideArrows: true
      }
    });

    /*var _slider = $slider.data('royalSlider');
     
     if (typeof _slider !== 'undefined' && _slider !== null && _slider !== false) {
     _slider.ev.on('rsEnterFullscreen', function () {
     _slider.st.imageScaleMode = "fit-if-smaller";
     _slider.st.imageAlignCenter = true;
     _slider.updateSliderSize(true);
     });
     setTimeout(function () {
     _slider.ev.on('rsExitFullscreen', function () {
     _slider.st.imageScaleMode = "fill";
     _slider.st.imageAlignCenter = true;
     _slider.autoScaleSlider = true;
     _slider.updateSliderSize(true);
     //$('.rsVideoContainer').removeAttr('style');
     });
     }, 20);
     }*/
  }

  jQuery(document).ready(function () {
    init_royalslider();
  });
</script>
