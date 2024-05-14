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

if(isset($_POST['submit'])) {
    $tree_id = $_POST['tree_id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $section = $_POST['section'];

    // Update tree details in the database
    $sql = "UPDATE trees SET Tree_name = '$name', Tree_catagory = '$category', Tree_price = '$price', Tree_section = '$section' WHERE Tree_id = '$tree_id'";
    if (mysqli_query($con, $sql)) {
        echo "Tree details updated successfully.";
    } else {
        echo "Error updating tree details: " . mysqli_error($con);
    }
}

$con->close();
?>
