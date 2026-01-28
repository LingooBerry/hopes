<?php
session_start();
$link = isset($_SESSION['user_id']) ? 'user.php' : 'loginhopes.php';

?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Check if causes have already been inserted in this session
    if (!sessionStorage.getItem("causesInserted")) {
        fetch('insertcauses.php')
            .then(response => response.text())
            .then(data => {
                console.log(data); // Optional: for debugging
                if (data.includes("successfully")) {
                    // Show SweetAlert once
                    Swal.fire({
                        icon: 'success',
                        title: 'Causes Added',
                        text: 'Default causes have been inserted successfully.',
                        timer: 2500,
                        showConfirmButton: false
                    });
                    sessionStorage.setItem("causesInserted", "true");
                } else {
                    // You may hide or silently fail
                    console.error("Failed to insert causes.");
                }
            })
            .catch(err => console.error("Insert error:", err));
        }
});
</script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>HopeS - Home</title>
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
                        <a href="home.php" class="nav_link active">Home</a>
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
        <div class="main-content">
            <!-- Homepage Hero Slider Section -->
            <section class="heroslider-section" id="slider">
                <!-- Slide 1 -->
                <div class="slide active" style="background-image: url('images/homehero1.jpg');">
                    <div class="slide-content">
                        <h1>Strengthen Local Communities in Malaysia</h1>
                        <p>Turn compassion into action. Join us in making a real difference through your time, effort, or contribution.</p>
                        <div class="herobuttons">
                            <a href="campaigns.php" style="text-decoration: none;">
                                <button class="primary">Donate Now</button>
                            </a>
                            <a href="volunteerform.php" style="text-decoration: none;">
                                <button class="secondary">Volunteer Now</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="slide" style="background-image: url('images/homehero2.jpg');">
                    <div class="slide-content">
                        <h1>Empowering Orphans Through Education</h1>
                        <p>Help provide school supplies, tuition, and learning support to orphaned children in Malaysia so they can build a better future.</p>
                        <div class="herobuttons">
                            <a href="campaigns.php" style="text-decoration: none;">
                                <button class="primary">Donate Now</button>
                            </a>
                            <a href="volunteerform.php" style="text-decoration: none;">
                                <button class="secondary">Volunteer Now</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="slide" style="background-image: url('images/homehero3.jpg');">
                    <div class="slide-content">
                        <h1>Hope and Healing for Gaza</h1>
                        <p>Give hope to displaced families by contributing.</p>
                        <div class="herobuttons">
                            <a href="campaigns.php" style="text-decoration: none;">
                                <button class="primary">Donate Now</button>
                            </a>
                            <a href="volunteerform.php" style="text-decoration: none;">
                                <button class="secondary">Volunteer Now</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Arrows -->
                <button class="arrow left" onclick="prevSlide()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="arrow right" onclick="nextSlide()">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <!-- Pagination Dots -->
                <div class="pagination" id="pagination"></div>
            </section>
            
            <!-- Homepage Impact Stats Section-->
            <section class="impact-stats">
                <div class="impact-stats-overlay"></div>
                <div class="impact-stats-container">
                    <div class="stats-grid">
                        <div class="stat">
                            <h2 class="count-wrapper">
                                <span class="count" data-target="8">0</span>
                            </h2>
                            <p>Campaigns</p>
                        </div>
                        <div class="stat">
                            <h2 class="count-wrapper">
                                <span class="count" data-target="500">0</span>
                                <i class="fas fa-plus plus-icon"></i>
                            </h2>
                            <p>People Helped</p>
                        </div>
                        <div class="stat">
                            <h2 class="count-wrapper">
                                <span class="count" data-target="50">0</span>
                                <i class="fas fa-plus plus-icon"></i>
                            </h2>
                            <p>Volunteers</p>
                        </div>
                        <div class="stat">
                            <h2 class="count-wrapper">
                                <span class="count" data-target="2">0</span>
                            </h2>
                            <p>Countries</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Homepage Missions Section -->
            <section class="mission-section">
                <div class="mission-header">
                    <h2 class="title">Our Missions</h2>
                    <p class="subtitle">We are dedicated to helping those in need, making a difference, and supporting communities to thrive.</p>
                </div>
                <div class="mission-cards">
                    <!-- Mission Card 1 -->
                     <div class="mission-card">
                        <div class="icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Helping Those in Need</h3>
                        <p>We are here to provide quick support like food, shelter, and medical care to people going through tough times.</p>
                    </div>
                    <!-- Mission Card 2 -->
                    <div class="mission-card">
                        <div class="icon">
                            <i class="fa-solid fa-earth-asia"></i>
                        </div>
                        <h3>Making a Real Difference</h3>
                        <p>We want to help vulnerable families and individuals get the basic things they need and hope for a better tomorrow.</p>
                    </div>
                    <!-- Mission Card 3 -->
                    <div class="mission-card">
                        <div class="icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h3>Supporting Communities</h3>
                        <p>Our goal is to support education, health, and opportunities so communities can build a stronger future.</p>
                    </div>
                </div>
            </section>
            
            <!-- Homepage About Us Section -->
            <section class="home-about">
                <div class="container-home-about">
                    <div class="row-home-about">
                        <div class="col-home-about">
                            <div class="text-home-about">
                                <h2 class="title">About Us</h2>
                                <p class="subtitle">We Are On A Mission To Help People</p>
                                <p>We are committed to making a real difference by supporting those in need and helping communities grow stronger. Through charitable actions and community engagement, we aim to create a positive impact that improves lives for everyone.</p>
                                <a href="aboutus.php" class="btn-home-about">Learn More</a>
                            </div>
                        </div>
                        <div class="col-home-about">
                            <div class="home-about-image">
                                <img src="images/abouthome.jpg" alt="Charity Image" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Homepage Our Causes section -->
            <section class="latest-causes">
                <div class="mission-header">
                    <h2 class="title">Recent Campaigns</h2>
                    <p class="subtitle">We are taking action on the issues that matter most to communities in need.</p>
                </div>
                <div class="causes-grid">
                    <?php
                    require_once 'database.php'; 
                    $stmt = $db->query("SELECT * FROM CAUSES ORDER BY id DESC LIMIT 3");
                    if ($stmt->rowCount() > 0):
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                            $progress = $row['goal_amount'] > 0
                            ? round(($row['raised_amount'] / $row['goal_amount']) * 100, 0)
                            : 0;
                            // Determine progress bar color
                            $progressColor = $progress >= 100 ? '#4CAF50' : ($progress >= 50 ? '#2196F3' : '#FF9800');
                            ?>
                            <div class="cause-card" onclick="showDonationMessage(
                            '<?= htmlspecialchars(addslashes($row['title'])) ?>',
                            <?= $progress ?>,
                            <?= $row['goal_amount'] ?>,
                            <?= $row['raised_amount'] ?>
                            )">
                            <a href="donatecampaign.php?cause_id=<?= $row['id'] ?>">
                                <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="cause-image" />
                            </a>
                            <div class="cause-content">
                                <div class="cause-title"><?= htmlspecialchars($row['title']) ?></div>
                                <div class="progress-wrapper">
                                    <div class="progress-percentage"><?= $progress ?>%</div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: <?= $progress ?>%; background-color: <?= $progressColor ?>;">
                                    </div>
                                </div>
                            </div>
                            <div class="funds-info">
                                <span class="raised-campaign">Raised: RM<?= number_format($row['raised_amount'], 2) ?></span>
                                <span class="goal-campaign">Goal: RM<?= number_format($row['goal_amount'], 2) ?></span>
                            </div>
                            <a href="donatecampaign.php?cause_id=<?= $row['id'] ?>" class="campaign-read-more">Read More</a>
                        </div>
                    </div>
                    <?php
                    endwhile;
                else:
                    echo "<p>No causes available yet.</p>";
                endif;
                ?>
                </div>
                <div class="campaigns-button-wrapper" style="text-align: center; margin-top: 50px;">
                    <a href="campaigns.php" class="contact-submit">See More</a>
                </div>
            </section>
            
            <!-- Homepage Become Volunteer Section -->
            <section class="home-volunteer-banner">
                <div class="home-volunteer-overlay">
                    <div class="home-volunteer-container">
                        <div class="home-volunteer-text">
                            <h2>Become a Volunteer</h2>
                            <p>Join us in using your time and skills to spark real change. Every small act of kindness brings hope to those who need it most.</p>
                        </div>
                        <div class="home-volunteer-action">
                            <a href="volunteer.php" class="home-volunteer-btn">Join Us Now</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Homepage Testimonials Section -->
            <section class="testimonial-heading">
                <h1 class="title">Testimonials</h1>
                <p class="subtitle">Meaningful words from contributors who have walked this journey with us.</p>
            </section>
            <section class="testimonial-slider">
                <button class="slider-arrow left"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow right"><i class="fas fa-chevron-right"></i></button>
                <div class="slide-container">
                    <div class="slide-track" id="slideTrack">
                        <!-- Testimonial Cards -->
                        <div class="slide-testimonial"><div class="card-wrapper"><div class="card-image"><img src="images/profile1.jpg" class="card-img" alt="Nurul Izzah"></div><h2 class="name">Nurul Izzah</h2><p class="job">Social Worker</p><p class="description">Every donation brings hope where it's needed most. I’ve seen struggling families smile again because someone cared enough to give.</p></div></div>
                        <div class="slide-testimonial"><div class="card-wrapper"><div class="card-image"><img src="images/profile2.jpg" class="card-img" alt="Madam Grace Lee"></div><h2 class="name">Madam Grace Lee</h2><p class="job">Retired Teacher</p><p class="description">Even in my old age, I still believe in nurturing others. Supporting these causes has been a beautiful way to continue giving love.</p></div></div>
                        <div class="slide-testimonial"><div class="card-wrapper"><div class="card-image"><img src="images/profile3.jpg" class="card-img" alt="Eric Chan"></div><h2 class="name">Eric Chan</h2><p class="job">Business Consultant</p><p class="description">Being part of this initiative reminds me that success is also about lifting others up. I’m proud to contribute and make a difference together.</p></div></div>
                        <div class="slide-testimonial"><div class="card-wrapper"><div class="card-image"><img src="images/profile4.jpg" class="card-img" alt="Kavitha Raj"></div><h2 class="name">Kavitha Raj</h2><p class="job">High School Educator</p><p class="description">Seeing students from underprivileged backgrounds receive real help brings so much hope. Thank you for making it possible.</p></div></div>
                        <div class="slide-testimonial"><div class="card-wrapper"><div class="card-image"><img src="images/profile5.jpg" class="card-img" alt="Faizal Hakim"></div><h2 class="name">Faizal Hakim</h2><p class="job">Startup Founder</p><p class="description">We often measure success by numbers. But through this charity, I’ve learned that true success is measured by the lives we touch.</p></div></div>
                        <!-- Clones for Infinite Loop -->
                        <div class="slide-testimonial clone"><div class="card-wrapper"><div class="card-image"><img src="images/profile1.jpg" class="card-img" alt="Nurul Izzah"></div><h2 class="name">Nurul Izzah</h2><p class="job">Social Worker</p><p class="description">Every donation brings hope where it's needed most. I’ve seen struggling families smile again because someone cared enough to give.</p></div></div>
                        <div class="slide-testimonial clone"><div class="card-wrapper"><div class="card-image"><img src="images/profile2.jpg" class="card-img" alt="Madam Grace Lee"></div><h2 class="name">Madam Grace Lee</h2><p class="job">Retired Teacher</p><p class="description">Even in my old age, I still believe in nurturing others. Supporting these causes has been a beautiful way to continue giving love.</p></div></div>
                        <div class="slide-testimonial clone"><div class="card-wrapper"><div class="card-image"><img src="images/profile3.jpg" class="card-img" alt="Eric Chan"></div><h2 class="name">Eric Chan</h2><p class="job">Business Consultant</p><p class="description">Being part of this initiative reminds me that success is also about lifting others up. I’m proud to contribute and make a difference together.</p></div></div>
                        <div class="slide-testimonial clone"><div class="card-wrapper"><div class="card-image"><img src="images/profile4.jpg" class="card-img" alt="Kavitha Raj"></div><h2 class="name">Kavitha Raj</h2><p class="job">High School Educator</p><p class="description">Seeing students from underprivileged backgrounds receive real help brings so much hope. Thank you for making it possible.</p></div></div>
                        <div class="slide-testimonial clone"><div class="card-wrapper"><div class="card-image"><img src="images/profile5.jpg" class="card-img" alt="Faizal Hakim"></div><h2 class="name">Faizal Hakim</h2><p class="job">Startup Founder</p><p class="description">We often measure success by numbers. But through this charity, I’ve learned that true success is measured by the lives we touch.</p></div></div>
                    </div>
                </div>
                <div id="secondPagination"></div>
            </section>
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
                    <p class="email-id">contact@hopes.org</p>
                    <h4>+60 12-345 6789</h4>
                </div>
                <div class="col">
                    <h3>Links <div class="underline"><span></span></div></h3>
                    <ul>
                        <li><a href="home.php" class="active">Home</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
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



 