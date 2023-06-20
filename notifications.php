<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
 
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* CSS styles omitted for brevity */
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
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;

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
        <h1 class="heading">Notification Management</h1>
        <button onclick="openModal()" class="btn btn-primary btn-insert">Upload Notification</button>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch notification data from the database and populate the table rows
                require_once "DBconn.php";
                $sql = "SELECT * FROM notifications";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["title"]."</td>";
                        echo "<td>".$row["message"]."</td>";
                        echo "<td>".$row["created_at"]."</td>";
                        echo "<td>";
                        echo "<button onclick=\"openEditModal(".$row["id"].")\" class=\"btn btn-primary btn-edit\">Edit</button>";
                        echo "<button onclick=\"openDeleteModal(".$row["id"].")\" class=\"btn btn-danger btn-delete\">Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No notification records found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for uploading a new notification -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Upload Notification</h2>
            <form action="upload_notifications.php" method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <input class="btn btn-primary" type="submit" value="Upload">
            </form>
        </div>
    </div>

    <!-- Modal for editing a notification -->
    <div id="editModal" class="modal">
        <!-- Modal content for editing a notification -->
        <!-- You can reuse the same form structure as the upload modal -->
    </div>

    <!-- Modal for deleting a notification -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Delete Notification</h2>
            <p>Are you sure you want to delete this notification?</p>
            <form action="delete_notification.php" method="POST">
                <input type="hidden" id="delete_notification_id" name="notification_id">
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

        function openEditModal(notificationId) {
            // Set the notification ID in the form for editing
            document.getElementById("edit_notification_id").value = notificationId;
            document.getElementById("editModal").style.display = "block";
        }

        function openDeleteModal(notificationId) {
    // Set the notification ID in the form for deletion
    document.getElementById("delete_notification_id").value = notificationId;

    // Open the delete modal with the notification ID as a query parameter in the action URL
    const deleteModal = document.getElementById("deleteModal");
    const deleteForm = deleteModal.querySelector("form");
    deleteForm.action = "delete_notification.php?notification_id=" + notificationId;

    deleteModal.style.display = "block";
}

    </script>
</body>
</html>
