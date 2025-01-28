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
        echo "
        <div style='display: flex;'>
            <!-- Image on the left -->
            <div style='flex: 1; padding-right: 20px;'>
                <img src='{$user['image']}' alt='Profile Picture' width='100'>
            </div>
            
            <!-- Text details stacked vertically on the right -->
            <div style='flex: 2; display: flex; flex-direction: column; justify-content: flex-start;'>
                <p><strong>Name: </strong>{$user['first_name']} {$user['middle_name']} {$user['last_name']}</p>
                <p><strong>Age: </strong>{$user['age']}</p>
                <p><strong>Gender: </strong>{$user['gender']}</p>
                <p><strong>Contact: </strong>{$user['contact']}</p>
                <p><strong>Position: </strong>{$user['position']}</p>
                <p><strong>Email: </strong>{$user['email']}</p>
                <p><strong>Password: </strong>{$user['password']}</p>
                <p><strong>Role: </strong>{$user['role']}</p>
            </div>
        </div>";
    }
}
?>