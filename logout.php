<?php
session_start();
unset($_SESSION["value"]);
header("Location:index.php");
?>
