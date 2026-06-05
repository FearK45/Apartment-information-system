<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

// Fetch dashboard statistics
$total_users = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$total_apartments = $conn->query("SELECT COUNT(*) as count FROM apartments")->fetch_assoc()['count'];
$total_bookings = $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count'];
$total_payments = $conn->query("SELECT COUNT(*) as count FROM payments")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">🏢 WallLove - Admin</div>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="apartments.php">Apartments</a></li>
                <li><a href="tenants.php">Tenants</a></li>
                <li><a href="bookings.php">Bookings</a></li>
                <li><a href="payments.php">Payments</a></li>
                <li><a href="maintenance.php">Maintenance</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container dashboard">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <p>Welcome, Admin! Here's an overview of your system.</p>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>Total Users</h3>
                <p style="font-size: 2rem; color: #3498db;"><?php echo $total_users; ?></p>
            </div>
            <div class="card">
                <h3>Total Apartments</h3>
                <p style="font-size: 2rem; color: #2ecc71;"><?php echo $total_apartments; ?></p>
            </div>
            <div class="card">
                <h3>Total Bookings</h3>
                <p style="font-size: 2rem; color: #e74c3c;"><?php echo $total_bookings; ?></p>
            </div>
            <div class="card">
                <h3>Total Payments</h3>
                <p style="font-size: 2rem; color: #f39c12;"><?php echo $total_payments; ?></p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Apartment Information System. All rights reserved.</p>
    </footer>
</body>
</html>
