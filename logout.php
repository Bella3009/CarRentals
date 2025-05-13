<?php
session_start();
unset ($_SESSION['email']);
unset($_SESSION['empId']);

session_destroy();
header("Location: ShowCars.php");

?>