<?php
require("DBconn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studentId = $_POST["student_id"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $fatherName = $_POST["father_name"];
    $CNIC = $_POST["cnic"];
    $registration_number = $_POST["registration_number"];
    $Grade = $_POST["grade"];
    $dateOfBirth = $_POST["date_of_birth"];
    $gender = $_POST["gender"];
    $contactNo=$_POST["phone"];
    $address = $_POST["address"];
   
   $sql =  "INSERT INTO Students (student_id, first_name, last_name, father_name,  cnic, grade, date_of_birth, gender, contact_number, address, registration_number) 
    VALUES ('$studentId', '$firstName', '$lastName','$fatherName','$CNIC','$Grade', '$dateOfBirth', '$gender', '$contactNo', '$address' , '$registration_number')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to the student management page after successful insertion
        header("Location: studentManagement.php");
        exit();
    } else {
        // Display an error message if the insertion fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
