<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

$message = '';

if(isset($_GET['deleted'])) {
    $message = "Apartment deleted successfully!";
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $block = $_POST['block'];
    $floor = $_POST['floor'];
    $apartment_type = $_POST['apartment_type'];
    $rent = $_POST['rent'];
    $status = 'available';

    $query = "INSERT INTO apartments (block, floor, type, rent, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssis", $block, $floor, $apartment_type, $rent, $status);
    
    if($stmt->execute()) {
        $message = "Apartment added successfully!";
    }
}

$result = $conn->query("SELECT * FROM apartments");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Apartments</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">🏢 WallLove - Admin</div>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="apartments_updated.php">Apartments</a></li>
                <li><a href="tenants.php">Tenants</a></li>
                <li><a href="bookings_updated.php">Bookings</a></li>
                <li><a href="payments.php">Payments</a></li>
                <li><a href="maintenance_updated.php">Maintenance</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container dashboard">
        <div class="dashboard-header">
            <h1>Manage Apartments</h1>
        </div>

        <?php if($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="card" style="margin-bottom: 2rem;">
            <h3>Add New Apartment</h3>
            <form method="POST" style="display: grid; gap: 1rem;">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label>Block</label>
                    <input type="text" name="block" required>
                </div>
                <div class="form-group">
                    <label>Floor</label>
                    <input type="text" name="floor" required>
                </div>
                <div class="form-group">
                    <label>Apartment Type</label>
                    <select name="apartment_type" required>
                        <option value="1BHK">1 BHK</option>
                        <option value="2BHK">2 BHK</option>
                        <option value="3BHK">3 BHK</option>
                        <option value="Studio">Studio</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rent</label>
                    <input type="number" name="rent" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Apartment</button>
            </form>
        </div>

        <h3>All Apartments</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #2c3e50; color: white;">
                    <th style="padding: 1rem; border: 1px solid #ddd;">Block</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Floor</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Type</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Rent</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Status</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['block']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['floor']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['type']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['rent']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo ucfirst($row['status']); ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;">
                            <a href="edit_apartment.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Edit</a>
                            <a href="delete_apartment.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem; background-color: #e74c3c;" onclick="return confirm('Delete this apartment?')">Delete</a>
                        </td>
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