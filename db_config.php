<?php
// Database Configuration
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'apartment_system';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>
