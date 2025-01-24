@extends('layouts.master')

@section('title', 'About Us')

@section('content')
<style>
    /* Gradient Background for Header */
    .bg-gradient-about {
        background: linear-gradient(135deg, #434343, #000000);
    }

    /* Section Padding */
    .section-padding {
        padding: 80px 0;
    }

    /* Modern Typography */
    h1, h2 {
        font-family: 'Poppins', sans-serif;
    }

    h1 {
        font-size: clamp(2.5rem, 6vw, 4rem);
    }

    h2 {
        font-size: clamp(2rem, 5vw, 3rem);
    }

    p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555; /* Default text color */
    }

    /* Image Styling */
    .about-img {
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .about-img:hover {
        transform: scale(1.05);
    }

    /* Icon Styling */
    .icon-box {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .icon-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .icon-box i {
        font-size: 2.5rem;
        color: #6a11cb;
        margin-bottom: 20px;
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        body {
            background-color: #121212;
            color: #ffffff;
        }
        p {
            color: #a0a0a0; /* Light gray for dark mode */
        }
        .icon-box {
            background-color: #1e1e1e;
            color: #ffffff; /* White text in dark mode */
        }
        .bg-light {
            background-color: #1e1e1e !important; /* Dark background for light sections */
            color: #ffffff; /* White text for dark mode */
        }
        .text-muted {
            color: #a0a0a0 !important; /* Light gray for muted text */
        }
    }
</style>

<!-- Header Section -->
<header class="bg-gradient-about py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder mb-4">About Us</h1>
            <p class="lead fw-normal text-white-50 mb-0">Discover the story behind our shop</p>
        </div>
    </div>
</header>

<!-- About Section -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src={{asset('storage/products/1737617576.jpg')}} alt="About Us" class="img-fluid about-img">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">Our Story</h2>
                <p>
                    Welcome to <strong>Shop in Style</strong>, a modern e-commerce platform designed to bring you the latest trends and timeless classics. 
                    This project was developed entirely by <strong>Fathy Abdelkader</strong>, a passionate backend Laravel developer, who single-handedly 
                    built the entire system from scratch. From the ground up, implemented the core features, including product management, 
                    categories, a seamless shopping cart, and a secure authentication system.
                </p>
                <p>
                    The goal of this platform is to provide a smooth and enjoyable shopping experience for users, combining style, functionality, 
                    and ease of use. Every aspect of this project reflects dedication to clean code, robust architecture, and user-centric design.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                <img src={{asset('storage/products/1737617576.jpg')}} alt="Our Mission" class="img-fluid about-img">
            </div>
            <div class="col-lg-6 order-lg-1">
                <h2 class="mb-4">Our Mission</h2>
                <p>
                    At <strong>Shop in Style</strong>, our mission is to redefine the online shopping experience by offering a platform that is not only 
                    visually appealing but also highly functional. The sole developer behind this project has ensured that every 
                    feature is built with precision and care. From the intuitive user interface to the robust backend systems, this platform is designed 
                    to make shopping effortless and enjoyable.
                </p>
                <p>
                    We strive to create a community where fashion meets technology, and every interaction on the platform is seamless and satisfying.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Developer Section -->
<section class="section-padding">
    <div class="container">
        <h2 class="text-center mb-5">Meet the Developer</h2>
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <img src={{asset('storage/products/IMG-20240819-WA0024.jpg')}} alt="Fathy Abdelkader" class="rounded-circle mb-3" style="width: 250px; height: 250px;">
                <h3>Fathy Abdelkader</h3>
                <p class="text-muted">Backend Laravel Developer</p>
                <p>
                    Iam a skilled backend developer with a passion for building robust and scalable web applications. 
                    For this project, i worked independently to design and implement the entire system, including:
                </p>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check-circle me-2"></i>User Authentication System</li>
                    <li><i class="bi bi-check-circle me-2"></i>Product and Category Management</li>
                    <li><i class="bi bi-check-circle me-2"></i>Shopping Cart Functionality</li>
                    <li><i class="bi bi-check-circle me-2"></i>Database Design and Optimization</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Technologies Section -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Technologies Used</h2>
        <div class="row">
            <!-- Laravel -->
            <div class="col-md-4 mb-4">
                <div class="icon-box">
                    <i class="bi bi-code-slash"></i>
                    <h3>Laravel</h3>
                    <p>The backbone of this project, Laravel was used to build a robust and scalable backend.</p>
                </div>
            </div>
            <!-- Bootstrap -->
            <div class="col-md-4 mb-4">
                <div class="icon-box">
                    <i class="bi bi-layout-wtf"></i>
                    <h3>Bootstrap</h3>
                    <p>For a responsive and modern frontend design, Bootstrap was the framework of choice.</p>
                </div>
            </div>
            <!-- MySQL -->
            <div class="col-md-4 mb-4">
                <div class="icon-box">
                    <i class="bi bi-database"></i>
                    <h3>MySQL</h3>
                    <p>MySQL was used for database management, ensuring efficient data storage and retrieval.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Values Section -->
<section class="section-padding">
    <div class="container">
        <h2 class="text-center mb-5">Our Values</h2>
        <div class="row">
            <!-- Quality -->
            <div class="col-md-4 mb-4">
                <div class="icon-box">
                    <i class="bi bi-star-fill"></i>
                    <h3>Quality</h3>
                    <p>We prioritize quality in every product, ensuring durability and satisfaction.</p>
                </div>
            </div>
            <!-- Sustainability -->
            <div class="col-md-4 mb-4">
                <div class="icon-box">
                    <i class="bi bi-globe"></i>
                    <h3>Sustainability</h3>
                    <p>We are committed to eco-friendly practices and sustainable sourcing.</p>
                </div>
            </div>
            <!-- Customer Focus -->
            <div class="col-md-4 mb-4">
                <div class="icon-box">
                    <i class="bi bi-people-fill"></i>
                    <h3>Customer Focus</h3>
                    <p>Your satisfaction is our top priority. We listen, adapt, and deliver.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
{{-- <section class="section-padding bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Meet Our Team</h2>
        <div class="row">
            <!-- Team Member 1 -->
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <img src="https://via.placeholder.com/150" alt="Team Member" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                    <h3>John Doe</h3>
                    <p class="text-muted">Founder & CEO</p>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <img src="https://via.placeholder.com/150" alt="Team Member" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                    <h3>Jane Smith</h3>
                    <p class="text-muted">Creative Director</p>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <img src="https://via.placeholder.com/150" alt="Team Member" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                    <h3>Mike Johnson</h3>
                    <p class="text-muted">Head of Operations</p>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection