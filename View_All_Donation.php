<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginhopes.php");
    exit();
}
$username = $_SESSION['name'];

// Database connection
$db = require_once 'database.php';

// Fetch all donations for the current user
$stmt = $db->prepare("SELECT d.*, c.title as cause_title 
                     FROM DONATIONS d 
                     JOIN CAUSES c ON d.cause_id = c.id 
                     WHERE d.user_id = :user_id 
                     ORDER BY d.Donation_date DESC");
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$donations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total donations
$totalDonations = array_sum(array_column($donations, 'Amount'));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>HopeS - View All Donations</title>
        <link rel="icon" href="images/logo.jpg"/>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
        <style>
            :root {
                --accent-color:rgb(21, 88, 110);
                --light-gray: #fafafa;
                --medium-gray: #d6d6d6;
                --dark-gray: #444444;
                --white: #ffffff;
                --shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
                --transition: all 0.3s ease;
            }
            
            body {
                line-height: 1.6;
                color: #333;
                background-color: #f9f9f9;
                margin: 0;
                padding: 0;
            }
            /* Main Content */
            .main-container {
                max-width: 1200px;
                margin: 2rem auto;
                padding: 0 2rem;
            }
            
            .page-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
            }
            
            .page-title {
                font-size: 2rem;
                color: var(--secondary-color);
                margin: 0;
            }
            
            .total-donations {
                background-color: var(--primary-color);
                color: white;
                padding: 0.8rem 1.5rem;
                border-radius: 15px;
                font-weight: 600;
            }
            
            /* View Toggle */
            .view-toggle {
                display: flex;
                justify-content: center;
                margin-bottom: 2rem;
                background-color: var(--light-gray);
                border-radius: 15px;
                padding: 0.5rem;
            }
            
            .view-option {
                padding: 0.8rem 1.5rem;
                cursor: pointer;
                font-weight: 500;
                color: var(--dark-gray);
                transition: var(--transition);
                border-radius: 15px;
            }
            
            .view-option.active {
                background-color: var(--primary-color);
                color: white;
            }
            
            /* List View Styles */
            .donations-list {
                display: block;
            }
            
            .donation-item {
                background-color: var(--white);
                border-radius: 15px;
                padding: 1.5rem;
                transition: var(--transition);
                border-left: 4px solid var(--primary-color);
                box-shadow: var(--shadow);
                margin-bottom: 1rem;
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
            
            .donation-meta {
                display: flex;
                justify-content: space-between;
                margin-top: 1rem;
                font-size: 0.9rem;
                color: var(--dark-gray);
            }
            
            .donation-date {
                color: #666;
            }
            
            .donation-method {
                display: flex;
                align-items: center;
            }
            
            .donation-method i {
                margin-right: 0.5rem;
            }
            
            /* Grid View Styles */
            .donations-grid {
                display: none;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 1.5rem;
                margin-bottom: 20px;
            }
            /* Modern button style */
            .modern-btn {
                background: linear-gradient(135deg, #4f46e5, #3b82f6);
                color: #fff;
                border: none;
                border-radius: 50px;
                padding: 0.5rem 1.25rem;
                font-weight: 500;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                transition: all 0.3s ease;
                text-decoration: none;
            }

            /* Icon sizing */
            .modern-btn i {
                font-size: 1.1rem;
            }

            /* Hover & focus effects */
            .modern-btn:hover, .modern-btn:focus {
                background: linear-gradient(135deg, #6366f1, #60a5fa);
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
                color: #fff;
                text-decoration: none;
            }

            
            .donation-card {
                background-color: var(--white);
                border-radius: 8px;
                padding: 1.5rem;
                transition: var(--transition);
                box-shadow: var(--shadow);
                border-top: 4px solid var(--primary-color);
                display: flex;
                flex-direction: column;
            }
            
            .donation-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            }
            
            .card-cause {
                font-weight: 600;
                color: var(--secondary-color);
                font-size: 1.1rem;
                margin-bottom: 0.5rem;
            }
            
            .card-amount {
                font-weight: bold;
                color: var(--primary-color);
                font-size: 1.5rem;
                margin: 0.5rem 0;
            }
            
            .card-impact {
                color: var(--dark-gray);
                margin-bottom: 1rem;
                flex-grow: 1;
            }
            
            .card-footer {
                display: flex;
                justify-content: space-between;
                font-size: 0.9rem;
                color: var(--dark-gray);
                margin-top: auto;
            }
            /*Enhance button hover/focus effects */
            .btn-backto-user-dashboard {
                padding: 10px 20px;
                border: 2px solid #fff;
                background: var(--secondary-color);
                border-radius: 12px;
                font-size: 16px;
                cursor: pointer;
                color: #fff;
                transition: all 0.3s ease;
            }
            
            .button-pls-donate {
                background-color: var(--primary-color);
                color: white;
                padding: 0.5rem 1.5rem;
                margin-top: 20px;
                border-radius: 15px;
                text-decoration: none;
                font-weight: 500;
                transition: var(--transition);
                border: none;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .button-pls-donate:hover {
                background-color: var(--primary-dark); /* Slightly darker shade of accent color */
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            }
            .button-pls-donate:active {
                transform: translateY(0);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            /* Responsive Design */
            @media (max-width: 768px) {
                .page-header {
                    flex-direction: column;
                    align-items: flex-start;
                }
                
                .total-donations {
                    margin-top: 1rem;
                }
                
                .donations-grid {
                    grid-template-columns: 1fr;
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
                <a href="user.php" class="btn-backto-user-dashboard">
                    <i class="fas fa-arrow-left"></i> Back to User Dashboard
                </a>
            </nav>
        </header>
        
         <!-- Main Content -->
        <div class="main-container">
            <div class="page-header">
                <h1 class="page-title">Your Donation History</h1>
                <div class="total-donations">
                    Total Donations: RM<?php echo number_format($totalDonations, 2); ?>
                </div>
            </div>
            
            <!-- View Toggle -->
            <div class="view-toggle">
                <div class="view-option active" id="list-view">
                    <i class="fas fa-list"></i> List View
                </div>
                <div class="view-option" id="grid-view">
                    <i class="fas fa-th-large"></i> Grid View
                </div>
            </div>
            
            <!-- List View -->
            <div class="donations-list" id="donations-list">
                <?php if (empty($donations)): ?>
                    <div class="donation-item">
                        <p>You haven't made any donations yet.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($donations as $donation): ?>
                        <div class="donation-item">
                            <div class="donation-header">
                                <div class="donation-cause"><?php echo htmlspecialchars($donation['cause_title']); ?></div>
                                <div class="donation-amount">RM<?php echo number_format($donation['Amount'], 2); ?></div>
                            </div>
                            <?php if ($donation['Impact_message']): ?>
                                <div class="donation-impact"><?php echo htmlspecialchars($donation['Impact_message']); ?></div>
                            <?php endif; ?>
                            <div class="donation-meta">
                                <div class="donation-date">
                                    <i class="far fa-calendar-alt"></i> 
                                    <?php echo date('M j, Y', strtotime($donation['Donation_date'])); ?>
                                </div>
                                <div class="donation-method">
                                    <i class="fas fa-credit-card"></i> 
                                    <?php echo ucfirst(str_replace('_', ' ', $donation['Payment_option'])); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Grid View -->
            <div class="donations-grid" id="donations-grid">
                <?php if (empty($donations)): ?>
                    <div class="donation-card">
                        <p>You haven't made any donations yet.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($donations as $donation): ?>
                        <div class="donation-card">
                            <div class="card-cause"><?php echo htmlspecialchars($donation['cause_title']); ?></div>
                            <div class="card-amount">RM<?php echo number_format($donation['Amount'], 2); ?></div>
                            
                            <?php if ($donation['Impact_message']): ?>
                                <div class="card-impact"><?php echo htmlspecialchars($donation['Impact_message']); ?></div>
                            <?php else: ?>
                                <div class="card-impact">Thank you for your generous donation!</div>
                            <?php endif; ?>
                            
                            <div class="card-footer">
                                <div>
                                    <i class="far fa-calendar-alt"></i> 
                                    <?php echo date('M j, Y', strtotime($donation['Donation_date'])); ?>
                                </div>
                                <div>
                                    <i class="fas fa-sync-alt"></i> 
                                    <?php echo ucfirst($donation['Recurring_option']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- In your header section (replace the existing logout button) -->
            <a href="process_donation.php" class="button-pls-donate">
                <i class="fas fa-sign-out-alt"></i>Please Donate
            </a>
            

        </form>
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
                // View toggle functionality
                const listViewBtn = document.getElementById('list-view');
                const gridViewBtn = document.getElementById('grid-view');
                const listView = document.getElementById('donations-list');
                const gridView = document.getElementById('donations-grid');
                
                listViewBtn.addEventListener('click', function() {
                    listView.style.display = 'block';
                    gridView.style.display = 'none';
                    listViewBtn.classList.add('active');
                    gridViewBtn.classList.remove('active');
                });
                
                gridViewBtn.addEventListener('click', function() {
                    listView.style.display = 'none';
                    gridView.style.display = 'grid';
                    gridViewBtn.classList.add('active');
                    listViewBtn.classList.remove('active');
                });
                
                // Animation for donation items
                const animateItems = () => {
                    const items = document.querySelectorAll('.donation-item, .donation-card');
                    items.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, index * 100);
                    });
                };
                
                // Initialize animation
                const items = document.querySelectorAll('.donation-item, .donation-card');
                items.forEach(item => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                });
                
                animateItems();
                
                // Re-animate when switching views
                listViewBtn.addEventListener('click', animateItems);
                gridViewBtn.addEventListener('click', animateItems);
            });
        </script>
    </body>
</html>