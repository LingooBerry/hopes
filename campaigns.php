<?php
session_start();
include 'database.php'; // includes $db PDO connection

$link = isset($_SESSION['user_id']) ? 'user.php' : 'loginhopes.php';

// Check for donation success message
$donation_success = isset($_GET['donation_success']) ? true : false;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>HopeS - Campaigns</title>
        <link rel="icon" href="images/logo.jpg"/>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
        <style>
        .popup-success {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px 30px;
            background-color: #d4edda;
            color: #341557ff;
            border: 2px solid #c3e6cb;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 9999;
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
            
            <!-- Banner section -->
            <div class="interactive-banner">
                <div class="simple-banner">
                    <h1>Current Campaigns</h1>
                    <p>Discover donation campaigns and select the cause that matters most to you.</p>
                </div>
            </div>
            <!-- Latest campaigns -->
            <section class="latest-causes">
                <div class="mission-header">
                    <h2 class="title">Ongoing Campaigns</h2>
                    <p class="subtitle">We are committed to creating meaningful impact through focused action.</p>
                </div>
                <div class="causes-grid">
                    <?php
                    $stmt = $db->query("SELECT * FROM CAUSES ORDER BY id DESC");
                    if ($stmt->rowCount() > 0):
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                            $progress = $row['goal_amount'] > 0
                            ? min(100, round(($row['raised_amount'] / $row['goal_amount']) * 100, 0))
                            : 0;
                            // Determine progress bar color
                            $progressColor = $progress >= 100 ? '#4CAF50' : ($progress >= 50 ? '#2196F3' : '#FF9800');
                            ?>
                            <div class="cause-card" onclick="showDonationMessage('
                            <?= htmlspecialchars(addslashes($row['title'])) ?>',
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
                                        <div class="progress-fill"
                                        style="width: <?= $progress ?>%;
                                        background-color: <?= $progressColor ?>;">
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
                                <li><a href="campaigns.php" class="active">Campaigns</a></li>
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
                <script src="script2.js"></script>
                
                <script>
                function showDonationMessage(campaignName, percentage, goalAmount, raisedAmount) {
                const successPopup = document.createElement('div');
                successPopup.className = 'popup-success';
                // Format amounts with commas
                const formattedRaised = new Intl.NumberFormat().format(raisedAmount);
                const formattedGoal = new Intl.NumberFormat().format(goalAmount);
                
                successPopup.innerHTML = `
                <strong>${campaignName}</strong><br>
                Current Progress: ${percentage}%<br>
                Raised: RM${formattedRaised} of RM${formattedGoal} goal<br><br>
                <a href="donatecampaign.php?cause_id=<?= $row['id'] ?>" style="color: #155724; text-decoration: underline; font-weight: bold;">
                Click here to donate
                </a>
                `;
                
                document.body.appendChild(successPopup);
                // Close popup when clicking anywhere
                document.addEventListener('click', function closePopup() {
                successPopup.remove();
                document.removeEventListener('click', closePopup);
                }, { once: true });
                
                // Also close after 5 seconds
                setTimeout(() => {
                successPopup.remove();
                }, 5000);
                }
                </script>
                
                <!-- Donation Success Popup -->
                <?php if ($donation_success): ?>
                <script>
                window.addEventListener('DOMContentLoaded', () => {
                const successPopup = document.createElement('div');
                successPopup.className = 'popup-success';
                successPopup.innerHTML = `<strong>Thank you!</strong><br>Your donation was successful and the progress has been updated.`;
                document.body.appendChild(successPopup);
                
                setTimeout(() => {
                successPopup.remove();
                }, 4000);
                });
            </script>
        <?php endif; ?>
    </body>
</html>