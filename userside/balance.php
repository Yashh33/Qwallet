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
        echo '<h1 style="width: 40%;margin: 20px auto;text-align: center;">Leaderboard</h1>';
        foreach ($results as $row) {
            echo '<div style="padding: 1px 20px;
            width: 15%;
            margin: 1px auto;text-transform: capitalize;
            background:rgba(42, 151, 165, 0.187);"><b>' . $row['name'] . ': </b>' . $row['wallet_balance'] . ' Points</div><br>';
        }

        // Close connection
        mysqli_close($conn);

        ?>
    </body>

    </html>
<?php
} else {
    header("location: index.html");
}
?>