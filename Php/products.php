<?php
include 'db_connect.php';
include 'header.php';
?>
<link rel="stylesheet" href="../css/products.css">

<main>
    <h2>Our Products</h2>
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
            echo "
            <div class='product-card'>
                <img src='../images/{$row['image']}' alt='{$row['name']}'>
                <h3>{$row['name']}</h3>
                <p>{$row['description']}</p>
                <p><strong>₱{$row['price']}</strong></p>
                <form method='post' action='cart.php'>
                    <input type='hidden' name='product_id' value='{$row['id']}'>
                    <button type='submit' name='add_to_cart'>Add to Cart</button>
                </form>
            </div>";
        }
        ?>
    </div>
</main>

<?php include 'footer.php'; ?>
