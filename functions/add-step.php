<?php
@session_start();
require_once "../functions/connect.php";
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../login-panel.php');
    exit();
}
$stepID = uniqid();
$storyID = $_POST['storyID'];
$text = $_POST['text'];

$sql=$conn->query("SELECT COUNT(id_kroku) AS liczba_krokow FROM kroki WHERE id_opowiesci='$storyID'");
$ilosc=$sql->fetch_assoc();
$step=$ilosc['liczba_krokow']+1;

$query = $conn->query("INSERT INTO kroki VALUES ('$stepID', '$storyID',$step, '$text')");

$conn->close();
header("Location: ../admin/edit-story.php?id=$storyID");

?>