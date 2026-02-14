<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
}

header('Location: manage_orders.php');
exit();
?>
