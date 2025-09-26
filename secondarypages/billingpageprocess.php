<?php
require_once("config.php");
session_start();

if (!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])) {
    http_response_code(401);
    echo 'Not authenticated.';
    exit;
}

$inviter_email = $_SESSION['user_email'];
$totalAmount = 2000;
$perHead = $totalAmount; // default for solo
// echo $inviter_email;




$sql = "SELECT * FROM team WHERE inviter = ?";
$stmt = $db->prepare($sql);
$result = $stmt->execute([$inviter_email]);

  




if($stmt->rowCount() > 0){
        $teamCount = (int)$stmt->rowCount();
        $perHead = ($totalAmount/($teamCount+1));
        echo "<div class='view-fri'>
                    <div>
                  <h2 class='view-name'>".$inviter_email."</h2>
                </div>
                <div>
                  <h6 class='view-numb'>₹".$perHead."</h6>
                </div>
                </div>";
        // echo $inviter_email;
        // echo "<hr>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='view-fri'>
                    <div>
                  <h2 class='view-name'>".$row["invitee"]."</h2>
                </div>
                <div>
                  <h6 class='view-numb'>₹".$price."</h6>
                </div>
                </div>";
        
    }
    echo "<div class='view-fri'>
                    <div>
                  <h2 class='view-name'>TOTAL</h2>
                </div>
                <div>
                  <h6 class='view-numb'>₹".$totalAmount."</h6>
                </div>
                </div>";

}
else{
    // No teammates: show inviter and total
    echo "<div class='view-fri'>
                    <div>
                  <h2 class='view-name'>".$inviter_email."</h2>
                </div>
                <div>
                  <h6 class='view-numb'>₹".$perHead."</h6>
                </div>
                </div>";

    echo "<div class='view-fri'>
                    <div>
                  <h2 class='view-name'>TOTAL</h2>
                </div>
                <div>
                  <h6 class='view-numb'>₹".$totalAmount."</h6>
                </div>
                </div>";
}
