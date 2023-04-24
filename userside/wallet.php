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

    <div id="output" style="
    padding: 10%;
    border-radius: 50%;
    font-size: 20px;
    margin: 5% auto;
    width: 70%;
    text-align: center;
    background: rgba(42, 151, 165, 0.387);">
      <?php

      // check if there is unique id, if yes get that id and store it in $uniqueID
      if (isset($_GET['id'])) {
        $uniqueId = $_GET['id'];

        // establish database connection
        $conn = mysqli_connect('localhost', 'root', '', 'user_registration');
        // get the user's email from the session
        $user_email = $_SESSION['email'];

        // check if the reward code is valid and has not been redeemed
        $sql = "SELECT * FROM rewards WHERE reward_id = '$uniqueId' AND status = 0";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) { // if there exist any row then the reward is not claimed

          // reward is valid and has not been redeemed
          $row = mysqli_fetch_assoc($result);
          $rewardPoints = $row['reward_points'];


          // get the user's current wallet balance from the database
          $sql = "SELECT wallet_balance FROM registration WHERE email = '$user_email'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $current_balance = $row['wallet_balance'];

          // calculate the new wallet balance
          $new_balance = $current_balance + $rewardPoints;

          // update the user's wallet balance in the database
          $sql = "UPDATE registration SET wallet_balance = '$new_balance' WHERE email = '$user_email'";
          mysqli_query($conn, $sql);

          // update the reward status where uniqueID is same as rewardID to indicate that it has been redeemed
          $sql = "UPDATE rewards SET status = 1 WHERE reward_id = '$uniqueId'";
          mysqli_query($conn, $sql);

          if (mysqli_affected_rows($conn) > 0) {
            // redemption was successful
            echo "<b>Congratulations,<br> you earned " . $rewardPoints . " Points!</b><br>";
            echo '<br><b style="text-transform:capitalize;"><i>' . $_SESSION['name'] . "'s</b></i> wallet balance is " . $new_balance . " Points!";
            $sql = "INSERT INTO user_rewards (email, reward_id, points_rewarded) VALUES ('$user_email', '$uniqueId', $rewardPoints)";
            mysqli_query($conn,$sql);
          } else {
            // there was an error updating the reward status
            echo "Error redeeming reward. Please try again later.";
          }
        } else {
          // reward is invalid or has already been redeemed
          $sql = "SELECT * FROM rewards WHERE reward_id = '$uniqueId' AND status = 1";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) { // checks if row exist with status 1
            // reward has already been redeemed
            echo "<b>Invalid Code: This code has already been redeemed.</b><br>";
            $sql = "SELECT wallet_balance FROM registration WHERE email = '$user_email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $show_balance = $row['wallet_balance'];
            echo '<br><b style="text-transform:capitalize;"><i>' . $_SESSION['name'] . "'s</b></i> wallet balance is " . $show_balance . " Points!"; // shows wallet balance 
          } else {
            // reward id does not exist or has been deactivated
            echo "<b>Invalid Code: This code is not valid.</b><br>";
            $sql = "SELECT wallet_balance FROM registration WHERE email = '$user_email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $show_balance = $row['wallet_balance'];
            echo '<br><b style="text-transform:capitalize;"><i>' . $_SESSION['name'] . "'s</i></b> wallet balance is " . $show_balance . " Points!"; // shows wallet balance 
          }
        }
      }

      mysqli_close($conn);

      ?>
    </div>

  </body>

  </html>
<?php
} else {
  header("location: index.html");
}
?>