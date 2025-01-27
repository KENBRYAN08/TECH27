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

// Check for search query
$searchQuery = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : null;

// Fetch users based on the search query
if (!empty($searchQuery)) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE 
        first_name LIKE ? OR 
        middle_name LIKE ? OR 
        last_name LIKE ? OR 
        email LIKE ? OR 
        role LIKE ?");
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bind_param("sssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $query = $stmt->get_result();
} else {
    // Fetch all users if no search query
    $query = $conn->query("SELECT * FROM users");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>




    </style>
</head>
<body>

<div class="sidenav">
    <?php include('sidenav.php'); ?>
</div>

   <!-- Search Form -->
   <form method="GET" action="admin.php" class="search-form">
                <input type="text" name="search" placeholder="Search users..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
                <button type="submit">Search</button>
            </form>


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
