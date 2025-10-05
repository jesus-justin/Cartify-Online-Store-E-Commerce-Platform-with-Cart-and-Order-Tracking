<?php
include 'db_connect.php';
include 'header.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $conn->query("INSERT INTO cart (product_id, quantity) VALUES ($product_id, 1)");
}
?>
<link rel="stylesheet" href="../css/cart.css">

<main>
    <h2>Your Shopping Cart</h2>
    <table>
        <tr><th>Product</th><th>Price</th><th>Quantity</th></tr>
        <?php
        $sql = "SELECT p.name, p.price, c.quantity 
                FROM cart c JOIN products p ON c.product_id = p.id";
        $result = $conn->query($sql);
        $total = 0;

        while($row = $result->fetch_assoc()) {
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>₱{$row['price']}</td>
                    <td>{$row['quantity']}</td>
                  </tr>";
        }
        ?>
    </table>
    <h3>Total: ₱<?php echo number_format($total, 2); ?></h3>
    <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
</main>

<?php include 'footer.php'; ?>
