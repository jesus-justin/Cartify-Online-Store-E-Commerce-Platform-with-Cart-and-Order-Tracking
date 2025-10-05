<?php
include('../includes/db_connect.php');
include('../includes/header.php');
session_start();

if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }

if (isset($_GET['action']) && $_GET['action'] == 'add') {
  $id = $_GET['id'];
  if (!isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id] = 1;
  else $_SESSION['cart'][$id]++;
}

if (isset($_GET['action']) && $_GET['action'] == 'remove') {
  $id = $_GET['id'];
  unset($_SESSION['cart'][$id]);
}

$total = 0;
echo "<h2>Your Cart</h2>";
if (empty($_SESSION['cart'])) {
  echo "<p>Your cart is empty.</p>";
} else {
  echo "<table><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th><th>Action</th></tr>";
  foreach ($_SESSION['cart'] as $id => $qty) {
    $result = $conn->query("SELECT * FROM products WHERE product_id=$id");
    $row = $result->fetch_assoc();
    $subtotal = $row['price'] * $qty;
    $total += $subtotal;
    echo "<tr>
      <td>{$row['name']}</td>
      <td>₱" . number_format($row['price'],2) . "</td>
      <td>$qty</td>
      <td>₱" . number_format($subtotal,2) . "</td>
      <td><a href='cart.php?action=remove&id=$id' class='btn'>Remove</a></td>
    </tr>";
  }
  echo "</table>";
  echo "<h3>Total: ₱" . number_format($total,2) . "</h3>";
  echo "<a href='checkout.php?total=$total' class='btn'>Proceed to Checkout</a>";
}

include('../includes/footer.php');
?>
