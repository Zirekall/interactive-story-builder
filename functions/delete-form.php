<?php

    require_once "connect.php";
    $ID = $_POST['ID'];

    $query = $conn->query("DELETE FROM formularze WHERE ID_formularza ='$ID'");

    $query = $conn->query("DELETE FROM pytania WHERE ID_formularza ='$ID'");


    $query = $conn->query("SELECT ID_wyniku FROM form_wyniki WHERE ID_formularza ='$ID'");
    while ($wyniki=$query->fetch_assoc()) {
        $wynik=$wyniki['ID_wyniku'];
        $query2 = $conn->query("DELETE FROM odpowiedzi WHERE ID_wyniku ='$wynik'");
        $query2 = $conn->query("DELETE FROM form_wyniki WHERE ID_formularza ='$ID'");
    }

    

    $conn->close();
    header('Location: ../admin/index.php');
    exit();
?>