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
        <title>HopeS - Privacy Policy</title>
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
                <h1>Privacy Policy</h1>
                <p>We value your privacy and are committed to protecting your personal information.</p>
            </div>
        </div>
        <!-- Privacy Policy Info -->
        <div class="privacy">
            <h2>1. About This Project</h2>
            <p>This website is a personal project developed to demonstrate how a charity and donation platform could work. It is not affiliated with any real organization and is not intended for public or commercial use.</p>
            <p>All data shown on this platform is fictional and used solely for demonstration purposes.</p>
            
            <h2>2. What Information We Simulate</h2>
            <p>This website may simulate user-related features including:</p>
            <ul>
                <li>Usernames and email addresses</li>
                <li>Mock donation records</li>
                <li>Simulated volunteer hours</li>
                <li>Engagement points and achievements</li>
            </ul>
            <p><strong>No real data is collected or stored.</strong></p>
            
            <h2>3. Cookies and Session Storage</h2>
            <p>This platform may use cookies or session storage to simulate features such as login sessions or user preferences. These are used strictly for functional demonstration purposes and do not involve real data tracking.</p>
            
            <h2>4. Data Sharing</h2>
            <p>This website does not share any data with third parties. As no actual data is collected, nothing is sold, stored, or disclosed.</p>
            
            <h2>5. Security</h2>
            <p>Basic front-end security features (like restricted access areas) are implemented to model secure development practices, but this is not a live application and does not use real encryption or authentication.</p>
            
            <h2>6. User Rights</h2>
            <p>As this site does not collect real data, user rights like data access or deletion do not apply. In a real-world context, users would typically have rights over their personal information, including access, correction, and removal.</p>
            
            <h2>7. Contact</h2>
            <p>For questions or feedback regarding this demo site, you may reach us at:</p>
            <ul>
                <li>Email: contact@hopes.org</li>
                <li>Phone: +60 12-345 6789</li>
                <li>Find us on Instagram and Facebook: HopeSCharity</li>
            </ul>
            
            <h2>8. Policy Updates</h2>
            <p>This Privacy Policy may be updated in the future to reflect new features or improved practices.</p>
            
            <div class="note">
                <strong>Note:</strong> This platform is for educational purposes only. No actual donations or personal information are processed.
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
                    <p>50300 Kuala Lumpur,</p>
                    <p>Malaysia</p>
                    <p class="email-id">contact@hopes.org</p>
                    <h4>+60 12-345 6789</h4>
                </div>
                <div class="col">
                    <h3>Links <div class="underline"><span></span></div></h3>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                        <li><a href="campaigns.php">Campaigns</a></li>
                        <li><a href="volunteer.php">Volunteer</a></li>
                        <li><a href="contactus.php">Contact Us</a></li>
                        <li><a href="privacypolicy.php" class="active">Privacy Policy</a></li>
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
