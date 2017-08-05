<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

<div class="typo animated wow zoomIn" data-wow-delay=".5s">
  <div class="container">
    <div class="typo-grids">
      <h3 class="title"><span>Welcome to <?php echo SITE_TITLE; ?></span></h3>
      <p class="autem">Welcome to here. You can find pictures here. For it, you need to membership.</p>
    </div>
  </div>
</div>

<script>
$(function() {
  setTimeout(function() {
    location.href="/";
  }, 1000);
})
</script>