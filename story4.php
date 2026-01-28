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
        <title>HopeS - Restoring Hope Together</title>
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
                <h1>Restoring Hope Together</h1>
                <p>Explore our meaningful journey and the impact we have made together.</p>
            </div>
        </div>
        <!-- Story content -->
        <div class="story-wrapper">
            <div class="story-container">
                <div class="story-text-box">
                    <h1>Sheltering Families and Strengthening Communities</h1>
                    <p>With the generous support of donors and the dedication of volunteers, we have been able to provide shelter to displaced
                        families across Malaysia who urgently need a safe home. Many communities here face housing insecurity, and through
                        focused donation efforts, we strive to bring relief and stability to these vulnerable families during challenging times.</p>
                    <p>In Malaysia, our hands-on approach allows us to be directly involved in delivering aid and support to those affected by
                        displacement and poverty. Thanks to the generosity of our donors and the commitment of our volunteers, we provide
                        necessities such as temporary shelter, food, and essential services to families in need across various regions.</p>
                    <p>While each community’s challenges may differ, the compassion, solidarity, and commitment behind every effort remain
                        the same. We believe that by working together, we can bring hope and restoration to families in crisis throughout
                        Malaysia, inspiring more people to join this mission of mercy and support.</p>
                        <a href="aboutus.php" class="back-link">← Back to Overview</a>
                </div>
                <div class="story-image">
                    <a href="images/aboutus.jpg" target="_blank" class="story-image-link">
                        <div class="story-image-overlay">
                            <img src="images/aboutstoryin4.jpg" alt="Restoring Hope Together" />
                            <div class="story-hover-overlay"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
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
                        <li><a href="campaigns.php">Donate</a></li>
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