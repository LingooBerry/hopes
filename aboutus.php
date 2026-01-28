<?php
session_start();
$link = isset($_SESSION['user_id']) ? 'user.php' : 'loginhopes.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>HopeS - About Us</title>
        <link rel="icon" href="images/logo.jpg"/>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    </head>
    <body>
        <!-- Header -->
        <header class="header">
            <nav class="nav">
                <img src="images/logo.jpg" class="header-logo">
                <ul class="nav_items">
                    <li class="nav_item">
                        <a href="home.php" class="nav_link">Home</a>
                        <a href="aboutus.php" class="nav_link active">About Us</a>
                        <a href="campaigns.php" class="nav_link">Campaigns</a>
                        <a href="volunteer.php" class="nav_link">Volunteer</a>
                        <a href="contactus.php" class="nav_link">Contact Us</a>
                    </li>
                </ul>
                <a href="<?php echo $link; ?>" class="user-icon">
                    <i class="fa-solid fa-user"></i>
                </a>
            </nav>
        </header>
        <!-- Banner section -->
        <div class="interactive-banner">
            <div class="simple-banner">
                <h1>About Us</h1>
                <p>Discover who we are, what drives us, and how we’ve touched lives through our stories and events.</p>
            </div>
        </div>
        <!-- Intro of the Organization section -->
        <section class="organization-section">
            <div class="organization-text">
                <h2 class="title">Our Purpose</h2>
                <p>From humble beginnings to where we are today, our journey has been filled with moments of change and impact.
                    Whether it’s providing meals for struggling families, offering shelter to those without a home, or
                    uplifting communities through education and support, every step we take reflects the power of unity and care in action.</p>
                <p>We believe in a future where no one is left behind where kindness creates real change and every person has 
                    a chance to live with dignity. This is the vision that guides us. Therefore, our mission is to come together to support
                    those in need, create opportunities for growth, and make a lasting difference through simple yet meaningful acts of giving.</p>
            </div>
            <div class="introduction-gallery">
                <img src="images/aboutus1.jpg" alt="Image 1" class="gallery-img img1">
                <img src="images/aboutus2.jpg" alt="Image 2" class="gallery-img img2">
                <img src="images/aboutus3.jpg" alt="Image 3" class="gallery-img img3">
            </div>
        </section>

        <!-- Our Past Events Section -->
        <section class="stories-section">
            <div class="stories-container">
                <h2 class="title">Our Past Events</h2>
                <p class="subtitle">Discover the impact of donations and volunteer efforts and how they unite to bring our mission to life.</p>
                <div class="card-grid">
                    <!-- Card 1 -->
                    <div class="story-card">
                        <a href="story1.php" class="stories-image-link">
                            <div class="stories-image-overlay"></div>
                            <img src="images/aboutstory1.jpg" alt="Story 1" class="stories-image">
                        </a>
                        <div class="stories-content">
                            <h3 class="stories-title">Opening Doors to Education</h3>
                            <p class="stories-summary">With support from donors and volunteers, we provided school supplies and tuition aid to orphans across Malaysia.</p>
                            <a href="story1.php" class="read-more-button">Read More</a>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="story-card">
                        <a href="story2.php" class="stories-image-link">
                            <div class="stories-image-overlay"></div>
                            <img src="images/aboutstory2.jpg" alt="Story 2" class="stories-image">
                        </a>
                        <div class="stories-content">
                            <h3 class="stories-title">Feeding Hope, One Family at a Time</h3>
                            <p class="stories-summary">Volunteers and donors worked together to deliver food and essentials to families in B40 communities, bringing comfort and dignity.</p>
                            <a href="story2.php" class="read-more-button">Read More</a>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="story-card">
                        <a href="story3.php" class="stories-image-link">
                            <div class="stories-image-overlay"></div>
                            <img src="images/aboutstory3.jpg" alt="Story 3" class="stories-image">
                        </a>
                        <div class="stories-content">
                            <h3 class="stories-title">Healing Hearts in Times of Crisis</h3>
                            <p class="stories-summary">With the help of generous donors, we helped provide urgent medical care to those in need which is a true act of compassion.</p>
                            <a href="story3.php" class="read-more-button">Read More</a>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="story-card">
                        <a href="story4.php" class="stories-image-link">
                            <div class="stories-image-overlay"></div>
                            <img src="images/aboutstory4.jpg" alt="Story 4" class="stories-image">
                        </a>
                        <div class="stories-content">
                            <h3 class="stories-title">Restoring Hope Together</h3>
                            <p class="stories-summary">With the help of volunteers and donors, we sheltered displaced families in Malaysia through donation efforts.</p>
                            <a href="story4.php" class="read-more-button">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Photo Gallery -->
        
        <!-- About Us CTA Section -->
        <section class="cta-about-section">
            <div class="cta-about-box">
                <div class="cta-column column-one">
                    <h2 class="cta-title">Together We Can</h2>
                    <p>Help spread the word and walk with us as we support communities in need. Every voice, every share, and every step forward brings hope to more lives</p>
                </div>
                <div class="cta-column column-two">
                    <h2>Make a Difference</h2>
                    <p>You make a difference and remind them they’re valued.</p>
                    <a href="campaigns.php" class="cta-button primary">Donate Now</a>
                </div>
                <div class="cta-column column-three">
                    <h2>Volunteer With Us</h2>
                    <p>Stand with us to bring hope. Every hand matters.</p>
                    <a href="volunteer.php" class="cta-button secondary">Volunteer Now</a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col">
                    <img src="images/footerlogo.jpg" class="footer-logo">
                    <p>Your support helps us reach more people in need. Join us to create real change through donations and care.</p>
                    <br>
                    <p>Monday - Saturday</p>
                    <p>9:00 a.m. - 6:00 p.m.</p>
                </div>
                <div class="col">
                    <h3>Location <div class="underline"><span></span></div></h3>
                    <p>HopeS, Lot 19</p>
                    <p>Jalan Damai Kasih,</p>
                    <p>56000 Kuala Lumpur,</p>
                    <p>Malaysia</p>
                    <p class="email-id">hopes@gmail.com</p>
                    <h4>+60 12-345 6789</h4>
                </div>
                <div class="col">
                    <h3>Links <div class="underline"><span></span></div></h3>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="aboutus.php" class="active">About Us</a></li>
                        <li><a href="campaigns.php">Campaigns</a></li>
                        <li><a href="volunteer.php">Volunteer</a></li>
                        <li><a href="contactus.php">Contact Us</a></li>
                        <li><a href="privacypolicy.php">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h3>Newsletter <div class="underline"><span></span></div></h3>
                    <form class="newsletter">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Enter your email" required>
                        <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                    </form>
                    <div class="social-icons">
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                </div>
            </div>
            <hr>
            <p class="copyright">&copy;2025 HopeS. All Rights Reserved.</p>
        </footer>
        <script src="script.js"></script>
    </body>
</html>