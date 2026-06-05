<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'tenant') {
    header('Location: ../login.php');
    exit();
}

$id = $_GET['id'];
if(isset($id)) {
    $conn->query("DELETE FROM bookings WHERE id=$id AND user_id={$_SESSION['user_id']}");
}

header('Location: my_bookings.php?cancelled=1');
exit();