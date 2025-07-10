<?php
// Test database connection and tables
include 'dbconnect.php';

echo "Testing database connection...\n";

if ($conn) {
    echo "✓ Database connection successful\n";
    
    // Check if tables exist
    $tables = ['users', 'orders', 'order_items', 'products'];
    
    foreach ($tables as $table) {
        $result = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
        if (mysqli_num_rows($result) > 0) {
            echo "✓ Table '$table' exists\n";
        } else {
            echo "✗ Table '$table' does not exist\n";
        }
    }
    
    // Test if we can create a simple order (if user exists)
    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM users");
    $row = mysqli_fetch_assoc($result);
    
    if ($row['count'] > 0) {
        echo "✓ Users table has data (" . $row['count'] . " users)\n";
    } else {
        echo "! Users table is empty - you may need to register first\n";
    }
    
} else {
    echo "✗ Database connection failed\n";
}
?>
