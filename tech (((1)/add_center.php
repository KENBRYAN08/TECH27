<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $manager = $_POST['manager'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'];

    // Upload image
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);

    $stmt = $pdo->prepare("INSERT INTO centers (name, location, manager, status, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $location, $manager, $status, $image]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Center</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="sidenav">
        <?php include('sidenav.php'); ?>
    </div>

    <div class="main-content">
        <h1>Add Center</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Center Name:</label>
            <input type="text" name="name" required><br>

            <label for="location">Center Location:</label>
            <input type="text" name="location" required><br>

            <label for="manager">Center Manager:</label>
            <input type="text" name="manager" required><br>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="relaunch">Relaunching</option>
                <option value="pending">Pending</option>
            </select><br>

            <label for="image">Center Image:</label>
            <input type="file" name="image" required><br>

            <button type="submit">Add Center</button>
        </form>
    </div>
</body>
</html>
