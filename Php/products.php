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
            8 => 'https://5.imimg.com/data5/SELLER/Default/2022/12/GV/GU/OL/55907991/aluminum-laptop-stand-360-degree-rotatable-height-adjustable-for-all-laptops-up-to-16-inches--500x500.png',
            9 => 'https://images.unsplash.com/photo-1544117519-31a4b719223d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            10 => 'https://images.unsplash.com/photo-1600003014755-ba31aa59c4b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            11 => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            12 => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            13 => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            14 => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            15 => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            16 => 'https://images.unsplash.com/photo-1593640495253-23196b27a87f?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            17 => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            18 => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            19 => 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            20 => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200',
            'external_drive' => 'https://www.westerndigital.com/content/dam/store/en-us/assets/products/portable/wd-my-passport/gallery/my-passport-2019-blue.png',
            'webcam' => 'https://resource.logitech.com/content/dam/logitech/en/products/webcams/c920/gallery/c920-gallery-1.png',
            'router' => 'https://dlcdnwebimgs.asus.com/gain/36E03309-3E91-4F44-9B1F-73F1E591D1BB/w1000/h732',
            'powerbank' => 'https://anker.com/cdn/shop/products/A1287_TD01_V1_ecc0d558-9452-41a3-a620-f53c89dilocked_800x.png',
            'microphone' => 'https://www.bluemic.com/cdn/shop/products/yeti_color_midnight_blue_2400x2400.png',
            'graphics_card' => 'https://dlcdnwebimgs.asus.com/gain/8E667465-B207-4EE4-B475-A891594C5FC2/w1000/h732',
            'tablet' => 'https://images.samsung.com/is/image/samsung/p6pim/levant/sm-x710nzaameb/gallery/levant-galaxy-tab-s8-wifi-x710-sm-x710nzaameb-thumb-531512124',
            'vr_headset' => 'https://www.meta.com/quest/static/img/quest-3/quest-3.png',
            'drone' => 'https://dji-official-fe.djicdn.com/dps/0b4cef970fbbd9b4402f6ef0d5e8f584.png',
            'smart_hub' => 'https://images.samsung.com/is/image/samsung/p6pim/uk/gp-u999gtveecf/gallery/uk-smartthings-station-gp-u999gtveecf-thumb-535921197'
        );

        // Pagination logic
        $limit = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Get total products count
        $total_sql = "SELECT COUNT(*) as total FROM products";
        $total_result = $conn->query($total_sql);
        $total_row = $total_result->fetch_assoc();
        $total_products = $total_row['total'];
        $total_pages = ceil($total_products / $limit);

        $sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";
        $result = $conn->query($sql);

        $displayed = 0;
        $product_descriptions = array(
            'external_drive' => 'High-speed 2TB portable storage solution with USB 3.0, perfect for backups',
            'webcam' => 'Full HD 1080p webcam with auto-focus and low-light correction',
            'router' => 'Dual-band WiFi 6 router with AI protection and gaming optimization',
            'powerbank' => '26800mAh high-capacity power bank with fast charging support',
            'microphone' => 'Professional USB condenser microphone with multiple pattern selection',
            'graphics_card' => 'RTX 4070 8GB GDDR6X gaming graphics card with ray tracing',
            'tablet' => '11-inch tablet with 128GB storage and S Pen support',
            'vr_headset' => 'Advanced VR headset with 4K display and wireless connectivity',
            'drone' => '4K camera drone with 3-axis gimbal and 30-minute flight time',
            'smart_hub' => 'Smart home control center with voice assistant compatibility'
        );

        while($row = $result->fetch_assoc()) {
            $image_url = isset($image_urls[$row['id']]) ? $image_urls[$row['id']] : $image_urls['default'];
            $description = isset($product_descriptions[$row['id']]) ? $product_descriptions[$row['id']] : $row['description'];
            
            echo "
            <div class='product-card'>
                <img src='{$image_url}' alt='{$row['name']}'>
                <h3>{$row['name']}</h3>
                <p>{$description}</p>
                <p><strong>₱{$row['price']}</strong></p>
                <form method='post' action='cart.php'>
                    <input type='hidden' name='product_id' value='{$row['id']}'>
                    <button type='submit' name='add_to_cart'>Add to Cart</button>
                </form>
            </div>";
            $displayed++;
        }

        // Add empty cards to maintain 2x3 grid balance
        for ($i = $displayed; $i < 6; $i++) {
            echo "<div class='product-card empty'></div>";
        }
        ?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php
        if ($total_pages > 1) {
            // Previous button
            if ($page > 1) {
                echo "<a href='?page=" . ($page - 1) . "' class='btn'>Previous</a>";
            }

            // Page numbers
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? 'active' : '';
                echo "<a href='?page=$i' class='btn $active'>$i</a>";
            }

            // Next button
            if ($page < $total_pages) {
                echo "<a href='?page=" . ($page + 1) . "' class='btn'>Next</a>";
            }
        }
        ?>
    </div>
</main>

<?php include 'footer.php'; ?>
