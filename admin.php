<?php

$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "gachpala"; 

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add_tree'])) {
    $name = $_POST['name'];
    $category = $_POST['catagory']; // corrected variable name
    $price = $_POST['price'];
    $section = $_POST['section'];
    $quantity = $_POST['quantity'];
    $key = $_POST['key'];
    
    // Check if file was uploaded without errors
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Directory where you want to save the uploaded files
        $target_dir = "uploads/";
        // Create the directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES['image']['name']);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Save the image path in the database
            $sql = "INSERT INTO trees (Tree_id, Tree_name, Tree_catagory, Tree_price, Tree_section, Tree_pic, Tree_key, Tree_quantity) 
                    VALUES (DEFAULT, '$name', '$category', '$price', '$section', '$target_file', '$key', '$quantity')";
            
            if (mysqli_query($conn, $sql)) {
                echo "New record inserted successfully";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error uploading file.";
    }
}

mysqli_close($conn);
?>
