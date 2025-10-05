<?php
include 'db_connect.php';
include 'header.php';

if (isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $total = $_POST['total'];
    $conn->query("INSERT INTO orders (customer_name, total) VALUES ('$name', $total)");
    $conn->query("DELETE FROM cart");
    echo "<p>✅ Order placed successfully! Thank you, $name.</p>";
}
?>
<link rel="stylesheet" href="../css/checkout.css">

<main>
    <h2>Checkout</h2>
    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" required>
        <?php
        $result = $conn->query("SELECT SUM(p.price * c.quantity) AS total FROM cart c JOIN products p ON c.product_id = p.id");
        $row = $result->fetch_assoc();
        $total = $row['total'] ?? 0;
        ?>
        <p>Total Amount: ₱<?php echo number_format($total, 2); ?></p>
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        <button type="submit" name="place_order">Place Order</button>
    </form>
</main>

<?php include 'footer.php'; ?>
