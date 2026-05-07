<?php
get_header();
?>

<div class="omni-hero-wrapper">
    <div class="omni-hero-container">
        
        <!-- TOP NAVIGATION (Dark Green Area) -->
        <nav class="omni-nav">
            <a href="#">Home</a>
            <a href="#">Services</a>
            <a href="#">Salon</a>
            <a href="#">Gift Card</a>
        </nav>

        <!-- LIGHT GREEN SECTION -->
        <div class="omni-light-card">
            <!-- Header inside light card -->
            <div class="omni-light-header">
                <div class="omni-logo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="24" height="24" rx="6" fill="#4B6E4D"/>
                        <path d="M8 12C8 10.5 9 9.5 10.5 9.5C11.5 9.5 12 10 12 10C12 10 12.5 9.5 13.5 9.5C15 9.5 16 10.5 16 12C16 13.5 12 16.5 12 16.5C12 16.5 8 13.5 8 12Z" fill="#EAF5E3"/>
                    </svg>
                    <span>Cmouse</span>
                </div>
                
                <div class="omni-auth">
                    <a href="#" class="btn-primary">Sign in</a>
                    <button class="btn-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            <!-- Main Content inside light card -->
            <div class="omni-light-content">
                <h1 class="hero-title">Beauty comes first, style<br>follows every step.</h1>
                <p class="hero-subtitle">Whether it's a quick touch-up or a full transformation, we're here<br>to bring your unique style to life.</p>
                
                <div class="omni-search-wrapper">
                    <div class="search-tabs">
                        <button class="active">Home</button>
                        <button>Institute</button>
                    </div>
                    <input type="text" placeholder="Search services">
                    <button class="search-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    </button>
                </div>

                <div class="omni-trusted">
                    <div class="star-badge">★</div>
                    <div class="trusted-text">
                        <strong>On Trusted Pilot</strong>
                        <span>150+ Reviews</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT IMAGE SECTION -->
        <div class="omni-image-card">
            <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?auto=format&fit=crop&w=800&q=80" alt="Beauty model" class="main-model-img">
            <span class="tag-recommended">Recommended</span>
            
            <div class="glass-card">
                <div class="glass-header">
                    <h3>Deep Conditioning Treatments</h3>
                    <span class="rating">★ (2.3k+)</span>
                </div>
                <p>Beause Monde du Esthétique<br><span>Montmartre & Sacré-Cœur Basilica (1km away)</span></p>
            </div>
        </div>

        <!-- BOTTOM SLATE SECTION -->
        <div class="omni-slate-card">
            <div class="slate-info">
                <h2>Lifestyle and<br><em>Wellness</em></h2>
                <div class="slate-actions">
                    <a href="#" class="btn-primary">Book Now</a>
                    <button class="btn-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                    <div class="social-icons">
                        <a href="#">IG</a>
                        <a href="#">FB</a>
                    </div>
                </div>
            </div>
            
            <div class="slate-services">
                <div class="service-box">
                    <div class="icon">✂️</div>
                    <span>Hairdressing</span>
                </div>
                <div class="service-box">
                    <div class="icon">💆</div>
                    <span>Well Massage</span>
                </div>
                <div class="service-box">
                    <div class="icon">👁️</div>
                    <span>Eye Care</span>
                </div>
                <div class="service-box">
                    <div class="icon">💅</div>
                    <span>Nail Beauty</span>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php
get_footer();
?>
