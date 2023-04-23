<?php

// session continue
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['name'])) {

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Qwallet - Home page</title>
        <link rel="stylesheet" href="style/indexmain.css">
    </head>

    <body>
        <header>
            <a href="userhome.php" class="logo">
                <img src="images/qwalletlogo.png" alt="" style="height: 100px;width: 100px;">
            </a>
            <nav>
                <a href="userhome.php">HOME</a>
                <a href="scanqr.php">SCAN-QR</a>
                <a href="balance.php">LEADERBOARD</a>
                <a href="logout.php">LOG OUT</a>
            </nav>
        </header>

        <div class="btns container" style="margin-top: 250px;">
            <a href="scanqr.php" class="btn scanqr">
                CLICK TO SCAN QR
            </a>
        </div>
    </body>

    </html>

    <?php
} else {

    //if the user doesn't have a session, send them to login page
    header("location: index.html");
}
?>