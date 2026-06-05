<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'tenant') {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT b.*, a.type, a.block, a.rent FROM bookings b 
                        JOIN apartments a ON b.apartment_id = a.id 
                        WHERE b.user_id = $user_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
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
            <h1>My Bookings</h1>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #2c3e50; color: white;">
                    <th style="padding: 1rem; border: 1px solid #ddd;">Apartment</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Block</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Rent</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Status</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Booking Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['type']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['block']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;">₹<?php echo $row['rent']; ?></td>
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
