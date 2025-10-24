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
            1 => 'https://images.unsplash.com/photo-1527814050087-3793815479db?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            2 => 'https://images.unsplash.com/photo-1541140532154-b024d705b90a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            3 => 'https://images.unsplash.com/photo-1599669454699-248893623440?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            4 => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            5 => 'https://images.unsplash.com/photo-1601593346740-925612772716?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            6 => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            7 => 'https://images.unsplash.com/photo-1580894894514-7c6c0dca0cc9?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            8 => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            9 => 'https://images.unsplash.com/photo-1544117519-31a4b719223d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            10 => 'https://images.unsplash.com/photo-1600003014755-ba31aa59c4b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            11 => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            12 => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            13 => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            14 => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            15 => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            16 => 'https://images.unsplash.com/photo-1593640495253-23196b27a87f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            17 => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            18 => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            19 => 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            20 => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
        );

        // overrides keyed by a stable key; each entry has keywords (synonyms) for partial matching
        $overrides = [
            'external_hdd' => [
                'keywords' => ['external hard drive', 'external hdd', 'portable hdd', 'external drive'],
                'image' => 'https://i.ebayimg.com/images/g/MvcAAOSwA8Bj2jEa/s-l400.jpg',
                'description' => 'Portable external hard drive — USB 3.0 / USB‑C, reliable storage for backups and large files.'
            ],
            'webcam' => [
                'keywords' => ['webcam', 'camera webcam', 'usb webcam'],
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvS2dVhQsRkx7cgVRCqjh1QVEjrOm89yDDvQ&s',
                'description' => '1080p HD webcam with built-in mic — optimized for video calls and live streaming.'
            ],
            'router' => [
                'keywords' => ['router', 'wi-fi router', 'wifi router', 'modem router'],
                'image' => 'https://ecommerce.datablitz.com.ph/cdn/shop/files/efasdfdsv_800x.jpg?v=1694485683',
                'description' => 'Dual-band Wi‑Fi router delivering stable range and high throughput for home networks.'
            ],
            'powerbank' => [
                'keywords' => ['powerbank', 'power bank', 'portable charger'],
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_IzI4uq4LVRcxwubIig5RmtDwCriWPYEtmQ&s',
                'description' => 'High-capacity power bank with fast-charge support for phones and tablets on the go.'
            ],
            'microphone' => [
                'keywords' => ['microphone', 'mic', 'condensor microphone', 'condenser microphone'],
                'image' => 'https://i5.walmartimages.com/seo/TONOR-Gaming-Mic-USB-Microphone-for-PC-PS4-5-Cardioid-Condenser-Mic-with-Adjustable-RGB-Modes_a6e768d6-f3d4-4cc9-9c27-cd8de7392c2a.35ff669717fcf714537b7a5b068b684b.jpeg',
                'description' => 'Condenser microphone — clear voice capture for streaming, podcasting, and calls.'
            ],
            'graphics_card' => [
                'keywords' => ['graphics card', 'gpu', 'video card'],
                'image' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'High-performance graphics card for gaming and GPU-accelerated creative workloads.'
            ],
            'tablet' => [
                'keywords' => ['tablet', 'ipad', 'android tablet'],
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'Slim tablet with vivid display — ideal for media consumption, reading, and light productivity.'
            ],
            'vr_headset' => [
                'keywords' => ['vr headset', 'vr', 'virtual reality', 'vr goggles'],
                'image' => 'https://images.unsplash.com/photo-1585386959984-a415522f3ef3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'Immersive VR headset with wide field of view — perfect for gaming and virtual experiences.'
            ],
            'drone' => [
                'keywords' => ['drone', 'quadrocopter', 'uav'],
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'Compact camera drone with stabilized flight and aerial photography capabilities.'
            ],
            'smart_home_hub' => [
                'keywords' => ['smart home hub', 'smart hub', 'home hub', 'smart home'],
                'image' => 'https://images.unsplash.com/photo-1580894894514-7c6c0dca0cc9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => 'Smart home hub to connect and control lights, locks, and sensors from one place.'
            ],
            'usb_charger' => [
                'keywords' => ['usb charger', 'charger'],
                'image' => 'https://alexnld.com/wp-content/uploads/2022/02/1f8dc3a2-d3b3-4a77-8985-554c6402ae79.jpg',
                'description' => 'Dual-port USB charger with 20W USB-C PD and USB-A QC3.0 support for fast charging.'
            ],
            'laptop_stand' => [
                'keywords' => ['laptop stand', 'stand'],
                'image' => 'https://www.syntech.co.za/wp-content/uploads/2021/01/RD-GCP500_wr_04-1-600x600.jpg',
                'description' => 'Adjustable laptop stand for ergonomic viewing and cooling.'
            ],
            'smart_watch' => [
                'keywords' => ['smart watch', 'smartwatch'],
                'image' => 'https://ph.garmin.com/m/ph/g/products/forerunner965.jpg',
                'description' => 'Smartwatch with fitness tracking, notifications, and health monitoring features.'
            ]
        ];

        // Pagination logic (unchanged)
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
        while($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $name_lc = strtolower(trim($name));
            $img_src = $image_urls[$row['id']] ?? 'https://via.placeholder.com/800x600?text=No+Image';
            $desc = $row['description'] ?? '';

            // robust matching: check override keywords (partial, case-insensitive)
            foreach ($overrides as $ov) {
                foreach ($ov['keywords'] as $kw) {
                    if (stripos($name_lc, strtolower($kw)) !== false) {
                        $img_src = $ov['image'];
                        $desc = $ov['description'];
                        break 2;
                    }
                }
            }

            // output card (unchanged structure)
            echo "
            <div class='product-card'>
                <img src='" . htmlspecialchars($img_src, ENT_QUOTES) . "' alt=\"" . htmlspecialchars($name, ENT_QUOTES) . "\">
                <h3>" . htmlspecialchars($name) . "</h3>
                <p>" . htmlspecialchars($desc) . "</p>
                <p><strong>₱" . number_format((float)$row['price'], 2) . "</strong></p>
                <form method='post' action='cart.php'>
                    <input type='hidden' name='product_id' value='" . htmlspecialchars($row['id']) . "'>
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
