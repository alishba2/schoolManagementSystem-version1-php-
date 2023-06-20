<?php
// Check if the teacher ID is provided in the query string
if (isset($_GET["teacher_id"])) {
    // Get the teacher ID from the query string
    $teacherId = $_GET["teacher_id"];

    // Delete the teacher from the database
    require_once "DBconn.php";

    $sql = "DELETE FROM Teachers WHERE teacher_id = '$teacherId'";

    if ($conn->query($sql) === true) {
        // Deletion successful
         
        header("Location: teacherManagement.php");
    } else {
        // Deletion failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    // Teacher ID is not provided, redirect to an error page or handle the error as desired
    echo "Invalid request. Teacher ID is not provided.";
}
?>
