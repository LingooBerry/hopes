<?php
session_start();
include 'database.php';  // contains the $db PDO connection

// Set the user icon link based on session
$link = isset($_SESSION['user_id']) ? 'user.php' : 'loginhopes.php';

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = trim($_POST['username'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Get user_id if logged in
    $user_id = $_SESSION['user_id'] ?? null;

    try {
        $stmt = $db->prepare("INSERT INTO ENQUIRIES (user_id, Username, Phone, Email, Message) VALUES (:user_id, :username, :phone, :email, :message)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<script>alert('Your enquiry has been sent! Please wait for our response.');</script>";
        } else {
            echo "<script>alert('Enquiry failed. Please try again.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database error: " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>HopeS - Contact Us</title>
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
                        <a href="contactus.php" class="nav_link active">Contact Us</a>
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
                <h1>Get in Touch With Us</h1>
                <p>We’re here to answer your questions and hear your feedback.</p>
            </div>
        </div>
        <!-- FAQ section -->
         <div class="intro-one">
            <p class="title">FAQs</p>
            <p class="subtitle">Everything you need to know about donating, volunteering, and engaging with our platform.</p>
        </div>
        <section class="faq-container">
            <div class="faq">
                <button class="faq-question" onclick="toggleAnswer('answer1', this)">
                    1. Do I need to log in to donate or volunteer?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div id="answer1" class="faq-answer" style="display: none;">
                    <p>Yes. You must be logged into your account to select a cause and make a donation. This helps us track your contributions and award points.</p>
                </div>
            </div>
            <hr class="faq-line">
            <div class="faq">
                <button class="faq-question" onclick="toggleAnswer('answer2', this)">
                    2. How does the point system work?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div id="answer2" class="faq-answer" style="display: none;">
                    <p>You will earn 1 point for every RM1 donated. These points accumulate over time and unlock badge names to recognize your impact and commitment. The minimum donation amount is RM10 per transaction.</p>
                </div>
            </div>
            <hr class="faq-line">
            <div class="faq">
                <button class="faq-question" onclick="toggleAnswer('answer3', this)">
                    3. What is the purpose of the engagement points and levels/tiers?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div id="answer3" class="faq-answer" style="display: none;">
                    <p>Engagement points and levels/tiers help recognize your contributions, motivate ongoing support, build a sense of community, and allow you to track your impact over time. They make the experience more meaningful and rewarding.</p>
                </div>
            </div>
            <hr class="faq-line">
            <div class="faq">
                <button class="faq-question" onclick="toggleAnswer('answer4', this)">
                    4. Is there a limit to how much I can donate or how many times?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div id="answer4" class="faq-answer" style="display: none;">
                    <p>No, there is no upper limit. You can donate as many times as you wish. Each donation of RM10 or more will continue to earn you points even if you’ve already reached the highest badge level. Your continued contributions will still be recorded and appreciated as part of your ongoing impact.</p>
                </div>
            </div>
            <hr class="faq-line">
            <div class="faq">
                <button class="faq-question" onclick="toggleAnswer('answer5', this)">
                    5. Can I cancel a donation after making it?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div id="answer5" class="faq-answer" style="display: none;">
                    <p>No, donations are non-refundable once processed. Please review all details carefully before confirming your donation.</p>
                </div>
            </div>
            <hr class="faq-line">
            <div class="faq">
                <button class="faq-question" onclick="toggleAnswer('answer6', this)">
                    6. Can I choose my area of interest when signing up to volunteer?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div id="answer6" class="faq-answer" style="display: none;">
                    <p>Yes, absolutely! When you sign up as a volunteer, you'll be able to select your preferred area of interest. Based on your selection, a role will be assigned to you.</p>
                </div>
            </div>
            <hr class="faq-line">
            <div class="faq">
                <button class="faq-question" onclick="toggleAnswer('answer7', this)">
                    7. What happens if I miss a volunteering event I signed up for?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div id="answer7" class="faq-answer" style="display: none;">
                    <p>Please inform our team in advance via email if you are unable to attend. Repeated no-shows without notice may affect your eligibility for certain volunteer roles.</p>
                </div>
            </div>
        </section>
        <section class="contact_container">
            <!-- Intro Title and Subtitle -->
            <div class="intro-two">
                <p class="title">Contact Us</p>
                <p class="subtitle">We'd love to hear from you! Reach out with any questions or feedback.</p>
            </div>
            <!-- Contact Info (Icon Row) -->
            <div class="contact-info-inline">
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>HopeS, Lot 19, Jalan Damai Kasih, 56000 Kuala Lumpur, Malaysia</span>
                </div>
                <span class="divider">|</span>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <span><a href="mailto:hopes@gmail.com" class="email-link">contact@hopes.org</a></span>
                </div>
                <span class="divider">|</span>
                <div class="info-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>+60 12-345 6789</span>
                </div>
                <span class="divider">|</span>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span>Mon - Sat: 9AM - 6PM</span>
                </div>
            </div>
            <!-- Contact Form and Map -->
             <div class="contact-section">
                <!-- Contact Form -->
                <div class="form-section">
                    <form id="contactForm" method="post">
                        <div class="row-contact">
                            <div class="input-group-contact">
                                <input type="text" placeholder="" id="name" name="username" required/>
                                <label for="name" class="floating-label">Name</label>
                            </div>
                            <div class="input-group-contact">
                                <input type="tel" id="phone" name="phone" required pattern="^\+?[0-9]{7,15}$" title="Enter a valid phone number." placeholder=""/>
                                <label for="phone" class="floating-label">Phone</label>
                            </div>
                        </div>
                        <div class="input-group-contact full">
                            <input type="email" placeholder=" " id="email" name="email" required/>
                            <label for="email" class="floating-label">Email</label>
                        </div>
                        <div class="input-group-contact full">
                            <textarea id="message" rows="5" placeholder=" " name="message" required></textarea>
                            <label for="message" class="floating-label">Message</label>
                        </div>
                        <button type="submit" class="contact-submit">Submit</button>
                    </form>
                    
                </div>
                <!-- Google Map -->
                 <div class="map-section">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3974.816065028528!2d101.70212581477193!3d3.166756797752531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc37a5abce6d27%3A0xe261c6ea19f8ef5d!2sLot%2019%2C%20Jalan%20Damai%20Kasih%2C%2050300%20Kuala%20Lumpur%2C%20Wilayah%20Persekutuan%20Kuala%20Lumpur%2C%20Malaysia!5e0!3m2!1sen!2sus!4v1691535979000!5m2!1sen!2sus" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
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
                        <li><a href="contactus.php" class="active">Contact Us</a></li>
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
