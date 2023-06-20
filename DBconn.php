<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school management system";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
