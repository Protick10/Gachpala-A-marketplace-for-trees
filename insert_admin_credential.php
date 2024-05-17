<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "gachpala";

$con = new mysqli($host, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$admin_email = "admin@gachpala.com";
$admin_password = password_hash("admin", PASSWORD_DEFAULT);

$sql = "INSERT INTO admin (admin_email, admin_password) VALUES ('$admin_email', '$admin_password')";

if ($con->query($sql) === TRUE) {
    echo "New admin inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
