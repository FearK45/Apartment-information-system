<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'tenant') {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';
$success = '';

if(isset($_GET['deleted'])) $success = "Maintenance request deleted!";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $issue_type = $_POST['issue_type'];
    $description = $_POST['description'];
    $status = 'pending';
    $request_date = date('Y-m-d H:i:s');

    $query = "INSERT INTO maintenance (user_id, issue_type, description, status, request_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issss", $user_id, $issue_type, $description, $status, $request_date);
    
    if($stmt->execute()) {
        $message = "Maintenance request submitted successfully!";
    }
}

$result = $conn->query("SELECT * FROM maintenance WHERE user_id = $user_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Requests</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">🏢 WallLove - Tenant</div>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="browse_apartments.php">Browse Apartments</a></li>
                <li><a href="my_bookings_updated.php">My Bookings</a></li>
                <li><a href="maintenance_updated.php">Maintenance Requests</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container dashboard">
        <div class="dashboard-header">
            <h1>Maintenance Requests</h1>
        </div>

        <?php if($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <div class="card" style="margin-bottom: 2rem;">
            <h3>Request New Maintenance</h3>
            <form method="POST" style="display: grid; gap: 1rem;">
                <div class="form-group">
                    <label>Issue Type</label>
                    <select name="issue_type" required>
                        <option value="Plumbing">Plumbing</option>
                        <option value="Electrical">Electrical</option>
                        <option value="Carpentry">Carpentry</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" required style="padding: 0.75rem; border: 1px solid #bdc3c7; border-radius: 5px; font-size: 1rem;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </form>
        </div>

        <h3>Your Maintenance Requests</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #2c3e50; color: white;">
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
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['issue_type']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['description']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo ucfirst($row['status']); ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;"><?php echo $row['request_date']; ?></td>
                        <td style="padding: 1rem; border: 1px solid #ddd;">
                            <?php if($row['status'] != 'resolved'): ?>
                                <a href="delete_maintenance.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem; background-color: #e74c3c;" onclick="return confirm('Delete request?')">Delete</a>
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
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