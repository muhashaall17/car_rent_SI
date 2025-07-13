// Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenu = document.getElementById('close-menu');
        const menuItems = mobileMenu.querySelectorAll('a'); // Ambil semua item menu di dalam mobile-menu

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.remove('opacity-0', 'pointer-events-none');
            mobileMenu.classList.add('opacity-100', 'pointer-events-auto');
        });

        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.remove('opacity-100', 'pointer-events-auto');
            mobileMenu.classList.add('opacity-0', 'pointer-events-none');
        });

        // Tutup menu saat item menu diklik 
        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                mobileMenu.classList.remove('opacity-100', 'pointer-events-auto');
                mobileMenu.classList.add('opacity-0', 'pointer-events-none');
            });
        });
        
        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            // Back to Top Button
            const backToTopButton = document.getElementById('back-to-top');
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });
        
        // Back to Top Button
        document.getElementById('back-to-top').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Initialize Swipers with autoplay
        const branchSwiper = new Swiper('.branch-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.branch-swiper .swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            breakpoints: {
                480: {
                    slidesPerView: 1.2,
                    spaceBetween: 20,
                },
                640: {
                    slidesPerView: 1.5,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 2.5,
                    spaceBetween: 20,
                }
            }
        });
        
        const testimonialSwiper = new Swiper('.testimonial-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.testimonial-swiper .swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            breakpoints: {
                480: {
                    slidesPerView: 1.2,
                    spaceBetween: 20,
                },
                640: {
                    slidesPerView: 1.5,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 2.5,
                    spaceBetween: 20,
                }
            }
        });
        
        // ScrollReveal Animations
        ScrollReveal().reveal('.hero-section h1, .hero-section p, .hero-section .flex', {
            delay: 200,
            distance: '20px',
            origin: 'left',
            interval: 100
        });
        
        ScrollReveal().reveal('.hero-section img', {
            delay: 400,
            distance: '20px',
            origin: 'right'
        });
        
        ScrollReveal().reveal('section', {
            delay: 200,
            distance: '20px',
            origin: 'bottom',
            interval: 100
        });
        
        ScrollReveal().reveal('.card-hover', {
            delay: 300,
            distance: '20px',
            origin: 'bottom',
            interval: 100
        });
        
        ScrollReveal().reveal('.divider', {
            delay: 200,
            opacity: 0,
            duration: 1000
        });
        
        // Add hover effects to all interactive elements
        document.querySelectorAll('a, button').forEach(element => {
            element.classList.add('transition', 'duration-300');
        });
        
        // Auto pause swipers when not in view
        const swipers = [branchSwiper, testimonialSwiper];
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                swipers.forEach(swiper => {
                    if (entry.isIntersecting) {
                        swiper.autoplay.start();
                    } else {
                        swiper.autoplay.stop();
                    }
                });
$0
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.swiper').forEach(swiper => {
            observer.observe(swiper);
        });
        
        // Add pulse animation to CTA buttons
        setInterval(() => {
            const ctaButtons = document.querySelectorAll('.glow-effect');
            ctaButtons.forEach(button => {
                button.classList.toggle('pulse-animation');
            });
        }, 3000);

         // Pastikan semua konten dimuat sebelum inisialisasi
        document.addEventListener('DOMContentLoaded', function() {
            // Periksa overflow setelah load
            function checkOverflow() {
                if (document.documentElement.scrollWidth > window.innerWidth) {
                    console.log('Horizontal overflow detected!');
                    // Periksa elemen yang menyebabkan overflow
                    document.querySelectorAll('*').forEach(el => {
                        if (el.scrollWidth > el.clientWidth) {
                            console.log('Overflow element:', el);
                        }
                    });
                }
            }
            
            // Jalankan saat load dan resize
            window.addEventListener('load', checkOverflow);
            window.addEventListener('resize', checkOverflow);
            
        });