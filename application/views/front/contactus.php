<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
  .contact-grid .contact-grid-left {
    margin-bottom: 1em;
  }
  .contact-grid textarea {
    margin: 0;
    width: 100% !important;
  }
</style>

<!---728x90--->
<!-- mail -->
<div class="map">
  <iframe src="https://maps.google.com/maps?q=<?php echo CONTACT_STREET; ?>&amp;ie=UTF8&amp;&amp;output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<!---728x90--->
<div class="contact">
  <div class="container">
    <h3><span>Contact Us</span></h3>
    <p class="autem">You can contact us by under...</p>
    <!---728x90--->
    <!--div class="contact-grids">
      <div class="contact-grid">
        <form action="#" method="post" novalidate class="validateform">
          <div class="col-md-6 contact-grid-left item">
            <input type="text" name="name" placeholder="Name" required="">
            </form>
          </div>
          <div class="col-md-6 contact-grid-left item">
            <input type="email" name="email" placeholder="Email" required="">
            </form>
          </div>
          <div class="col-md-12 contact-grid-left item">
            <input type="text" name="subject" placeholder="Subject" required="">
          </div>
          <div class="col-md-12 contact-grid-left item">
            <textarea name="Message" type="text" placeholder="Message"></textarea>
            <input type="submit" value="Submit Now">
          </div>
          <div class="clearfix"> </div>
      </div>
    </div-->
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="contact-grid1">
      <div class="col-md-4 contact-grid1-left">
        <div class="contact-grid1-left1">
          <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
          <h4>Contact By Email</h4>
          <ul>
            <li>Mail: <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 contact-grid1-left">
        <div class="contact-grid1-left1">
          <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
          <h4>Contact By Phone</h4>
          <ul>
            <li>Phone: <a href="tel:<?php echo CONTACT_PHONE; ?>"><?php echo CONTACT_PHONE; ?></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 contact-grid1-left">
        <div class="contact-grid1-left1">
          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
          <h4>Looking For Address</h4>
          <ul>
            <li>Address: <?php echo CONTACT_STREET; ?></li>
          </ul>
        </div>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
<!-- //mail -->