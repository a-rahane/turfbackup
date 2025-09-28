<?php
session_start();

require_once('config.php');
?>

<?php

if (!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])) {
    http_response_code(401);
    echo 'Not authenticated.';
    exit;
}

if (!isset($_POST['invitee']) || empty($_POST['invitee'])) {
    http_response_code(400);
    echo 'Missing invitee.';
    exit;
}

$invitee = $_POST['invitee'];
// echo $_SESSION['user_email'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmtselect = $pdo->prepare($sql);
$result = $stmtselect->execute([$invitee]);

if($stmtselect->rowCount() > 0){
    $sql = "SELECT * FROM invites WHERE inviter = ? AND invitee = ?";
    $stmtselect2 = $pdo->prepare($sql);
    $result = $stmtselect2->execute([$_SESSION['user_email'], $invitee]);



    if($stmtselect2->rowCount() > 0) {
        echo 'An invite from you to this user already exists.';
    }else if(strcmp($_SESSION['user_email'], $invitee) === 0){
        echo 'Cannot send invite to yourself';
    }else{
        $new_sql = "INSERT INTO invites (inviter, invitee) VALUES (?, ?)";
        $stmtinsert = $pdo->prepare($new_sql);
        $final_result = $stmtinsert->execute([$_SESSION['user_email'], $invitee]);

        if($final_result){
            echo 'Invite sent successfully.';
        }else{
            echo 'Error sending invite.';
        }
    }
}else{
    echo 'invitee not found';
}