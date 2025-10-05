<?php
include('../includes/db_connect.php');
include('../includes/header.php');

$result = $conn->query("SELECT * FROM orders ORDER BY order_id DESC");
?>

<h2>Your Orders</h2>
<table>
<tr><th>Order ID</th><th>Total Amount</th><th>Date</th><th>Status</th></tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
  <td>#<?php echo $row['order_id']; ?></td>
  <td>₱<?php echo number_format($row['total_amount'], 2); ?></td>
  <td><?php echo $row['order_date']; ?></td>
  <td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>
</table>

<?php include('../includes/footer.php'); ?>
