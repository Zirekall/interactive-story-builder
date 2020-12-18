<?php

    require_once "connect.php";
    $ID = $_POST['ID'];
    $query = $conn->query("DELETE FROM formularze WHERE ID_formularza ='$ID'");

    $query = $conn->query("DELETE FROM pytania WHERE ID_formularza ='$ID'");

    $conn->close();
    header('Location: ../admin/index.php');
?>