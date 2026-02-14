<?php
include 'db_connect.php';
include 'header.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;

    if ($product_id > 0) {
        $check_stmt = $conn->prepare("SELECT quantity FROM cart WHERE product_id = ?");
        $check_stmt->bind_param('i', $product_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result && $check_result->num_rows > 0) {
            $update_stmt = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE product_id = ?");
            $update_stmt->bind_param('i', $product_id);
            $update_stmt->execute();
        } else {
            $insert_stmt = $conn->prepare("INSERT INTO cart (product_id, quantity) VALUES (?, 1)");
            $insert_stmt->bind_param('i', $product_id);
            $insert_stmt->execute();
        }
    }
}
?>
<link rel="stylesheet" href="../CSS/cart.css">

<main>
    <h2>Your Shopping Cart</h2>
    <?php
    $sql = "SELECT p.name, p.price, c.quantity 
            FROM cart c JOIN products p ON c.product_id = p.id";
    $result = $conn->query($sql);
    $total = 0;
    ?>

    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr><th>Product</th><th>Price</th><th>Quantity</th></tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
                echo "<tr>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>₱" . number_format((float) $row['price'], 2) . "</td>
                        <td>" . (int) $row['quantity'] . "</td>
                      </tr>";
            }
            ?>
        </table>
        <h3>Total: ₱<?php echo number_format($total, 2); ?></h3>
        <a href="checkout.php" class="checkout-btn btn">Proceed to Checkout</a>
    <?php else: ?>
        <p class="empty-cart">Your cart is empty. Add products to get started.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
