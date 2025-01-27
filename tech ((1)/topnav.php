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

        <!-- User Icon (always visible on all pages) -->
        <div>
            <a href="account.php">
                <div class="user">
                    <ion-icon name="person-circle-outline" style="font-size: 65px;"></ion-icon>
                </div>
            </a>
        </div>

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
