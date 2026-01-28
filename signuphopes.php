<?php
session_start();
include 'database.php';
$error = [];

$name = $_POST['signup-name'];
$phone = $_POST['signup-phone'];
$email = $_POST['signup-email'];
$password = $_POST['signup-password'];
$repassword = $_POST['signup-confirm-password'];

// Validations
if (!preg_match("/^[A-Za-z\s-]+$/", $name)) {
    $error[] = "Invalid input! Name must contain only letters, hyphens, and whitespaces.";
}
if (!preg_match("/^\+?(\d[\d -]{7,19}\d|\d{8,15})$/", $phone)) {
    $error[] = "Invalid phone number! Please enter a valid phone number with 8 to 15 digits.";
}
if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
    $error[] = "Invalid email entered! Please enter a valid email address.";
}
if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/", $password)) {
    $error[] = "Password must be at least 8 characters long and include uppercase, lowercase, and a digit.";
}
if ($password !== $repassword) {
    $error[] = "Passwords do not match!";
}

// Check if username already exists
$stmt = $db->prepare("SELECT Username FROM USERS WHERE Username = ?");
$stmt->execute([$name]);
if ($stmt->rowCount() > 0) {
    echo "<script>alert('Username already exists. Please use a different one.'); window.location.href='signuphopes.html';</script>";
    exit();
}

// Check if phone already exists
$stmt = $db->prepare("SELECT Phone FROM USERS WHERE Phone = ?");
$stmt->execute([$phone]);
if ($stmt->rowCount() > 0) {
    echo "<script>alert('Phone number already exists. Please use a different one.'); window.location.href='signuphopes.html';</script>";
    exit();
}

// Check if email already exists
$stmt = $db->prepare("SELECT Email FROM USERS WHERE Email = ?");
$stmt->execute([$email]);
if ($stmt->rowCount() > 0) {
    echo "<script>alert('This email is already registered. Please log in or use a different email.'); window.location.href='signuphopes.html';</script>";
    exit();
}

// Insert user
if (empty($error)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $db->prepare("INSERT INTO USERS (Username, Phone, Email, Password_hash) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $phone, $email, $hashed_password])) {
        $_SESSION['name'] = $name;
        $_SESSION['phone'] = $phone;
        $_SESSION['email'] = $email;
        echo "<script>alert('Registration successful! Please log in.'); window.location.href='loginhopes.php';</script>";
        exit();
    } else {
        $error[] = "Error in registering user.";
    }
}

if (!empty($error)) {
    foreach ($error as $err) {
        echo "<script>alert('$err');</script>";
    }
}
?>
