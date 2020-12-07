<?php
$title = "Internetowy kwestionariusz osobowości - Panel logowania";
$header="Logowanie";
include "header.php";
?>

<body>
    <div class="container">
        <div id=login-panel>
            <div id="login-form">
                <h3 class="mt-4">Zaloguj się, żeby przejsc do panelu admina</h3>
                <form  action="functions/login.php" method="post">
                    <label for="login-input">Login:</label><br>
                    <input name="login" id="login" type="text"><br>
                    <label for="password-input">Hasło:</label><br>
                    <input name="password" id="password" type="password"><br>
                    <input class="mt-3"type="submit" value="Zaloguj">
                </form>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.slim.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>