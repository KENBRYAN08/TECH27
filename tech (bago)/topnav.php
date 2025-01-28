<?php

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch the user's image from the database
    $query = $conn->prepare("SELECT image FROM users WHERE id = ?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    // Set image URL or default image if not found
    $imageUrl = $user['image'] ?? 'images/default.png';  // Default image if no user image exists
} else {
    // Default image if no user is logged in
    $imageUrl = 'images/default.png';
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Management</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="css/sidebar.css">


</head>
<body>

    <!-- Top Navigation -->
    <div class="topnav" id="topnav">

        <!-- Check if the current page is index.php, center.php, or update_center.php -->
        <?php if (in_array(basename($_SERVER['PHP_SELF']), ['index.php', 'center.php', 'update_center.php'])): ?>
            <div class="topnav-right">
                <form method="GET" action="" class="search-form">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" placeholder="Search centers..." />
                    <button type="submit">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                </form>
            </div>
        <?php endif; ?>

<!-- User Profile Image -->
<a href="account.php">
    <div class="user">
        <img src="<?php echo $imageUrl; ?>" alt="User Image" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-top: 16px;">
    </div>
</a>

    </div>

    <script>
        let lastScrollTop = 0; // To store the last scroll position
        const topnav = document.getElementById('topnav');

        window.addEventListener('scroll', function() {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop) {
                // Scrolling down, hide the topnav
                topnav.style.top = "-100px"; // Hide the topnav off-screen
            } else {
                // Scrolling up, show the topnav
                topnav.style.top = "0"; // Bring the topnav back to the top
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For mobile or negative scrolling
        });
    </script>

</body>
</html>
