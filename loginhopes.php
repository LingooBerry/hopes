<?php
include 'database.php';
session_start();

if (isset($_POST['login-email']) && isset($_POST['login-password'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];
    $remember = isset($_POST['remember-me']);

    // Use the correct PDO connection object from database.php ($db)
    $stmt = $db->prepare("SELECT id, Username, Phone, Email, Password_hash FROM USERS WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['Password_hash'])) {
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);
            // Store user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['Username'];
            $_SESSION['phone'] = $user['Phone'];
            $_SESSION['email'] = $user['Email'];

            // Handle "Remember Me" cookie
            if ($remember) {
                $cookie_name = "hopes_login";
                $cookie_value = $email;
                $cookie_expiration = time() + (86400 * 30); // 30 days
                setcookie($cookie_name, $cookie_value, $cookie_expiration, "/", "", true, true);
            }
            echo "<script>alert('Login successful! Redirecting to your user profile.'); window.location.href='user.php';</script>";
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); window.location.href='loginhopes.php';</script>";
        }
    } else {
        echo "<script>alert('Email not found. Please sign up.'); window.location.href='signuphopes.html';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HopeS - Login</title>
    <link rel="icon" href="images/logo.jpg"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
</head>
<body class="headerform">
    <div class="form_container">
        <div class="form login_form">
            <form name="loginForm" action="loginhopes.php" method="post" onsubmit="return validateLoginForm();">
                <div style="text-align: center; margin-bottom: 10px;">
                    <img src="images/logo.jpg" alt="Logo" style="height: 90px; width: 110px;">
                </div>
                <h2>Login</h2>
                <div class="input_box">
                    <input type="text" id="login-email" name="login-email" placeholder="Enter your email" required onchange="validateLoginEmail()"/>
                    <i class="fa-solid fa-envelope email"></i>
                </div>
                <small id="loginEmailError" class="error-message"></small>
                <div class="input_box">
                    <input type="password" id="login-password" name="login-password" placeholder="Enter your password" required onchange="validateLoginPass()">
                    <i class="fa-solid fa-lock password"></i>
                    <i class="fa-regular fa-eye-slash pw_hide" aria-hidden="true" id="loginpassword-notvisible"></i>
                </div>
                <small id="loginPasswordError" class="error-message"></small>
                <div class="option_field">
                    <span class="checkbox">
                        <input type="checkbox" id="check" name="remember-me" value="1">
                        <label for="check">Remember me</label>
                    </span>
                    <a href="forgotpwhopes.php" class="forgot_pw">Forgot password?</a>
                </div>
                <button type="submit" class="button_header">Login Now</button>
                <div class="login_signup">
                    Don't have an account? <a href="signuphopes.html">Signup</a>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>