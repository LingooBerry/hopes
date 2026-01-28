<?php
session_start();
include 'database.php'; // This defines $db PDO connection
$link = isset($_SESSION['user_id']) ? 'user.php' : 'loginhopes.php';
$cause_id = isset($_GET['cause_id']) ? intval($_GET['cause_id']) : 0;

if ($cause_id <= 0) {
    header("Location: campaigns.php");
    exit();
}

// Fetch cause data from database using $db
$sql = "SELECT * FROM CAUSES WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$cause_id]);
$cause = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cause) {
    // Redirect if cause not found
    header("Location: campaigns.php");
    exit();
}

$progress = $cause['goal_amount'] > 0
? round(($cause['raised_amount'] / $cause['goal_amount']) * 100, 0)
: 0;
    
// Determine progress bar color
$progressColor = $progress >= 100 ? '#4CAF50' : ($progress >= 50 ? '#2196F3' : '#FF9800');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>HopeS - Donate Campaign</title>
        <link rel="icon" href="images/logo.jpg"/>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
        <style>
        .progress-bar {
            width: 100%;
            background-color: #e0e0e0;
            height: 10px;
            border-radius: 5px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            transition: width 0.6s ease-in-out;
        }
        </style>
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
                        <a href="campaigns.php" class="nav_link active">Campaigns</a>
                        <a href="volunteer.php" class="nav_link">Volunteer</a>
                        <a href="contactus.php" class="nav_link">Contact Us</a>
                    </li>
                </ul>
                <a href="<?php echo $link; ?>" class="user-icon">
                    <i class="fa-solid fa-user"></i>
                </a>
            </nav>
        </header>
        
        <!-- Donate Campaign Page -->
        <section class="o-campaign">
            <h1 class="campaign-title"><?= htmlspecialchars($cause['title']) ?></h1>
            <div class="campaign-content">
                <!-- Left: Image & Organizer Info -->
                <div class="campaign-image">
                    <img src="<?= htmlspecialchars($cause['image_path']) ?>" alt="Campaign" class="campaign-main-image">
                    <div class="organizer-info">
                        <img src="images/logo.jpg" alt="Organizer Profile" class="organizer-avatar">
                        <div><strong>HopeS.org</strong> is organizing this campaign</div>
                    </div>
                    <hr class="campaign-line">
                    <div class="education-description">
                        <?= $cause['description'] ?>
                    </div>
                    <div class="organizer-section">
                        <h3>Organizer</h3>
                        <div class="organizer-info">
                            <img src="images/logo.jpg" alt="HopeS.Org" class="organizer-avatar">
                            <div>
                                <div><strong>HopeS.org</strong></div>
                                <div>Malaysia</div>
                            </div>
                        </div>
                        <a href="contactus.php" class="contact-button">Contact</a>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <aside class="campaign-sidebar">
                    <div class="raised-amount">RM<?= number_format($cause['raised_amount'], 2) ?> raised</div>
                    <div class="goal-amount">
                        of RM<?= number_format($cause['goal_amount'], 2) ?> goal • 
                        <span class="donation-count">
                            <?php
                            $count_sql = "SELECT COUNT(*) as donation_count FROM DONATIONS WHERE cause_id = ?";
                            $count_stmt = $db->prepare($count_sql);
                            $count_stmt->execute([$cause_id]);
                            $donation_count = $count_stmt->fetch(PDO::FETCH_ASSOC)['donation_count'];
                            echo $donation_count . " donation" . ($donation_count != 1 ? "s" : "");
                            ?>
                        </span>
                    </div>
                    <div class="progress-wrapper">
                        <div class="progress-percentage"><?= $progress ?>%</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= $progress ?>%; background-color: <?= $progressColor ?>;"></div>
                        </div>
                    </div>
                    <a href="process_donation.php?cause_id=<?= $cause_id ?>" class="donate-button">Donate Now</a>
                    
                    <!-- Share Icons -->
                    <div class="share-section">
                        <span class="share-label">Share:</span>
                        <div class="share-icons">
                            <a href="https://www.facebook.com" onclick="shareOnFacebook()" title="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.whatsapp.com/" onclick="shareOnWhatsApp()" title="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" onclick="copyCampaignLink()" title="Copy campaign link"><i class="fas fa-link"></i></a>
                        </div>
                    </div>
                </aside>
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
                    <p>50300 Kuala Lumpur</p>
                    <p>Malaysia</p>
                    <p class="email-id">hopes@gmail.com</p>
                    <h4>+60 12-345 6789</h4>
                </div>
                <div class="col">
                    <h3>Links <div class="underline"><span></span></div></h3>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                        <li><a href="campaigns.php active">Campaigns</a></li>
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
        
        <script>
        function shareOnFacebook() {
            window.open("https://www.facebook.com/sharer/sharer.php?u=" + window.location.href, '_blank');
        }

        function shareOnWhatsApp() {
            window.open("https://wa.me/?text=" + encodeURIComponent(window.location.href), '_blank');
        }

        function copyCampaignLink() {
            navigator.clipboard.writeText(window.location.href)
                .then(() => alert("Campaign link copied to clipboard!"))
                .catch(err => alert("Failed to copy: " + err));
        }
        </script>
    </body>
</html>