<?php 
@session_start();
include "functions/connect.php";
?>
<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/fef7379b87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <?php
    echo "<title>".$title."</title>";
    ?>

    <head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Internetowy kwestionariusz osobowości</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="tests.php">Kwestionariusze</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="enter-code.php">Opowieść</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/">Admin Panel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <header>
            <!-- <div class="row"> -->
                <div class="col-lg-12 text-center">
                    <h1 class="pt-5 pb-5">
                        <?php
                        echo $header
                    ?>
                    </h1>
                </div>
            </div>
        </header>