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
$storyID=$_POST['storyID'];
if (isset($_POST['previous'])) {
    $sql=$conn->query("UPDATE czesci SET lewo='$left',prawo='$right',label='$label' WHERE globalID='$globalID'");
    print_r($globalID);
    $sql=$conn->query("DELETE FROM sciezki WHERE globalID= '$globalID'");
    foreach ($_POST['previous'] as $key => $previous) {
        $query = $conn->query("INSERT INTO sciezki VALUES (NULL,'$globalID','$previous','$storyID')");
    }
}
else{
    $sql=$conn->query("UPDATE czesci SET lewo='$left',prawo='$right',label='$label' WHERE globalID='$globalID'");
}


$conn->close();
header("Location: ../admin/edit-story.php?id=$storyID");
?>