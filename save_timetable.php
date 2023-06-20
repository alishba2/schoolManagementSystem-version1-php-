<?php
// Retrieve values from the submitted form
$timetableData = array();
for ($i = 1; $i <= 5; $i++) {
    $subject = $_POST["subject$i"];
    $day = $_POST["day$i"];
    $time = $_POST["time$i"];
    $teacher = $_POST["teacher$i"];

    $timetableData[] = array(
        'subject' => $subject,
        'day' => $day,
        'time' => $time,
        'teacher' => $teacher
    );
}

// Store the timetable data in a database (MySQL/MariaDB)
$host = 'localhost'; // Replace with your database host
$dbUsername = 'root'; // Replace with your database username
$dbPassword = ''; // Replace with your database password
$dbName = 'school management system'; // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Create a table to store timetable data if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS timetable (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    day VARCHAR(50) NOT NULL,
    time VARCHAR(50) NOT NULL,
    teacher VARCHAR(255) NOT NULL
)";
$conn->query($sql);

// Insert the timetable data into the database
foreach ($timetableData as $data) {
    $subject = $conn->real_escape_string($data['subject']);
    $day = $conn->real_escape_string($data['day']);
    $time = $conn->real_escape_string($data['time']);
    $teacher = $conn->real_escape_string($data['teacher']);

    $sql = "INSERT INTO timetable (subject, day, time, teacher) VALUES ('$subject', '$day', '$time', '$teacher')";
    $conn->query($sql);
}

// Close the database connection
$conn->close();

// Redirect to the page where timetable data will be displayed
header('Location: display_timetable.php');
exit();
?>