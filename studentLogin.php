<?php

require_once "DBconn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the username and password from the login form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform authentication and fetch student ID based on the provided username and password
    $sql = "SELECT student_id FROM Students WHERE first_name = '$username' AND cnic = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, redirect to index.php with the student ID as a parameter
        $row = $result->fetch_assoc();
        $studentId = $row["student_id"];
        header("Location: index.php?id=$studentId");
        exit();
    } else {
        // Login failed
        echo "Invalid username or password.";
    }
}
?>
