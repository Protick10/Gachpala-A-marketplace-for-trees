<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

$admin_email = $_SESSION['admin_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($admin_email); ?></h2>
    <p>This is the admin dashboard.</p>
    <a href="admin.php">ADD TREES</a>
    <a href="admin_update.php">update and delete</a>
    <a href="admin_logout.php">Logout</a>
</body>
</html>
