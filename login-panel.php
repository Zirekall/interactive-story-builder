<?php
@session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
header('Location:  admin.php');
exit();
}
$title = "Internetowy kwestionariusz osobowości - Panel logowania";
$header="Logowanie";
include "header.php";

?>

<body>
    <div class="container">
        <div class="text-center">
            <h3 class="mt-4">Zaloguj się, żeby przejsc do panelu admina</h3>
            <form  action="functions/login.php" method="post">
                <label for="login-input">Login:</label><br>
                <input name="login" id="login" type="text"><br>
                <label for="password-input">Hasło:</label><br>
                <input name="password" id="password" type="password"><br>
                <input class="mt-3"type="submit" value="Zaloguj">
            </form>
            <hr>
            <?php 
                if(isset($_SESSION['err'])) {
                    echo $_SESSION['err'];
                } else { echo ''; } 
            ?>
        </div>
    </div>

</body>