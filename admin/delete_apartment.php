<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

$id = $_GET['id'];
$conn->query("DELETE FROM apartments WHERE id = $id");
header('Location: apartments.php?deleted=1');
exit();