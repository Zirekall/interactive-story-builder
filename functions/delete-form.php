<?php

    require_once "connect.php";
    $ID = $_POST['ID'];

    if (isset($conn)) {
        $query = $conn->query("DELETE FROM formularze WHERE ID_formularza ='$ID'");
    }

    $query = $conn->query("DELETE FROM pytania WHERE ID_formularza ='$ID'");

    $query = $conn->query("DELETE FROM form_wyniki WHERE ID_formularza ='$ID'");

    $conn->close();
    header('Location: ../admin/index.php');
    exit();
?>