<?php 
require_once('config.php')
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
    <!-- <a class="logo" href="/"><img src="/images/logo.svg" alt="logo"></a> -->
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
                <a href="#" class="logo">Welcome.<span></span></a>
                <div class="heading">
                    <h2>Turf</h2>
                    <p>Find your turf</p>
                </div>
                <div class="success-msg">
                    <p>Great! You are one of our members now</p>
                    <a href="#" class="profile">Your Profile</a>
                </div>
            </div>

            <!-- Form Box -->
            <div class="col-sm-6 form">
                <!-- Login Form -->
                <div class="login form-peice switched">
                    <form class="login-form" action="#" method="post">
                        <div class="form-group">
                            <label for="loginemail">Email Address</label>
                            <input type="email" name="loginemail" id="loginemail" required>
                        </div>

                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input type="password" name="loginpassword" id="loginpassword" required>
                        </div>

                        <div class="CTA">
                            <input type="submit" id="login" name="button" value="Login">
                            <a href="#" class="switch">I'm New</a>
                        </div>
                    </form>
                </div><!-- End Login Form -->

                <!-- Signup Form -->
                <div class="signup form-peice">
                    <form class="signup-form" action="#" method="post">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="fullname" id="fullname" class="name" required>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="email" required>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="phone" required>
                            <span class="error"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="aadhar">Aadhar Number</label>
                            <input type="text" name="aadhar" id="aadhar" class="aadhar" required>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="pass" required>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="passwordCon">Confirm Password</label>
                            <input type="password" name="passwordCon" id="passwordCon" class="passConfirm" required>
                            <span class="error"></span>
                        </div>

                        <div class="CTA">
                            <input type="submit" value="Signup Now" id="submit" name="create">
                            <a href="#" class="switch">I have an account</a>
                        </div>
                    </form>
                </div><!-- End Signup Form --> 
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Login Script -->
<script>
$(function(){
    $('#login').click(function(e){
        var valid = this.form.checkValidity();
        if(valid){
            var loginemail = $('#loginemail').val();
            var loginpassword = $('#loginpassword').val();
            
            e.preventDefault();
            
            $.ajax({
                type: 'POST',
                url: '/jslogin.php',
                data: {loginemail: loginemail, loginpassword: loginpassword},
                success: function(data){
                    if($.trim(data) === "1"){
                        Swal.fire({
                            title: 'Success!',
                            text: 'Login successful!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        setTimeout(function(){
                            window.location.href = "/index.php";
                        }, 1000);
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data,
                            icon: 'error'
                        });
                    }
                },
                error: function(data){
                    Swal.fire({
                        title: 'Error!',
                        text: 'There were errors while processing your request.',
                        icon: 'error'
                    });
                }
            });
        } else {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Please fill in all required fields.',
                icon: 'error'
            });
        }
    });
});
</script>

<!-- Signup Script -->
<script type="text/javascript">
$(function(){
    $('#submit').click(function(e){
        var valid = this.form.checkValidity();

        if(valid){
            var fullname = $('#fullname').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var aadhar = $('#aadhar').val();
            var password = $('#password').val();
            var passwordCon = $('#passwordCon').val();

            if(password !== passwordCon){
                e.preventDefault();
                Swal.fire({
                    title: 'Error!',
                    text: 'Passwords do not match.',
                    icon: 'error'
                });
                return;
            }

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/process.php',
                data: {
                    fullname: fullname,
                    email: email,
                    phone: phone,
                    aadhar: aadhar,
                    password: password
                },
                success: function(data){
                    Swal.fire({
                        title: 'Success!',
                        text: 'Account created successfully!',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(function(){
                        window.location.href = "/index.php";
                    }, 2000);
                },
                error: function(data){
                    Swal.fire({
                        title: 'Error!',
                        text: 'There were errors while creating your account.',
                        icon: 'error'
                    });
                }
            });
        } else {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Please fill in all required fields.',
                icon: 'error'
            });
        }
    });
});
</script>

<!-- Form Switching Script -->
<script>
$(document).ready(function(){
    $('.switch').click(function(e){
        e.preventDefault();
        
        if($('.login').hasClass('switched')){
            $('.login').removeClass('switched');
            $('.signup').addClass('switched');
        } else {
            $('.signup').removeClass('switched');
            $('.login').addClass('switched');
        }
    });
});
</script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src="/script.js"></script>

</body>
</html>