<?php

    require_once "connect.php";
    $ID = $_POST['ID'];
    
    $usun=$conn->query("DELETE FROM czesci WHERE ID_opowiesci ='$ID'");
    $usun=$conn->query("DELETE FROM opowiesci WHERE ID_opowiesci ='$ID'");

    $conn->close();
    header('Location: ../admin/index.php');
    exit();
?>