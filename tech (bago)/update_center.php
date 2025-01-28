<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('connection.php');

// Handle Add Center form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_center'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $manager = $_POST['manager'];
    $status = $_POST['status'];

    // Insert new center into the database
    $stmt = $pdo->prepare("INSERT INTO centers (name, location, manager, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $location, $manager, $status]);

    // Redirect after adding new center
    header('Location: update_center.php');
    exit;
}

// Handle delete operation
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the center from the database
    $stmt = $pdo->prepare("DELETE FROM centers WHERE id = ?");
    $stmt->execute([$delete_id]);

    // Redirect after deletion
    header('Location: update_center.php');
    exit;
}

// Handle the search query
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Query to get all centers based on search
$stmt = $pdo->prepare("SELECT * FROM centers WHERE name LIKE ?");
$stmt->execute(['%' . $searchQuery . '%']);
$centers = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Centers</title>
    <link rel="stylesheet" href="css/styles.css">
</head> 
<body>
    <div class="sidenav">
        <?php include('sidenav.php'); ?>
    </div>

    <div class="topnav">
        <?php include('topnav.php'); ?>
    </div>

    <div class="main-content">
        <div class="detailss">
            <div class="centerBoxs">
                <div class="centerHeaders">
                    <h2>All Centers</h2>
                    <a href="add_center.php" class="btn">Add Center</a>
                </div>
                
                <!-- Search Form -->

                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Location</td>
                            <td>Manager</td>
                            <td>Status</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($centers as $center): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($center['name']); ?></td>
                            <td><?php echo htmlspecialchars($center['location']); ?></td>
                            <td><?php echo htmlspecialchars($center['manager']); ?></td>
                            <td>
                                <span class="status <?php echo htmlspecialchars(strtolower($center['status'])); ?>">
                                    <?php echo htmlspecialchars($center['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit_center.php?id=<?php echo $center['id']; ?>" class="edit-btn">Update</a>
                            </td>
                            <td>
                                <a href="update_center.php?delete_id=<?php echo $center['id']; ?>" onclick="return confirm('Are you sure you want to delete this center?')" class="delete-btn">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
