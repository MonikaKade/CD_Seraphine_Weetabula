// Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            // Back to top button
            const backToTop = document.querySelector('.back-to-top');
            if (window.scrollY > 300) {
                backToTop.classList.add('active');
            } else {
                backToTop.classList.remove('active');
            }
        });
        
        // Smooth scrolling for all links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
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
        const productItems = document.querySelectorAll('.produk-item');
        productItems.forEach(item => {
            item.addEventListener('click', function() {
                // Here you can add functionality to show product details
                alert('Produk akan ditampilkan lebih detail di halaman produk');
            });
        });
        
        // Read more button
        document.querySelector('.read-more').addEventListener('click', function() {
            alert('Konten lebih lanjut akan ditampilkan');
            // You can replace this with actual content expansion
        });
        
        // See all products button
        document.querySelector('.lihat-semua').addEventListener('click', function() {
            window.location.href = '../produk/produk.html';
        });
        
        // Animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.card, .produk-item, .intro-text');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if (elementPosition < screenPosition) {
                    element.classList.add('animate_animated', 'animate_fadeInUp');
                }
            });
        }
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);