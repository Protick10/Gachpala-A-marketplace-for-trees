<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['User_email'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tree_key'])) {
        $tree_key = $_POST['tree_key'];
        $user_email = $_SESSION['User_email'];

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gachpala";
        $con = new mysqli($host, $username, $password, $dbname);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Verify the Tree_key exists in the trees table
        $stmt = $con->prepare("SELECT Tree_key FROM trees WHERE Tree_key = ?");
        $stmt->bind_param("s", $tree_key);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Add the tree to the user's cart
            $stmt = $con->prepare("INSERT INTO cart (User_email, Tree_key) VALUES (?, ?)");
            if ($stmt) {
                $stmt->bind_param("ss", $user_email, $tree_key);
                if ($stmt->execute()) {
                    echo "Item added to cart successfully.";
                } else {
                    echo "Error adding item to cart: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $con->error;
            }
        } else {
            echo "Tree_key does not exist.";
        }

        $con->close();
    } else {
        echo "Invalid request.";
    }
} else {
    echo "User is not logged in.";
}
?>
