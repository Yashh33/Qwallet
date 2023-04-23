<?php
// THIS FILES SENDS REWARD ID, POINTS IN DB

// Connect to the database
$host = 'localhost';
$reward_id = $_POST['reward_id'];
$reward_points = $_POST['reward_points'];
$dbname = 'user_registration';
$conn = mysqli_connect($host, "root", "", $dbname);

// Check for errors
if (mysqli_connect_error()) {
  die('Failed to connect to database: ' . mysqli_connect_error());
}

// Process the form data
$reward_id = mysqli_real_escape_string($conn, $_POST['reward_id']);
$reward_points = mysqli_real_escape_string($conn, $_POST['reward_points']);

$sql = "SELECT * FROM rewards WHERE reward_id = '$reward_id'";
$check = mysqli_query($conn,$sql);
if (mysqli_num_rows($check) > 0){
  echo "<script>alert('The reward id already exist.')</script>";
  echo "<meta http-equiv='refresh' content='0;url=http://localhost/qwallet/adminside/admin.html'>";
}else{
// Insert the data into the database
$sql = "INSERT INTO rewards (reward_id, reward_points) VALUES ('$reward_id','$reward_points')";
if (mysqli_query($conn, $sql)) {
  echo "";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Rewards </title>
  <link rel="stylesheet" href="indexmain.css">
  <style>
    body {
      background-color: rgba(137, 43, 226, 0.219);
    }

    .btn {
      padding: 10px 30px;
      width: 20%;
      text-decoration: none;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      background-color: white;
      margin: 10% 37%;
      color: black;
      font-size: 20px;
      font-weight: bold;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <header>
    <a href="userhome.php" class="logo">
      <img src="qwalletlogo.png" alt="" style="height: 100px;width: 100px;margin: 20px 44%;">
    </a>
  </header>

  <a class="btn" href="http://localhost/qwallet/userside/index.html">
    Click to move userside!
  </a>
<div class="btn">
  <?php

// fetch the past reward id with reward points 
$sql = "SELECT reward_id, reward_points
        FROM rewards
        ORDER BY reward_id DESC";
$result = mysqli_query($conn, $sql);

// Fetch the results as an array of associative arrays
$results = mysqli_fetch_all($result, MYSQLI_ASSOC);

// gives the output of the result
echo '<i>PAST REWARDS</i><br><br>';
echo '<div>';
foreach ($results as $row) {
    echo $row['reward_id'] . ': ' . $row['reward_points'] . '<br>';
} echo '</div>';

// Close connection
mysqli_close($conn);
?></div>
</body>

</html>