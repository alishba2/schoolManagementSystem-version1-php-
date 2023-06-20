<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <style>
    th{
      background-color: #698474;
    }
  </style>

  <body>
    <?php

if (isset($_GET["id"])) {
  $studentId = $_GET["id"];
 

}
    ?>

    <div class="mainContainer">
      <div class="mainA">
        <span>LOGO</span>
        <div class="links">
          <a href="#">Dashboard</a>
          <a href="./result.php?student_id=<?php echo $studentId; ?>">Results</a>

          <a href="./timetable.html">TimeTable</a>
          <a href="./login.html">Log out</a>

        </div>
      </div>
      

      <div class="mainB">
        <span>Dashboard</span>

      
      <?php

require_once "DBconn.php";

session_start();
if (isset($_GET["id"])) {
    $studentId = $_GET["id"];
    // Fetch student data based on the provided student ID
    $sql = "SELECT * FROM Students WHERE student_id = $studentId";
    $result = $conn->query($sql);
    $_SESSION["student_id"] = $row["student_id"];
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<td>".$row["first_name"]." ".$row["last_name"]."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Father Name</th>";
        echo "<td>".$row["father_name"]."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>CNIC</th>";
        echo "<td>".$row["cnic"]."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Grade</th>";
        echo "<td>".$row["grade"]."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Contact No</th>";
        echo "<td>".$row["contact_number"]."</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "Student data not found.";
    }
} else {
    echo "Invalid student ID.";
}
?>


        
        <!-- <span style="font-size: 20px">My Courses</span> -->
        <!-- <table>
          <thead>
            <th>Course Name</th>
            <th>Course code</th>
            <th>Credit hours</th>
          </thead>
          <tbody>
            <tr>
              <td>SE</td>
              <td>SE102</td>
              <td>04</td>
            </tr>
            <tr>
              <td>SE</td>
              <td>SE102</td>
              <td>04</td>
            </tr>
            <tr>
              <td>SE</td>
              <td>SE102</td>
              <td>04</td>
            </tr>
            <tr>
              <td>SE</td>
              <td>SE102</td>
              <td>04</td>
            </tr>
          </tbody>
        </table> -->
      </div>
      <div class="mainC">
        <div class="mainC1">
          <span>Profile</span>
          <span><i class="fa fa-edit" style="font-size: 24px"></i></span>
        </div>
        <div class="mainC2">
          <img src="./assets/user.png" alt="img" height="70" />
        </div>
        <div class="mainC3">
          <?php
            echo "<span>".$row["first_name"]." ".$row["last_name"]."</span>";
          ?>
             <?php
            echo "<span>".$row["registration_number"]."</span>";
          ?>
        </div>
     
        <div class="notification-sidebar">
          <div class="notification-header">
         
          <?php
require_once "DBconn.php";

// Fetch notifications from the database
$sql = "SELECT message FROM notifications";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output each notification as a list item
    echo '<div class="notification-container">';
    echo '<span class="notification-title">Notifications</span>';
    echo '<ul style=margin-top:20px; class="notification-list">';
    while ($row = $result->fetch_assoc()) {
        $notificationText = $row["message"];
        echo '<li class="notification-item"><a href="#">' . $notificationText . '</a></li>';
    }
    echo '</ul>';
    echo '</div>';
} else {
    // No notifications found
    echo 'No notifications found.';
}

// Close the database connection
$conn->close();
?>


        
        </div>
      </div>
    </div>
    <script src="./scrip.js"></script>
  </body>
</html>
