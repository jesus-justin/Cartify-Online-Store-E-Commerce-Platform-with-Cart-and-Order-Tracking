<?php
include 'db_connect.php';
include 'header.php';
?>
<link rel="stylesheet" href="../css/products.css">

<main>
    <h2>Our Products</h2>
    <div class="product-grid">
        <?php
        $image_urls = array(
            1 => 'https://images.unsplash.com/photo-1527814050087-3793815479db?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            2 => 'https://images.unsplash.com/photo-1541140532154-b024d705b90a?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            3 => 'https://images.unsplash.com/photo-1599669454699-248893623440?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            4 => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            5 => 'https://images.unsplash.com/photo-1601593346740-925612772716?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            6 => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            7 => 'https://down-ph.img.susercontent.com/file/sg-11134201-22100-xxxfh5cjm4ivf8',
            8 => 'https://5.imimg.com/data5/SELLER/Default/2022/12/GV/GU/OL/55907991/aluminum-laptop-stand-360-degree-rotatable-height-adjustable-for-all-laptops-up-to-16-inches--500x500.png'
        );

        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
            echo "
            <div class='product-card'>
                <img src='{$image_urls[$row['id']]}' alt='{$row['name']}'>
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
