<?php
require_once "DBconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $message = $_POST["message"];
    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO notifications (title, message, created_at) VALUES ('$title', '$message', '$created_at')";
    
    if ($conn->query($sql) === TRUE) {
        // Notification uploaded successfully
        header("Location: notifications.php"); // Redirect back to the notification management page
        exit();
    } else {
        // Error uploading notification
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
