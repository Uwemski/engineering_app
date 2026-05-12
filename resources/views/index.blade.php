<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONPASS - Metallurgical Engineering Excellence</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e3a8a;
            --dark-bg: #0f172a;
            --light-bg: #f8fafc;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        /* Navbar */
        .navbar {
            transition: all 0.3s ease;
            padding: 1.2rem 0;
        }

        .navbar.scrolled {
            background-color: var(--dark-bg) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #60a5fa !important;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #1e3a8a 100%);
            color: white;
            padding: 140px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.05) 10px, rgba(255,255,255,0.05) 20px);
            opacity: 0.1;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .hero .highlight {
            color: #60a5fa;
        }

        .hero p.lead {
            font-size: 1.25rem;
            color: #cbd5e1;
            margin-bottom: 2rem;
        }

        .btn-custom-primary {
            background: var(--primary-color);
            color: white;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
        }

        .btn-custom-primary:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
            color: white;
        }

        .btn-custom-secondary {
            background: transparent;
            color: white;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            border: 2px solid white;
            transition: all 0.3s;
        }

        .btn-custom-secondary:hover {
            background: white;
            color: var(--dark-bg);
        }

        /* Stats Section */
        .stats {
            background: white;
            padding: 60px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-item h3 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-bg);
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            color: #64748b;
            font-size: 1rem;
        }

        /* Services Section */
        .services {
            background: var(--light-bg);
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-title p {
            font-size: 1.125rem;
            color: #64748b;
        }

        .service-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            height: 100%;
            transition: all 0.3s;
            border: 1px solid #e2e8f0;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            width: 60px;
            height: 60px;
            background: #dbeafe;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .service-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .service-card p {
            color: #64748b;
            margin-bottom: 0;
        }

        /* About Section */
        .about {
            background: white;
            padding: 80px 0;
        }

        .about h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .about p {
            color: #64748b;
            margin-bottom: 1rem;
        }

        .about-list {
            list-style: none;
            padding: 0;
            margin-top: 1.5rem;
        }

        .about-list li {
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        .about-list li i {
            color: #22c55e;
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .about-highlight {
            background: linear-gradient(135deg, #1e293b 0%, #1e3a8a 100%);
            color: white;
            padding: 40px;
            border-radius: 12px;
            height: 100%;
        }

        .about-highlight h3 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }

        .highlight-item {
            border-left: 4px solid #60a5fa;
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .highlight-item h4 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .highlight-item p {
            font-size: 0.9rem;
            color: #cbd5e1;
            margin-bottom: 0;
        }

        /* Contact Section */
        .contact {
            background: var(--dark-bg);
            color: white;
            padding: 80px 0;
        }

        .contact .section-title h2,
        .contact .section-title p {
            color: white;
        }

        .contact .section-title p {
            color: #cbd5e1;
        }

        .contact-card {
            text-align: center;
            padding: 30px;
        }

        .contact-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
        }

        .contact-card h3 {
            font-size: 1.25rem;
            margin-bottom: 15px;
        }

        .contact-card a {
            color: #60a5fa;
            text-decoration: none;
            transition: color 0.3s;
        }

        .contact-card a:hover {
            color: #93c5fd;
        }

        .contact-card p {
            color: #cbd5e1;
            margin-bottom: 0;
        }

        /* Footer */
        footer {
            background: #020617;
            color: #94a3b8;
            padding: 30px 0;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.25rem;
            }

            .hero p.lead {
                font-size: 1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .about h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">DONPASS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container position-relative">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1>Engineering Excellence in <span class="highlight">Metallurgy</span></h1>
                    <p class="lead">Precision metal analysis, innovative process solutions, and uncompromising quality standards for industry leaders worldwide</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="#contact" class="btn btn-custom-primary">
                            Get Started <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <a href="#services" class="btn btn-custom-secondary">Our Services</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <h3>25+</h3>
                        <p>Years Experience</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <h3>500+</h3>
                        <p>Projects Completed</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <h3>98%</h3>
                        <p>Client Satisfaction</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <h3>50+</h3>
                        <p>Industry Partners</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-title">
                <h2>Our Services</h2>
                <p>Comprehensive metallurgical solutions tailored to your industry needs</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Materials Testing</h3>
                        <p>Comprehensive analysis of metal properties and performance characteristics</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3>Process Optimization</h3>
                        <p>Advanced metallurgical process design and efficiency improvements</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Quality Assurance</h3>
                        <p>Rigorous quality control and certification services</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3>Technical Consulting</h3>
                        <p>Expert guidance on metallurgical challenges and solutions</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h2>About DONPASS</h2>
                    <p>With over two decades of expertise in metallurgical engineering, DONPASS has established itself as a trusted partner for companies seeking precision, reliability, and innovation in metal processing and analysis.</p>
                    <p>Our team of certified metallurgists and engineers combines cutting-edge technology with deep industry knowledge to deliver solutions that drive efficiency, reduce costs, and ensure the highest quality standards.</p>
                    <ul class="about-list">
                        <li><i class="fas fa-check-circle"></i> ISO 9001:2015 Certified</li>
                        <li><i class="fas fa-check-circle"></i> State-of-the-art Laboratory</li>
                        <li><i class="fas fa-check-circle"></i> Expert Engineering Team</li>
                        <li><i class="fas fa-check-circle"></i> 24/7 Technical Support</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="about-highlight">
                        <h3>Why Choose Us?</h3>
                        <p class="mb-4">We deliver measurable results through precision engineering, innovative methodologies, and an unwavering commitment to client success.</p>
                        <div class="highlight-item">
                            <h4>Precision & Accuracy</h4>
                            <p>Advanced testing with 99.9% accuracy rates</p>
                        </div>
                        <div class="highlight-item">
                            <h4>Fast Turnaround</h4>
                            <p>Results delivered within 48-72 hours</p>
                        </div>
                        <div class="highlight-item">
                            <h4>Expert Consultation</h4>
                            <p>Dedicated support from industry specialists</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Get In Touch</h2>
                <p>Ready to start your next project? Contact our team today</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email Us</h3>
                        <a href="mailto:info@donpass.com">info@donpass.com</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3>Call Us</h3>
                        <a href="tel:+1234567890">+1 (234) 567-890</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Visit Us</h3>
                        <p>123 Industry Ave<br>Lagos, Nigeria</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">&copy; 2026 DONPASS Metallurgical Engineering. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling
        var links = document.querySelectorAll('a[href^="#"]');
        for (var i = 0; i < links.length; i++) {
            links[i].addEventListener('click', function(e) {
                e.preventDefault();
                var targetId = this.getAttribute('href');
                var target = document.querySelector(targetId);
                if (target) {
                    var navHeight = document.querySelector('.navbar').offsetHeight;
                    var targetPosition = target.offsetTop - navHeight;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        }
    </script>
</body>
</html>