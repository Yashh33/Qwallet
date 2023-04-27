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
    <link rel="stylesheet" href="admin.css">
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
                <input type="text" placeholder="ENTER REWARD POINTSgi" name="reward_points">
            </div>

            <div class="buttons" style="justify-content: center;">
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
</body>

</html>