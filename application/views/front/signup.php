<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
<!-- banner -->
<div class="banner">
  <div class="container">
    <div class="banner-right center">
      <h3><span>Sign Up</span></h3>
      <div class="reservation">
        
        <?php if ($error_msgs) {
          my_show_msg($error_msgs, "danger");
        }
        ?>
        
        <form id="frmSignin" method="post" novalidate class="validateform">
          <input type='hidden' name="action" value="signup">
          <div class="keywords item">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <input type="text" name="fullname" placeholder="Fullname" required="required" value="<?php echo $this->input->post('fullname'); ?>">
          </div>
          <div class="keywords item">
            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
            <input type="email" name="email" placeholder="Email" required="required" value="<?php echo $this->input->post('email'); ?>">
          </div>
          <div class="keywords item">
            <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
            <input type="tel" name="phone" placeholder="Phone" required="required" value="<?php echo $this->input->post('phone'); ?>">
          </div>
          <div class="keywords item">
            <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
            <input type="password" name="password" placeholder="Password" required="required" data-validate-length-range="6">
          </div>
          <div class="keywords">
            <input type="submit" value="Sign Up">
          </div>
          <div class="text-center">
            <br/>
            <a href="<?php echo base_url("auth/signin"); ?>">Already have an account</a>
          </div>
        </form>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- //banner -->
