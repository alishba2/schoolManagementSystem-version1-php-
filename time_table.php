<!DOCTYPE html>
<html>
<head>
    <title>Timetable</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Timetable</h1>

    <form method="post" action="save_timetable.php">
        <table>
            <tr>
                <th>Subject</th>
                <th>Day</th>
                <th>Time</th>
                <th>Teacher</th>
            </tr>
            <?php
            // Generate rows for each subject
            for ($i = 1; $i <= 5; $i++) {
                echo "<tr>";
                echo "<td><input type='text' name='subject$i'></td>";
                echo "<td><input type='text' name='day$i'></td>";
                echo "<td><input type='text' name='time$i'></td>";
                echo "<td><input type='text' name='teacher$i'></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <input type="submit" value="Submit">
    </form>
</body>
</html>