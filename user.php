<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginhopes.php");
    exit();
}

// Database connection
$db = require_once 'database.php';

// Fetch all donations for the current user
$stmt = $db->prepare("SELECT d.*, c.title as cause_title, c.goal_amount, c.raised_amount 
                     FROM DONATIONS d 
                     JOIN CAUSES c ON d.cause_id = c.id 
                     WHERE d.user_id = :user_id 
                     ORDER BY d.Donation_date DESC");
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$donations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total donations and engagement points
$totalDonations = array_sum(array_column($donations, 'Amount'));
$engagementPoints = $totalDonations; // 1 RM = 1 point

// Determine engagement level
$engagementLevel = 'New Donor';
$nextLevel = 'Supporter';
$pointsNeeded = 100 - $engagementPoints;
$progressPercentage = ($engagementPoints / 100) * 100;

if ($engagementPoints >= 5000) {
    $engagementLevel = 'Hope Builder';
    $nextLevel = '';
    $pointsNeeded = 0;
    $progressPercentage = 100;
} elseif ($engagementPoints >= 3600) {
    $engagementLevel = 'Legacy';
    $nextLevel = 'Hope Builder';
    $pointsNeeded = 5000 - $engagementPoints;
    $progressPercentage = (($engagementPoints - 3600) / 1400) * 100;
} elseif ($engagementPoints >= 2800) {
    $engagementLevel = 'Guardian';
    $nextLevel = 'Legacy';
    $pointsNeeded = 3600 - $engagementPoints;
    $progressPercentage = (($engagementPoints - 2800) / 800) * 100;
} elseif ($engagementPoints >= 2100) {
    $engagementLevel = 'Core Champion';
    $nextLevel = 'Guardian';
    $pointsNeeded = 2800 - $engagementPoints;
    $progressPercentage = (($engagementPoints - 2100) / 700) * 100;
} elseif ($engagementPoints >= 1500) {
    $engagementLevel = 'Sustainer';
    $nextLevel = 'Core Champion';
    $pointsNeeded = 2100 - $engagementPoints;
    $progressPercentage = (($engagementPoints - 1500) / 600) * 100;
} elseif ($engagementPoints >= 1000) {
    $engagementLevel = 'Loyal Contributor';
    $nextLevel = 'Sustainer';
    $pointsNeeded = 1500 - $engagementPoints;
    $progressPercentage = (($engagementPoints - 1000) / 500) * 100;
} elseif ($engagementPoints >= 600) {
    $engagementLevel = 'Committed Backer';
    $nextLevel = 'Loyal Contributor';
    $pointsNeeded = 1000 - $engagementPoints;
    $progressPercentage = (($engagementPoints - 600) / 400) * 100;
} elseif ($engagementPoints >= 300) {
    $engagementLevel = 'Ally';
    $nextLevel = 'Committed Backer';
    $pointsNeeded = 600 - $engagementPoints;
    $progressPercentage = (($engagementPoints - 300) / 300) * 100;
} elseif ($engagementPoints >= 100) {
    $engagementLevel = 'Supporter';
    $nextLevel = 'Ally';
    $pointsNeeded = 300 - $engagementPoints;
    $progressPercentage = (($engagementPoints - 100) / 200) * 100;
} else {
    $engagementLevel = 'New Donor';
    $nextLevel = 'Supporter';
    $pointsNeeded = 100 - $engagementPoints;
    $progressPercentage = ($engagementPoints / 100) * 100;
}
$username = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>HopeS - User Profile Dashboard</title>
        <link rel="icon" href="images/logo.jpg"/>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
        <style>
            /* Base Styles */
            :root {
                --accent-color: #ff5722;          /* Bright orange for CTA or highlights */
                --light-gray: #fafafa;            /* Very light background */
                --medium-gray: #d6d6d6;           /* Neutral for borders and muted elements */
                --dark-gray: #444444;             /* For primary text */
                --white: #ffffff;                 /* Standard white */
                --shadow: 0 4px 6px rgba(0, 0, 0, 0.15); /* Slightly darker for depth */
                --transition: all 0.3s ease;      /* Smooth transitions */
            }
            body {
                line-height: 1.6;
                color: #333;
                background-color: #f9f9f9;
                margin: 0;
                padding: 0;
            }
            
            /* User Banner */
            .user-banner {
                background: linear-gradient(135deg, var(--secondary-color), var(--secondary-color));
                color: white;
                padding: 2rem;
                margin: 2rem auto;
                max-width: 1200px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                box-shadow: var(--shadow);
            }
            
            .user-icon-profile {
                font-size: 3.5rem;
                margin-right: 1.5rem;
                color: white;
            }
            
            .user-details {
                flex: 1;
            }
            
            .user-name {
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 0.3rem;
            }
            
            .user-tier {
                background-color: rgba(255, 255, 255, 0.2);
                padding: 0.3rem 0.8rem;
                border-radius: 20px;
                font-size: 0.9rem;
                display: inline-block;
            }
            
            .user-impact {
                text-align: center;
                padding: 0 1.5rem;
                border-left: 1px solid rgba(255, 255, 255, 0.3);
            }
            
            .impact-amount {
                font-size: 2rem;
                font-weight: bold;
                margin-bottom: 0.3rem;
            }
            
            .impact-label {
                font-size: 0.9rem;
                opacity: 0.9;
            }
            
            /* Tabs Section */
            .tab-section {
                max-width: 1200px;
                margin: 2rem auto;
                background-color: var(--white);
                border-radius: 10px;
                box-shadow: var(--shadow);
                overflow: hidden;
            }
            
            .tab-header {
                display: flex;
                background-color: var(--light-gray);
                border-bottom: 1px solid var(--medium-gray);
            }
            
            .tab-label {
                padding: 1rem 2rem;
                cursor: pointer;
                font-weight: 500;
                color: var(--dark-gray);
                transition: var(--transition);
                text-align: center;
                flex: 1;
                position: relative;
            }
            
            .tab-label:hover {
                background-color: var(--medium-gray);
                color: var(--secondary-color);
            }
            
            input[name="tab"] {
                display: none;
            }

            #tab1:checked ~ .tab-header label[for="tab1"],
            #tab2:checked ~ .tab-header label[for="tab2"] {
                background-color: var(--white);
                color: var(--primary-color);
                font-weight: 600;
            }

            #tab1:checked ~ .tab-header label[for="tab1"]::after,
            #tab2:checked ~ .tab-header label[for="tab2"]::after {
                content: '';
                position: absolute;
                bottom: -1px;
                left: 0;
                width: 100%;
                height: 3px;
                background-color: var(--primary-color);
            }
            
            .tab-content {
                padding: 2rem;
                display: none;
            }
            
            #tab1:checked ~ .content1,
            #tab2:checked ~ .content2 {
                display: block;
                animation: fadeIn 0.5s ease;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            /* Donation History Styles */
            .donations-section {
                margin-top: 1rem;
            }
            
            .section-title {
                color: var(--secondary-color);
                margin-bottom: 1.5rem;
                font-size: 1.5rem;
                border-bottom: 2px solid var(--primary-color);
                padding-bottom: 0.5rem;
                display: inline-block;
            }
            
            .donation-item {
                background-color: var(--light-gray);
                border-radius: 8px;
                padding: 1.5rem;
                margin-bottom: 1rem;
                transition: var(--transition);
                border-left: 4px solid var(--primary-color);
            }
            
            .donation-item:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            
            .donation-header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 0.5rem;
                align-items: center;
            }
            
            .donation-cause {
                font-weight: 600;
                color: var(--secondary-color);
                font-size: 1.1rem;
            }
            
            .donation-amount {
                font-weight: bold;
                color: var(--primary-color);
                font-size: 1.2rem;
            }
            
            .donation-impact {
                color: var(--dark-gray);
                margin-bottom: 0.5rem;
                font-style: italic;
            }
            
            .donation-date {
                color: #666;
                font-size: 0.9rem;
            }
            
            .view-all-btn {
                background-color: var(--primary-color);
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 15px;
                cursor: pointer;
                font-size: 18px;
                font-weight: 500;
                transition: var(--transition);
                margin-top: 20px;
                display: block;
                width: 200px;
                text-align: center;
                margin-left: auto;
                margin-right: auto;
            }
            
            .view-all-btn:hover {
                background-color: var(--primary-dark);
                transform: translateY(-2px);
            }
    
            .donate-link-button {
                display: inline-block;
                margin-top: 16px;
                padding: 10px 20px;
                background-color: var(--primary-color);
                color: var(--white);
                font-weight: 600;
                border: none;
                border-radius: 15px;
                text-decoration: none;
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }

            .donate-link-button:hover {
                background-color: var(--primary-dark);
                transform: translateY(-2px);
            }

            /* Engagement Levels Styles */
            .hero-progress-section {
                background-color: var(--light-gray);
                padding: 1.5rem;
                border-radius: 8px;
                margin-bottom: 2rem;
            }
            
            .hero-progress-title {
                display: flex;
                align-items: center;
                font-size: 1.2rem;
                color: var(--secondary-color);
                margin-bottom: 1rem;
                font-weight: 600;
            }
            
            .hero-progress-icon {
                margin-right: 0.8rem;
                color: var(--primary-color);
                font-size: 1.5rem;
            }
            
            .hero-progress-bar-container {
                height: 10px;
                background-color: var(--medium-gray);
                border-radius: 5px;
                margin-bottom: 0.5rem;
                overflow: hidden;
            }
            
            .hero-progress-bar-fill {
                height: 100%;
                background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
                border-radius: 5px;
                transition: width 1s ease;
            }
            
            .hero-progress-info {
                display: flex;
                justify-content: space-between;
                font-size: 0.9rem;
                color: #666;
                margin-bottom: 1rem;
            }
            
            .hero-engagement-level {
                font-weight: 600;
                color: var(--white);
                text-align: center;
                padding: 0.5rem;
                background-color:#ff6f16;
                border-radius: 5px;
            }
            
            .engagement-tiers-section {
                margin-top: 2rem;
            }
            
            .tiers-title {
                color: var(--secondary-color);
                margin-bottom: 1.5rem;
                font-size: 1.3rem;
            }
            
            .tier-card {
                background-color: white;
                border-radius: 8px;
                padding: 1.5rem;
                margin-bottom: 1rem;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                border-left: 4px solid var(--primary-color);
                transition: var(--transition);
            }
            
            .tier-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            
            .tier-header {
                display: flex;
                align-items: center;
            }
            
            .tier-icon {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background-color: var(--light-gray);
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                color: var(--primary-color);
                font-size: 1.2rem;
            }
            
            .tier-details h5 {
                margin: 0;
                color: var(--secondary-color);
                font-size: 1.1rem;
            }
            
            .tier-range {
                font-size: 0.9rem;
                color: #666;
            }
            
            .tier-status {
                margin-left: auto;
                padding: 0.3rem 0.8rem;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 500;
            }
            
            .tier-status.current {
                background-color: rgba(243, 156, 18, 0.2);
                color: var(--primary-dark);
            }
            
            .tier-status.completed {
                background-color: rgba(243, 156, 18, 0.2);
                color: var(--primary-dark);
            }

            .points-info p {
                font-size: 14px;
                color: var(--text-secondary);
            }
            /* Responsive Design */
            @media (max-width: 768px) {
                .nav {
                    flex-direction: column;
                    padding: 1rem;
                }
                
                .nav_items {
                    margin: 1rem 0;
                }
                
                .nav_item {
                    margin-left: 0;
                    margin-right: 1rem;
                }
                
                .user-banner {
                    flex-direction: column;
                    text-align: center;
                    padding: 1.5rem;
                }
                
                .user-icon-profile {
                    margin-right: 0;
                    margin-bottom: 1rem;
                }
                
                .user-impact {
                    border-left: none;
                    border-top: 1px solid rgba(255, 255, 255, 0.3);
                    margin-top: 1rem;
                    padding-top: 1rem;
                    padding-left: 0;
                }
                
                .tab-header {
                    flex-direction: column;
                }
                
                .tab-label {
                    border-radius: 0;
                    margin-right: 0;
                    border-bottom: 1px solid var(--medium-gray);
                }
                
                .row {
                    flex-direction: column;
                }
                
                .col {
                    margin-bottom: 1.5rem;
                }
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
                        <a href="campaigns.php" class="nav_link">Donate</a>
                        <a href="volunteer.php" class="nav_link">Volunteer</a>
                        <a href="contactus.php" class="nav_link">Contact Us</a>
                    </li>
                </ul>
                <a href="logouthopes.php" class="button-logout">
                    Logout
                </a>
            </nav>
        </header>
        
        <!-- User Banners -->
        <section class="user-banner">
            <i class="fas fa-user-circle user-icon-profile"></i>
            <div class="user-details">
                <div class="user-name" style="color:white;"><?php echo htmlspecialchars($username); ?></div>
                <div class="user-tier" style="background-color: <?php 
                    if ($engagementLevel === 'Hero') echo '#ff6f16';
                    elseif ($engagementLevel === 'Champion') echo '#ff6f16';
                    elseif ($engagementLevel === 'Supporter') echo '#ff6f16';
                    else echo '#ff6f16';
                ?>;color:white;"><?php echo $engagementLevel; ?></div>
            </div>
            <div class="user-impact">
                <div class="impact-amount">
                    RM <?php echo number_format($totalDonations, 2); ?>
                </div>
                <div class="impact-label">Total Impact</div>
            </div>
        </section>
        
        <!-- Tabs -->
        <section class="tab-section">
            <input type="radio" name="tab" id="tab1" checked>
            <input type="radio" name="tab" id="tab2">
            
            <div class="tab-header">
                <label for="tab1" class="tab-label">Donation History</label>
                <label for="tab2" class="tab-label">Engagement Levels</label>
            </div>
            
            <!-- Donation History Content -->
            <div class="tab-content content1">
                <div class="donations-section">
                    <h3 class="section-title">Your Donation History</h3>
                    
                    <?php if (empty($donations)): ?>
                        <div class="donation-item">
                            <div class="donation-header">
                                <div class="donation-cause">No donations yet</div>
                            </div>
                            <div class="donation-impact">Make your first donation to see it appear here.</div>
                            <a href="campaigns.php" class="donate-link-button">
                                <i class="fas fa-heart"></i> Donate Now
                            </a>
                        </div>
                    <?php else: ?>
                        <?php foreach (array_slice($donations, 0, 3) as $donation): ?>
                            <div class="donation-item">
                                <div class="donation-header">
                                    <div class="donation-cause"><?php echo htmlspecialchars($donation['cause_title']); ?></div>
                                    <div class="donation-amount">RM <?php echo number_format($donation['Amount'], 2); ?></div>
                                </div>
                                <div class="donation-impact">
                                    <?php 
                                    $campaignProgress = min(100, ($donation['raised_amount'] / $donation['goal_amount']) * 100);
                                    echo "Campaign progress: " . number_format($campaignProgress, 2) . "%";
                                    ?>
                                </div>
                                <div class="donation-date">
                                    <?php echo date('F j, Y', strtotime($donation['Donation_date'])); ?>
                                    • <?php echo ucfirst($donation['Recurring_option']); ?> donation
                                    • Paid via <?php echo ucfirst(str_replace('_', ' ', $donation['Payment_option'])); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <a href="View_All_Donation.php" style="text-decoration: none;">
                            <button class="view-all-btn">View All Donations</button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Engagement Levels -->
            <div class="tab-content content2">
                <section class="hero-progress-section">
                    <div class="hero-progress-title">
                        <span class="hero-progress-icon"><i class="fas fa-chart-line"></i></span>
                        Progress to <?php echo $nextLevel ?: 'Max Level'; ?>
                    </div>
                    <div class="hero-progress-bar-container">
                        <div class="hero-progress-bar-fill" style="width: <?php echo $progressPercentage; ?>%"></div>
                    </div>
                    <div class="hero-progress-info">
                        <span class="hero-progress-points"><?php echo $engagementPoints; ?> points</span>
                        <?php if ($pointsNeeded > 0): ?>
                            <span class="hero-progress-amount"><?php echo $pointsNeeded; ?> points to next level</span>
                        <?php else: ?>
                            <span class="hero-progress-amount">Max level achieved!</span>
                        <?php endif; ?>
                    </div>
                    <div class="hero-engagement-level">Engagement Level: <?php echo $engagementLevel; ?></div>
                </section>
                
                <section class="engagement-tiers-section">
                    <h4 class="tiers-title">Engagement Tiers</h4>
                    
                    <div class="tier-card <?php echo $engagementLevel === 'New Donor' ? 'current' : 'completed'; ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-seedling"></i></div>
                            <div class="tier-details">
                                <h5>New Donor</h5>
                                <span class="tier-range">0 - 99 points</span>
                            </div>
                            <?php if ($engagementLevel === 'New Donor'): ?>
                                <span class="tier-status current">Current</span>
                            <?php else: ?>
                                <span class="tier-status completed">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="tier-card <?php echo $engagementLevel === 'Supporter' ? 'current' : ($engagementPoints >= 100 ? 'completed' : ''); ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="tier-details">
                                <h5>Supporter</h5>
                                <span class="tier-range">100 - 299 points</span>
                            </div>
                            <?php if ($engagementLevel === 'Supporter'): ?>
                                <span class="tier-status current">Current</span>
                            <?php elseif ($engagementPoints >= 100): ?>
                                <span class="tier-status completed">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="tier-card <?php echo $engagementLevel === 'Ally' ? 'current' : ($engagementPoints >= 300 ? 'completed' : ''); ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-user-friends"></i></div>
                            <div class="tier-details">
                                <h5>Ally</h5>
                                <span class="tier-range">300 - 599 points</span>
                            </div>
                            <?php if ($engagementLevel === 'Ally'): ?>
                                <span class="tier-status current">Current</span>
                            <?php elseif ($engagementPoints >= 300): ?>
                                <span class="tier-status completed">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="tier-card <?php echo $engagementLevel === 'Committed Backer' ? 'current' : ($engagementPoints >= 600 ? 'completed' : ''); ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-bolt"></i></div>
                            <div class="tier-details">
                                <h5>Committed Backer</h5>
                                <span class="tier-range">600 - 999 points</span>
                            </div>
                            <?php if ($engagementLevel === 'Committed Backer'): ?>
                                <span class="tier-status current">Current</span>
                            <?php elseif ($engagementPoints >= 600): ?>
                                <span class="tier-status completed">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="tier-card <?php echo $engagementLevel === 'Loyal Contributor' ? 'current' : ($engagementPoints >= 1000 ? 'completed' : ''); ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-heart"></i></div>
                            <div class="tier-details">
                                <h5>Loyal Contributor</h5>
                                <span class="tier-range">1000 - 1499 points</span>
                            </div>
                            <?php if ($engagementLevel === 'Loyal Contributor'): ?>
                                <span class="tier-status current">Current</span>
                            <?php elseif ($engagementPoints >= 1000): ?>
                                <span class="tier-status completed">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="tier-card <?php echo $engagementLevel === 'Sustainer' ? 'current' : ($engagementPoints >= 1500 ? 'completed' : ''); ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-bell"></i></div>
                            <div class="tier-details">
                                <h5>Sustainer</h5>
                                <span class="tier-range">1500 - 2099 points</span>
                            </div>
                            <?php if ($engagementLevel === 'Sustainer'): ?>
                                <span class="tier-status current">Current</span>
                            <?php elseif ($engagementPoints >= 1500): ?>
                                <span class="tier-status completed">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="tier-card <?php echo $engagementLevel === 'Core Champion' ? 'current' : ($engagementPoints >= 2100 ? 'completed' : ''); ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-trophy"></i></div>
                            <div class="tier-details">
                                <h5>Core Champion</h5>
                                <span class="tier-range">2100 - 2799 points</span>
                            </div>
                            <?php if ($engagementLevel === 'Core Champion'): ?>
                                <span class="tier-status current">Current</span>
                            <?php elseif ($engagementPoints >= 2100): ?>
                                <span class="tier-status completed">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="tier-card <?php echo $engagementLevel === 'Guardian' ? 'current' : ($engagementPoints >= 2800 ? 'completed' : ''); ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-feather-alt"></i></div>
                            <div class="tier-details">
                                <h5>Guardian</h5>
                                <span class="tier-range">2800 - 3599 points</span>
                            </div>
                            <?php if ($engagementLevel === 'Guardian'): ?>
                                <span class="tier-status current">Current</span>
                            <?php elseif ($engagementPoints >= 2800): ?>
                                <span class="tier-status completed">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>

                     <div class="tier-card <?php echo $engagementLevel === 'Legacy' ? 'current' : ($engagementPoints >= 3600 ? 'completed' : ''); ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-medal"></i></div>
                            <div class="tier-details">
                                <h5>Legacy</h5>
                                <span class="tier-range">3600 - 4499 points</span>
                            </div>
                            <?php if ($engagementLevel === 'Legacy'): ?>
                                <span class="tier-status current">Current</span>
                            <?php elseif ($engagementPoints >= 3600): ?>
                                <span class="tier-status completed">Completed</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tier-card <?php echo $engagementLevel === 'Hope Builder' ? 'current' : ''; ?>">
                        <div class="tier-header">
                            <div class="tier-icon"><i class="fas fa-dove"></i></div>
                            <div class="tier-details">
                                <h5>Hope Builder</h5>
                                <span class="tier-range">5000+ points</span>
                            </div>
                            <?php if ($engagementLevel === 'Hope Builder'): ?>
                                <span class="tier-status current">Current</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                
                <div class="points-info" style="text-align: center; margin-top: 2rem; color: var(--dark-gray); padding: 1rem; background-color: var(--light-gray); border-radius: 8px;">
                    <p><i class="fas fa-info-circle"></i><strong> Engagement Points System:</strong></p>
                    <p>You earn 1 engagement point for every RM1 donated.</p>
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
                    <p>HopeS, Lot 19,</p>
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
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const donationItems = document.querySelectorAll('.donation-item');
                const tierCards = document.querySelectorAll('.tier-card');
                
                const animateOnScroll = (elements) => {
                    elements.forEach((element, index) => {
                        const elementPosition = element.getBoundingClientRect().top;
                        const screenPosition = window.innerHeight / 1.3;
                        
                        if (elementPosition < screenPosition) {
                            setTimeout(() => {
                                element.style.opacity = '1';
                                element.style.transform = 'translateY(0)';
                            }, index * 100);
                        }
                    });
                };
                
                // Initialize elements with hidden state
                donationItems.forEach(item => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                });
                
                tierCards.forEach(card => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                });
                
                // Animate on first load
                animateOnScroll(donationItems);
                animateOnScroll(tierCards);
                
                // Animate on scroll
                window.addEventListener('scroll', () => {
                    animateOnScroll(donationItems);
                    animateOnScroll(tierCards);
                });
                
                // Tab switching with smooth content transition
                const tabs = document.querySelectorAll('input[name="tab"]');
                tabs.forEach(tab => {
                    tab.addEventListener('change', function() {
                        const tabContents = document.querySelectorAll('.tab-content');
                        tabContents.forEach(content => {
                            content.style.opacity = '0';
                            content.style.transform = 'translateY(10px)';
                            setTimeout(() => {
                                content.style.display = 'none';
                                if (this.checked) {
                                    const activeContent = document.querySelector(`.${this.id.replace('tab', 'content')}`);
                                    activeContent.style.display = 'block';
                                    setTimeout(() => {
                                        activeContent.style.opacity = '1';
                                        activeContent.style.transform = 'translateY(0)';
                                    }, 50);
                                }
                            }, 300);
                        });
                    });
                });
            });
        </script>
    </body>
</html>