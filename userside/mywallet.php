<?php

session_start();

if (isset($_SESSION['email']) && isset($_SESSION['name'])) {

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/indexmain.css">
  </head>

  <body>
    <header>
      <a href="indexmain.php" class="logo">
        <img src="images/qwalletlogo.png" alt="" style="height: 100px;width: 100px;">
      </a>
      <nav>
        <a href="userhome.php">HOME</a>
        <a href="scanqr.php">SCAN-QR</a>
        <a href="balance.php">LEADERBOARD</a>
        <a href="logout.php">LOG OUT</a>
      </nav>
    </header>

    <div class="wallet_history">
        <?php 
        // Create connection
$conn = new mysqli("localhost", "root", "", "user_registration");
$useremail = $_SESSION['email'];

//execute the query
$sql = "SELECT email, points_rewarded, transaction_no, created_at FROM user_rewards ORDER BY transaction_no DESC";
$result = mysqli_query($conn, $sql);
$results = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT name FROM registration WHERE email = '$useremail'";
$name = mysqli_query($conn, $sql);

//output 
//echo '<h1 style="width: 40%;margin: 20px auto;text-align: center;">' . $name ."'s wallet history</h1>";
foreach ($results as $row) {
    $created_at = date('H:i, d-m-Y. ', strtotime($row['created_at']));
    echo '<div style="padding: 1px 20px;font-size:20px;width: 35%;margin: 1px auto;background:rgba(42, 151, 165, 0.187);"><b><span style="margin-left:5%;margin-right:5%;">' . $row['points_rewarded'] . ' Points<span></b> added on  ' . $created_at . '</div><br>';
}
        ?>
    </div>
    </body>

  </html>
<?php
} else {
  header("location: index.html");
}
?>