<?php

require_once('config.php');
session_start();
// Expect session to already contain user info from login

// Read inputs safely
$date = isset($_POST['date']) ? $_POST['date'] : null;
$turfname = isset($_POST['turfname']) ? $_POST['turfname'] : null;
$time = isset($_POST['time']) ? $_POST['time'] : null;

if (!$date || !$turfname || !$time) {
    http_response_code(400);
    echo 'Missing required fields.';
    exit;
}

if (!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])) {
    http_response_code(401);
    echo 'Not authenticated.';
    exit;
}

$email = $_SESSION['user_email'];



// require("slots.php";);





$sql = "SELECT * FROM matches 
        WHERE turf = ?
        AND date = ?
        AND slot = ?";
$stmtselect = $pdo->prepare($sql);
$result = $stmtselect->execute([$turfname,$date,$time]);


// CASE 1: INVITER1 IS WAITING FOR MATCH
if($stmtselect->rowCount() > 0){

    // echo $count;

    $row = $stmtselect->fetch(PDO::FETCH_ASSOC);
    $inviter1 = $row['inviter1'];

    if($inviter1 != $email){                                    //So that inviter is not matched with himself
    
    // echo "hello";
        $new_sql = "UPDATE matches
                    SET inviter2 = '$email'
                    WHERE turf = '$turfname'
                    AND date = '$date'
                    AND slot = '$time'";
        // echo $new_sql;   

        $stmtselect = $pdo->prepare($new_sql);
        $result = $stmtselect->execute();
            
    }
    else{
        echo "match request already exists";
    }            
}
// CASE 2: NO TEAM HAS SELECTED THIS TURF BEFORE
else{
    // Insert new match (schema without 'count' column)
    $new_sql = "INSERT INTO matches (turf,date,slot,inviter1) 
                VALUES (?,?,?,?)";

    $stmtselect = $pdo->prepare($new_sql);
    $result = $stmtselect->execute([$turfname,$date,$time,$email]);
    if ($result) {
        echo 'match request created';
    } else {
        http_response_code(500);
        echo 'Failed to create match';
    }
}

