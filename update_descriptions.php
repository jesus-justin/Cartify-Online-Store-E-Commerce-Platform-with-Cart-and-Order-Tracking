<?php
include 'Php/db_connect.php';
include 'Php/product_helpers.php';

$overrides = get_product_overrides();

// Fetch all products
$sql = "SELECT id, name, description FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = strtolower(trim($row['name']));
        $current_desc = $row['description'];

        $new_desc = $current_desc; // Default to current

        // Check for matches
        foreach ($overrides as $ov) {
            foreach ($ov['keywords'] as $kw) {
                if (stripos($name, strtolower($kw)) !== false) {
                    $new_desc = $ov['description'];
                    break 2;
                }
            }
        }

        // Update if description changed
        if ($new_desc !== $current_desc) {
            $update_sql = "UPDATE products SET description = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("si", $new_desc, $id);
            $stmt->execute();
            $stmt->close();
            echo "Updated product ID $id: $row[name] - New description: $new_desc\n";
        }
    }
} else {
    echo "No products found.\n";
}

$conn->close();
echo "Description updates completed.\n";
?>
