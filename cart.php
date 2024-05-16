<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['User_email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['User_email'];

// Connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "gachpala";
$con = new mysqli($host, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$stmt = $con->prepare("SELECT trees.Tree_name, trees.Tree_price, cart.Quantity FROM cart JOIN trees ON cart.Tree_key = trees.Tree_key WHERE cart.User_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();


$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
   
</head>
<body>
  
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <!-- Other navbar links -->
            <li><a href="logout.php">Logout</a></li> <!-- Add a logout link -->
        </ul>
    </nav>

    <!-- Cart items -->
    <h2>Your Cart</h2>
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Tree Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['Tree_name']; ?></td>
                    <td><?php echo $row['Tree_price']; ?></td>
                    <td><?php echo $row['Quantity']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Your cart is empty.</p>
    <?php } ?>

   
</body>
</html>
