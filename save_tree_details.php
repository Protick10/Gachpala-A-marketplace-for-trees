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

// Get form data
$treekey = $_POST['treekey'];
$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$section = $_POST['section'];

// Update tree details in the database
$sql = "UPDATE trees SET Tree_name='$name', Tree_catagory='$category', Tree_price='$price', Tree_section='$section' WHERE Tree_key='$treekey'";
if (mysqli_query($con, $sql)) {
    echo "<p>Tree details updated successfully. Go to <a href='admin_update.php'>Update Page</a></p>";
} else {
    echo "Error updating record: " . mysqli_error($con);
}

// Close the connection
$con->close();
?>

