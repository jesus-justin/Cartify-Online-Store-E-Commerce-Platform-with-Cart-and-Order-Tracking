<?php
include 'db_connect.php';
include 'header.php';
?>
<link rel="stylesheet" href="../css/order_history.css">

<main>
    <h2>Order History</h2>
    <table>
        <tr><th>Order ID</th><th>Customer</th><th>Total</th><th>Date</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['customer_name']}</td>
                    <td>₱{$row['total']}</td>
                    <td>{$row['order_date']}</td>
                  </tr>";
        }
        ?>
    </table>
</main>

<?php include 'footer.php'; ?>
