<?php
include 'db_connect.php';
include 'header.php';
?>
<link rel="stylesheet" href="../CSS/order_history.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<main id="main-content">
    <h2>Manage Orders</h2>
    <div class="manage-container">
        <a href="order_history.php" class="manage-btn back-btn">
            <i class="fas fa-arrow-left"></i> Back to Order History
        </a>
    </div>
    <?php
    $result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
    ?>
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                $order_id = (int) $row['id'];
                echo "<tr>
                        <td>{$order_id}</td>
                        <td>" . htmlspecialchars($row['customer_name']) . "</td>
                        <td>₱" . number_format((float) $row['total'], 2) . "</td>
                        <td>" . htmlspecialchars($row['order_date']) . "</td>
                        <td>
                            <a href='edit.php?id={$order_id}' class='edit-btn'>Edit</a>
                            <form method='post' action='delete_order.php' class='inline-form' onsubmit='return confirm("Are you sure you want to delete this order?")'>
                                <input type='hidden' name='id' value='{$order_id}'>
                                <button type='submit' class='delete-btn'>Delete</button>
                            </form>
                        </td>
                      </tr>";
            }
            ?>
        </table>
    <?php else: ?>
        <p class="no-orders">No orders to manage yet.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
