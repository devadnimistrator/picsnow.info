<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3><?php echo my_address_display($address); ?></h3>
<ul>
  <?php if ($address->owner_firstname || $address->owner_lastname) : ?>
  <li>Owner: <?php echo my_ucfirst($address->owner_firstname) ?> <?php echo my_ucfirst($address->owner_lastname) ?></li>
  <?php endif ?>
  <?php if ($address->mortgagee) : ?>
  <li>Mortgagee: <?php echo $address->mortgagee ?></li>
  <?php endif ?>
  <?php if ($address->loan_year) : ?>
    <li>Loan Year: <?php echo $address->loan_year ?></li>
  <?php endif; ?>
  <?php if ($address->loan_amount) : ?>
    <li>Loan Amount: <?php echo $address->loan_amount ?></li>
  <?php endif; ?>
  <?php if ($address->trustee_name) : ?>
    <li>Trustee: <?php echo $address->trustee_name ?></li>
  <?php endif; ?>
  <?php if ($address->legal_description1) : ?>
    <li>Legal Description: <?php echo $address->legal_description1 ?></li>
  <?php endif; ?>

  
</ul>