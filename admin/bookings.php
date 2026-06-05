<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

// Fetch all bookings
$result = $conn->query("SELECT b.*, u.name as tenant_name, a.type as apt_type FROM bookings b 
                        JOIN users u ON b.user_id = u.id 
                        JOIN apartments a ON b.apartment_id = a.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
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
            <h1>Manage Bookings</h1>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #2c3e50; color: white;">
                    <th style="padding: 1rem; border: 1px solid #ddd;">Tenant Name</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Apartment Type</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Status</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Booking Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['tenant_name']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['apt_type']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo ucfirst($row['status']); ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['booking_date']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2026 Apartment Information System. All rights reserved.</p>
    </footer>
</body>
</html>
