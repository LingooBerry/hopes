<?php
$conn = include 'database.php'; // assign the returned PDO connection to $conn
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['forgot-email'];
    $password = $_POST['new-password'];
    $repassword = $_POST['new-repassword'];
    $error = [];

    // Check if passwords match
    if ($password !== $repassword) {
        $error[] = "Passwords do not match.";
    }
    if (empty($error)) {
        try {
            // Check if email exists
            $stmt = $conn->prepare("SELECT id FROM USERS WHERE Email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // Email exists, update password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $conn->prepare("UPDATE USERS SET Password_hash = ? WHERE Email = ?");
                $stmt->execute([$hashed_password, $email]);
                
                echo "<script>alert('Password updated successfully.'); window.location.href='loginhopes.php';</script>";
                exit();
            } else {
                $error[] = "Email not found. Please sign up.";
            }
        } catch (PDOException $e) {
            $error[] = "Database error: " . $e->getMessage();
        }
    }
    // Show errors via JavaScript alert
    if (!empty($error)) {
        $alertMessage = implode("\\n", $error);
        echo "<script>alert('$alertMessage');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HopeS - Forgot Password</title>
        <link rel="icon" href="images/logo.jpg"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="headerform">
        <div class="form_container">
            <!-- Forgot Password Form -->
            <div class="form forgot_password_form">
                <form name="loginForm" action="forgotpwhopes.php" method="post" onsubmit="return validateForgotPasswordForm();">
                    <h2>Forgot Password</h2>
                    <div class="input_box">
                        <input type="email" id="forgot-email" name="forgot-email" placeholder="Enter your email" required onchange="validateForgotEmail()"/>
                        <i class="fa-solid fa-envelope email"></i>
                    </div>
                    <small id="loginEmailError2" class="error-message"></small>
                    <div class="input_box">
                        <input type="password" id="new-password" name="new-password" placeholder="Create new password" required onchange="validateNewPass()"/>
                        <i class="fa-solid fa-lock password"></i>
                        <i class="fa-regular fa-eye-slash pw_hide" aria-hidden="true" id="newpassword-notvisible"></i>
                    </div>
                    <small id="passwordError2" class="error-message"></small>
                    <div class="input_box">
                        <input type="password" id="new-repassword" name="new-repassword" placeholder="Confirm new password" required onchange="validateNewRepass()" />
                        <i class="fa-solid fa-lock password"></i>
                        <i class="fa-regular fa-eye-slash pw_hide" aria-hidden="true" id="newrepassword-notvisible"></i>
                    </div>
                    <small id="repasswordError2" class="error-message"></small>
                    <button type="submit" name="submit" class="button_header">Reset Password</button>
                    <div class="login_signup">
                        Already have an account? <a href="loginhopes.php">Login</a>
                    </div>
                </form>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
</html>