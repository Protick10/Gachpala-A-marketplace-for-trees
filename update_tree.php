<?php

// Check if the user is logged in
session_start();

// Redirect to admin login page if not logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tree Details</title>
    <link rel="stylesheet" href="styles/admin_update.css">
</head>
<body>
    <?php
    // Connect to the database
    $host = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "gachpala"; 
    $con = new mysqli($host, $username, $password, $dbname);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Get the tree_key from the query parameter
    $treekey = $_GET['key'];

    // Fetch tree details from the database
    $sql = "SELECT * FROM trees WHERE Tree_key='$treekey'"; 
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['Tree_name'];
        $price = $row['Tree_price'];
        $section = $row['Tree_section'];
        $category = $row['Tree_catagory'];
    } else {
        echo "No tree found with the specified key.";
        exit;
    }

    // Close the connection
    $con->close();
    ?>

    <h2>Update Tree Details</h2>
    <form action="save_tree_details.php" method="post">
        <input type="hidden" name="treekey" value="<?php echo htmlspecialchars($treekey); ?>">
        <div>
            <label for="name">Tree Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($category); ?>" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" required>
        </div>
        <div>
            <label for="section">Section:</label>
            <input type="text" id="section" name="section" value="<?php echo htmlspecialchars($section); ?>" required>
        </div>
        <button type="submit">Save</button>
    </form>
</body>
</html>

