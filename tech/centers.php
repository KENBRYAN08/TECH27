<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('connection.php');

// Default filter is to show all centers
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Query to count centers based on their status
$statuses = ['active', 'inactive', 'relaunch', 'pending'];
$counts = [];

foreach ($statuses as $status) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM centers WHERE status = ?");
    $stmt->execute([$status]);
    $counts[$status] = $stmt->fetchColumn();
}

// Query to fetch centers based on selected status
if ($statusFilter == 'all') {
    $stmt = $pdo->prepare("SELECT * FROM centers");
    $stmt->execute();
} else {
    $stmt = $pdo->prepare("SELECT * FROM centers WHERE status = ?");
    $stmt->execute([$statusFilter]);
}

$centers = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Management</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="sidenav">
        <?php include('sidenav.php'); ?>
    </div>

    <div class="cardBox">
        <!-- Total Centers Card -->
        <div class="card" onclick="window.location.href='centers.php?status=all'"> 
            <div>
                <div class="numbers"><?php echo count($centers); ?></div>
                <div class="cardName">Centers</div>
            </div>
            <div class="iconBx">
                <ion-icon name="stats-chart-outline"></ion-icon>
            </div>
        </div>

        <!-- Active Centers Card -->
        <div class="card" onclick="window.location.href='centers.php?status=active'"> 
            <div>
                <div class="numbers"><?php echo $counts['active']; ?></div>
                <div class="cardName">Active</div>
            </div>
            <div class="iconBx">
                <ion-icon name="radio-button-on-outline"></ion-icon>
            </div>
        </div>

        <!-- Inactive Centers Card -->
        <div class="card" onclick="window.location.href='centers.php?status=inactive'"> 
            <div>
                <div class="numbers"><?php echo $counts['inactive']; ?></div>
                <div class="cardName">Inactive</div>
            </div>
            <div class="iconBx">
                <ion-icon name="radio-button-off-outline"></ion-icon>
            </div>
        </div>

        <!-- Relaunching Centers Card -->
        <div class="card" onclick="window.location.href='centers.php?status=relaunch'"> 
            <div>
                <div class="numbers"><?php echo $counts['relaunch']; ?></div>
                <div class="cardName">Relaunching</div>
            </div>
            <div class="iconBx">
                <ion-icon name="reload-circle-outline"></ion-icon>
            </div>
        </div>
    </div>

    <div class="centers-list">
        <div class="details">
            <div class="centerBox">
                <div class="centerHeader">
                    <h2>
                        <?php
                        switch ($statusFilter) {
                            case 'active':
                                echo "Active Centers";
                                break;
                            case 'inactive':
                                echo "Inactive Centers";
                                break;
                            case 'relaunch':
                                echo "Relaunching Centers";
                                break;
                            default:
                                echo "All Centers";
                        }
                        ?>
                    </h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>CENTERS</th>
                            <th>LOCATION</th>
                            <th>MANAGER</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($centers as $center): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($center['name']); ?></td>
                                <td><?php echo htmlspecialchars($center['location']); ?></td>
                                <td><?php echo htmlspecialchars($center['manager']); ?></td>
                                <td><span class="status <?php echo htmlspecialchars(strtolower($center['status'])); ?>" style="flex: 0 0 120px; text-align: center;">
                                    <?php echo htmlspecialchars($center['status']); ?>
                                </span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
