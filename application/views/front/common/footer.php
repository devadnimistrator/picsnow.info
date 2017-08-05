<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
</div><!-- End Main Container -->

<!-- footer -->
<div class="footer">
  <div class="container">
    <div class="footer-grids">
      <div class="col-md-4 footer-grid">
        <p><a href="tel:<?php echo CONTACT_PHONE; ?>"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <?php echo CONTACT_STREET; ?></a></p>
        <p><a href="mailto:<?php echo CONTACT_EMAIL; ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo CONTACT_EMAIL; ?></a></p>
        <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><?php echo CONTACT_PHONE; ?></p>
      </div>
      <div class="col-md-2 footer-grid">
        <ul>
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li><a href="<?php echo base_url('gallery'); ?>">Gallery</a></li>
          <li><a href="<?php echo base_url('about_us'); ?>">About Us</a></li>
          <li><a href="<?php echo base_url('contact_us'); ?>">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-grid">
        <?php
        $this->load->model("address_m");
        $address_m = new Address_m();
        $new_addresses = $address_m->get_new_address();
        ?>
        <?php foreach ($new_addresses as $address): ?>
          <div class="footer-grid1">
            <div class="footer-grid1-left">
              <a href="<?php echo my_get_address_link($address); ?>"><img src="<?php echo my_get_address_image($address, 340, 255); ?>" alt=" " class="img-responsive"></a>
            </div>
            <div class="footer-grid1-right">
              <a href="<?php echo my_get_address_link($address); ?>"><?php echo my_address_display($address); ?></a>
            </div>
            <div class="clearfix"> </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="col-md-3 footer-grid">
        <?php
        $this->load->model("address_m");
        $address_m = new Address_m();
        $new_addresses = $address_m->get_hot_address();
        ?>
        <?php foreach ($new_addresses as $address): ?>
          <a href="<?php echo my_get_address_link($address); ?>">
            <div class="footer-grid-instagram" style="background-image: url('<?php echo my_get_address_image($address, 150, 100); ?>');"></div>
          </a>
        <?php endforeach; ?>
        <div class="clearfix"> </div>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
<!-- //footer -->

<!-- validator -->
<?php my_load_js('/plugins/validator.min.js'); ?>

<!-- validator -->
<script>
  // initialize the validator function
  validator.message.date = 'not a real date';

  // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
  $('form').on('blur', 'input[required], input.optional, select.required', validator.checkField).on('change', 'select.required', validator.checkField).on('keypress', 'input[required][pattern]', validator.keypress);

  $('.multi.required').on('keyup blur', 'input', function () {
    validator.checkField.apply($(this).siblings().last()[0]);
  });

  $('form.validateform').submit(function (e) {
    e.preventDefault();
    var submit = true;

    // evaluate the form using generic validaing
    if (!validator.checkAll($(this))) {
      submit = false;
    }

    if (submit)
      this.submit();

    return false;
  });
</script>
<!-- /validator -->

</body>
</html>