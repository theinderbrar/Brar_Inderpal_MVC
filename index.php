<?php
session_destroy();
session_start();
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
include("controllers/User.php");
$user = new User();
$user->loadViews();
?>
