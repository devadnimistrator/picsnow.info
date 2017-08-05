<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
  <div class="col-md-6">
    <div class="x_panel">
      <div class="x_title">
        <h2><?php echo $this->page_title ?></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <form class="form-horizontal form-label-left validateform" novalidate method="post">
          <input type="hidden" name="action" value="process" />
          <p>
            Please configuration for system.
          </p>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="site_title">Site Title <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="site_title" name="site_title" value="<?php echo SITE_TITLE ?>" class="form-control col-md-7 col-xs-12" required="required" type="text">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_email">Contact Email <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="email" id="contact_email" name="contact_email" value="<?php echo CONTACT_EMAIL ?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_phone">Contact Phone <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="contact_phone" name="contact_phone" value="<?php echo CONTACT_PHONE ?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_street">Contact Street <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="contact_street" name="contact_street" required="required" class="form-control col-md-7 col-xs-12"><?php echo CONTACT_STREET ?></textarea>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_street">Fron Skin <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="front_skin" class="form-control col-md-7 col-xs-12">
                <?php
                $skins = scandir(APPPATH . "../assets/css/skins");
                foreach ($skins as $skin) {
                  $skin_file = pathinfo($skin);
                  if ($skin_file['extension'] == 'css') {
                    echo '<option value="'.$skin_file['filename'].'" '.($skin_file['filename'] == FRONT_SKIN ? 'selected' : '').'>'.ucfirst($skin_file['filename']).'</option>';
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button type="reset" class="btn btn-primary">
                Cancel
              </button>
              <button id="send" type="submit" class="btn btn-success">
                Submit
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- validator -->
<?php my_load_js('plugins/validator.min.js'); ?>

<!-- validator -->
<script>
  // initialize the validator function
  validator.message.date = 'not a real date';

  // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
  $('form').on('blur', 'input[required], input.optional, select.required', validator.checkField).on('change', 'select.required', validator.checkField).on('keypress', 'input[required][pattern]', validator.keypress);

  $('.multi.required').on('keyup blur', 'input', function () {
    validator.checkField.apply($(this).siblings().last()[0]);
  });

  $('form').submit(function (e) {
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