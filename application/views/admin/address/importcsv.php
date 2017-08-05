<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
if ($success) {
  my_show_msg($success, "info");
}
if ($error) {
  my_show_msg($error, "error");
}
?>

<script>
  $(function () {
    setTimeout(function () {
      location.href = '<?php echo base_url('admin/address'); ?>';
    }, 1500);
  });
</script>