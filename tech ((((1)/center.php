<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('connection.php');

// Handle the search query
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Query to get all center details based on search
$stmt = $pdo->prepare("SELECT * FROM centers WHERE name LIKE ?");
$stmt->execute(['%' . $searchQuery . '%']);
$centers = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .center-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-left: 30px;
            margin-top: 20px;
            justify-content: left;
            padding-top: 50px;
        }

        .view-details-btn {
            background-color: #2a2185;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 10px;
        }

        .view-details-btn:hover {
            background-color: #4c43e0;
            transform: scale(1.05);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            border-radius: 20px;
            width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .modal-header {
            font-size: 20px;
            font-weight: bold;
            text-align: left; /* Aligns header text to the left */
            color: #fff;
            background-color: #2a2185;
            padding: 10px 20px; /* Adjust padding for better spacing */
            border-top-left-radius: 20px; /* Keep the left border rounded */
            border-top-right-radius: 20px; /* Keep the right border rounded */
            width: 100%; /* Ensure it spans the modal's width */
            position: relative;
        }
        .modal-body {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
        }

        .modal-details {
            display: flex;
            flex-direction: row;
            width: 100%;
        }

        .details-text {
            flex: 2;
            padding: 10px;
        }

        .details-image {
            flex: 1;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .details-image img {
            max-width: 100%;
            max-height: 150px;
            border-radius: 10px;
            object-fit: cover;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
        }
    </style>
</head>
<body>
    <div class="sidenav">
        <?php include('sidenav.php'); ?>
    </div>
    <div class="topnav">
        <?php include('topnav.php'); ?>
    </div>

    <div class="main-content">
        <div class="center-grid">
            <?php foreach ($centers as $center): ?>
                <div class="center-box">
                    <img src="images/<?php echo htmlspecialchars($center['image']); ?>" alt="Center Image">
                    <h2><?php echo htmlspecialchars($center['name']); ?></h2>
                    <p>
                        <span class="status <?php echo htmlspecialchars(strtolower($center['status'])); ?>">
                            <?php echo htmlspecialchars($center['status']); ?>
                        </span>
                    </p>
                    <button class="view-details-btn" onclick="viewDetails(<?php echo htmlspecialchars($center['id']); ?>)">View Details</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-header">Center Details</div>
            <div class="modal-body">
                <div class="modal-details">
                    <div class="details-text" id="modal-text"></div>
                    <div class="details-image" id="modal-image"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewDetails(centerId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'get_center_details.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var centerDetails = JSON.parse(xhr.responseText);
                    if (centerDetails) {
                        var modalText = document.getElementById('modal-text');
                        var modalImage = document.getElementById('modal-image');
                        modalText.innerHTML = `
                            <p><strong>Name:</strong> ${centerDetails.name}</p>
                            <p><strong>Location:</strong> ${centerDetails.location}</p>
                            <p><strong>Manager:</strong> ${centerDetails.manager}</p>
                            <p><strong>Status:</strong> ${centerDetails.status}</p>
                        `;
                        modalImage.innerHTML = `
                            <img src="images/${centerDetails.image}" alt="${centerDetails.name}">
                        `;
                        var modal = document.getElementById('myModal');
                        modal.style.display = 'block';
                    } else {
                        alert("Center not found.");
                    }
                }
            };
            xhr.send('center_id=' + centerId);
        }

        var closeBtn = document.getElementsByClassName('close')[0];
        closeBtn.onclick = function() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('myModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
