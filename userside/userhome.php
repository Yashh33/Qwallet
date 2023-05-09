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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
        <style>.swal2-styled.swal2-confirm{background-color: rgb(78, 122, 129);}.swal2-styled{margin:auto 30px;}</style>
    </head>

    <body>
        <header><div class="container">
            <a href="userhome.php" class="logo">
                <img src="images/qwalletlogo.png" alt="" style="height: 100px;width: 100px;">
            </a>
            <nav>
                <a href="userhome.php">HOME</a>
                <a href="scanqr.php">SCAN-QR</a>
                <a href="mywallet.php">MY-WALLET</a>
                <a href="balance.php">LEADERBOARD</a>
                <a href="logout.php" id="logout-link">LOGOUT</a>
            </nav></div>
        </header>

        <div class="btns container" style="margin-top: 250px;">
            <a href="scanqr.php" class="btn scanqr">
                CLICK TO SCAN QR
            </a>
        </div>
    </body>
    <script src="logout.js"></script>

    </html>

<?php
} else {

    //if the user doesn't have a session, send them to login page
    header("location: index.html");
}
?>