<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "gachpala";

$con = new mysqli($host, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    $stmt = $con->prepare("SELECT admin_password FROM admin WHERE admin_email = ?");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($admin_password, $hashed_password)) {
            $_SESSION['admin_email'] = $admin_email;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No admin found with that email.";
    }
    $stmt->close();
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post" action="admin_login.php">
        <label for="admin_email">Email:</label>
        <input type="email" id="admin_email" name="admin_email" required>
        <br>
        <label for="admin_password">Password:</label>
        <input type="password" id="admin_password" name="admin_password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>

