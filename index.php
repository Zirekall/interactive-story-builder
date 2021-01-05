<?php
include "functions/connect.php";
?>
<html lang="">

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/landingpage.css">

    <title>Internetowy kwestionariusz osobowości</title>
</head>

<body>
    <nav>
        <h1>Internetowy kwestionariusz osobowości</h1>
        <div id="tak"><a href="admin/">Admin Panel</a></div>
</nav>
    <div class="container-fluid">
        <div id="two-side">
            <div id="lewy" class="col-md-6">
                <a href="tests.php">
                    <div class="hovertext">
                        <h1>Test osobowości</h1>
                        <p>Rozwiąż test osobowości</p>
                    </div>
                    <div class="helper">
                        <img src="img/people.png" alt="kwestionariusze osobowości">
                    </div>
                </a>
            </div>

            <div id="prawy" class="col-md-6">
                <a href="enter-code.php">
                    <div class="hovertext">
                        <h1>Interaktywna opowieść</h1>
                        <p>Rozwiąż interaktywaną opowieść</p>
                    </div>
                    <div class="helper">
                        <img src="img/comic.png" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>


</html>