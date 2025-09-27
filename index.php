<?php 
session_start(); 
if (!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])) {
    // Redirect the user to the login page or any desired page
    header("Location: /Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/HomeStyles.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <title>HOME</title>
</head>
<body style="background-color: #0c2605;">
        <header>
            <!-- <a class="logo" href="/"><img src="/images/logo.svg" alt="logo"></a> -->
            <nav>
                <ul class="nav__links">
                <li><a href="/Home.html">Home</a></li>
                <li><a href="/Home.html#about">About</a></li>
                <li><a href="/Home.html#review">Review</a></li>
                </ul>
            </nav>
            <a class="cta" href="/logout.php">Log Out</a>
            <a class="cta"><?php echo $_SESSION['user_email']; ?> </a>
        </header>

        <script src="/slider-script.js"></script>

        <div class="row">
            <div class="slider">
                <img id="slider-img" src="/images/football-slider.jpeg" alt="slider image">
            </div>
        </div>
            <div class="row">
            <div class="page-buttons"> 
	            <div class="container">
	                <div class="column">
                        <div class="column-image"><img src="/images/Add people-01.png" width="200" height="200"/></div>
                        <div><button onclick="window.location.href='/secondarypages/invite.php'" class="invite-players">Invite Players</button></div>
	                </div>
	                                    
	                <div class="column">
                        <div class="column-image"><img src="/images/group-01.png" width="200" height="200"/></div>
                        <div class="button-index"><button onclick="window.location.href='/secondarypages/viewteam.php'" class="view-team">View Team</button></div>
	                </div> 

	                <div class="column">
                        <div class="column-image"><img src="/images/turficon-01.png" width="200" height="200"/></div>
                        <div><button onclick="window.location.href='/secondarypages/findmatch.php'" class="find-match">Find Match</button></div>
                    </div>
	            </div>
                  </div>
        </div>
        <!-- <h1>Session Variables:</h1>
        <p>Variable 1: </p> -->

</body>
</html>