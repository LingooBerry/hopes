<?php
session_start();
require_once 'database.php'; // Initializes DB and returns $db

if (!isset($_SESSION['user_id'])) {
    echo "<script>
    alert('Please log in to donate.'); 
    window.location.href = 'loginhopes.php';
    </script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user_id = $_POST['user_id'] ?? null;
        $cause_id = $_POST['cause_id'] ?? null;
        $amount = $_POST['Amount'] ?? null;
        $recurring = $_POST['Recurring_option'] ?? null;
        $payment = $_POST['Payment_option'] ?? null;
        $impact = $_POST['Impact_message'] ?? null;
        $donation_date = $_POST['Donation_date'] ?? date('Y-m-d');

        if (!$user_id || !$cause_id || !$amount || !$recurring || !$payment) {
            $error = 'Missing required fields';
        } else {
            $stmt = $db->prepare("INSERT INTO DONATIONS (
                user_id, cause_id, Amount, Recurring_option, Payment_option, Impact_message, Donation_date
            ) VALUES (
                :user_id, :cause_id, :amount, :recurring, :payment, :impact, :donation_date
            )");

            $stmt->execute([
                ':user_id' => $user_id,
                ':cause_id' => $cause_id,
                ':amount' => $amount,
                ':recurring' => $recurring,
                ':payment' => $payment,
                ':impact' => $impact ?: null,
                ':donation_date' => $donation_date
            ]);

            // Update the raised_amount in the CAUSES table
            $updateRaised = $db->prepare("UPDATE CAUSES SET raised_amount = raised_amount + :amount WHERE id = :cause_id");
            $updateRaised->execute([
                ':amount' => $amount,
                ':cause_id' => $cause_id
            ]);

            // Update the donation_count in the CAUSES table
            $updateCount = $db->prepare("UPDATE CAUSES SET donation_count = donation_count + 1 WHERE id = :cause_id");
            $updateCount->execute([
                ':cause_id' => $cause_id
            ]);

           
            // Fetch cause title to customize success message
            $stmtCause = $db->prepare("SELECT title FROM CAUSES WHERE id = ?");
            $stmtCause->execute([$cause_id]);
            $cause = $stmtCause->fetch(PDO::FETCH_ASSOC);

            // Define impact message
            $successMessage = match($cause['title']) {
                'Education Support for Orphans in Malaysia' => 'Your support has opened the doors of quality education to children who might otherwise be left behind. Every lesson they learn, every book they read, and every dream they chase is possible because of you.',
                'Hunger Relief in Malaysia' => 'Your generosity has filled empty plates and lifted weary hearts. By feeding a family in need, you’ve brought relief in their time of struggle and restored dignity and hope for tomorrow.',
                'Medical Aid for the Needy in Malaysia' => 'Your donation is more than a gift, it’s a lifeline. You are helping provide critical medical aid to those in need across Malaysia, ensuring that lives are saved when it matters most.',
                'Empowering B40 Communities in Malaysia'=> 'Thanks to your generosity, you have empowered families in B40 communities across Malaysia. Your support is transforming lives by providing essential resources and opportunities.',
                'Clean Water for Rural Communities in Malaysia'=> 'You’ve empowered rural communities in Malaysia with access to clean water, bringing better health, dignity, and hope for a brighter future',
                'Support for Women\'s Empowerment in Malaysia' => 'Because of you, women in Malaysia are accessing opportunities that uplift their voices, restore dignity, and open doors to a brighter future.',
                'Relief for Refugee Families in Gaza'=>'You help displaced families in Gaza with food, water, shelter, and medical aid!',
                'Emergency Medical Aid for Gaza'=>'Because of you, displaced families in Gaza are receiving food, water, shelter, and urgent medical aid, comfort and survival in the face of crisis.',
                default => 'We appreciate your generous support!'
            };
            $success = true;
        }
    } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate Now</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #ff6f16;        
            --primary-dark: #ec5300;         
            --secondary-color: #010741;      
            --white: #ffffff;
        }
        body {
            background-color: #f9fafc;
            font-family: 'Open Sans', sans-serif;
        }
        .donation-banner {
            background: var(--secondary-color);
            color: white;
            padding: 32px 0; /* 2rem = 32px */
            text-align: center;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .donation-banner h1 {
            font-size: 46px;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        .donation-banner p {
            font-size: 17px;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.5;
            margin-bottom: 40px;
        }

        .donation-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 32px; 
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
        }

        .payment-option {
            border: 2px solid #ddd;
            border-radius: 15px;
            padding: 16px; 
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-option:hover {
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(63, 55, 201, 0.2);
        }

        .payment-option.selected {
            border-color: var(--primary-color);
            background-color: rgba(63, 55, 201, 0.05);
        }

        .btn-donate {
            background: var(--primary-color);
            color: white;
            border-radius: 15px;
            font-size: 17px;
            font-weight: bold;
            margin-top: 15px;
            padding:10px 20px;
            transition: background 0.3s ease;
        }

        .btn-donate:hover {
            background: var(--primary-dark);
            color: white;
        }

        .impact-text {
            background: var(--primary-dark);
            padding: 16px; /* 1rem = 16px */
            border-left: 5px solid var(--primary-color);
            margin-bottom: 32px; /* 2rem = 32px */
        }

        .payment-option i {
            font-size: 32px; /* 2rem = 32px */
            margin-bottom: 8px; /* 0.5rem = 8px */
        }

        input[type="checkbox"] {
            accent-color: var(--secondary-color); /* your desired color */
        }

        .terms-link {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .terms-link:hover {
            color: rgb(1, 5, 34);
        }

        .donation-footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 32px 0;
            text-align: center;
            border-top-left-radius: 70px;
        }

        hr {
            width: 90%;
            border: 0;
            border-bottom: 1px solid #ffffffff;
            margin: 20px auto;
        }

        .copyright {
            font-size: 14px;
            text-align: center;
            margin-bottom: -15px;
        }

        @media (max-width: 576px) {
            .payment-option i {
                font-size: 24px; /* 1.5rem = 24px */
            }
        }
        </style>
        </head>
        <body>
            <!-- Header Section -->
            <div class="donation-banner">
                <h1>Make a Difference Today</h1>
                <p>Your donation helps bring hope and positive change to those who need it most. Together, we can make a real difference and create lasting impact in their lives.</p>
            </div>
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="donation-card">
                            <form method="POST" id="donationForm">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? '1'; ?>">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Select a Campaign</label>
                                    <select class="form-select" name="cause_id" required>
                                        <option value="" disabled selected>Select one...</option>
                                        <?php
                                        $stmt = $db->query("SELECT id, title FROM CAUSES");
                                        $causes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($causes as $cause) {
                                            echo "<option value=\"{$cause['id']}\">{$cause['title']}</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Donation Amount (RM)</label>
                                        <input type="number" class="form-control" name="Amount" min="10" step="0.01" required placeholder="Please enter amount (minimum RM10)">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Recurring Donation Options</label>
                                        <select class="form-select" name="Recurring_option" required>
                                            <option value="" disabled selected>Select an option...</option>
                                            <option value="one-time">One-Time</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="yearly">Yearly</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                    <label class="form-label fw-bold">Select Payment Method</label>
                                    <div class="row">
                                        <?php
                                        $paymentMethods = [
                                            ['id' => 'credit_card', 'label' => 'Credit Card', 'icon' => 'far fa-credit-card'],
                                            ['id' => 'e_wallet', 'label' => 'E-Wallet', 'icon' => 'fas fa-wallet'],
                                            ['id' => 'online_banking', 'label' => 'Online Banking', 'icon' => 'fas fa-university'],
                                            ['id' => 'paypal', 'label' => 'PayPal', 'icon' => 'fab fa-paypal']
                                        ];
                                        foreach ($paymentMethods as $method):
                                        ?>
                                        <div class="col-6 col-md-4 mb-3">
                                            <div class="payment-option" data-value="<?php echo $method['id']; ?>">
                                                <i class="<?php echo $method['icon']; ?>"></i>
                                                <div><?php echo $method['label']; ?></div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <input type="hidden" name="Payment_option" id="Payment_option" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Send a message of hope (optional)</label>
                                    <textarea class="form-control" name="Impact_message" rows="4" placeholder="Share your kind words..."></textarea>
                                </div>
                                <label>
                                    <input type="checkbox" name="agree" required>
                                    I agree with <a href="termsconditions.html" target="_blank" class="terms-link">Terms and Conditions</a>
                                </label>
                                <div class="mb-4 text-center">
                                    <button type="submit" class="btn btn-donate px-4 py-2">Donate Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer Section -->
            <div class="donation-footer">
                <p>Together, we can build a brighter future. Thank you for your generosity and support.</p>
                <hr>
                <p class="copyright">&copy;2025 HopeS. All Rights Reserved.</p>
            </div>
            
            <!-- Font Awesome -->
            <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
            <script>
            const paymentOptions = document.querySelectorAll('.payment-option');
            const paymentInput = document.getElementById('Payment_option');
            
            paymentOptions.forEach(option => {
                option.addEventListener('click', () => {
                    paymentOptions.forEach(o => o.classList.remove('selected'));
                    option.classList.add('selected');
                    paymentInput.value = option.getAttribute('data-value');
                });
            });
            
            <?php if (!empty($success)): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Thank you for your donation!',
                    text: <?= json_encode($successMessage ?? 'We appreciate your contribution!') ?>,
                    confirmButtonColor: '#ff6f16',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = 'View_All_Donation.php';
                });
                <?php elseif (!empty($error)): ?>
                    Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '<?php echo $error; ?>',
                confirmButtonColor: '#ff5722';
            });
            <?php endif; ?>
            </script>
        </body>
</html>
