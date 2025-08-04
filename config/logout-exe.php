<?php
session_start();
 unset($_SESSION['usernameeform']);
 unset($_SESSION['nameusereform']);
 unset($_SESSION['hostnameeform']);
 unset($_SESSION['divisioncodeeform']);
 unset($_SESSION['divisioneform']);
 unset($_SESSION['leveleform']);
 session_destroy();
 if (session_get_cookie_params()){
 echo"<script>  window.location='../dist/login.php'; </script>";
 exit();
 }
?>