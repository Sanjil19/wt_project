<?php
session_start();
include '../database/dbconnect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['cart']) || !is_array($data['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid cart data']);
    exit();
}

$cart = $data['cart'];
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['qty'];
}

// Add order
$sql = "INSERT INTO orders (user_id, total) VALUES ($user_id, $total)";
if (mysqli_query($conn, $sql)) {
    $order_id = mysqli_insert_id($conn);
    foreach ($cart as $item) {
        $pid = mysqli_real_escape_string($conn, $item['id']);
        $pname = mysqli_real_escape_string($conn, $item['name']);
        $pprice = floatval($item['price']);
        $pqty = intval($item['qty']);
        $sql_item = "INSERT INTO order_items (order_id, product_id, product_name, price, quantity) VALUES ($order_id, '$pid', '$pname', $pprice, $pqty)";
        mysqli_query($conn, $sql_item);
    }
    echo json_encode(['success' => true, 'message' => 'Order done!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Order not saved.']);
}
?>
