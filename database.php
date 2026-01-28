<?php
$host = 'localhost';
$port = '3306'; 
$dbname = 'dataconnect';
$user = 'root';
$password = '';

try {
    // Step 1: Connect to MySQL server (initially without DB)
    $dsnNoDB = "mysql:host=$host;port=$port";
    $pdo = new PDO($dsnNoDB, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Step 2: Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");

    // Step 3: Connect to the newly created database
    $dsn = "mysql:host=$host;dbname=$dbname;port=$port";
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // USERS table
    $db->exec("CREATE TABLE IF NOT EXISTS USERS (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Username VARCHAR(50) NOT NULL,
        Phone VARCHAR(20),
        Email VARCHAR(100) NOT NULL UNIQUE,
        Password_hash VARCHAR(255) NOT NULL,
        Tier VARCHAR(50) DEFAULT 'New Donor',
        Date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // ENQUIRIES table
    $db->exec("CREATE TABLE IF NOT EXISTS ENQUIRIES (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        Username VARCHAR(255) NOT NULL,
        Phone VARCHAR(20) NOT NULL,
        Email VARCHAR(255) NOT NULL,
        Message TEXT NOT NULL,
        Created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES USERS(id)
    ) ENGINE=InnoDB");

    // VOLUNTEERS table
    $db->exec("CREATE TABLE IF NOT EXISTS VOLUNTEERS (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        Username VARCHAR(255) NOT NULL,
        Phone VARCHAR(20) NOT NULL,
        Email VARCHAR(255) NOT NULL,
        Gender ENUM('Male', 'Female', 'Prefer not to say') NOT NULL,
        Address TEXT,
        Areas_of_Interest ENUM(
            'Education and Tutoring', 
            'Food and Hunger Relief', 
            'Community Projects and Outreach', 
            'Women Empowerment and Economic Skills'
        ) NOT NULL,
        Availability ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NOT NULL,
        Preferred_Time_Slot ENUM('Morning (9AM - 1PM)', 'Afternoon (2PM - 6PM)', 'Flexible') NOT NULL,
        Created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES USERS(id)
    ) ENGINE=InnoDB");

    // CAUSES table
    $db->exec("CREATE TABLE IF NOT EXISTS CAUSES (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        goal_amount DECIMAL(10, 2) NOT NULL,
        raised_amount DECIMAL(10, 2) DEFAULT 0,
        donation_count INT DEFAULT 0,
        image_path VARCHAR(255) DEFAULT 'images/default.jpg',
        description TEXT
    ) ENGINE=InnoDB");

    // DONATIONS table
    $db->exec("CREATE TABLE IF NOT EXISTS DONATIONS (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        cause_id INT NOT NULL,
        Amount DECIMAL(10, 2) NOT NULL,
        Recurring_option ENUM('one-time', 'monthly', 'yearly') NOT NULL,
        Payment_option ENUM('credit_card', 'e_wallet', 'online_banking') NOT NULL,
        Impact_message TEXT,
        Donation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES USERS(id) ON DELETE CASCADE,
        FOREIGN KEY (cause_id) REFERENCES CAUSES(id) ON DELETE CASCADE
    ) ENGINE=InnoDB");
    
    return $db; //Return the actual PDO connection
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
?>
