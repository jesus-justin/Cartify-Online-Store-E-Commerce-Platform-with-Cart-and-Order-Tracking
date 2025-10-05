<?php
include('../includes/db_connect.php');
include('../includes/header.php');

$result = $conn->query("SELECT * FROM products");
?>

<h2 class="title">All Products</h2>
<div class="product-container">
<?php while($row = $result->fetch_assoc()) { ?>
  <div class="product-card">
    <img src="../assets/images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
    <h3><?php echo $row['name']; ?></h3>
    <p><?php echo $row['description']; ?></p>
    <p><strong>₱<?php echo number_format($row['price'], 2); ?></strong></p>
    <a href="cart.php?action=add&id=<?php echo $row['product_id']; ?>" class="btn">Add to Cart</a>
  </div>
<?php } ?>
</div>

<?php include('../includes/footer.php'); ?>
