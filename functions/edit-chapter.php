<?php
@session_start();
require_once "../functions/connect.php";
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../login-panel.php');
    exit();
}
$globalID=$_POST['ID'];
$left=$_POST['left'];
$right=$_POST['right'];
$label=$_POST['label'];

if (isset($_POST['previous'])) {
    $previous=$_POST['previous'];
    $sql=$conn->query("UPDATE czesci SET lewo='$left',prawo='$right',label='$label',poprzednia='$previous' WHERE globalID='$globalID'");
}
else{
    $sql=$conn->query("UPDATE czesci SET lewo='$left',prawo='$right',label='$label' WHERE globalID='$globalID'");
}


$conn->close();
header("Location: ../admin/edit-story.php?id=$storyID");
?>