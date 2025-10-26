<?php
include 'db_connect.php';
include 'header.php';
?>
<link rel="stylesheet" href="../css/products.css">

<main>
    <h2>Our Products</h2>
    <!-- Search + Sort UI -->
    <form method="get" class="product-filters" style="margin: 10px 0; display:flex; gap:8px; align-items:center;">
        <input type="text" name="q" placeholder="Search products..." value="<?php echo htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES); ?>">
        <select name="sort">
            <option value="" <?php echo empty($_GET['sort']) ? 'selected' : ''; ?>>Sort</option>
            <option value="price_asc"  <?php echo (($_GET['sort'] ?? '')==='price_asc')?'selected':''; ?>>Price: Low to High</option>
            <option value="price_desc" <?php echo (($_GET['sort'] ?? '')==='price_desc')?'selected':''; ?>>Price: High to Low</option>
            <option value="name_asc"   <?php echo (($_GET['sort'] ?? '')==='name_asc')?'selected':''; ?>>Name: A–Z</option>
            <option value="name_desc"  <?php echo (($_GET['sort'] ?? '')==='name_desc')?'selected':''; ?>>Name: Z–A</option>
        </select>
        <button type="submit" class="btn">Apply</button>
        <?php if (!empty($_GET['q']) || !empty($_GET['sort'])): ?>
            <a class="btn" href="?page=1">Reset</a>
        <?php endif; ?>
    </form>

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
                'image' => 'https://www.elryan.com/img/600/600/resize/catalog/product/6/6/665edb37e7f15a0056371a2a5794871w-74987.jpg',
                'description' => 'High-performance graphics card for gaming and GPU-accelerated creative workloads.'
            ],
            'tablet' => [
                'keywords' => ['tablet', 'ipad', 'android tablet'],
                'image' => 'https://zoneofdeals.com/wp-content/uploads/2025/08/lenovo-legion-tab-3.jpg',
                'description' => 'Slim tablet with vivid display — ideal for media consumption, reading, and light productivity.'
            ],
            'vr_headset' => [
                'keywords' => ['vr headset', 'vr', 'virtual reality', 'vr goggles'],
                'image' => 'https://substackcdn.com/image/fetch/$s_!L4Eu!,w_1456,c_limit,f_auto,q_auto:good,fl_progressive:steep/https%3A%2F%2Fsubstack-post-media.s3.amazonaws.com%2Fpublic%2Fimages%2Fca0a6e37-ed11-4feb-b69a-6ee4a570e409_600x600.jpeg',
                'description' => 'Immersive VR headset with wide field of view — perfect for gaming and virtual experiences.'
            ],
            'drone' => [
                'keywords' => ['drone', 'quadrocopter', 'uav'],
                'image' => 'https://discountstore.pk/cdn/shop/files/D97-GPS-Drone-with-8K-UHD-Camera-Foldable-Drones-for-Adults-Beginners-RC-Quadcopter-Drone-Brushless-Motor-VR-Mode-GPS-Auto-Follow_8d720195-da77-4e6b-a55e-093164d85efa.0934a43569cb6cef.webp?v=1735375064',
                'description' => 'Compact camera drone with stabilized flight and aerial photography capabilities.'
            ],
            'smart_home_hub' => [
                'keywords' => ['smart home hub', 'smart hub', 'home hub', 'smart home'],
                'image' => 'https://p.turbosquid.com/ts-thumb/wX/Gfj6eN/mJ/001/jpg/1656681452/600x600/fit_q87/5ffea264948b10fb5bd4e1db33e2e90370895fa6/001.jpg',
                'description' => 'Smart home hub to connect and control lights, locks, and sensors from one place.'
            ],
            'wireless_earbuds' => [
                'keywords' => ['wireless earbuds', 'earbuds', 'tws earbuds'],
                'image' => 'https://www.wellypaudio.com/uploads/Auto-Pairing-Wireless-TWS-Gaming-Earbuds.jpg',
                'description' => 'Wireless earbuds with true wireless stereo technology for seamless audio experience.'
            ],
            'wireless_mouse' => [
                'keywords' => ['wireless mouse', 'mouse', 'wireless'],
                'image' => 'https://shop.tti.com.ph/pub/media/catalog/product/cache/07dc43095bd992476134f3022ceb9abf/h/i/high_resolution_png-g502_lightspeed-gallery-2.png',
                'description' => 'Wireless mouse with ergonomic design and precise tracking for productivity.'
            ],
            'mechanical_keyboard' => [
                'keywords' => ['mechanical keyboard', 'keyboard', 'mechanical'],
                'image' => 'https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_600,h_600/https://fantech.ph/wp-content/uploads/2023/05/b2f71ac7642d4a6ea189317e5d61a37-600x600.jpg',
                'description' => 'Mechanical keyboard with tactile switches and durable build for enhanced typing experience.'
            ],
            'headset' => [
                'keywords' => ['headset', 'headphones', 'earphones'],
                'image' => 'https://m.media-amazon.com/images/I/81o785DXfyL.jpg',
                'description' => 'High-quality headset with immersive sound and comfortable design for music and calls.'
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
            ],
            'phone_case' => [
                'keywords' => ['phone case', 'phonecase', 'case', 'mobile case'],
                'image' => 'https://minibay.in/wp-content/uploads/2025/09/white-58-600x600.jpg',
                'description' => 'Protective phone case featuring a stylish design and shock-absorbent materials.'
            ],
            'bluetooth_speaker' => [
                'keywords' => ['bluetooth speaker', 'speaker', 'bluetooth'],
                'image' => 'https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_600,h_600/https://fantech.ph/wp-content/uploads/2022/01/clipboard_image_ad76f34ab15a3563-600x600.png',
                'description' => 'Portable Bluetooth speaker with high-quality sound and wireless connectivity.'
            ]
        ];

        // Search and sort (whitelisted + escaped)
        $q = isset($_GET['q']) ? trim($_GET['q']) : '';
        $sort = isset($_GET['sort']) ? trim($_GET['sort']) : '';
        $q_esc = $conn->real_escape_string($q);
        $where = $q !== '' ? "WHERE name LIKE '%$q_esc%' OR description LIKE '%$q_esc%'" : '';

        $allowedSort = ['price_asc','price_desc','name_asc','name_desc'];
        if (!in_array($sort, $allowedSort)) { $sort = ''; }
        switch ($sort) {
            case 'price_asc':  $order = 'ORDER BY price ASC'; break;
            case 'price_desc': $order = 'ORDER BY price DESC'; break;
            case 'name_asc':   $order = 'ORDER BY name ASC'; break;
            case 'name_desc':  $order = 'ORDER BY name DESC'; break;
            default:           $order = 'ORDER BY id ASC';
        }

        // Pagination logic (unchanged)
        $limit = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Get total products count (with filter)
        $total_sql = "SELECT COUNT(*) as total FROM products $where";
        $total_result = $conn->query($total_sql);
        $total_row = $total_result->fetch_assoc();
        $total_products = $total_row['total'];
        $total_pages = ceil($total_products / $limit);

        $sql = "SELECT * FROM products $where $order LIMIT $limit OFFSET $offset";
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
                <img src='" . htmlspecialchars($img_src, ENT_QUOTES) . "'
                     onerror=\"this.onerror=null;this.src='https://via.placeholder.com/800x600?text=No+Image'\"
                     alt=\"" . htmlspecialchars($name, ENT_QUOTES) . "\">
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
        // Preserve query across pagination
        $qs = (!empty($q) || !empty($sort)) ? ('&q=' . urlencode($q) . '&sort=' . urlencode($sort)) : '';

        if ($total_pages > 1) {
            // Previous button
            if ($page > 1) {
                echo "<a href='?page=" . ($page - 1) . $qs . "' class='btn'>Previous</a>";
            }

            // Page numbers
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? 'active' : '';
                echo "<a href='?page=$i" . $qs . "' class='btn $active'>$i</a>";
            }

            // Next button
            if ($page < $total_pages) {
                echo "<a href='?page=" . ($page + 1) . $qs . "' class='btn'>Next</a>";
            }
        }
        ?>
    </div>
</main>

<?php include 'footer.php'; ?>
