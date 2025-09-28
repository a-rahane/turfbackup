<?php
session_start();
require_once('config.php'); // make sure path points to the centralized config.php

$loginemail = $_POST['loginemail'] ?? '';
$loginpassword = $_POST['loginpassword'] ?? '';

if (empty($loginemail) || empty($loginpassword)) {
    echo "Please enter email and password.";
    exit;
}

try {
    // Prepare statement safely
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1");
    $stmt->execute([$loginemail, $loginpassword]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['userlogin'] = $user;
        $_SESSION['user_email'] = $user['email'];
        echo '1';
    } else {
        echo 'No user found with this email/password combination.';
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
