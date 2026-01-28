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
        <title>HopeS - Healing Hearts in Times of Crisis</title>
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
                <h1>Healing Hearts in Times of Crisis</h1>
                <p>Explore our meaningful journey and the impact we have made together.</p>
            </div>
        </div>
        <!-- Story content -->
        <div class="story-wrapper">
            <div class="story-container">
                <div class="story-text-box">
                    <h1>Extending Hope Through Medical Relief</h1>
                    <p>On 10 April 2025, we launched our “Healing Hearts in Time of Crisis” outreach to support families in Malaysia
                        struggling to access medical care. While many families in Gaza face the horrors of war, some B40 communities
                        in Malaysia are unable to afford even basic medical treatment. With rising living costs and unstable incomes,
                        the need for medical assistance has become more urgent than ever. Thanks to the combined efforts of generous
                        donors and dedicated volunteers, we were able to extend support and provide essential medical aid to those in need
                        across underserved communities.</p>
                    <p>With the help of generous donors, we were also able to provide urgent medical care which is a true act of compassion.
                        In both Malaysia and Gaza, these efforts were made possible entirely through donations. In Malaysia, our support
                        focused on helping families facing medical emergencies. In Gaza, contributions were directed to trusted humanitarian
                        partners working on the ground to reach those affected by conflict. Though the methods differed, the heart behind
                        each act was the same which are the compassion and solidarity in action.</p>
                    <p>By sharing these stories of impact and collaboration, we hope to show how values like empathy and justice can align
                        with a greater purpose. When trust is built through real, visible change, it encourages more people to get involved.
                        As we continue supporting families in need and expanding our medical relief efforts, we invite more hearts to stand
                        with us.</p>
                        <a href="aboutus.php" class="back-link">← Back to Overview</a>
                </div>
                <div class="story-image">
                    <a href="images/aboutus.jpg" target="_blank" class="story-image-link">
                        <div class="story-image-overlay">
                            <img src="images/aboutstory3.jpg" alt="Healing Hearts in Times of Crisis" />
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