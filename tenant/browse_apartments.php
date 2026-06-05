<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'tenant') {
    header('Location: ../login.php');
    exit();
}

// Fetch available apartments
$result = $conn->query("SELECT * FROM apartments WHERE status = 'available'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Apartments</title>
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
            <h1>Browse Available Apartments</h1>
        </div>

        <div class="dashboard-grid">
            <?php while($apt = $result->fetch_assoc()): ?>
                <div class="card">
                    <h3><?php echo $apt['type']; ?> - Block <?php echo $apt['block']; ?></h3>
                    <p><strong>Floor:</strong> <?php echo $apt['floor']; ?></p>
                    <p><strong>Rent:</strong> ₹<?php echo number_format($apt['rent']); ?>/month</p>
                    <p><strong>Status:</strong> <?php echo ucfirst($apt['status']); ?></p>
                    <a href="book_apartment.php?id=<?php echo $apt['id']; ?>" class="btn btn-primary">Book Now</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Apartment Information System. All rights reserved.</p>
    </footer>
</body>
</html>
