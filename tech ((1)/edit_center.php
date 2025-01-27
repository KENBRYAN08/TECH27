<?php
include('connection.php');

// Check if the center ID is provided for editing
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $center_id = $_GET['id'];

    // Fetch the current center details
    $stmt = $pdo->prepare("SELECT * FROM centers WHERE id = ?");
    $stmt->execute([$center_id]);
    $center = $stmt->fetch();

    // Check if the center exists
    if (!$center) {
        die('Center not found.');
    }

    // Handle form submission for updating the center
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_center'])) {
        $name = $_POST['name'];
        $location = $_POST['location'];
        $manager = $_POST['manager'];
        $status = $_POST['status'];
        $image = $center['image']; // Keep the existing image by default

        // Check if a new image is uploaded
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);
        }

        // Update the center details in the database
        $stmt = $pdo->prepare("UPDATE centers SET name = ?, location = ?, manager = ?, status = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $location, $manager, $status, $image, $center_id]);

        // Redirect after updating the center
        header('Location: update_center.php');
        exit;
    }
} else {
    die('Invalid Center ID.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Center</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="sidenav">
        <?php include('sidenav.php'); ?>
    </div>

    <div class="main-content">
        <h1>Edit Center</h1>

        <form method="POST" enctype="multipart/form-data">
            <label for="name">Center Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($center['name']); ?>" required><br>

            <label for="location">Center Location:</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($center['location']); ?>" required><br>

            <label for="manager">Center Manager:</label>
            <input type="text" name="manager" value="<?php echo htmlspecialchars($center['manager']); ?>" required><br>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="active" <?php echo $center['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?php echo $center['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                <option value="relaunch" <?php echo $center['status'] == 'relaunch' ? 'selected' : ''; ?>>Relaunching</option>
                <option value="pending" <?php echo $center['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
            </select><br>

            <!-- Display the current image if available -->
            <label for="image">Center Image:</label>
            <?php if ($center['image']): ?>
                <br>
                <img src="images/<?php echo htmlspecialchars($center['image']); ?>" alt="Current Image">
                <br>
            <?php endif; ?>
            <input type="file" name="image"><br>

            <button type="submit" name="update_center">Update Center</button>
        </form>
    </div>
</body>
</html>
