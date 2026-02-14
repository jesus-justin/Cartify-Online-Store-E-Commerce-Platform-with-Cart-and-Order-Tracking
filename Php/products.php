<?php
include 'db_connect.php';
include 'header.php';
include 'product_helpers.php';
?>
<link rel="stylesheet" href="../CSS/products.css">
<link rel="stylesheet" href="../CSS/products_search.css">

<main>
    <h2>Our Products</h2>
    <!-- Search + Sort UI -->
    <div class="search-wrapper">
        <form method="get" class="product-filters">
            <input type="text" name="q" placeholder="Search products..." maxlength="100" aria-label="Search products" value="<?php echo htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES); ?>">
            <select name="sort" aria-label="Sort products">
                <option value="" <?php echo empty($_GET['sort']) ? 'selected' : ''; ?>>Sort</option>
                <option value="price_asc"  <?php echo (($_GET['sort'] ?? '')==='price_asc')?'selected':''; ?>>Price: Low to High</option>
                <option value="price_desc" <?php echo (($_GET['sort'] ?? '')==='price_desc')?'selected':''; ?>>Price: High to Low</option>
                <option value="name_asc"   <?php echo (($_GET['sort'] ?? '')==='name_asc')?'selected':''; ?>>Name: A–Z</option>
                <option value="name_desc"  <?php echo (($_GET['sort'] ?? '')==='name_desc')?'selected':''; ?>>Name: Z–A</option>
            </select>
            <button type="submit" class="btn">Apply</button>
            <?php if (!empty($_GET['q']) || !empty($_GET['sort'])): ?>
                <a class="btn btn--ghost" href="?page=1">Reset</a>
            <?php endif; ?>
            <input type="hidden" name="page" value="1">
        </form>
    </div>

    <div class="product-grid">
        <?php
        $q = isset($_GET['q']) ? trim($_GET['q']) : '';
        if (strlen($q) > 100) {
            $q = substr($q, 0, 100);
        }
        $sort = isset($_GET['sort']) ? trim($_GET['sort']) : '';

        $allowedSort = ['price_asc', 'price_desc', 'name_asc', 'name_desc'];
        if (!in_array($sort, $allowedSort, true)) {
            $sort = '';
        }
        switch ($sort) {
            case 'price_asc':  $order = 'ORDER BY price ASC'; break;
            case 'price_desc': $order = 'ORDER BY price DESC'; break;
            case 'name_asc':   $order = 'ORDER BY name ASC'; break;
            case 'name_desc':  $order = 'ORDER BY name DESC'; break;
            default:           $order = 'ORDER BY id ASC';
        }

        $limit = 6;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        if ($q !== '') {
            $like = '%' . $q . '%';
            $total_stmt = $conn->prepare("SELECT COUNT(*) as total FROM products WHERE name LIKE ? OR description LIKE ?");
            $total_stmt->bind_param('ss', $like, $like);
        } else {
            $total_stmt = $conn->prepare("SELECT COUNT(*) as total FROM products");
        }

        $total_stmt->execute();
        $total_result = $total_stmt->get_result();
        $total_row = $total_result->fetch_assoc();
        $total_products = (int) ($total_row['total'] ?? 0);
        $total_pages = $total_products > 0 ? (int) ceil($total_products / $limit) : 1;

        if ($page < 1) {
            $page = 1;
        }
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $offset = ($page - 1) * $limit;

        if ($q !== '') {
            $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ? $order LIMIT ? OFFSET ?");
            $stmt->bind_param('ssii', $like, $like, $limit, $offset);
        } else {
            $stmt = $conn->prepare("SELECT * FROM products $order LIMIT ? OFFSET ?");
            $stmt->bind_param('ii', $limit, $offset);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $media = resolve_product_media($row['name'], (int) $row['id'], $row['description']);
                $img_src = $media['image'];
                $desc = $media['description'];

                echo "
                <div class='product-card'>
                    <img src='" . htmlspecialchars($img_src, ENT_QUOTES) . "'
                         onerror=\"this.onerror=null;this.src='https://via.placeholder.com/800x600?text=No+Image'\"
                         alt=\"" . htmlspecialchars($row['name'], ENT_QUOTES) . "\"
                         loading='lazy' decoding='async'>
                    <h3>" . htmlspecialchars($row['name']) . "</h3>
                    <p>" . htmlspecialchars($desc) . "</p>
                    <p><strong>₱" . number_format((float) $row['price'], 2) . "</strong></p>
                    <form method='post' action='cart.php'>
                        <input type='hidden' name='product_id' value='" . htmlspecialchars($row['id']) . "'>
                        <button type='submit' name='add_to_cart' class='btn'>Add to Cart</button>
                    </form>
                </div>";
            }
        } else {
            echo "<p class='empty-state'>No products matched your search. Try a new keyword.</p>";
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
