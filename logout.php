<?php
include "app/config.php";
session_start();
session_unset();
session_destroy();
session_start([
      'cookie_lifetime' => 0
      // Session cookie expires when the browser is closed
]);
header("Location: login.php");
?>