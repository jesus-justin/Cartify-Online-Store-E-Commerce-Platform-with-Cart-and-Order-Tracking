<?php
include 'db_connect.php';
include 'header.php';
?>
<link rel="stylesheet" href="../CSS/order_history.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<main id="main-content">
    <h2>Order History</h2>
    <div class="manage-container">
        <a href="manage_orders.php" class="manage-btn">
            <i class="fas fa-cog"></i> Manage Orders
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
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . (int) $row['id'] . "</td>
                        <td>" . htmlspecialchars($row['customer_name']) . "</td>
                        <td>₱" . number_format((float) $row['total'], 2) . "</td>
                        <td>" . htmlspecialchars($row['order_date']) . "</td>
                      </tr>";
            }
            ?>
        </table>
    <?php else: ?>
        <p class="no-orders">No orders yet. New purchases will show up here.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
