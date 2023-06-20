<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
 
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* CSS styles omitted for brevity */
        .container{
            margin-left:0px;
        }
        form{
            display: flex;
    flex-direction: column;
    width: 400px;
        }
        .heading {
            font-family: Arial, sans-serif;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-insert {
            margin-bottom: 10px;
        }
        .modal {
    display: none; /* Hide the modal by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4); /* Add a semi-transparent background overlay */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* Center the modal vertically and horizontally */
    padding: 20px;
    border: 1px solid #888;
    width: 35%; /* Adjust the width as needed */

    display: flex;
    flex-direction: column;
    align-items: center;

}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

/* Add any additional styling for the form inputs if needed */
.modal-content input,
.modal-content select,
.modal-content textarea {
    margin-bottom: 10px;
}
        .btn-edit,
        .btn-delete {
            margin-right: 5px;
        }
      .table{
        width:auto;
     
      }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="heading">Student Management</h1>
        <button onclick="openModal()" class="btn btn-primary btn-insert">Insert New Student</button>
        <style>
    .table {
        width: 140%; /* Set the desired width for the table */
        /* Add any other desired CSS styles for the table */
    }
</style>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Father Name</th>
            <th>Registration Number</th>
            <th>CNIC</th>
            <th>Grade</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch student data from the database and populate the table rows
        require_once "DBconn.php";
        $sql = "SELECT * FROM Students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["first_name"]." ".$row["last_name"]."</td>";
                echo "<td>".$row["father_name"]."</td>";
                echo "<td>".$row["registration_number"]."</td>";
                echo "<td>".$row["cnic"]."</td>";
                echo "<td>".$row["grade"]."</td>";
                echo "<td>".$row["date_of_birth"]."</td>";
                echo "<td>".$row["address"]."</td>";
                echo "<td>".$row["contact_number"]."</td>";
                echo "<td>";
                echo "<button onclick=\"openEditModal(".$row["student_id"].")\" class=\"btn btn-primary btn-edit\">Edit</button>";
                echo "<button onclick=\"openDeleteModal(".$row["student_id"].")\" class=\"btn btn-danger btn-delete\">Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No student records found.</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>

    </div>

    <!-- Modal for inserting a new student -->
   
  <!-- Modal for inserting a new student -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Insert New Student</h2>
        <form action="insert_student.php" method="POST">
            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="father_name">Father Name:</label>
            <input type="text" id="father_name" name="father_name" required>

            <label for="registration_number">Registration Number:</label>
            <input type="text" id="registration_number" name="registration_number" required>

            <label for="cnic">CNIC:</label>
            <input type="text" id="cnic" name="cnic" required>


            <label for="grade">Grade:</label>
            <input type="text" id="grade" name="grade" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>


            <input class="btn btn-primary" type="submit" value="Insert">
        </form>
    </div>
</div>

    <!-- Modal for editing a student -->
    <div id="editModal" class="modal">
        <!-- Modal content for editing a student -->
        <!-- You can reuse the same form structure as the insert modal -->
    </div>

    <!-- Modal for deleting a student -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Delete Student</h2>
            <p>Are you sure you want to delete this student?</p>
            <form action="delete_student.php" method="POST">
    <input type="hidden" id="delete_student_id" name="student_id">
    <input class="btn btn-danger" type="submit" value="Delete">
</form>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        function openModal() {
            document.getElementById("modal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
            document.getElementById("editModal").style.display = "none";
            document.getElementById("deleteModal").style.display = "none";
        }

        function openEditModal(studentId) {
            // Set the student ID in the form for editing
            document.getElementById("edit_student_id").value = studentId;
            document.getElementById("editModal").style.display = "block";
        }

        function openDeleteModal(studentId) {
            // Set the student ID in the form for deletion
            document.getElementById("delete_student_id").value = studentId;
            document.getElementById("deleteModal").style.display = "block";
        }
        function openDeleteModal(studentId) {
    // Set the student ID in the form for deletion
    document.getElementById("delete_student_id").value = studentId;

    // Open the delete modal with the student ID as a query parameter in the action URL
    const deleteModal = document.getElementById("deleteModal");
    const deleteForm = deleteModal.querySelector("form");
    deleteForm.action = "delete_student.php?student_id=" + studentId;

    deleteModal.style.display = "block";
}

    </script>
</body>
</html>
