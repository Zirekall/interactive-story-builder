<?php
    @session_start();

    if(!isset($_POST['login']) || !isset($_POST['password'])) {
        header('Location: ../login-panel.php');
        exit();
    }
    require_once "connect.php";

    $sql = "SELECT `login`, `passw`,`adminID` FROM `admins` WHERE `login` = ".$_POST['login'];


    $wynik = @$conn->query(sprintf("SELECT  * FROM `admins` WHERE `login` = '%s'", mysqli_real_escape_string($conn, $_POST['login'])));

    $x=$wynik->num_rows;

    if ($x == 1) {
        $get_dane = $wynik->fetch_assoc();
 
        if (password_verify($_POST['password'], $get_dane['passw'])) {

            $_SESSION['loggedin'] = true;

            $_SESSION['user'] = $get_dane['name'];
            $_SESSION['ID'] = $get_dane['adminID'];
            
            unset($_SESSION['err']);
            $wynik->free_result();
            header('Location: ../admin/');
        } else {
            $_SESSION['err'] = '<p>Nieprawidłowy login lub hasło</p>';
            header('Location: ../login-panel.php');
        }
    }else {
        $_SESSION['err'] = '<p>Nieprawidłowy login lub hasło</p>';
        header('Location: ../login-panel.php');
    }
    $conn->close();

?>