<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Rewards </title>
  <link rel="stylesheet" href="admin.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

  <div class="buttons">
    <button id="btn">Generate QR</button>
    <button id="download-btn">Download QR</button>
  </div>

<div id="Qr-output"></div>

  <div class="btn">
    <?php
    // Connect to the database
    $host = 'localhost';
    $dbname = 'user_registration';
    $conn = mysqli_connect($host, "root", "", $dbname);


    // fetch the past reward id with reward points 
    $sql = "SELECT reward_id, reward_points
        FROM rewards
        ORDER BY sr_no DESC";
    $result = mysqli_query($conn, $sql);

    // Fetch the results as an array of associative arrays
    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // gives the output of the result
    echo '<i>PAST REWARDS</i><br><br>';
    echo '<div>';
    foreach ($results as $row) {
      echo $row['reward_id'] . ': ' . $row['reward_points'] . '<br>';
    }
    echo '</div>';

    $sql = 'SELECT reward_id FROM rewards ORDER BY sr_no DESC LIMIT 1';
    $result = mysqli_query($conn, $sql);
    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($results as $row) {
    $idforQR = $row['reward_id']; 
    }
    ?>
    </div>

    
</body>
<script>
  // // generates qr code
  // document.getElementById('btn').addEventListener('click', function() {
  //   const uniqueId = document.getElementById('reward_id').value;
  //   // make new url for the qr code
  //   const url = `http://localhost/qwallet/userside/wallet.php?id=${uniqueId}==`;
  //   //updates id= Qr-output 
  //   const QrCode = document.getElementById('Qr-output');
  //   QrCode.innerHTML = "<b>SCAN TO EARN POINTS</b>";
  //   // generates the qr code
  //   new QRCode(QrCode, url);
  // })
// generates qr code
document.getElementById('btn').addEventListener('click', function() {
    
    const url = `http://localhost/qwallet/userside/wallet.php?id=<?php echo $idforQR;?>`;
    //updates id= Qr-output 
    const QrCode = document.getElementById('Qr-output');
    QrCode.innerHTML = "<b>SCAN TO EARN POINTS</b>";
    // generates the qr code
    new QRCode(QrCode, url);
})
  //download qr code
  const downloadBtn = document.getElementById('download-btn');
  const QrOutput = document.getElementById('Qr-output');
  //adds the download button  
  downloadBtn.addEventListener('click', function() {
    const qrImage = QrOutput.querySelector('img');
    const url = qrImage.src;
    const link = document.createElement('a');
    link.download = 'qrcode.png';
    link.href = url;
    link.click();
  });
</script>

</html>

<?php
// Close connection
mysqli_close($conn);
?>