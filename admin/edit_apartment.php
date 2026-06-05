<?php
session_start();
include '../db_config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

$id = $_GET['id'];
$apt = $conn->query("SELECT * FROM apartments WHERE id = $id")->fetch_assoc();
$message = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $block = $_POST['block'];
    $floor = $_POST['floor'];
    $type = $_POST['apartment_type'];
    $rent = $_POST['rent'];
    $status = $_POST['status'];
    
    $conn->query("UPDATE apartments SET block='$block', floor='$floor', type='$type', rent=$rent, status='$status' WHERE id=$id");
    $message = "Apartment updated!";
    $apt = $conn->query("SELECT * FROM apartments WHERE id = $id")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Apartment</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">🏢 WallLove - Admin</div>
            <ul class="nav-links">
                <li><a href="apartments.php">Back to Apartments</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container dashboard">
        <div class="dashboard-header">
            <h1>Edit Apartment</h1>
        </div>

        <?php if($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="card" style="max-width: 500px;">
            <form method="POST" style="display: grid; gap: 1rem;">
                <div class="form-group">
                    <label>Block</label>
                    <input type="text" name="block" value="<?php echo $apt['block']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Floor</label>
                    <input type="text" name="floor" value="<?php echo $apt['floor']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Apartment Type</label>
                    <select name="apartment_type" required>
                        <option value="1BHK" <?php if($apt['type']=='1BHK') echo 'selected'; ?>>1 BHK</option>
                        <option value="2BHK" <?php if($apt['type']=='2BHK') echo 'selected'; ?>>2 BHK</option>
                        <option value="3BHK" <?php if($apt['type']=='3BHK') echo 'selected'; ?>>3 BHK</option>
                        <option value="Studio" <?php if($apt['type']=='Studio') echo 'selected'; ?>>Studio</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rent</label>
                    <input type="number" name="rent" value="<?php echo $apt['rent']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="available" <?php if($apt['status']=='available') echo 'selected'; ?>>Available</option>
                        <option value="booked" <?php if($apt['status']=='booked') echo 'selected'; ?>>Booked</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Apartment</button>
            </form>
        </div>
    </div>
</body>
</html>