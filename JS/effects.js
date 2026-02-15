// Simple scroll effects
const header = document.querySelector('.site-header');
window.addEventListener('scroll', function() {
  if (!header) {
    return;
  }
  const scrollY = window.scrollY;
  header.style.boxShadow = scrollY > 30
    ? '0 14px 32px rgba(19, 19, 26, 0.12)'
    : '0 12px 30px rgba(19, 19, 26, 0.06)';
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
      link.setAttribute('aria-current', 'page');
    }
  });
});

// Responsive navigation toggle
document.addEventListener('DOMContentLoaded', () => {
  const navToggle = document.querySelector('.nav-toggle');
  const siteHeader = document.querySelector('.site-header');

  if (navToggle && siteHeader) {
    navToggle.addEventListener('click', () => {
      const isOpen = siteHeader.classList.toggle('nav-open');
      navToggle.setAttribute('aria-expanded', String(isOpen));
    });
  }
});

// Scroll-triggered reveal animations
const observer = new IntersectionObserver((entries, obs) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('reveal');
      obs.unobserve(entry.target);
    }
  });
}, { threshold: 0.15 });

document.addEventListener('DOMContentLoaded', () => {
  const elementsToReveal = document.querySelectorAll('.product-card, .product-grid, table, form, .feature, .hero');
  elementsToReveal.forEach(el => {
    el.classList.add('reveal-ready');
    observer.observe(el);
  });
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

// Scroll-to-top button
document.addEventListener('DOMContentLoaded', () => {
  const scrollBtn = document.querySelector('.scroll-top');
  if (!scrollBtn) {
    return;
  }

  window.addEventListener('scroll', () => {
    scrollBtn.classList.toggle('is-visible', window.scrollY > 350);
  });

  scrollBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
});
