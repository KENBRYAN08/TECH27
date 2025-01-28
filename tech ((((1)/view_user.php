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
        echo "<p><strong>Name: </strong>{$user['first_name']} {$user['middle_name']}  {$user['last_name']}</p>";
        echo "<p><strong>Age: </strong>{$user['age']}</p>";
        echo "<p><strong>Gender: </strong>{$user['gender']}</p>";
        echo "<p><strong>Contact: </strong>{$user['contact']}</p>";
        echo "<p><strong>Position: </strong>{$user['position']}</p>";
        echo "<p><strong>Email: </strong>{$user['email']}</p>";
        echo "<p><strong>Password: </strong>{$user['password']}</p>";
        echo "<p><strong>Role: </strong>{$user['role']}</p>";
    }
}
?>
