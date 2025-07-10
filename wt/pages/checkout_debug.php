<?php
session_start();
include '../database/dbconnect.php';

// Add debug logging
error_log("Checkout attempt started at " . date('Y-m-d H:i:s'));

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    error_log("Checkout failed: User not logged in");
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
error_log("Checkout for user ID: " . $user_id);

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['cart']) || !is_array($data['cart'])) {
    error_log("Checkout failed: Invalid cart data - " . print_r($data, true));
    echo json_encode(['success' => false, 'message' => 'Invalid cart data']);
    exit();
}

$cart = $data['cart'];
error_log("Cart items: " . count($cart));

$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['qty'];
}
error_log("Total amount: " . $total);

// Add order using prepared statements for security
$sql = "INSERT INTO orders (user_id, total) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    $error_msg = 'Database error: ' . mysqli_error($conn);
    error_log("Checkout failed: " . $error_msg);
    echo json_encode(['success' => false, 'message' => $error_msg]);
    exit();
}

mysqli_stmt_bind_param($stmt, "id", $user_id, $total);

if (mysqli_stmt_execute($stmt)) {
    $order_id = mysqli_insert_id($conn);
    error_log("Order created with ID: " . $order_id);
    
    // Insert order items
    $sql_item = "INSERT INTO order_items (order_id, product_id, product_name, price, quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt_item = mysqli_prepare($conn, $sql_item);
    
    if (!$stmt_item) {
        $error_msg = 'Database error: ' . mysqli_error($conn);
        error_log("Checkout failed: " . $error_msg);
        echo json_encode(['success' => false, 'message' => $error_msg]);
        exit();
    }
    
    $success = true;
    foreach ($cart as $item) {
        $pid = $item['id'];
        $pname = mysqli_real_escape_string($conn, $item['name']);
        $pprice = $item['price'];
        $pqty = $item['qty'];
        
        mysqli_stmt_bind_param($stmt_item, "issdi", $order_id, $pid, $pname, $pprice, $pqty);
        
        if (!mysqli_stmt_execute($stmt_item)) {
            error_log("Failed to insert order item: " . $pname . " - " . mysqli_error($conn));
            $success = false;
            break;
        } else {
            error_log("Added order item: " . $pname);
        }
    }
    
    mysqli_stmt_close($stmt_item);
    
    if ($success) {
        error_log("Checkout completed successfully for order ID: " . $order_id);
        echo json_encode(['success' => true, 'message' => 'Order placed successfully!']);
    } else {
        error_log("Checkout failed: Error saving order items");
        echo json_encode(['success' => false, 'message' => 'Error saving order items: ' . mysqli_error($conn)]);
    }
} else {
    $error_msg = 'Order not saved: ' . mysqli_error($conn);
    error_log("Checkout failed: " . $error_msg);
    echo json_encode(['success' => false, 'message' => $error_msg]);
}

mysqli_stmt_close($stmt);
?>
