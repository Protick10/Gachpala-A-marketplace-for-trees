<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
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
                $treekey = $row['Tree_key'];
                $category = $row['Tree_catagory'];
                $quantity = $row['Tree_quantity'];

                // Displaying each plant as a card with an "Update Details" button
                echo '<div class="card">';
                echo '<img src="' . htmlspecialchars($pic) . '" alt="' . htmlspecialchars($name) . '"/>'; // Use path to image
                echo '<div class="np">';
                echo '<h3>' . htmlspecialchars($name) . '</h3>';
                echo '<p>Category: ' . htmlspecialchars($category) . '</p>';
                echo '<p>Key: ' . htmlspecialchars($treekey) . '</p>'; 
                echo '<p>&#2547; ' . htmlspecialchars($price) . '</p>';
                echo '<p>Quantity: ' . htmlspecialchars($quantity) . '</p>';
                echo '</div>';
                echo '<div class="atc">';
                // Pass tree details to the JavaScript function when "Update Details" button is clicked
                echo '<button onclick="window.location.href=\'update_tree.php?key='.htmlspecialchars($treekey).'\'">Update Details</button>';

                echo '<div class="atcimg" onclick="deleteTree(\''.htmlspecialchars($treekey).'\')">';
                echo '<img src="images/delete.svg" alt="Delete">';
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

    <script>
        function deleteTree(treekey) {
            if (confirm('Are you sure you want to delete this tree?')) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_tree.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        // Reload the page to reflect the changes
                        location.reload();
                    }
                };
                xhr.send("treekey=" + encodeURIComponent(treekey));
            }
        }
    </script>
</body>
</html>

