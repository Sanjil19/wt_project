
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - E-Tech</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/navbar-footer.css">
    <link rel="stylesheet" href="../styles/profile.css">
    <style>
        .welcome-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 40px;
            border: 1px solid #ddd;
            border-radius: 12px;
            background-color: #ffffff;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db, #2980b9);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 36px;
            font-weight: bold;
        }

        .welcome-container h1 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .profile-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: left;
        }

        .profile-info h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
        }

        .info-value {
            color: #6c757d;
        }

        .buttons {
            margin-top: 20px;
        }

        .welcome-container button {
            padding: 12px 24px;
            margin: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .welcome-container button:hover {
            background-color: #2980b9;
        }

        .welcome-container button.logout-btn {
            background-color: #e74c3c;
        }

        .welcome-container button.logout-btn:hover {
            background-color: #c0392b;
        }

        .welcome-container a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    // Show navbar without cart for profile page
    $hide_cart = true;
    include '../parts/navbar.php';
    ?>
    <div class="welcome-container">
        <?php
        session_start();
        include '../database/dbconnect.php';

        if (isset($_SESSION['user_id'])) {
            $user_id = intval($_SESSION['user_id']);
            $sql = "SELECT * FROM users WHERE id = $user_id";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                $initials = strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1));
                
                echo "<div class='profile-header'>";
                echo "<div class='profile-avatar'>" . $initials . "</div>";
                echo "<h1>Welcome, " . $user['first_name'] . "!</h1>";
                echo "<p style='color: #6c757d;'>Manage your account and view your information</p>";
                echo "</div>";
            
            echo "<div class='profile-info'>";
            echo "<h3>Personal Information</h3>";
            echo "<div class='info-item'>";
            echo "<span class='info-label'>Full Name:</span>";
            echo "<span class='info-value'>" . $user['first_name'] . " " . $user['last_name'] . "</span>";
            echo "</div>";
            echo "<div class='info-item'>";
            echo "<span class='info-label'>Username:</span>";
            echo "<span class='info-value'>" . $user['username'] . "</span>";
            echo "</div>";
            echo "<div class='info-item'>";
            echo "<span class='info-label'>Email:</span>";
            echo "<span class='info-value'>" . $user['email'] . "</span>";
            echo "</div>";
            echo "</div>";

            echo "<div class='buttons'>";
            echo "<button><a href='../index.php' style='color: white; text-decoration: none;'>Continue Shopping</a></button>";
            echo "<form method='post' style='display:inline;'><button class='logout-btn' name='logout' style='color:white;'>Logout</button></form>";
            echo "</div>";
            if (isset($_POST['logout'])) {
                session_destroy();
                header('Location: ../index.php');
                exit();
            }
        } else {
            echo "<div class='profile-header'>";
            echo "<h1>Access Denied</h1>";
            echo "<p>Please log in to view your profile.</p>";
            echo "</div>";
            echo "<button><a href='login.php' style='color: white; text-decoration: none;'>Login Now</a></button>";
        }
    }
    ?>
    </div>


</body>

</html>
