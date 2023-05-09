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
        <title>Qwallet - Leaderboard</title>
        <link rel="stylesheet" href="style/indexmain.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
       <style>
            .wallet-history-container {
                background-color: rgba(27, 26, 26, 0.55);
                margin: 5% auto;
                width: 20%;
                height: 310px;
                padding-top: 5px;
                font-size: 22px;
                border: 3px solid rgba(42, 151, 165, 0.587);
                border-radius: 10px;
                display: flex;
                flex-direction: column;
                align-items: center;
                color:white;
            }

            .wallet-history-content {
                width: 100%;
                margin: auto;
                height: 90%;
                overflow-y: scroll;
                background-color: rgb(78, 122, 129);
                border-top: 3px solid rgba(42, 151, 165, 0.587);
            }

            .swal2-styled.swal2-confirm{
                background-color: rgb(78, 122, 129);
            }.swal2-styled{margin:auto 30px;}

        </style>
    </head>

    <body>
        <header>
            <div class="container">
            <a href="userhome.php" class="logo">
                <img src="images/qwalletlogo.png" alt="" style="height: 100px;width: 100px;">
            </a>
            <nav>
                <a href="userhome.php">HOME</a>
                <a href="scanqr.php">SCAN-QR</a>
                <a href="mywallet.php">MY-WALLET</a>
                <a href="balance.php">LEADERBOARD</a>
                <a href="logout.php" id="logout-link">LOGOUT</a>
            </nav>
            </div>
        </header>

        <div id="walletHistory" class="wallet-history-container">
            <div style="font-weight:bolder;padding-top:3px;padding-bottom:10px;text-align:center;text-transform:capitalize;text-decoration:underline;">QWALLET LEADERBOARD</div>
            <div class="wallet_history wallet-history-content">
        <?php

        // establish database connection
        $conn = mysqli_connect('localhost', 'root', '', 'user_registration');

        // Execute the SQL query
        $sql = "SELECT name, wallet_balance
                FROM registration
                ORDER BY wallet_balance DESC
                LIMIT 5";
        $result = mysqli_query($conn, $sql);

        // Fetch the results as an array of associative arrays
        $results = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Output the results
        foreach ($results as $row) {
            //echo '<div style="padding: 1px 20px;width: 15%;margin: 1px auto;text-transform: capitalize;background:rgba(42, 151, 165, 0.187);"><b>' . $row['name'] . ': </b>' . $row['wallet_balance'] . ' Points</div><br>';
            echo '<br><div style="padding: 1px 20px;font-size:20px;margin: 1px auto;background:rgba( 78, 78, 78,0.9);"><i>' . $row['name'] . ': </i><span style="float:right;">' . $row['wallet_balance'] . ' Points</span> </div>';

        }

        // Close connection
        mysqli_close($conn);

        ?>
        </div>
    </div>
    </body>
    <script src="logout.js"></script>

    </html>
<?php
} else {
    header("location: index.html");
}
?>