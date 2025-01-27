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

/* =========== Search Form Styles ============ */
/* Search form styling */
/* General styling for the top navigation */
.topnav {
  display: flex;
  justify-content: space-between;  /* Centers content horizontally */
  align-items: center;
  padding: 5px 10px;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: transparent; 
  color: white;
  z-index: 10;
  height: 100px; /* Adjust for proper alignment */
  transition: top 0.3s; /* Smooth transition */
}

/* Positioning the logo on the left */
.topnav .logo {
  position: absolute;
  left: 20px;
}

.topnav .logo h1 {
  font-size: 24px;
  margin: 0;
}

/* Right side of the nav */
.topnav-right {
  display: flex;
  align-items: center;
}

/* Search form styling */
.search-form {
  position: relative;
  display: flex;
  align-items: center;
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 25px;
  width: 400px; /* Adjust width as necessary */
  overflow: hidden;
  transition: border-color 0.3s ease;
  justify-content: center;
  padding-left: 10px;
  margin: 20px 10px; /* Add margin on top to move it down */
  left: 120px; /* Move the search form 100px to the right */
}

.search-form:hover {
  border-color: #2a2185;
}

.search-form button {
  background-color: #f9f9f9; /* White background for the button */
  border: none;
  cursor: pointer;
  padding: 10px 15px;
  border-radius: 25px; /* Rounded corners on all sides */
  display: flex;
  align-items: center;
  justify-content: center;
  transform: translate(-20%); /* Align with the middle of the input */
}

.search-form button ion-icon {
  color: #2a2185; /* Icon matches primary theme color */
  font-size: 1.2rem;
}


.search-form {
  position: relative;
  display: flex;
  align-items: center;
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 25px;
  width: 400px; /* Adjust width as necessary */
  overflow: hidden;
  transition: border-color 0.3s ease;
  justify-content: center;
  padding-left: 10px;
  transform: translateX(500px);
  margin: 20px 10px; /* Add margin on top to move it down */
}

.search-form:hover {
  border-color: #2a2185;
}

.search-form input {
  height: 20px; /* Height of the input */
  padding: 5px 20px;
  font-size: 16px;
  position: relative;
  border: none;
  outline: none;
  flex-grow: 1; /* Fills remaining space */
  background-color: transparent;
  color: #333;
  margin-top: 10px; /* Add margin-top to push the input lower */
}


.search-form input::placeholder {
  color: #888;
  font-style: italic;
}

.user {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: #f9f9f9; /* Background for better visibility */
  cursor: pointer;
  color: #2a2185;
}

.user ion-icon {
  font-size: 3.5rem;
}


  @media (max-width: 991px) {
    .navigation {
      left: -300px;
    }
    .navigation.active {
      width: 300px;
      left: 0;
    }
    .main {
      width: 100%;
      left: 0;
    }
    .main.active {
      left: 300px;
    }
    .cardBox {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  
  @media (max-width: 768px) {
    .details {
      grid-template-columns: 1fr;
    }
    .recentOrders {
      overflow-x: auto;
    }
    .status.inProgress {
      white-space: nowrap;
    }
  }
  
  @media (max-width: 480px) {
    .cardBox {
      grid-template-columns: repeat(1, 1fr);
    }
    .cardHeader h2 {
      font-size: 20px;
    }
    .user {
      min-width: 40px;
    }
    .navigation {
      width: 100%;
      left: -100%;
      z-index: 1000;
    }
    .navigation.active {
      width: 100%;
      left: 0;
    }
    .toggle {
      z-index: 10001;
    }
    .main.active .toggle {
      color: #fff;
      position: fixed;
      right: 0;
      left: initial;
    }
  }


    </style>
</head>
<body>

<div class="sidenav">
    <?php include('sidenav.php'); ?>
</div>

<div class="topnav" id="topnav">
   <!-- Search Form -->
   <form method="GET" action="admin.php" class="search-form">
                <input type="text" name="search" placeholder="Search users..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
                <button type="submit">Search</button>
            </form>

       <!-- User Icon (always visible on all pages) -->
       <div>
            <a href="account.php">
                <div class="user">
                    <ion-icon name="person-circle-outline" style="font-size: 65px;"></ion-icon>
                </div>
            </a>
        </div>
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
