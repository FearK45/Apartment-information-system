<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

// Fetch all tenants
$result = $conn->query("SELECT * FROM users WHERE user_type = 'tenant'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tenants</title>
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
            <h1>Manage Tenants</h1>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #2c3e50; color: white;">
                    <th style="padding: 1rem; border: 1px solid #ddd;">Name</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Email</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Contact</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Joined Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['name']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['email']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['contact']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['created_at']; ?></td>
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
