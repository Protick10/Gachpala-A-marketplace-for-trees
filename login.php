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
    $email = $_POST['email'];
    $password = $_POST['password'];}

$sql = "SELECT * FROM user WHERE $email = User_email"; 

// $name = "SELECT Tree_name FROM trees WHERE id = 001";

// echo '<p>' .$name .'</p>';

$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // $tem = $row;
        // $json = json_encode($tem);

        $name = $row['User_name'];
        $user_email = $row['User_email'];
        $user_password = $row['User_password'];
        $user_pic = $row['User_pic'];
    }
} else {
    echo "No Results Found.";
}

if ($email == $user_email && password_verify($password, $user_password)) {
    $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($picture[$user_pic]);

        $_SESSION['username'] = $name;
        $_SESSION['userpic'] = $targetFile;
    header('Location: feature.php');
} else {
    $error = "Invalid email or password.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Add your styles and scripts -->
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="login.php">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
