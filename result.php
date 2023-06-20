<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./result.css" />
  </head>
  <body>
    <div class="container">
      <span> RESULT</span>
      <table>
        <caption>
          <b>Semester</b>
          FALL-2022
        </caption>
        <thead>
          <tr>
            <th scope="col">Course Title</th>
            <th scope="col">Total marks</th>
            <th scope="col">Obtained Marks</th>
          </tr>
        </thead>
        <tbody>
          <?php
         if (isset($_GET["student_id"])){

          $studentId = $_GET['student_id'];


          // Retrieve the result data for the student from the database
          require_once "DBconn.php";
        $sql = "SELECT * FROM Grades WHERE student_id = $studentId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subjectId = $row["subject_id"];
        $grades = $row["grade"];
        
        $sql2 = "SELECT * FROM Subjects WHERE subject_id = $subjectId";
        $result2 = $conn->query($sql2);
        
        if ($result2->num_rows > 0) {
            $subjectRow = $result2->fetch_assoc();
            $courseTitle = $subjectRow["subject_name"];
          
            
            echo "<tr>";
            echo "<td>" . $subjectRow["subject_name"] . "</td>";
            echo "<td>100</td>";
            echo "<td>" . $grades . "</td>";
            echo "</tr>";
        }
    }
} else {
    echo "<tr><td colspan='3'>No result data found.</td></tr>";
}
         }
        
     
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
