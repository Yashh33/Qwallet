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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
        <style>
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
            .swal2-styled.swal2-confirm{
                background-color: rgb(78, 122, 129);
            }.swal2-styled{margin:auto 30px;}

            @media only screen and (max-width : 1000px) {
                #reader {
                    scale: 0.8
                }
            }

            @media only screen and (max-width : 650px) {
                #reader {
                    scale: 0.4
                }
            }
        </style>
        <link rel="stylesheet" href="style/indexmain.css">
    </head>

    <body>
        <header>
            <div class="container">
            <div class="logo">
                <img src="images/qwalletlogo.png" alt="" style="height: 100px;width: 100px;">
            </div>
            <nav>
                <a href="userhome.php">HOME</a>
                <a href="scanqr.php">SCAN-QR</a>
                <a href="mywallet.php">MY-WALLET</a>
                <a href="balance.php">LEADERBOARD</a>
                <a href="logout.php" id="logout-link">LOGOUT</a>
            </nav>
        </div>
        </header>

        <main>
            <!-- SCANNER LIBRARY -->
            <div id="reader" style="font-size: 25px;scale: 1.2;margin-top: 5%;background-color: rgb(78, 122, 129);border-radius:20px;color:white;"></div>
        </main>


        <script>
            const scanner = new Html5QrcodeScanner('reader', {
                // Scanner will be initialized in DOM inside element with id of 'reader'
                qrbox: {
                    width: 250,
                    height: 250,
                }, // Sets dimensions of scanning box (set relative to reader element width)
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
    <script src="logout.js"></script>

    </html>

<?php
} else {
    header("location: index.html");
}
?>