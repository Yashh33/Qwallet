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
        <title>Qwallet - My Wallet</title>
        <link rel="stylesheet" href="style/indexmain.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
        <style>
            .wallet-history-container {
                background-color: rgba(27, 26, 26, 0.55);
                margin: 0 auto;
                width: 32%;
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

            .hide {
                display: none;
            }
            .swal2-styled.swal2-confirm{
                background-color: rgb(78, 122, 129);
            }.swal2-styled{margin:auto 30px;}
        </style>
    </head>

    <body>
        <header>
            <div class="container">
            <a href="indexmain.php" class="logo">
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

        <button onclick="toggleWalletHistory()" class="btn" style="width: 15%;margin: 5% 43% 10px 43%;"></button>

        <div id="walletHistory" class="wallet-history-container hide">
            <div style="font-weight:bolder;padding-top:3px;padding-bottom:10px;text-align:center;text-transform:capitalize;text-decoration:underline;"><?php echo $_SESSION['name'];?>'S WALLET HISTORY</div>
            <div class="wallet_history wallet-history-content">
                <?php
                // Create connection
                $conn = new mysqli("localhost", "root", "", "user_registration");
                $useremail = $_SESSION['email'];

                //execute the query
                $sql = "SELECT email, points_rewarded, transaction_no, created_at FROM user_rewards 
                WHERE email = '$useremail' ORDER BY transaction_no DESC ";
                $result = mysqli_query($conn, $sql);
                $results = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                $sql = "SELECT name FROM registration WHERE email = '$useremail'";
                $name = mysqli_query($conn, $sql);

                //output 
                foreach ($results as $row) {
                    $created_at = date('H:i, d-m-Y. ', strtotime($row['created_at']));
                    echo '<br><div style="padding: 1px 20px;font-size:20px;margin: 1px auto;background:rgba( 78, 78, 78,0.9);"><i>' . $row['points_rewarded'] . ' Points added</i><span style="float:right;"> - ' . $created_at . '</span></div>';
                }
                ?>
            </div>
            <div style="font-weight:bolder;padding-top:3px;padding-bottom:3px;text-align:center;text-transform:capitalize;"> YOUR BALANCE : <?php $sql = "SELECT wallet_balance FROM registration WHERE email = '$useremail'";$bal = mysqli_query($conn, $sql);$row = mysqli_fetch_assoc($bal);echo $row['wallet_balance'] . ' POINTS'; ?></div>
        </div>
        <script>
            function toggleWalletHistory() {
                var walletHistory = document.getElementById("walletHistory");
                walletHistory.classList.toggle("hide");
                var button = document.getElementsByTagName("button")[0];
                if (walletHistory.classList.contains("hide")) {
                    button.innerHTML = "Show Wallet History";
                } else {
                    button.innerHTML = "Hide Wallet History";
                }
            }

            // Add this code to start with the wallet history content hidden
            document.addEventListener("DOMContentLoaded", function(event) {
                var walletHistory = document.getElementById("walletHistory");
                walletHistory.classList.add("hide");
                var button = document.getElementsByTagName("button")[0];
                button.innerHTML = "Show Wallet History";
            });
        </script>
    </body>
    <script src="logout.js"></script>


    </html>
<?php
} else {
    header("location: index.html");
}
?>