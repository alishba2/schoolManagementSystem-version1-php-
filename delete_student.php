<?php
if (isset($_GET["student_id"])) {
    $studentId = $_GET["student_id"];

    // Establish a database connection
    require("DBconn.php");

    // Prepare the SQL query to delete the student record
    $sql = "DELETE FROM Students WHERE student_id = $studentId";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo "Student record deleted successfully";
    } else {
        // Error occurred during deletion
        echo "Error deleting student record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the student management page
    header("Location: studentManagement.php");
    exit();
}
?>
