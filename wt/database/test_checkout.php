<?php
// Test checkout functionality
session_start();
include '../database/dbconnect.php';

// Simulate a logged-in user (you'll need to replace this with actual user ID)
$_SESSION['user_id'] = 1; // Replace with actual user ID

// Simulate cart data
$test_cart = [
    [
        'id' => 'laptop1',
        'name' => 'Test Laptop',
        'price' => 999.99,
        'qty' => 1
    ],
    [
        'id' => 'laptop2', 
        'name' => 'Another Laptop',
        'price' => 1299.99,
        'qty' => 2
    ]
];

// Test the checkout process
$user_id = $_SESSION['user_id'];
$cart = $test_cart;
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['qty'];
}

echo "Testing checkout process...\n";
echo "User ID: $user_id\n";
echo "Cart items: " . count($cart) . "\n";
echo "Total: $" . number_format($total, 2) . "\n";

// Add order using prepared statements
$sql = "INSERT INTO orders (user_id, total) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    echo "✗ Failed to prepare order statement: " . mysqli_error($conn) . "\n";
    exit();
}

mysqli_stmt_bind_param($stmt, "id", $user_id, $total);

if (mysqli_stmt_execute($stmt)) {
    $order_id = mysqli_insert_id($conn);
    echo "✓ Order created with ID: $order_id\n";
    
    // Insert order items
    $sql_item = "INSERT INTO order_items (order_id, product_id, product_name, price, quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt_item = mysqli_prepare($conn, $sql_item);
    
    if (!$stmt_item) {
        echo "✗ Failed to prepare order_items statement: " . mysqli_error($conn) . "\n";
        exit();
    }
    
    $success = true;
    foreach ($cart as $item) {
        $pid = $item['id'];
        $pname = $item['name'];
        $pprice = $item['price'];
        $pqty = $item['qty'];
        
        mysqli_stmt_bind_param($stmt_item, "issdi", $order_id, $pid, $pname, $pprice, $pqty);
        
        if (mysqli_stmt_execute($stmt_item)) {
            echo "✓ Added item: $pname\n";
        } else {
            echo "✗ Failed to add item: $pname - " . mysqli_error($conn) . "\n";
            $success = false;
        }
    }
    
    mysqli_stmt_close($stmt_item);
    
    if ($success) {
        echo "✓ Test checkout completed successfully!\n";
    } else {
        echo "✗ Some items failed to save\n";
    }
} else {
    echo "✗ Failed to create order: " . mysqli_error($conn) . "\n";
}

mysqli_stmt_close($stmt);
?>
