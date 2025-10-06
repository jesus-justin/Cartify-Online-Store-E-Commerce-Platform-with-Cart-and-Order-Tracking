// Header shadow on scroll
window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  if (window.scrollY > 30) {
    header.style.boxShadow = '0 6px 24px rgba(30,144,255,0.25)';
  } else {
    header.style.boxShadow = '0 2px 8px rgba(30,144,255,0.15)';
  }
});

// Hero text animation (floating effect)
document.addEventListener('DOMContentLoaded', () => {
  const hero = document.querySelector('.hero');
  if (hero) {
    hero.style.transition = 'box-shadow 0.6s';
    setInterval(() => {
      hero.style.boxShadow = '0 8px 32px rgba(30,144,255,0.12)';
      setTimeout(() => {
        hero.style.boxShadow = '0 2px 8px rgba(30,144,255,0.08)';
      }, 800);
    }, 2000);
  }
});

// Button ripple effect
document.querySelectorAll('.shop-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    const ripple = document.createElement('span');
    ripple.className = 'ripple';
    ripple.style.left = `${e.offsetX}px`;
    ripple.style.top = `${e.offsetY}px`;
    ripple.style.width = ripple.style.height = `${Math.max(btn.offsetWidth, btn.offsetHeight)}px`;
    btn.appendChild(ripple);
    ripple.addEventListener('animationend', () => ripple.remove());
  });
});
