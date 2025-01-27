<?php
session_start();
include('db.php');

// Check if the form was submitted to delete a user
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    // Prepare the delete query
    $query = $conn->prepare("DELETE FROM users WHERE id = ?");
    $query->bind_param("i", $id);

    // Execute the query
    if ($query->execute()) {
        // Redirect to the same page to refresh the list
        header("Location: admin.php");
        exit;
    } else {
        echo "Error deleting user.";
    }
}

// Fetch all users
$query = $conn->query("SELECT * FROM users");



// Handle the search query
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
     /* General Modal Styles */



.center-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-left: 30px;
    margin-top: 20px;
    justify-content: left;
    padding-top: 50px;
}

.view-details-btn {
    background-color: #2a2185;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 50px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.2s;
    margin-top: 10px;
}

.view-details-btn:hover {
    background-color: #4c43e0;
    transform: scale(1.05);
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    overflow: auto;
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    border-radius: 20px;
    width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.modal-header {
    font-size: 20px;
    font-weight: bold;
    text-align: left;
    color: #fff;
    background-color: #2a2185;
    padding: 10px 20px;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    width: 100%;
    position: relative;
}

.modal-body {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-start;
}

.modal-details {
    display: flex;
    flex-direction: row;
    width: 100%;
}

.details-text {
    flex: 2;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.details-image {
    flex: 1;
    padding: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%; /* Make sure the image container fills the height of the content */
}



.close {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
}




.close {
    color: #aaa;
    font-size: 30px;
    font-weight: bold;
    top: 10px;
    right: 20px;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
}


/* Cancel button styles */
.cancel-btn {
    background-color: #f44336; /* Red color */
    color: white;
    padding:15px;
    width:20%;
    margin-left:20px;
    margin-top:50px;
    margin-bottom:30px;
}

.cancel-btn:hover {
    background-color: #d32f2f;
}

/* Confirm button styles */
.confirm-btn {
    background-color: #4CAF50; /* Green color */
    color: white;
    padding:15px;
    width:30%;
    margin-right:20px;
    margin-top:50px;
    margin-bottom:30px;
}

.confirm-btn:hover {
    background-color: #388E3C;
}
    </style>
</head>
<body>

<div class="sidenav">
    <?php include('sidenav.php'); ?>
</div>



<div class="main-content">
    <div class="detailss">
        <div class="centerBoxs">
            <div class="centerHeaders">
                <h2>Admin Page</h2>
                <a href="add_user.php" class="btn btn-primary">Add Users</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $query->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['role']; ?></td>
                            <td>
                                <button type="button" class="view-btn" onclick="viewUser(<?= $row['id']; ?>)">View</button>
                            </td>
                            <td>
                                <a href="add_user.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                            </td>
                            <td>
                                <button type="button" class="delete-btn" onclick="openDeleteModal(<?= $row['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for viewing user -->
<div id="userModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>User Details</h2>
        </div>
        <div class="modal-body">
            <div class="modal-details">
                <div class="details-text" id="userDetails"></div>
                <div class="details-image" id="userImage"></div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Are you sure you want to delete this user?</h2>
        <form id="deleteForm" method="POST" action="admin.php">
            <input type="hidden" name="delete_id" id="delete_id">
            <button type="submit" class="confirm-btn">Yes, Delete</button>
            <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
        </form>
    </div>
</div>

<script>
    function viewUser(userId) {
        fetch('view_user.php?id=' + userId)
            .then(response => response.text())
            .then(data => {
                document.getElementById('userDetails').innerHTML = data;
                document.getElementById('userModal').style.display = 'block';
            });
    }

    function closeModal() {
        document.getElementById('userModal').style.display = 'none';
    }

    function openDeleteModal(userId) {
        document.getElementById('delete_id').value = userId;
        document.getElementById('deleteModal').style.display = 'block';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>

</body>
</html>
