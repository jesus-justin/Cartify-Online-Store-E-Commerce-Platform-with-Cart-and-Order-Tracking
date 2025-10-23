<?php
include 'Php/db_connect.php';

$sql = "SELECT id, name, description FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Description: " . $row["description"] . "\n";
    }
} else {
    echo "No products found.";
}

$conn->close();
?>
