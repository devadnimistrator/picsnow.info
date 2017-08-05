<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="clearfix"></div>
</div><!-- End Right Content -->

<!-- bootstrap-daterangepicker -->
<?php my_load_js('/js/moment/moment.min.js'); ?>
<?php my_load_js('/js/datepicker/daterangepicker.js'); ?>

<!-- iCheck -->
<?php my_load_js('/plugins/iCheck/icheck.min.js'); ?>

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

<!-- Custom Theme Scripts -->
<?php my_load_js('/js/admin.js?v' . ASSETS_VERSION); ?>

<!-- footer content -->
<!--footer>
  @2017, PSP
</footer-->
<!-- /footer content -->
</div>
</div>
</body>
</html>