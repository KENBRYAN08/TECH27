<?php
include('db.php');

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Prepare the SQL query to get the user details by user_id
    $query = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $query->bind_param("i", $user_id); // "i" stands for integer type
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user); // Returning user data in JSON format
    } else {
        echo json_encode(null); // No user found
    }
} else {
    echo json_encode(null); // No user ID provided
}
?>
