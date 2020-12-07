<?php
    @session_start();

    if(!isset($_POST['email']) || !isset($_POST['haslo'])) {
        header('Location: ../login-panel.php');
        exit();
    }
    require_once "connect.php";

    $sql = "SELECT `login`, `passw` FROM `admins` WHERE `login` = ".$_POST['login'];


    $wynik = @$conn->query(sprintf("SELECT  * FROM `admins` WHERE `login` = '%s'", mysqli_real_escape_string($conn, $_POST['login'])));

    $x=$wynik->num_rows;
    if ($x == 1) {
        $get_dane = $wynik->fetch_assoc();
 
        if (password_verify($_POST['password'], $get_dane['passw'])) {
            echo "udało się ". $get_dane['name'];

            $_SESSION['loggedin'] = true;

            $_SESSION['id'] = $get_dane['id_user'];
            $_SESSION['imie'] = $get_dane['imie'];
            $_SESSION['nazwisko'] = $get_dane['nazwisko'];
            $_SESSION['email'] = $get_dane['email'];
            
            unset($_SESSION['err']);
            $result->free_result();
            header('Location: ../admin.php');
        } else {
            $_SESSION['err'] = '<p>Nieprawidłowy login lub hasło.</p>';
            header('Location: ../login-panel.php');
        }
    }else {
        $_SESSION['err'] = '<p>Nieprawidłowy login lub hasło.</p>';
        header('Location: ../login-panel2.php');
    }
    $polaczenie->close();

?>