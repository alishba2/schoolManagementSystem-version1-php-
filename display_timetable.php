<!DOCTYPE html>
<html>
<head>
    <title>Timetable - Display</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Timetable - Display</h1>

    <table class="result-table">
        <tr>
            <th>Subject</th>
            <th>Day</th>
            <th>Time</th>
            <th>Teacher</th>
        </tr>
        <?php
        // Retrieve timetable data from the database
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

        $sql = "SELECT * FROM timetable";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['subject']}</td>";
                echo "<td>{$row['day']}</td>";
                echo "<td>{$row['time']}</td>";
                echo "<td>{$row['teacher']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data available</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>
</body>
</html>