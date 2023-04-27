<?php 
// Connect to the database
$host = 'localhost';
$dbname = 'user_registration';
$conn = mysqli_connect($host, "root", "", $dbname);

 function generateRandomString($length = 10)
 {
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, strlen($characters) - 1)];
     }
     return $randomString;
 }

 // Generate a unique alphanumeric value and insert it into the database
 $unique = false;
 while (!$unique) {
     $randomString = generateRandomString();
     $sql = "SELECT * FROM rewards WHERE reward_id = '$randomString'";
     $result = mysqli_query($conn, $sql);
     if ($result->num_rows == 0) {
         $unique = true;
     }
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Qwallet Admin panel</title>
</head>

<body>

    <div class="container">

        <div class="head">
            <h1>Qwallet</h1>
            <h3>Admin Panel</h3>
        </div>
        <form action="" method="post">
            <div class="input first-input">
                
            </div>

            <div class="input">
                <input type="text" placeholder="Points to give" name="reward_points">
            </div>

            <div class="buttons">
                <button>SUBMIT</button>
            </div>
        </form>
        <?php

        // Check for errors
        if (mysqli_connect_error()) {
            die('Failed to connect to database: ' . mysqli_connect_error());
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the form data
            $reward_points = mysqli_real_escape_string($conn, $_POST['reward_points']);

            $sql = "INSERT INTO rewards (reward_id, reward_points) VALUES ('$randomString','$reward_points')";
            if (mysqli_query($conn, $sql)) {
                echo '<div id="Qr-output"></div>';
                header("location: get_reward.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        ?>
        
    </div>

    <script>
        // generates qr code
        document.getElementById('btn').addEventListener('click', function() {
            const uniqueId = document.getElementById('reward_id').value;
            // make new url for the qr code
            const url = `http://localhost/qwallet/userside/wallet.php?id=${uniqueId}`;
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
</body>

</html>