<?php



session_start();
include '../database/dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = intval($_SESSION['user_id']); // Convert to integer

$orders = array();
$order_items = array();

// Get orders for this user
$sql = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
} else {
    echo '<div style="color:red;">Could not get orders: ' . mysqli_error($conn) . '</div>';
}

// Get order items for each order
foreach ($orders as $order) {
    $oid = intval($order['id']);
    $item_sql = "SELECT * FROM order_items WHERE order_id = $oid";
    $item_result = mysqli_query($conn, $item_sql);
    if ($item_result) {
        while ($item_row = mysqli_fetch_assoc($item_result)) {
            $order_items[$oid][] = $item_row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order History - E-Tech</title>
  <link rel="stylesheet" href="../styles/styles.css" />
  <link rel="stylesheet" href="../styles/navbar-footer.css" />
  <link rel="stylesheet" href="../styles/orders.css" />
  <link rel="stylesheet" href="../styles/cart.css" />
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
  <?php include '../parts/navbar.php'; ?>
  <main class="container">
    <h2 class="section-title">Your Orders</h2>
    <?php if (empty($orders)): ?>
      <p style="text-align:center; color:#888;">You have no orders yet.</p>
    <?php else: ?>
      <?php foreach ($orders as $order): ?>
        <div class="order-card" style="background:#fff;box-shadow:0 2px 8px #eee;padding:20px;margin-bottom:30px;border-radius:8px;">
          <div class="order-header" style="margin-bottom:16px; padding-bottom:8px; border-bottom:1px solid #eee; font-size:1.08em; color:#222; font-weight:500;">
            Order Number: <?php echo $order['id']; ?>
            <span style="color:#bbb; margin:0 10px;">|</span>
            By: <span style="color:#333; font-weight:600;"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
          </div>
          <table style="width:100%;border-collapse:collapse;">
            <thead>
              <tr style="background:#f8f8f8;">
                <th style="padding:8px 4px;text-align:left;">Product</th>
                <th style="padding:8px 4px;text-align:right;">Price</th>
                <th style="padding:8px 4px;text-align:right;">Qty</th>
                <th style="padding:8px 4px;text-align:right;">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($order_items[$order['id']])): ?>
              <?php if (!empty($order_items[$order['id']])): ?>
                <?php foreach ($order_items[$order['id']] as $item): ?>
                  <tr>
                    <td style="padding:6px 4px;"> <?php echo htmlspecialchars($item['product_name']); ?> </td>
                    <td style="padding:6px 4px;text-align:right;">$<?php echo number_format($item['price'],2); ?></td>
                    <td style="padding:6px 4px;text-align:right;"> <?php echo $item['quantity']; ?> </td>
                    <td style="padding:6px 4px;text-align:right;">$<?php echo number_format($item['price'] * $item['quantity'],2); ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="4" style="text-align:center;color:#aaa;">No items found for this order.</td></tr>
              <?php endif; ?>
              <?php else: ?>
                <tr>
                  <td colspan="4" style="text-align:center;color:#888;padding:10px;">No items for this order.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </main>
  <!-- <?php // include '../parts/footer.php'; ?> -->
</body>
</html>
