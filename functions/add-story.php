<?php
@session_start();
require_once "../functions/connect.php";
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../login-panel.php');
    exit();
}
$storyID = uniqid();
$userID = $_SESSION['ID'];
$name = $_POST['tytul'];
$left = $_POST['left'];
$right = $_POST['right'];
$label = $_POST['label'];
$chapterID = uniqid();

$query = $conn->query("INSERT INTO opowiesci VALUES ('$storyID', '$userID','$name', NOW())");

$query = $conn->query("INSERT INTO czesci VALUES ('$chapterID', 1,'$left','$right','$label',0,'$storyID')");

$conn->close();
header('Location: ../admin/index.php');

?>