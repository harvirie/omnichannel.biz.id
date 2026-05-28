/**
 * Omni Animations JS
 * Integrates Swup for page transitions and GSAP for Parallax.
 */

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Initialize GSAP Parallax
    function initGSAPParallax() {
        const swupContainer = document.getElementById('swup');
        if (!swupContainer) return;
        
        const isParallaxEnabled = swupContainer.dataset.parallax === 'yes';
        
        if (isParallaxEnabled && typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
            
            // Mencari gambar hero atau elemen dengan kelas parallax khusus
            // Jika tidak ada class khusus, kita beri efek ringan pada semua gambar besar
            const images = swupContainer.querySelectorAll('img');
            images.forEach(img => {
                const initParallaxOnImg = () => {
                    // Terapkan hanya pada gambar yang lumayan besar (menghindari icon)
                    if (img.clientHeight > 50) {
                        gsap.to(img, {
                            y: -40, // Bergerak 40px ke atas secara relatif saat di-scroll
                            ease: "none",
                            scrollTrigger: {
                                trigger: img,
                                start: "top bottom", // Mulai saat bagian atas gambar menyentuh bagian bawah layar
                                end: "bottom top",   // Selesai saat bagian bawah gambar menyentuh bagian atas layar
                                scrub: true          // Animasi mengikuti scroll
                            }
                        });
                    }
                };
                
                if (img.complete) {
                    initParallaxOnImg();
                } else {
                    img.addEventListener('load', initParallaxOnImg);
                }
            });
        }
    }
    
    // Jalankan parallax saat halaman pertama kali diload
    initGSAPParallax();

    // 2. Initialize Swup for Page Transitions
    if (typeof Swup !== 'undefined' && typeof SwupScriptsPlugin !== 'undefined' && typeof SwupBodyClassPlugin !== 'undefined') {
        const swup = new Swup({
            containers: ['#swup'],
            plugins: [
                new SwupScriptsPlugin({
                    head: true,
                    body: true,
                    optin: false // Menjalankan semua script ulang secara default
                }),
                new SwupBodyClassPlugin()
            ]
        });

        // Event hooks
        swup.hooks.on('page:view', () => {
            // Re-init parallax after page changes
            if (typeof ScrollTrigger !== 'undefined') {
                ScrollTrigger.getAll().forEach(st => st.kill()); // Bersihkan scrolltrigger lama
            }
            initGSAPParallax();
            
            // Re-init theme scripts (Lucide Icons, etc) if they were globally available
            // Note: SwupScriptsPlugin sudah membantu menjalankan <script> tag di dalam body, 
            // tapi kita bisa trigger DOMContentLoaded secara manual jika tema membutuhkannya.
            window.document.dispatchEvent(new Event("DOMContentLoaded", {
                bubbles: true,
                cancelable: true
            }));
        });
    }
});
