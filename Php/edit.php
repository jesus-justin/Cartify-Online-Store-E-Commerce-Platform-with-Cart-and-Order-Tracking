<?php
include 'db_connect.php';
include 'header.php';

$order = null;

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    // Handle Delete
    if(isset($_POST['delete'])) {
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if($stmt->execute()) {
            header("Location: order_history.php");
            exit();
        }
    }

    // Handle Update
    if(isset($_POST['update'])) {
        $customer_name = $_POST['customer_name'];
        $total = $_POST['total'];
        
        $sql = "UPDATE orders SET customer_name = ?, total = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $customer_name, $total, $id);
        if($stmt->execute()) {
            header("Location: order_history.php");
            exit();
        }
    }

    // Get current order data
    $sql = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
}
?>

<link rel="stylesheet" href="../CSS/order_history.css">
<link rel="stylesheet" href="../CSS/edit.css">

<main id="main-content">
    <h2>Edit Order</h2>
    <div class="edit-form">
        <?php if (!empty($order)): ?>
            <form method="POST">
                <div class="form-group">
                    <label>Customer Name:</label>
                    <input type="text" name="customer_name" value="<?php echo htmlspecialchars($order['customer_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Total Amount:</label>
                    <input type="number" name="total" value="<?php echo htmlspecialchars($order['total'] ?? ''); ?>" step="0.01" required>
                </div>
                <div class="button-group">
                    <button type="submit" name="update" class="btn update-btn">Update Order</button>
                    <button type="submit" name="delete" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this order?')">Delete Order</button>
                    <a href="order_history.php" class="btn">Back</a>
                </div>
            </form>
        <?php else: ?>
            <p class="no-orders">Order not found. Please return to order history.</p>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>
