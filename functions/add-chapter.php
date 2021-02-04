<?php
@session_start();
require_once "../functions/connect.php";
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../login-panel.php');
    exit();
}
$chapterID = uniqid();
$left = $_POST['left'];
$right = $_POST['right'];
$label = $_POST['label'];
$storyID = $_POST['storyID'];

$sql=$conn->query("SELECT COUNT(localID) AS liczba_czesci FROM czesci WHERE id_opowiesci='$storyID'");
$ilosc=$sql->fetch_assoc();
$localID=$ilosc['liczba_czesci']+1;

$query = $conn->query("INSERT INTO czesci VALUES ('$chapterID', '$localID','$left', '$right','$label','$storyID')");
foreach ($_POST['previous'] as $key => $previous) {
    $query = $conn->query("INSERT INTO sciezki VALUES (NULL,'$chapterID','$previous','$storyID')");
}


$conn->close();
header("Location: ../admin/edit-story.php?id=$storyID");

?>