<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    $conn->query("UPDATE maintenance SET status='$status' WHERE id=$id");
    header('Location: maintenance_updated.php?updated=1');
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM maintenance WHERE id=$id");
    header('Location: maintenance_updated.php?deleted=1');
    exit();
}

$message = '';
if(isset($_GET['updated'])) $message = "Maintenance status updated!";
if(isset($_GET['deleted'])) $message = "Maintenance request deleted!";

$result = $conn->query("SELECT m.*, u.name as tenant_name FROM maintenance m 
                        JOIN users u ON m.user_id = u.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Maintenance</title>
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
            <h1>Manage Maintenance Requests</h1>
        </div>

        <?php if($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #2c3e50; color: white;">
                    <th style="padding: 1rem; border: 1px solid #ddd;">Tenant Name</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Issue Type</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Description</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Status</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Date</th>
                    <th style="padding: 1rem; border: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['tenant_name']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['issue_type']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['description']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo ucfirst($row['status']); ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['request_date']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;">
                            <a href="maintenance_updated.php?action=update&id=<?php echo $row['id']; ?>&status=resolved" class="btn btn-primary" style="padding: 0.5rem 0.8rem; font-size: 0.85rem;">Resolved</a>
                            <a href="maintenance_updated.php?action=update&id=<?php echo $row['id']; ?>&status=in_progress" class="btn btn-primary" style="padding: 0.5rem 0.8rem; font-size: 0.85rem; background-color: #f39c12;">In Progress</a>
                            <a href="maintenance_updated.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-primary" style="padding: 0.5rem 0.8rem; font-size: 0.85rem; background-color: #e74c3c;" onclick="return confirm('Delete request?')">Delete</a>
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