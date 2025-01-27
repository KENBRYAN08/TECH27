<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        echo "<p><img src='{$user['image']}' alt='Profile Picture' width='100'></p>";
        echo "<p>Name: {$user['first_name']} {$user['middle_name']}  {$user['last_name']}</p>";
        echo "<p>Age: {$user['age']}</p>";
        echo "<p>Gender: {$user['gender']}</p>";
        echo "<p>Contact: {$user['contact']}</p>";
        echo "<p>Position: {$user['position']}</p>";
        echo "<p>Email: {$user['email']}</p>";
        echo "<p>Password: {$user['password']}</p>";
        echo "<p>Role: {$user['role']}</p>";
    }
}
?>
