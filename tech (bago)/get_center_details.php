<?php
include('connection.php');

// Check if center_id is provided
if (isset($_POST['center_id'])) {
    $center_id = $_POST['center_id'];

    // Fetch the center details based on center_id
    $stmt = $pdo->prepare("SELECT * FROM centers WHERE id = ?");
    $stmt->execute([$center_id]);
    $center = $stmt->fetch();

    if ($center) {
        // Return the details as a JSON response
        echo json_encode([
            'name' => $center['name'],
            'location' => $center['location'],
            'manager' => $center['manager'],
            'status' => $center['status'],
            'image' => $center['image']
        ]);
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(null);
}
?>
