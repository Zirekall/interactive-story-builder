<?php

    require_once "connect.php";
    $ID = $_POST['ID'];

    $sql = $conn->query("SELECT id_kroku FROM kroki WHERE id_opowiesci = '$ID'");
    
    while($wiersz = $sql->fetch_assoc()){
        $krok=$wiersz['id_kroku'];
        $usun=$conn->query("DELETE FROM drogi WHERE id_kroku ='$krok'");
        $usun=$conn->query("DELETE FROM kroki WHERE id_kroku ='$krok'");
    }

    $query = $conn->query("DELETE FROM opowiesci WHERE id_opowiesci ='$ID'");

    

    $conn->close();
    header('Location: ../admin/index.php');
    exit();
?>