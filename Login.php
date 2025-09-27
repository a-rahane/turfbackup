<?php
require_once('config.php');
session_start();

// --- LOGIN HANDLER ---
if (isset($_POST['button'])) {
    $email = $_POST['loginemail'] ?? '';
    $password = $_POST['loginpassword'] ?? '';

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header("Location: Home.html");
            exit;
        } else {
            echo "<script>alert('Invalid email or password');</script>";
        }
    }
}

// --- SIGNUP HANDLER ---
if (isset($_POST['create'])) {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $aadhar = $_POST['aadhar'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordCon = $_POST['passwordCon'] ?? '';

    if ($password === $passwordCon) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (fullname, email, phone, aadhar, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullname, $email, $phone, $aadhar, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Signup successful! You can now log in.');</script>";
        } else {
            echo "<script>alert('Error: Could not register. Maybe email already exists.');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" href="/css/Login.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
</head>
<body>
<header>
    <nav>
        <ul class="nav__links">
            <li><a href="/Home.html">Home</a></li>
            <li><a href="/Home.html#about">About</a></li>
            <li><a href="/Home.html#review">Review</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <section id="formHolder">
        <div class="row">
            <!-- Brand Box -->
            <div class="col-sm-6 brand">
                <div class="heading">
                    <h2>Turf</h2>
                    <p>Find your turf</p>
                </div>
            </div>

            <!-- Form Box -->
            <div class="col-sm-6 form">
                <!-- Login Form -->
                <div class="login form-peice active">
                    <form class="login-form" action="login.php" method="post">
                        <div class="form-group">
                            <label for="loginemail">Email Address</label>
                            <input type="email" name="loginemail" id="loginemail" required>
                        </div>
                        <div class="form-group">
                            <label for="loginpassword">Password</label>
                            <input type="password" name="loginpassword" id="loginpassword" required>
                        </div>
                        <div class="CTA">
                            <input type="submit" id="login" name="button" value="Login">
                            <a href="#" class="switch">I'm New</a>
                        </div>
                    </form>
                </div>

                <!-- Signup Form -->
                <div class="signup form-peice">
                    <form class="signup-form" action="login.php" method="post">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="fullname" id="fullname" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" id="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="aadhar">Aadhar Number</label>
                            <input type="text" name="aadhar" id="aadhar" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="passwordCon">Confirm Password</label>
                            <input type="password" name="passwordCon" id="passwordCon" required>
                        </div>
                        <div class="CTA">
                            <input type="submit" value="Signup Now" id="submit" name="create">
                            <a href="#" class="switch">I have an account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Form Switching Script -->
<script>
$(document).ready(function(){
    $('.switch').click(function(e){
        e.preventDefault();
        $('.form-peice').removeClass('active');
        if($(this).text().includes("New")){
            $('.signup').addClass('active');
        } else {
            $('.login').addClass('active');
        }
    });
});
</script>
</body>
</html>
