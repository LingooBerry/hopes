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
        <title>HopeS - Feeding Hope, One Family at a Time</title>
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
                <h1>Feeding Hope, One Family at a Time</h1>
                <p>Explore our meaningful journey and the impact we have made together.</p>
            </div>
        </div>
        <!-- Story content -->
        <div class="story-wrapper">
            <div class="story-container">
                <div class="story-text-box">
                    <h1>Bringing Hope Through Every Meal</h1>
                    <p>On 10 April 2025, we launched our “Feeding Hope, One Family at a Time” outreach as part of our commitment to the Zero
                        Hunger goal in Malaysia. Many B40 families continue to face the daily burden of food insecurity and unsure of when their
                        next meal will come or how to provide for their children. With rising living costs and unstable incomes, the need for
                        food assistance has grown more urgent than ever. Through the combined efforts of generous donors and dedicated
                        volunteers, we were able to distribute essential groceries and nutritious food packs to over 250 families in need
                        across underserved communities.</p>
                    <p>Our volunteers went beyond delivering food which they offered kindness, listened to families’ stories, and provided
                        encouragement during difficult times. Donors, both individuals and organizations, stepped up to fund the program,
                        showing how compassion and generosity can directly address one of the most basic human needs. Together,
                        their contributions restored not just physical nourishment but also a sense of dignity and care.</p>
                    <p>By sharing these stories of impact and collaboration, we hope to show how personal values such as empathy and justice
                        which can align with a greater cause. When trust is built through real, visible change, it motivates more people to get
                        involved. As we continue to fight hunger in Malaysia, we invite more hearts to stand with us.</p>
                        <a href="aboutus.php" class="back-link">← Back to Overview</a>
                </div>
                <div class="story-image">
                    <a href="images/aboutus.jpg" target="_blank" class="story-image-link">
                        <div class="story-image-overlay">
                            <img src="images/aboutstoryin2.jpg" alt="Feeding Hope, One Family at a Time" />
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