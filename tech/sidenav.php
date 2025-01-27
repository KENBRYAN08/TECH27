<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech4ED Program</title>
    <!-- Link to Sidebar Styles -->
    <link rel="stylesheet" href="css/sidebar.css">
    <!-- Ionicons for Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <!-- Link to the homepage -->
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="laptop-outline"></ion-icon>
                        </span>
                        <span class="title">Tech4ED Program</span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="center.php">
                        <span class="icon">
                            <ion-icon name="business-outline"></ion-icon>
                        </span>
                        <span class="title">Centers</span>
                    </a>
                </li>

                <!-- Admin-specific links -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                    <li>
                        <a href="update_center.php">
                            <span class="icon">
                                <ion-icon name="accessibility-outline"></ion-icon>
                            </span>
                            <span class="title">Manage Centers</span>
                        </a>
                    </li>
                <?php } ?>

                <li>
                    <a href="about.php">
                        <span class="icon">
                            <ion-icon name="information-outline"></ion-icon>
                        </span>
                        <span class="title">About Us</span>
                    </a>
                </li>
                <li>
                    <a href="help.php">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>
                <li>
                    <a href="account.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Account</span>
                    </a>
                </li>

                <!-- Admin-specific links -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                    <li>
                        <a href="admin.php">
                            <span class="icon">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="title">Manage Users</span>
                        </a>
                    </li>
                <?php } ?>

                <li>
                    <a href="logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- =========== Scripts ========= -->
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
