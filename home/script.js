const heroText = document.getElementById('heroText');

window.addEventListener('scroll', () => {
  const scrollY = window.scrollY;
  const scale = Math.max(1 - scrollY / 600, 0.6);
  const translateY = Math.min(scrollY / 2, 150);
  heroText.style.transform =` translateY(-${translateY}px) scale(${scale})`;
});