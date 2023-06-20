<?php

session_start();
require("DBconn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    echo $username;
    echo $password;

    // Query the database for the user credentials
    $sql = "SELECT * FROM Users WHERE username='$username' AND password='$password'  ";
    $result = $conn->query($sql);
    $_SESSION["student_id"] = $row["student_id"];

    if ($result->num_rows == 1) {
        // Successful login, redirect to the dashboard
        header("Location: AdminDashboard.html");
        exit();
    } else {
        // Invalid credentials, display an error message
        echo "Invalid username or password!";
    }
}

// Close the database connection (optional, as it will be closed automatically at the end of the script execution)
$conn->close();
?>
