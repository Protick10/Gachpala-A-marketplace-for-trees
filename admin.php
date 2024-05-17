<?php

// $host = "localhost"; 
// $username = "root"; 
// $password = ""; 
// $dbname = "gachpala"; 


// $conn = mysqli_connect($host, $username, $password, $dbname);


// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }


// if (isset($_POST['add_tree'])) {
//     $image = $_FILES['image']['tmp_name'];

//     $name = $_POST['name'];
//     $catagory = $_POST['catagory'];
//     $price = $_POST['price'];
//     $section = $_POST['section'];

//     $image = addslashes(file_get_contents($image));

//     $sql = "INSERT INTO trees (Tree_id, Tree_name, Tree_catagory, Tree_price, Tree_section, Tree_pic ) VALUES (DEFAULT, '$name', '$catagory', '$price', '$section', '$image')";

//     // $sql = "INSERT INTO info (ID, Name, email, phone) VALUES ('$id', '$name', '$email', '$phone')";
    
//     if (mysqli_query($conn, $sql)) {
//         echo "New record inserted successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//     }
// }

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
    
    // Check if file was uploaded without errors
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['tmp_name'];
        $image = addslashes(file_get_contents($image));
        
        $sql = "INSERT INTO trees (Tree_id, Tree_name, Tree_catagory, Tree_price, Tree_section, Tree_pic, Tree_quantity) 
                VALUES (DEFAULT, '$name', '$category', '$price', '$section', '$image', '$quantity')";
        
        if (mysqli_query($conn, $sql)) {
            echo "New record inserted successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file.";
    }
}

mysqli_close($conn);