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
        <title>Qwallet - ScanQR</title>
        <script src="./node_modules/html5-qrcode/html5-qrcode.min.js"></script>
        <style>
            header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 80%;
                margin: 0 auto;
                /* mix-blend-mode: color-burn; */
            }

            nav {
                width: 50%;
                display: flex;
                justify-content: space-between;
                font-size: large;
                font-weight: bolder;
            }

            nav a:hover {
                background-color: rgba(42, 151, 165, 0.387);
            }

            nav a {
                text-decoration: none;
                color: black;
                padding: 10px 2%;
                border-radius: 5px;
            }

            body {
                background: url(https://media.istockphoto.com/id/674585488/vector/money-seamless-pattern-background-with-icons.jpg?s=612x612&w=0&k=20&c=S3ids-pK5iG4m4andUB1J67P7ELQiVLROJo8sdwUR6M=);
            }

            main {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #reader {
                width: 600px;
            }

            #result {
                text-align: center;
                font-size: 1.5rem;
            }

            @media only screen and (max-width : 1000px) {
                #reader {
                    scale: 0.8
                }
            }

            @media only screen and (max-width : 650px) {
                header {
                    flex-direction: column;
                    width: 100%;
                }


                .btn {
                    width: 70%;
                }

                #reader {
                    scale: 0.4
                }

                nav {
                    flex-wrap: wrap;
                }

                nav a {
                    width: 30%;
                }
            }
        </style>
        <link rel="stylesheet" href="style/indexmain.css">
    </head>

    <body>
        <header>
            <div class="logo">
                <img src="images/qwalletlogo.png" alt="" style="height: 100px;width: 100px;">
            </div>
            <nav>
                <a href="userhome.php">HOME</a>
                <a href="scanqr.php">SCAN-QR</a>
                <a href="balance.php">LEADERBOARD</a>
                <a href="logout.php">LOG OUT</a>
            </nav>
        </header>

        <main>
            <!-- SCANNER LIBRARY -->
            <div id="reader" style="font-size: 33px;scale: 1.2;margin-top: 5%;"></div>
            <!-- SCAN RESULT  -->
            <div id="result"></div>
        </main>


        <script>


            const scanner = new Html5QrcodeScanner('reader', {
                // Scanner will be initialized in DOM inside element with id of 'reader'
                qrbox: {
                    width: 250,
                    height: 250,
                },  // Sets dimensions of scanning box (set relative to reader element width)
                fps: 20, // Frames per second to attempt a scan
            });


            scanner.render(success, error);
            // Starts scanner

            function success(result) {
                // Prints result as a link inside result element
                window.location.href = result;
                scanner.clear();
                // Clears scanning instance

                document.getElementById('reader').remove();
                // Removes reader element from DOM since no longer needed

            }

            function error(err) {
                console.error(err);
                // Prints any errors to the console
            }

        </script>
    </body>

    </html>

    <?php
} else {
    header("location: index.html");
}
?>