<!DOCTYPE html>
<html>
<head>
    <title>Teacher Management</title>
 
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* CSS styles omitted for brevity */
        form {
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
    </style>
</head>
<body>
    <div class="container">
        <h1 class="heading">Teacher Management</h1>
        <button onclick="openModal()" class="btn btn-primary btn-insert">Insert New Teacher</button>
        <table class="table">
            <thead>
                <tr>
                    <th>Teacher ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>CNIC</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch teacher data from the database and populate the table rows
                require_once "DBconn.php";
                $sql = "SELECT * FROM Teachers";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["teacher_id"]."</td>";
                        echo "<td>".$row["first_name"]."</td>";
                        echo "<td>".$row["last_name"]."</td>";
                        echo "<td>".$row["date_of_birth"]."</td>";
                        echo "<td>".$row["cnic"]."</td>";
                        echo "<td>".$row["gender"]."</td>";
                        echo "<td>".$row["address"]."</td>";
                        echo "<td>".$row["contact_number"]."</td>";
                        echo "<td>";
                        echo "<button onclick=\"openEditModal(".$row["teacher_id"].")\" class=\"btn btn-primary btn-edit\">Edit</button>";
                        echo "<button onclick=\"openDeleteModal(".$row["teacher_id"].")\" class=\"btn btn-danger btn-delete\">Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No teacher records found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for inserting a new teacher -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Insert New Teacher</h2>
            <form action="insert_teacher.php" method="POST">
                <label for="teacher_id">Teacher ID:</label>
                <input type="text" id="teacher_id" name="teacher_id" required>

                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>

                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required>

                <label for="cnic">CNIC:</label>
                <input type="text" id="cnic" name="cnic" required>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>

                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" required>

                <input class="btn btn-primary" type="submit" value="Insert">
            </form>
        </div>
    </div>

    <!-- Modal for editing a teacher -->
    <div id="editModal" class="modal">
        <!-- Modal content for editing a teacher -->
        <!-- You can reuse the same form structure as the insert modal -->
    </div>

    <!-- Modal for deleting a teacher -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Delete Teacher</h2>
            <p>Are you sure you want to delete this teacher?</p>
            <form id="deleteForm" method="POST">
    <input type="hidden" id="delete_teacher_id" name="teacher_id">
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

        function openEditModal(teacherId) {
            // Set the teacher ID in the form for editing
            document.getElementById("edit_teacher_id").value = teacherId;
            document.getElementById("editModal").style.display = "block";
        }
        
        function openDeleteModal(teacherId) {
        // Set the teacher ID in the form for deletion
        document.getElementById("delete_teacher_id").value = teacherId;

        // Open the delete modal with the teacher ID as a query parameter in the action URL
        const deleteForm = document.getElementById("deleteForm");
        deleteForm.action = "delete_teacher.php?teacher_id=" + teacherId;

        // Submit the form
        deleteForm.submit();
    }
    </script>
</body>
</html>
