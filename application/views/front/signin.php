<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
<!-- banner -->
<div class="banner">
  <div class="container">
    <div class="banner-right center">
      <h3><span>Sign In</span></h3>
      <div class="reservation">
        
        <?php if ($error_msgs) {
          my_show_msg($error_msgs, "danger");
        }
        ?>
        
        <form id="frmSignin" method="post" novalidate class="validateform">
          <input type='hidden' name="action" value="signin">
          <div class="keywords item">
            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
            <input type="email" name="email" placeholder="Email" required="required" value='<?php echo $this->input->post('email'); ?>'>
          </div>
          <div class="keywords item">
            <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
            <input type="password" name="password" placeholder="Password" required="required">
          </div>
          <div class="keywords">
            <input type="submit" value="Sign In">
          </div>
          <div class="text-center">
            <br/>
            <a href="<?php echo base_url("auth/signup"); ?>">Create new account</a>
          </div>
        </form>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- //banner -->
