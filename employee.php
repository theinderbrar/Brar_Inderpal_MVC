<?php
session_start();
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
include("controllers/Employee.php"); 
$emp = new Employee();
$emp->loadViews();