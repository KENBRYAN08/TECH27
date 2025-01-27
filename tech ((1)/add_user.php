<?php
session_start();
include('db.php');

$user = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();
}

// Handle Image Upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    // Handle Image Upload
    if ($_FILES['profile_image']['name']) {
        $image_name = $_FILES['profile_image']['name'];
        $image_tmp = $_FILES['profile_image']['tmp_name'];
        $image_path = 'images/' . $image_name;
        move_uploaded_file($image_tmp, $image_path);
    } else {
        // Use the existing image if none is uploaded
        $image_path = $user['image'] ?? 'images/default.png';
    }

    if (isset($user['id'])) {
        // Update User
        $query = $conn->prepare("UPDATE users SET first_name=?, middle_name=?, last_name=?, age=?, gender=?, contact=?, position=?, email=?, password=?, role=?, image=? WHERE id=?");
        $query->bind_param("sssisisssssi", $first_name, $middle_name, $last_name, $age, $gender, $contact, $position, $email, $password, $role, $image_path, $user['id']);
    } else {
        // Add User
        $query = $conn->prepare("INSERT INTO users (first_name, middle_name, last_name, age, gender, contact, position, email, password, role, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("sssisisssss", $first_name, $middle_name, $last_name, $age, $gender, $contact, $position, $email, $password, $role, $image_path);
    }

    $query->execute();
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= isset($user['id']) ? 'Edit User' : 'Add User'; ?></title>
    <link rel="stylesheet" href="css/accountstyle.css">
</head>
<body>

<div class="sidenav">
    <?php include('sidenav.php'); ?>
</div>

<div class="main-content">
    <div class="account-container">
        <h2><?= isset($user['id']) ? 'Edit User' : 'Add User'; ?></h2>
        
        <form method="POST" enctype="multipart/form-data">
            <?php if (isset($user['id'])): ?>
                <input type="hidden" name="id" value="<?= $user['id']; ?>">
            <?php endif; ?>

            <div>
                <img src="<?= $user['image'] ?? 'images/default.png'; ?>" alt="Profile Picture" width="100" height="100">
            </div>

            <div>
                <label for="profile_image">Profile Picture</label>
                <input type="file" name="profile_image" id="profile_image" accept="image/*">
            </div>

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="<?= $user['first_name'] ?? ''; ?>" required>
            </div>
            <div>
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" value="<?= $user['middle_name'] ?? ''; ?>">
            </div>
            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="<?= $user['last_name'] ?? ''; ?>" required>
            </div>
            <div>
                <label for="age">Age</label>
                <input type="number" name="age" value="<?= $user['age'] ?? ''; ?>" required>
            </div>
            <div>
                <label for="gender">Gender</label>
                <select name="gender" required>
                    <option value="male" <?= isset($user['gender']) && $user['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?= isset($user['gender']) && $user['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                    <option value="others" <?= isset($user['gender']) && $user['gender'] == 'others' ? 'selected' : ''; ?>>Others</option>
                </select>
            </div>
            <div>
                <label for="contact">Contact</label>
                <input type="text" name="contact" value="<?= $user['contact'] ?? ''; ?>">
            </div>
            <div>
                <label for="position">Position</label>
                <input type="text" name="position" value="<?= $user['position'] ?? ''; ?>">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?? ''; ?>" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" value="<?= $user['password'] ?? ''; ?>" required>
            </div>
            <div>
                <label for="role">Role</label>
                <select name="role">
                    <option value="admin" <?= isset($user['role']) && $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?= isset($user['role']) && $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                </select>
            </div>
            
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

</body>
</html>
