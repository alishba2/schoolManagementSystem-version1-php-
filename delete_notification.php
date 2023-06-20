<?php
require_once "DBconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $notification_id = $_POST["notification_id"];

    $sql = "DELETE FROM notifications WHERE id = $notification_id";
    
    if ($conn->query($sql) === TRUE) {
        // Notification deleted successfully
        header("Location: notifications.php"); // Redirect back to the notification management page
        exit();
    } else {
        // Error deleting notification
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
