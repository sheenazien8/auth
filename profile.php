<?php
  require_once 'core/init.php';

  if (!Session::exist('username')) {
    header("Location: register.php");
  }

  require_once 'template/header.php';
?>
  <h1>hai, <?= Session::get('username'); ?></h1>
<?php

  require_once 'template/footer.php';

?>
