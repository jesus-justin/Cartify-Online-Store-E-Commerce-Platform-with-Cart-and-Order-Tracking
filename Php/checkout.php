<?php
include 'db_connect.php';
include 'header.php';

$success_message = '';
$error_message = '';
$name_value = '';

if (isset($_POST['place_order'])) {
    $name = trim($_POST['name'] ?? '');
    $name_value = $name;

    if ($name === '') {
        $error_message = 'Please enter your name to place an order.';
    } else {
        $total_result = $conn->query("SELECT SUM(p.price * c.quantity) AS total FROM cart c JOIN products p ON c.product_id = p.id");
        $total_row = $total_result ? $total_result->fetch_assoc() : null;
        $total = (float) ($total_row['total'] ?? 0);

        if ($total <= 0) {
            $error_message = 'Your cart is empty. Add items before checking out.';
        } else {
            $stmt = $conn->prepare("INSERT INTO orders (customer_name, total) VALUES (?, ?)");
            $stmt->bind_param('sd', $name, $total);
            $stmt->execute();
            $conn->query("DELETE FROM cart");
            $success_message = 'Order placed successfully! Thank you, ' . htmlspecialchars($name) . '.';
        }
    }
}
?>
<link rel="stylesheet" href="../CSS/checkout.css">

<main id="main-content">
    <h2>Checkout</h2>
    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name_value, ENT_QUOTES); ?>" required>
        <?php
        $result = $conn->query("SELECT SUM(p.price * c.quantity) AS total FROM cart c JOIN products p ON c.product_id = p.id");
        $row = $result ? $result->fetch_assoc() : null;
        $total = (float) ($row['total'] ?? 0);
        ?>
        <p>Total Amount: ₱<?php echo number_format($total, 2); ?></p>
        <?php if ($total <= 0): ?>
            <p class="empty-cart-note">Your cart has no items yet.</p>
        <?php endif; ?>
        <button type="submit" name="place_order" class="btn" <?php echo $total <= 0 ? 'disabled' : ''; ?>>Place Order</button>
        <div class="form-messages" role="status" aria-live="polite">
            <?php if ($success_message !== ''): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <?php if ($error_message !== ''): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </form>
</main>

<?php include 'footer.php'; ?>
