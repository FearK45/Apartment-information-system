<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'tenant') {
    header('Location: ../login.php');
    exit();
}

// Fetch tenant info
$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();

// Fetch tenant's bookings
$bookings = $conn->query("SELECT * FROM bookings WHERE user_id = $user_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">🏢 WallLove - Tenant</div>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="browse_apartments.php">Browse Apartments</a></li>
                <li><a href="my_bookings.php">My Bookings</a></li>
                <li><a href="maintenance.php">Maintenance Requests</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container dashboard">
        <div class="dashboard-header">
            <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
            <p>Your Apartment Management Dashboard</p>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>📋 My Bookings</h3>
                <p>Manage your apartment bookings</p>
                <a href="my_bookings.php" class="btn btn-primary">View Bookings</a>
            </div>
            <div class="card">
                <h3>🏠 Browse Apartments</h3>
                <p>Explore available apartments</p>
                <a href="browse_apartments.php" class="btn btn-primary">Browse</a>
            </div>
            <div class="card">
                <h3>💳 Payments</h3>
                <p>Pay rent and booking fees</p>
                <a href="payments.php" class="btn btn-primary">Make Payment</a>
            </div>
            <div class="card">
                <h3>🔧 Maintenance</h3>
                <p>Request maintenance services</p>
                <a href="maintenance.php" class="btn btn-primary">Request Help</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Apartment Information System. All rights reserved.</p>
    </footer>
</body>
</html>
