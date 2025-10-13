// Simple scroll effects
window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  const scrollY = window.scrollY;

  if (scrollY > 30) {
    header.style.boxShadow = '0 6px 24px rgba(30,144,255,0.25)';
  } else {
    header.style.boxShadow = '0 2px 8px rgba(30,144,255,0.15)';
  }
});

// Button click effects
document.querySelectorAll('.shop-btn, .btn').forEach(btn => {
  btn.addEventListener('click', function() {
    this.style.transform = 'scale(0.95)';
    setTimeout(() => {
      this.style.transform = '';
    }, 150);
  });
});

// Navigation active link highlighting
document.addEventListener('DOMContentLoaded', () => {
  const navLinks = document.querySelectorAll('.nav-buttons a');
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';

  navLinks.forEach(link => {
    const linkPath = link.getAttribute('href');
    if (linkPath === currentPath) {
      link.classList.add('active');
    }
  });
});

// Scroll-triggered reveal animations
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('reveal');
    }
  });
}, { threshold: 0.1 });

document.addEventListener('DOMContentLoaded', () => {
  const elementsToReveal = document.querySelectorAll('.product-card, .product-grid, table, form');
  elementsToReveal.forEach(el => observer.observe(el));
});

// Staggered animations for product cards
document.addEventListener('DOMContentLoaded', () => {
  const productCards = document.querySelectorAll('.product-card');
  productCards.forEach((card, index) => {
    card.style.animationDelay = `${index * 0.1}s`;
  });
});

// Table row hover effects
document.addEventListener('DOMContentLoaded', () => {
  const tableRows = document.querySelectorAll('tbody tr');
  tableRows.forEach(row => {
    row.addEventListener('mouseenter', function() {
      this.style.backgroundColor = '#f0f0f0';
    });
    row.addEventListener('mouseleave', function() {
      this.style.backgroundColor = '';
    });
  });
});
