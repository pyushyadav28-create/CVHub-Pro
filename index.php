<?php
require_once 'includes/header.php';
require_once 'includes/guest_navbar.php';
?>
<!-- HERO -->
<section class="hero">

    <div class="blur blur1"></div>
    <div class="blur blur2"></div>

    <div class="container hero-container">

        <div class="hero-text">

            <span class="badge">🚀 Build Your Career</span>

            <h1>
                Build Your
                <span>Dream Developer Portfolio</span>
            </h1>

            <p>
                Showcase your skills, projects, education and experience.
                Connect with recruiters and developers worldwide.
            </p>

            <div class="search-box">

                <input type="text"
                       placeholder="Search developers by skill, name or technology">

                <button>
                    <i class="fa-solid fa-search"></i>
                </button>

            </div>

            <div class="hero-buttons">

                <a href="register.php" class="btn-primary">
                    Get Started
                </a>

                <a href="#" class="btn-outline">
                    Explore Developers
                </a>

            </div>

        </div>

    </div>

</section>

<!-- STATS -->

<section class="stats">

    <div class="container stats-grid">

        <div class="stat-card">
            <h2>5000+</h2>
            <p>Developers</p>
        </div>

        <div class="stat-card">
            <h2>1200+</h2>
            <p>Companies</p>
        </div>

        <div class="stat-card">
            <h2>8500+</h2>
            <p>CV Uploaded</p>
        </div>

        <div class="stat-card">
            <h2>98%</h2>
            <p>Hiring Success</p>
        </div>

    </div>

</section>

<!-- FEATURED DEVELOPERS -->

<section class="developers">

    <div class="container">

        <h2 class="section-title">Featured Developers</h2>

        <p class="section-subtitle">
            Meet talented developers from around the world.
        </p>

        <div class="developer-grid">

            <div class="developer-card">
                <img src="https://i.pravatar.cc/150?img=1" alt="">
                <h3>Alex Johnson</h3>
                <span>Full Stack Developer</span>
                <p>PHP • Laravel • React • MySQL</p>
            </div>

            <div class="developer-card">
                <img src="https://i.pravatar.cc/150?img=5" alt="">
                <h3>Sarah Wilson</h3>
                <span>Frontend Developer</span>
                <p>React • Vue • Tailwind CSS</p>
            </div>

            <div class="developer-card">
                <img src="https://i.pravatar.cc/150?img=12" alt="">
                <h3>Michael Chen</h3>
                <span>Backend Developer</span>
                <p>Node.js • Express • MongoDB</p>
            </div>

        </div>

    </div>

</section>

<!-- HOW IT WORKS -->

<section class="how-it-works">

    <div class="container">

        <h2 class="section-title">
            How CVHub Pro Works
        </h2>

        <p class="section-subtitle">
            Create your professional profile in just three simple steps.
        </p>

        <div class="steps-grid">

            <div class="step-card">

                <div class="step-icon">
                    <i class="fa-solid fa-user-plus"></i>
                </div>

                <h3>Create Account</h3>

                <p>
                    Register in seconds and create your developer account.
                </p>

            </div>

            <div class="step-card">

                <div class="step-icon">
                    <i class="fa-solid fa-file-code"></i>
                </div>

                <h3>Build Portfolio</h3>

                <p>
                    Add your skills, education, projects and work experience.
                </p>

            </div>

            <div class="step-card">

                <div class="step-icon">
                    <i class="fa-solid fa-briefcase"></i>
                </div>

                <h3>Get Discovered</h3>

                <p>
                    Recruiters can search your profile and download your CV.
                </p>

            </div>

        </div>

    </div>

</section>

<!-- TESTIMONIALS -->

<section class="testimonials">

    <div class="container">

        <h2 class="section-title">
            What Developers Say
        </h2>

        <p class="section-subtitle">
            Thousands of developers trust CVHub Pro to showcase their careers.
        </p>

        <div class="testimonial-grid">

            <div class="testimonial-card">

                <p>
                    "CVHub Pro helped me organize my portfolio and land my first software engineering internship."
                </p>

                <h4>Alex Johnson</h4>

                <span>Software Engineer</span>

            </div>

            <div class="testimonial-card">

                <p>
                    "The clean interface and easy profile builder made it simple to showcase my projects."
                </p>

                <h4>Sarah Wilson</h4>

                <span>Frontend Developer</span>

            </div>

            <div class="testimonial-card">

                <p>
                    "Recruiters found my profile through CVHub Pro, and I received multiple interview invitations."
                </p>

                <h4>Michael Chen</h4>

                <span>Backend Developer</span>

            </div>

        </div>

    </div>

</section>

<?php
require_once 'includes/footer.php';
?>
