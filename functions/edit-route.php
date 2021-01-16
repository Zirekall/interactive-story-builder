<?php
@session_start();
require_once "../functions/connect.php";
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../login-panel.php');
    exit();
}
$routeID = $_POST['routeID'];
$text = $_POST['text'];
$next = $_POST['next'];
$storyID = $_POST['storyID'];

$sql=$conn->query("UPDATE drogi SET tresc='$text',nastepny='$next' WHERE id_drogi='$routeID'");

$conn->close();
header("Location: ../admin/edit-story.php?id=$storyID");
print_r($_POST);
?>