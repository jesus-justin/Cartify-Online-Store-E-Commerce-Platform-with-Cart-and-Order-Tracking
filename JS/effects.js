// Header shadow and parallax on scroll
window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  const hero = document.querySelector('.hero');
  const scrollY = window.scrollY;

  if (scrollY > 30) {
    header.style.boxShadow = '0 6px 24px rgba(30,144,255,0.25)';
    header.style.transform = 'translateY(-5px)';
  } else {
    header.style.boxShadow = '0 2px 8px rgba(30,144,255,0.15)';
    header.style.transform = 'translateY(0)';
  }

  // Parallax effect for hero
  if (hero) {
    hero.style.transform = `translateY(${scrollY * 0.5}px)`;
  }
});

// Advanced hero animations (floating, pulse)
document.addEventListener('DOMContentLoaded', () => {
  const hero = document.querySelector('.hero');
  if (hero) {
    hero.style.transition = 'box-shadow 0.6s, transform 0.1s';
    setInterval(() => {
      hero.style.boxShadow = '0 8px 32px rgba(30,144,255,0.12)';
      hero.style.transform = 'scale(1.01)';
      setTimeout(() => {
        hero.style.boxShadow = '0 2px 8px rgba(30,144,255,0.08)';
        hero.style.transform = 'scale(1)';
      }, 800);
    }, 2000);
  }
});

// Enhanced button ripple and pulse effect
document.querySelectorAll('.shop-btn, .btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    const ripple = document.createElement('span');
    ripple.className = 'ripple';
    ripple.style.left = `${e.offsetX}px`;
    ripple.style.top = `${e.offsetY}px`;
    ripple.style.width = ripple.style.height = `${Math.max(btn.offsetWidth, btn.offsetHeight)}px`;
    btn.appendChild(ripple);
    ripple.addEventListener('animationend', () => ripple.remove());

    // Add pulse effect
    btn.classList.add('pulse');
    setTimeout(() => btn.classList.remove('pulse'), 300);
  });
});

// Navigation active link highlighting, hover effects, and slide-in
document.addEventListener('DOMContentLoaded', () => {
  const navLinks = document.querySelectorAll('.nav-buttons a');
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';

  navLinks.forEach((link, index) => {
    const linkPath = link.getAttribute('href');
    if (linkPath === currentPath) {
      link.classList.add('active');
    }

    // Staggered slide-in animation
    link.style.animationDelay = `${index * 0.1}s`;
    link.classList.add('nav-slide-in');

    // Enhanced hover effect: glow and scale
    link.addEventListener('mouseenter', () => {
      link.style.filter = 'brightness(1.1) drop-shadow(0 0 10px rgba(30,144,255,0.5))';
      link.style.transform = 'scale(1.05)';
    });

    link.addEventListener('mouseleave', () => {
      link.style.filter = 'brightness(1)';
      link.style.transform = 'scale(1)';
    });
  });
});

// Scroll-triggered reveal animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('reveal');
    }
  });
}, observerOptions);

document.addEventListener('DOMContentLoaded', () => {
  const elementsToReveal = document.querySelectorAll('.product-card, .product-grid, table, form');
  elementsToReveal.forEach(el => observer.observe(el));
});

// Loading spinner for dynamic content
function showLoadingSpinner(element) {
  const spinner = document.createElement('div');
  spinner.className = 'loading-spinner';
  spinner.innerHTML = '<div class="spinner"></div>';
  element.appendChild(spinner);
  return spinner;
}

function hideLoadingSpinner(spinner) {
  if (spinner) spinner.remove();
}

// Animated counter for prices
function animateCounter(element, target) {
  let current = 0;
  const increment = target / 100;
  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      current = target;
      clearInterval(timer);
    }
    element.textContent = '$' + current.toFixed(2);
  }, 20);
}

// Page transition effects
document.addEventListener('DOMContentLoaded', () => {
  document.body.classList.add('page-loaded');
});

// Product card flip animation (for products page)
document.addEventListener('DOMContentLoaded', () => {
  const productCards = document.querySelectorAll('.product-card');
  productCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.classList.add('flip');
    });
    card.addEventListener('mouseleave', () => {
      card.classList.remove('flip');
    });
  });
});

// Cart item slide-in animations
document.addEventListener('DOMContentLoaded', () => {
  const cartItems = document.querySelectorAll('tbody tr');
  cartItems.forEach((item, index) => {
    item.style.animationDelay = `${index * 0.1}s`;
    item.classList.add('slide-in-left');
  });
});

// Checkout progress bar
document.addEventListener('DOMContentLoaded', () => {
  const progressBar = document.querySelector('.progress-bar');
  if (progressBar) {
    let progress = 0;
    const interval = setInterval(() => {
      progress += 10;
      progressBar.style.width = progress + '%';
      if (progress >= 100) clearInterval(interval);
    }, 200);
  }
});

// Order history staggered animations
document.addEventListener('DOMContentLoaded', () => {
  const orderRows = document.querySelectorAll('tbody tr');
  orderRows.forEach((row, index) => {
    row.style.animationDelay = `${index * 0.05}s`;
    row.classList.add('fade-in-up');
  });
});
