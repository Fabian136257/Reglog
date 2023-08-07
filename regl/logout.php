<?php

session_start();

if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  $_SESSION['logged_out'] = true;
  unset($_SESSION['auth']);
  header("Location: login.php");
  exit();
} else {
  header("Location: login.php");
  exit();
}

?>