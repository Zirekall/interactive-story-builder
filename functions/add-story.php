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
$text = $_POST['step1'];
$listed = $_POST['listed'];



$query = $conn->query("INSERT INTO opowiesci VALUES ('$storyID', '$userID','$name', NOW())");

$query = $conn->query("INSERT INTO kroki VALUES (NULL, '$storyID',1, '$text')");

$conn->close();
header('Location: ../admin/index.php');

?>