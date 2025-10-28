<?php include 'header.php'; ?>
<link rel="stylesheet" href="../css/index.css">
<link rel="stylesheet" href="../css/index_animations.css">

<main>
    <!-- Animated Hero Banner -->
    <div class="hero-banner">
        <h1>Welcome to Cartify</h1>
        <p>Your One-Stop Tech Shop — Explore Premium Gadgets & Accessories</p>
        
        <!-- Small animated delivery cart -->
        <div class="delivery-cart-wrapper">
            <svg class="delivery-cart" viewBox="0 0 100 40" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="8" width="64" height="18" rx="2" fill="#fff" opacity="0.9"/>
                <rect x="10" y="2" width="30" height="10" rx="1.5" fill="#ffe8b6"/>
                <rect x="36" y="3" width="14" height="10" rx="1" fill="#ff7a7a"/>
                <circle class="wheel" cx="18" cy="30" r="4" fill="#222"/>
                <circle class="wheel" cx="50" cy="30" r="4" fill="#222"/>
                <path d="M66 12 L78 12 L84 24" stroke="#fff" stroke-width="2" fill="none"/>
            </svg>
        </div>
    </div>

    <section class="hero">
        <h2>Welcome to PinoyTech Finds!</h2>
        <p>Discover the latest gadgets and tech accessories at great prices.</p>
        <a href="products.php" class="shop-btn">Shop Now</a>
    </section>

    <section class="features">
        <div class="feature">
            <div class="feature-icon">🚚</div>
            <h3>Fast Shipping</h3>
            <p>Get your orders delivered quickly and safely.</p>
        </div>
        <div class="feature">
            <div class="feature-icon">💳</div>
            <h3>Secure Payments</h3>
            <p>Shop with confidence using our secure payment options.</p>
        </div>
        <div class="feature">
            <div class="feature-icon">🔄</div>
            <h3>Easy Returns</h3>
            <p>Not satisfied? Return your items hassle-free.</p>
        </div>
    </section>

    <section class="cta">
        <h2>Ready to Upgrade Your Tech?</h2>
        <p>Join thousands of satisfied customers and explore our collection today!</p>
        <a href="products.php" class="cta-btn">Explore Products</a>
    </section>

    <h2>Featured Products</h2>
    <div class="product-grid">
        <?php
        // ...existing code (image_urls, overrides, queries)...
        ?>
    </div>
</main>

<!-- Scroll to Top Button -->
<button id="scrollToTop" title="Back to top">↑</button>

<script>
// Show/hide scroll-to-top button
const scrollBtn = document.getElementById('scrollToTop');
window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        scrollBtn.classList.add('show');
    } else {
        scrollBtn.classList.remove('show');
    }
});

// Smooth scroll to top
scrollBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>

<?php include 'footer.php'; ?>
