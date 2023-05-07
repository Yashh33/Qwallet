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
    <title>Qwallet Admin panel</title>
    <style>
        * {
  margin: 0;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
}

body {
  background-color: rgba(137, 43, 226, 0.219);
}

#Qr-output {
  /* text-align: center; */
  margin: 13px auto;
  /* mix-blend-mode: color-burn; */
}

.container {
  display: flex;
  flex-direction: column;
  align-items: flex start;
  height: 30%;
  width: 20%;
  margin: 10% auto;
  background-color: rgb(255, 255, 255);
  border-radius: 10px;
  font-size: larger;
  box-shadow: 0px 4px 10px 1px rgba(255, 255, 255, 0.394);
}

h1 {
  margin: 10px 10px;
}

.head {
  padding: 20px;
  text-align: center;
  background: #f2c8f96d;
}

.first-input {
  padding-top: 40px;
}

.input {
  display: flex;
  flex-direction: column;
  width: 80%;
  margin: 30px auto;
}

input {
  padding: 6px;
  font-size: 20px;
  border: 1px solid rgba(0, 0, 0, 0.162);
  border-radius: 3px;
}

input:focus {
  border-color: #e4bdfa;
  box-shadow: inset 0px 0px 2px 2px rgba(222, 142, 239, 0.25);
  outline: none;
}

.buttons {
  display: flex;
  margin: 20px auto;
}

button {
  padding: 10px 10px;
  background: #f2c8f9d8;
  border: 0;
  margin: 0px 2px;
  width: 20%;
  font-size: medium;
  border-radius: 3px;
}

.center {
  width: 50%;
  margin: 0 25%;
}

button:hover {
  opacity: 0.7;
}

button:active {
  scale: 0.95;
}

@media only screen and (max-width: 1400px) {
  .container {
    width: 30%;
    margin: 10% auto;
  }
}

@media only screen and (max-width: 600px) {
  .container {
    width: 90%;
    margin: 10% auto;
  }
}

@media only screen and (max-width: 400px) {
  .container {
    width: 95%;
    margin: 20% auto;
    padding: 5% 10%;
  }

  .input {
    font-size: small;
  }

  button {
    font-size: small;
  }
}

    </style>
</head>

<body>

    <div class="container">

        <div class="head">
            <h1>Qwallet</h1>
            <h3>Admin Panel</h3>
        </div>
        <form action="" method="post">

            <div class="input">
                <input type="text" placeholder="ENTER REWARD POINTS" name="reward_points">
            </div>

            <div class="buttons" style="justify-content: center;">
                <button style="width:200px;">SUBMIT</button>
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