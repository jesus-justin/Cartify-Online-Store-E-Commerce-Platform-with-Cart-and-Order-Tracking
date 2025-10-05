<?php
include('../includes/db_connect.php');
include('../includes/header.php');
session_start();

if (isset($_POST['checkout'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $total = $_POST['total'];

  $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '')");
  $user_id = $conn->insert_id;

  $conn->query("INSERT INTO orders (user_id, total_amount) VALUES ($user_id, $total)");
  $order_id = $conn->insert_id;

  $_SESSION['cart'] = [];
  echo "<h2>Thank you for your purchase!</h2><p>Your order ID: #$order_id</p>";
} else {
?>
<h2>Checkout</h2>
<form method="POST">
  <label>Name:</label>
  <input type="text" name="name" required>
  <label>Email:</label>
  <input type="email" name="email" required>
  <input type="hidden" name="total" value="<?php echo $_GET['total'] ?? 0; ?>">
  <button type="submit" name="checkout" class="btn">Place Order</button>
</form>
<?php } ?>

<?php include('../includes/footer.php'); ?>
