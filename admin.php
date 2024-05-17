<?php
session_start();

// Redirect to admin login page if not logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}


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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.title {
    text-align: center;
}

.addtrees {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.addtrees h3 {
    margin-top: 0;
}

.addtrees form {
    display: flex;
    flex-direction: column;
}

.addtrees input[type="file"],
.addtrees input[type="text"],
.addtrees input[type="number"], 
.addtrees button[type="submit"] {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.addtrees button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
}

.addtrees button[type="submit"]:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
    <h2 class="title">Admin Dashboard</h2>
    <div class="addtrees">
        <h3>Add Trees</h3>
        <form action="admin.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" id="image">
            <input type="text" name="name" id="name" placeholder="Tree Name">
            <input type="text" name="catagory" id="catagory" placeholder="Tree catagory">
            <input type="text" name="price" id="price" placeholder="Price">
            <input type="text" name="section" id="section" placeholder="Section">
            <input type="text" name="key" id="key" placeholder="key">
            
            <input type="number" name="quantity" id="quantity" placeholder="Quantity">
            <button type="submit" name="add_tree">Add</button>

        </form>
    </div>

</body>
</html>
