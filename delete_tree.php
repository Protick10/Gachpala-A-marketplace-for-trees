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

// Get the tree_key from the POST request
$treekey = $_POST['treekey'];

// Validate that treekey is set and not empty
if (isset($treekey) && !empty($treekey)) {
    // Delete tree from the database
    $sql = "DELETE FROM trees WHERE Tree_key='$treekey'";
    if (mysqli_query($con, $sql)) {
        echo "Tree deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    echo "Invalid tree key.";
}

// Close the connection
$con->close();
?>
