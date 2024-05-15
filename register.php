<?php
session_start(); // Start the session

// Connect to the database
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "gachpala"; 
$con = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Function to validate email format
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password strength
function isStrongPassword($password) {
    $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/";
    return preg_match($pattern, $password);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $picture = $_FILES['picture'];

    // Validate that all required fields are filled
    if (empty($name) || empty($phone) || empty($email) || empty($password) || empty($repassword) || empty($address) || empty($city) || empty($zipcode)) {
        echo "All fields are required.";
    } 
    // Validate email format
    elseif (!isValidEmail($email)) {
        echo "Invalid email format.";
    } 
    // Check if passwords match
    elseif ($password !== $repassword) {
        echo "Passwords do not match.";
    } 
    // Check if password is strong enough
    elseif (!isStrongPassword($password)) {
        echo "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    } 
    // Validate picture upload
    elseif ($picture['error'] !== UPLOAD_ERR_OK) {
        echo "Error uploading picture.";
    } 
    else {
        // Ensure the uploads directory exists
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($picture["name"]);
        if (!move_uploaded_file($picture["tmp_name"], $targetFile)) {
            echo "Error saving picture.";
        } else {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind
            $stmt = $con->prepare("INSERT INTO user (User_name, User_phone, User_email, User_password, User_adress_line, User_city, User_zipcode, User_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssis", $name, $phone, $email, $hashedPassword, $address, $city, $zipcode, $targetFile);

            // Execute the statement
            if ($stmt->execute()) {
                // Store user information in session
                $_SESSION['username'] = $name;
                $_SESSION['userpic'] = $targetFile;
                
                // Redirect to index.php
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement and connection
            $stmt->close();
        }
    }

    $con->close();
}
?>
