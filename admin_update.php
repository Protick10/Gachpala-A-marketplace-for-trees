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
// Connect to the database
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "gachpala"; 
$con = new mysqli($host, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch tree details from the database
$sql = "SELECT * FROM trees"; 
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $name = $row['Tree_name'];
        $pic = $row['Tree_pic'];
        $price = $row['Tree_price'];
        $section = $row['Tree_section'];
        $treeId = $row['Tree_id'];
        $category = $row['Tree_catagory']; // Added category variable

        // Displaying each plant as a card with an "Update Details" button
        echo '<div class="card">';
        echo '<img src="data:image/png;base64,'.base64_encode($pic).'"/>';
        echo '<div class="np">';
        echo '<h3>' . $name . '</h3>';
        echo '<p>Category: ' . $category . '</p>'; // Display category
        echo '<p>&#2547; ' . $price . '</p>';
        echo '</div>';
        echo '<div class="atc">';
        // Pass tree details to the JavaScript function when "Update Details" button is clicked
        echo '<button onclick="updateTreeDetails('.htmlspecialchars($treeId).', \''.htmlspecialchars($name).'\', \''.htmlspecialchars($category).'\', \''.htmlspecialchars($price).'\', \''.htmlspecialchars($section).'\')">Update Details</button>';

        echo '<div class="atcimg">';
        echo '<img src="images/delete.svg" alt="">';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No Results Found.";
}

$con->close();
?>
        </div>
    </section>
</body>
</html>
