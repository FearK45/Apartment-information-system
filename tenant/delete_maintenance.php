<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'tenant') {
    header('Location: ../login.php');
    exit();
}

$id = $_GET['id'];
if(isset($id)) {
    $conn->query("DELETE FROM maintenance WHERE id=$id AND user_id={$_SESSION['user_id']}");
}

header('Location: maintenance.php?deleted=1');
exit();