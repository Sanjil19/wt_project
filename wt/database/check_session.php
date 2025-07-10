<?php
session_start();

echo "Session Debug Information:\n";
echo "========================\n";

if (isset($_SESSION['user_id'])) {
    echo "✓ User is logged in\n";
    echo "User ID: " . $_SESSION['user_id'] . "\n";
    echo "Username: " . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Not set') . "\n";
    echo "Email: " . (isset($_SESSION['email']) ? $_SESSION['email'] : 'Not set') . "\n";
} else {
    echo "✗ User is NOT logged in\n";
    echo "Please log in first before attempting checkout\n";
}

echo "\nAll session data:\n";
print_r($_SESSION);
?>
