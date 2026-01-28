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
        <title>HopeS - Volunteer</title>
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
                        <a href="aboutus.php" class="nav_link">About Us</a>
                        <a href="campaigns.php" class="nav_link">Campaigns</a>
                        <a href="volunteer.php" class="nav_link active">Volunteer</a>
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
                <h1>Our Community</h1>
                <p>We’re here to grow and contribute to help out people.</p>
            </div>
        </div>
        <!-- Volunteer Information Section -->
        <section class="volunteer-section">
            <!-- Intro -->
            <div class="volunteer-intro">
                <h2 class="title">Our Past Volunteering Activities</h2>
                <p class="subtitle">Choose from our curated volunteer opportunities.</p>
                <p class="vol-paragraph">Choose from our curated volunteer opportunities to make an impact in your community. Volunteering helps develop important skills and builds a strong sense of community. Choose from our curated volunteer opportunities to make an impact in your community. Volunteering helps develop important skills and builds a strong sense of community.</p>
            </div>
            <!-- Gallery -->
            <div class="volunteer-gallery">
                <div class="gallery-item large">
                    <a href="images/vol1.jpg" target="_blank" rel="noopener noreferrer">
                        <img src="images/vol1.jpg" alt="Event 1" />
                        <div class="volunteer-overlay"></div>
                    </a>
                </div>
                <div class="gallery-item small">
                    <a href="images/vol2.jpg" target="_blank" rel="noopener noreferrer">
                        <img src="images/vol2.jpg" alt="Event 2" />
                        <div class="volunteer-overlay"></div>
                    </a>
                </div>
                <div class="gallery-item medium">
                    <a href="images/vol3.jpg" target="_blank" rel="noopener noreferrer">
                        <img src="images/vol3.jpg" alt="Event 3" />
                        <div class="volunteer-overlay"></div>
                    </a>
                </div>
                <div class="gallery-item medium">
                    <a href="images/vol4.jpg" target="_blank" rel="noopener noreferrer">
                        <img src="images/vol4.jpg" alt="Event 4" />
                        <div class="volunteer-overlay"></div>
                    </a>
                </div>
                <div class="gallery-item small">
                    <a href="images/vol5.jpg" target="_blank" rel="noopener noreferrer">
                        <img src="images/vol5.jpg" alt="Event 5" />
                        <div class="volunteer-overlay"></div>
                    </a>
                </div>
            </div>
            <!-- Volunteer Call to Action Box Section -->
            <div class="volunteer-cta-box">
                <div class="cta-header">
                    <h2 class="start-title">Start Volunteering in 3 Simple Steps</h2>
                    <p class="follow-subtitle">Follow these steps to get involved and make a difference.</p>
                </div>
                <div class="volunteer-steps">
                    <div class="step">
                        <div class="icon"><i class="fas fa-hand-pointer"></i></div>
                        <h3>Step 1</h3>
                        <p>Click the <strong>Volunteer Now</strong> button below.</p>
                    </div>
                    <div class="step">
                        <div class="icon"><i class="fas fa-pen"></i></div>
                        <h3>Step 2</h3>
                        <p>Fill out the form with your details and interests.</p>
                    </div>
                    <div class="step">
                        <div class="icon"><i class="fas fa-check-circle"></i></div>
                        <h3>Step 3</h3>
                        <p>Submit and wait for confirmation to start volunteering.</p>
                    </div>
                </div>
                <div class="volunteer-button-container">
                    <a href="volunteerform.php" class="btn-volunteer">Volunteer Now</a>
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
                        <li><a href="aboutus.php">About Us</a></li>
                        <li><a href="campaigns.php">Campaigns</a></li>
                        <li><a href="volunteer.php" class="active">Volunteer</a></li>
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