<?php
include 'db_connect.php';
include 'header.php';
?>
<link rel="stylesheet" href="../css/order_history.css">

<main>
    <h2>Manage Orders</h2>
    <div class="manage-container">
        <a href="order_history.php" class="manage-btn">Back to Order History</a>
    </div>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['customer_name']}</td>
                    <td>₱{$row['total']}</td>
                    <td>{$row['order_date']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}' class='edit-btn'>Edit</a>
                        <a href='delete_order.php?id={$row['id']}' class='delete-btn' 
                           onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</main>

<?php include 'footer.php'; ?>
