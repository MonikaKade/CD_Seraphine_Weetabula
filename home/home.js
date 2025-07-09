// Mobile Menu Toggle
const mobileMenu = document.querySelector('.mobile-menu');
const navbarLinks = document.querySelector('.navbar-links');

mobileMenu.addEventListener('click', () => {
    navbarLinks.classList.toggle('active');
    mobileMenu.querySelector('i').classList.toggle('fa-times');
});

// Combined scroll effects
// Auto set active link based on current URL
window.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.navbar-links a');
    const currentPage = window.location.pathname.split('/').pop();

    links.forEach(link => {
        const linkPage = link.getAttribute('href').split('/').pop();
        if (linkPage === currentPage) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
});

    
    // Back to top button
    const backToTop = document.querySelector('.back-to-top');
    if (window.scrollY > 300) {
        backToTop.classList.add('active');
    } else {
        backToTop.classList.remove('active');
    }
    
    // Animation on scroll
    const elements = document.querySelectorAll('.card, .produk-item, .intro-text');
    elements.forEach(element => {
        const elementPosition = element.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;
        
        if (elementPosition < screenPosition) {
            element.classList.add('animate_animated', 'animate_fadeInUp');
        }
    });


// Smooth scrolling for all links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
            
            // Close mobile menu if open
            if (navbarLinks.classList.contains('active')) {
                navbarLinks.classList.remove('active');
                mobileMenu.querySelector('i').classList.remove('fa-times');
            }
        }
    });
});

// Back to top functionality
document.querySelector('.back-to-top').addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Product hover effect
document.querySelectorAll('.produk-button').forEach(button => {
    button.addEventListener('click', function(e) {
        e.stopPropagation();
        const productName = this.closest('.produk-overlay').querySelector('h3').textContent;
        const phoneNumber = "6289542177009";
        const message = Halo, saya tertarik dengan produk ${productName}, bisa minta info lebih lanjut?;
        const url = https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)};
        window.open(url, "_blank");
    });
});

// Lihat Semua Produk button
document.querySelector('.lihat-semua').addEventListener('click', function() {
    window.location.href = "../produk/produk.html";
});
function setActive(clickedLink) {
    const links = document.querySelectorAll('.navbar-links .nav-link');
    links.forEach(link => link.classList.remove('active'));
    clickedLink.classList.add('active');
}