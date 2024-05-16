<?php
// session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "gachpala";

$con = new mysqli($host, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch first three featured trees
$sql = "SELECT * FROM trees WHERE Tree_section = 'Feature' LIMIT 3";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    echo '<section class="featured">';
    echo '<h2 class="playfare-font">Featured</h2>';
    echo '<div class="featurecard">';
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['Tree_name'];
        $pic = $row['Tree_pic'];

        // Display each tree dynamically
        echo '<div class="card">';
        echo '<img class="featured-image" src="data:image/png;base64,' . base64_encode($pic) . '" alt="' . $name . '"/>';
        echo '<div class="np">';
        echo '<h3 class="inter-font">' . $name . '</h3>';
        echo '<p>&#2547; 250</p>'; // Assuming price is fixed for featured trees
        echo '</div>';
        echo '<div class="atc">';
        echo '<button><img src="images/shopping-cart.svg" alt=""> Add to Cart</button>';
        echo '<div class="atcimg">';
        echo '<img src="images/heart.svg" alt="">';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '<div class="vap">';
    echo '<p>VIEW ALL PLANTS</p>';
    echo '<img src="images/arrow-right-circle.png" alt="">';
    echo '</div>';
    echo '</div>';
//     echo '<div class="vap">';
// echo '<p>VIEW ALL PLANTS</p>';
// echo '<img src="images/arrow-right-circle.png" alt="">';
// echo '</div>';
    echo '</section>';
} else {
    echo "No Results Found.";
}

$con->close();
?>
 
 