<?php
include 'database.php';
session_start();
$link = isset($_SESSION['user_id']) ? 'user.php' : 'loginhopes.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and fetch inputs
    $username = trim($_POST['username']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $gender = $_POST['gender'];
    $address = trim($_POST['address']);
    $interest = $_POST['interest'];
    $availability = $_POST['availability'];
    $timeslot = $_POST['timeslot'];

    // Map gender input values to DB enum values
    $genderMap = [
        'male' => 'Male',
        'female' => 'Female',
        'prefer_not_to_say' => 'Prefer not to say'
    ];
    $genderDb = $genderMap[$gender] ?? null;

    // Validate Areas_of_Interest options
    $validInterests = [
        'Education and Tutoring',
        'Food and Hunger Relief',
        'Community Projects and Outreach',
        'Women Empowerment and Economic Skills'
    ];

    // Validate Availability options (as per your DB enum, note Sunday is missing in your form, keep consistent)
    $validAvailability = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

    // Validate Preferred_Time_Slot options
    $validTimeslots = ['Morning (9AM - 1PM)', 'Afternoon (2PM - 6PM)', 'Flexible'];

    // Make Availability and Interest case consistent for DB
    $availabilityDb = ucfirst(strtolower($availability)); // e.g. 'monday' to 'Monday'

    // Check required fields and enums are valid
    if (!$username || !$phone || !$email || !$genderDb || !$address
        || !in_array($interest, $validInterests)
        || !in_array($availabilityDb, $validAvailability)
        || !in_array($timeslot, $validTimeslots)) {
        echo "<script>alert('Invalid input detected. Please fill the form correctly.');</script>";
    } else {
        try {
            // Prepare and execute INSERT statement with PDO
            $stmt = $db->prepare("INSERT INTO VOLUNTEERS (user_id, Username, Phone, Email, Gender, Address, Areas_of_Interest, Availability, Preferred_Time_Slot) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // user_id can be null if user not logged in
            $user_id = $_SESSION['user_id'] ?? null;

            $stmt->execute([
                $user_id,
                $username,
                $phone,
                $email,
                $genderDb,
                $address,
                $interest,
                $availabilityDb,
                $timeslot
            ]);

            echo "<script>alert('Volunteer registration successful! Please wait for the message.');</script>";
        } catch (PDOException $e) {
            // Handle duplicate email or other DB errors gracefully
            echo "<script>alert('Registration failed: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>HopeS - Become a Volunteer</title>
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
                        <a href="volunteer.php" class="nav_link active">Volunteer</a>
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
                <h1>Become a Volunteer</h1>
                <p>Together, we can ignite hope and empower communities through the power of volunteering.</p>
            </div>
        </div>
        <!-- Volunteer Form -->
        <div class="volunteering-section">
            <div class="volunteer-form-section">
                <form id="volunteerForm" autocomplete="off" method="post">
                    <!-- Row 1: Name and Phone -->
                    <div class="row-volunteer">
                        <div class="input-volunteer">
                            <input type="text" id="name" name="username" placeholder=" " required />
                            <label for="name" class="floating-vlabel">Name</label>
                        </div>
                        <div class="input-volunteer">
                            <input type="tel" id="phone" name="phone" required pattern="^\+?[0-9]{7,15}$" title="Enter a valid phone number." placeholder=""/>
                            <label for="phone" class="floating-vlabel">Phone</label>
                        </div>
                    </div>
                    <!-- Row 2: Email and Gender (Dropdown) -->
                    <div class="row-volunteer">
                        <div class="input-volunteer">
                            <input type="email" id="email" name="email" placeholder=" " required />
                            <label for="email" class="floating-vlabel">Email</label>
                        </div>
                        <div class="input-volunteer">
                            <select id="gender" name="gender" required>
                                <option value="" disabled selected hidden></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="prefer_not_to_say">Prefer not to say</option>
                            </select>
                            <label for="gender" class="floating-vlabel select-label">Gender</label>
                        </div>
                    </div>
                    <!-- Address textarea full width -->
                    <div class="input-volunteer full">
                        <textarea id="address" name="address" rows="5" placeholder=" " required></textarea>
                        <label for="address" class="floating-vlabel">Address</label>
                    </div>
                    <!-- Areas of Interests dropdown full width -->
                    <div class="input-volunteer full">
                        <select id="interest" name="interest" required>
                            <option value="" disabled selected hidden></option>
                            <option value="Education and Tutoring">Education & Tutoring</option>                          
                            <option value="Food and Hunger Relief">Food & Hunger Relief</option>
                            <option value="Community Projects and Outreach">Community Projects & Outreach</option>
                            <option value="Women Empowerment and Economic Skills">Women Empowerment & Economic Skills</option>
                        </select>
                        <label for="interest" class="floating-vlabel select-label">Areas of Interests</label>
                    </div>
                    <!-- Row 3: Availability and Preferred Time Slot -->
                    <div class="row-volunteer">
                        <div class="input-volunteer">
                            <select id="availability" name="availability" required>
                                <option value="" disabled selected hidden></option>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                            </select>
                            <label for="availability" class="floating-vlabel select-label">Availability</label>
                        </div>
                        <div class="input-volunteer">
                            <select id="timeslot" name="timeslot" required>
                                <option value="" disabled selected hidden></option>
                                <option value="Morning (9AM - 1PM)">Morning (9 AM - 1 PM)</option>
                                <option value="Afternoon (2PM - 6PM)">Afternoon (2 PM - 6 PM)</option>
                                <option value="Flexible">Flexible</option>
                            </select>
                            <label for="timeslot" class="floating-vlabel select-label">Preferred Time Slot</label>
                        </div>
                    </div>
                    <button type="submit" class="volunteer-submit">Submit</button>
                </form>
                
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
                        <li><a href="aboutus.php">About Us</a></li>
                        <li><a href="campaigns.php">Campaigns</a></li>
                        <li><a href="volunteer.php" class="active">Volunteer</a></li>
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