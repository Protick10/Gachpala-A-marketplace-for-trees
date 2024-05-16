<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/admin_update.css">
</head>
<body>
    <section class="featured">
        <div class="featurecard">
        <?php
// Start session
session_start();

// Check if the user is logged in
if (isset($_SESSION['User_email'])) {
    // Fetch tree details from the database
    $host = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "gachpala"; 
    $con = new mysqli($host, $username, $password, $dbname);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT * FROM trees"; 
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $name = $row['Tree_name'];
            $pic = $row['Tree_pic'];
            $price = $row['Tree_price'];
            $section = $row['Tree_section'];
            $treekey = $row['Tree_key'];
            $category = $row['Tree_catagory']; // Added category variable

            // Displaying each plant as a card with an "Add to Cart" button
            echo '<div class="card">';
            echo '<img src="data:image/png;base64,'.base64_encode($pic).'"/>';
            echo '<div class="np">';
            echo '<h3>' . $name . '</h3>';
            echo '<p>&#2547; ' . $price . '</p>';
            echo '</div>';
            echo '<div class="atc">';
            echo '<form method="post" action="add_to_cart.php">';
            echo '<input type="hidden" name="tree_key" value="' . $treekey . '">';
            echo '<button type="submit"><img src="images/shopping-cart.svg" alt=""> Add to Cart</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "No Results Found.";
    }

    $con->close();
} else {
    // Prompt the user to log in
    echo 'Please login to add items to your cart.';
}
?>
        </div>
    </section>