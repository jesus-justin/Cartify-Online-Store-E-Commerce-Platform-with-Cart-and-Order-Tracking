<?php
include 'header.php';
include 'db_connect.php';
include 'product_helpers.php';
?>
<link rel="stylesheet" href="../CSS/index.css">
<link rel="stylesheet" href="../CSS/index_animations.css">

<main id="main-content">
    <section class="hero-banner">
        <div class="hero-content">
            <div class="hero-copy">
                <span class="hero-pill">Weekly tech drops</span>
                <h1>Upgrade your everyday tech with Cartify.</h1>
                <p>Curated gadgets, standout accessories, and an effortless checkout. Discover what is trending now.</p>
                <div class="hero-actions">
                    <a href="products.php" class="btn">Shop the Collection</a>
                    <a href="order_history.php" class="btn btn--ghost">Track Orders</a>
                </div>
                <div class="hero-highlights">
                    <div class="highlight">
                        <strong>24h dispatch</strong>
                        <span>Fast processing on top picks</span>
                    </div>
                    <div class="highlight">
                        <strong>Secure checkout</strong>
                        <span>Protected payments, every order</span>
                    </div>
                </div>
            </div>
            <div class="hero-visual" aria-hidden="true">
                <div class="orb orb--one"></div>
                <div class="orb orb--two"></div>
                <div class="hero-card">
                    <h3>Trending Now</h3>
                    <p>Wireless audio, smart wearables, and creative tools.</p>
                    <span class="hero-badge">Top Rated</span>
                </div>
            </div>
        </div>
        <div class="delivery-cart-wrapper" aria-hidden="true">
            <svg class="delivery-cart" viewBox="0 0 100 40" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="8" width="64" height="18" rx="2" fill="#fff" opacity="0.9"/>
                <rect x="10" y="2" width="30" height="10" rx="1.5" fill="#ffe8b6"/>
                <rect x="36" y="3" width="14" height="10" rx="1" fill="#ff7a7a"/>
                <circle class="wheel" cx="18" cy="30" r="4" fill="#222"/>
                <circle class="wheel" cx="50" cy="30" r="4" fill="#222"/>
                <path d="M66 12 L78 12 L84 24" stroke="#fff" stroke-width="2" fill="none"/>
            </svg>
        </div>
    </section>

    <section class="features">
        <div class="feature">
            <div class="feature-icon">🚚</div>
            <h3>Fast shipping</h3>
            <p>Quick dispatch and local delivery for your everyday essentials.</p>
        </div>
        <div class="feature">
            <div class="feature-icon">💳</div>
            <h3>Secure checkout</h3>
            <p>Trusted payment flow with clear order tracking.</p>
        </div>
        <div class="feature">
            <div class="feature-icon">🔄</div>
            <h3>Easy returns</h3>
            <p>Simple returns when a product is not the right fit.</p>
        </div>
    </section>

    <section class="cta">
        <div class="cta-card">
            <div>
                <h2>Ready to sharpen your setup?</h2>
                <p>Discover accessories and gear that make work, play, and travel feel faster.</p>
            </div>
            <a href="products.php" class="btn">Explore products</a>
        </div>
    </section>

    <section class="featured-products">
        <h2 class="section-title">Featured products</h2>
        <p class="section-subtitle">Hand-picked tech favorites to help you move faster, create more, and stay connected.</p>
        <div class="product-grid">
            <?php
            $result = $conn->query("SELECT * FROM products ORDER BY id ASC LIMIT 6");
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $media = resolve_product_media($row['name'], (int) $row['id'], $row['description']);
                    $img_src = $media['image'];
                    $desc = $media['description'];
                    echo "
                    <div class='product-card'>
                        <img src='" . htmlspecialchars($img_src, ENT_QUOTES) . "'
                             onerror=\"this.onerror=null;this.src='https://via.placeholder.com/800x600?text=No+Image'\"
                             alt='" . htmlspecialchars($row['name'], ENT_QUOTES) . "'
                             loading='lazy' decoding='async'>
                        <h3>" . htmlspecialchars($row['name']) . "</h3>
                        <p>" . htmlspecialchars($desc) . "</p>
                        <p class='price-tag'>₱" . format_price($row['price']) . "</p>
                        <a href='products.php' class='btn btn--ghost'>View details</a>
                    </div>";
                }
            } else {
                echo "<p class='empty-state'>No featured products yet. Please check back soon.</p>";
            }
            ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
