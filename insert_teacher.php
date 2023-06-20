<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $teacherId = $_POST["teacher_id"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $dateOfBirth = $_POST["date_of_birth"];
    $CNIC = $_POST["cnic"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $contactNumber = $_POST["contact_number"];

    // Perform any additional validation as needed

    // Insert the teacher data into the database
    require_once "DBconn.php";

    $sql = "INSERT INTO Teachers (teacher_id, first_name, last_name, date_of_birth, gender,address, contact_number, cnic)
            VALUES ('$teacherId', '$firstName', '$lastName', '$dateOfBirth', '$gender', '$address', '$contactNumber','$CNIC')";

    if ($conn->query($sql) === true) {
        // Insertion successful
      
        header("Location: teacherManagement.php");
    } else {
        // Insertion failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
