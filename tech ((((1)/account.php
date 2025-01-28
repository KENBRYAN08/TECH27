<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();


// Set the role from the session or default to 'user' if not found
$role = isset($user['role']) ? $user['role'] : 'user'; 

// If the user is not an admin, disable the role selection in the form
$role_disabled = ($_SESSION['role'] != 'admin') ? 'disabled' : '';


// Handle Image Upload
if (isset($_POST['update_user'])) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // If user is not an admin, do not allow changing the role
    if ($_SESSION['role'] != 'admin') {
        $role = $user['role']; // Keep existing role if not admin
    }
    
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

    // Update User Info
    $query = $conn->prepare("UPDATE users SET first_name=?, middle_name=?, last_name=?, age=?, gender=?, contact=?, position=?, email=?, password=?, role=?, image=? WHERE id=?");
    $query->bind_param("sssisssssssi", $first_name, $middle_name, $last_name, $age, $gender, $contact, $position, $email, $password, $role, $image_path, $user_id);
    $query->execute();

    // Set a success message
    $_SESSION['success_message'] = 'Successfully Updated Account';
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Account</title>
    <link rel="stylesheet" href="css/accountstyle.css">



</head>
<body>

<div class="sidenav">
    <?php include('sidenav.php'); ?>
</div>

<div class="main-content">
    <div class="account-container">
        <h2>My Account</h2>




        
        <form method="POST" enctype="multipart/form-data">

        
             <div>
                <img src="<?php echo $user['image'] ?? 'images/default.png'; ?>" alt="Profile Picture" width="100" height="100">
            </div>

        
            <div>
                <label for="profile_image">Profile Picture</label>
                <input type="file" name="profile_image" id="profile_image" accept="image/*">
            </div>

       

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>
            </div>
            <div>
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" value="<?php echo $user['middle_name']; ?>">
            </div>
            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>
            </div>
            <div>
                <label for="age">Age</label>
                <input type="number" name="age" value="<?php echo $user['age']; ?>" required>
            </div>
            <div>
                <label for="gender">Gender</label>
                <select name="gender" required>
                    <option value="male" <?php echo ($user['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo ($user['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                    <option value="others" <?php echo ($user['gender'] == 'others') ? 'selected' : ''; ?>>Others</option>
                </select>
            </div>
            <div>
                <label for="contact">Contact</label>
                <input type="text" name="contact" value="<?php echo $user['contact']; ?>">
            </div>
            <div>
                <label for="position">Position</label>
                <input type="text" name="position" value="<?php echo $user['position']; ?>">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" value="<?php echo $user['password']; ?>" required>
            </div>
            
        <div>
            <label for="role">Role</label>
            <!-- Only allow the admin to change the role -->
            <select name="role" <?php echo $role_disabled; ?>>
                <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?php echo ($role == 'user') ? 'selected' : ''; ?>>User</option>
            </select>
        </div>
        
        <button type="submit" name="update_user">Update Profile</button>
        </form>
    </div>
</div>

<!-- Modal -->
<div id="successModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">×</span>
        <p id="successMessage"></p>
    </div>
</div>


<!-- Display modal with success message if set -->
<script>
<?php if (isset($_SESSION['success_message'])): ?>
    // Show the modal and set the success message
    document.getElementById('successModal').style.display = 'block';
    document.getElementById('successMessage').textContent = '<?php echo $_SESSION['success_message']; ?>';
    <?php unset($_SESSION['success_message']); // Clear the message ?>
<?php endif; ?>
</script>

<!-- Function to close the modal -->
<script>
function closeModal() {
    document.getElementById('successModal').style.display = 'none';
}

// Function to close the modal when clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById('successModal');
    if (event.target == modal) {
        closeModal();
    }
}


</script>

</body>
</html>
