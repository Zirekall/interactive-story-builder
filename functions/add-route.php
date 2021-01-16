<?php
@session_start();
require_once "../functions/connect.php";
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../login-panel.php');
    exit();
}
$text = $_POST['text'];
$stepID = $_POST['stepID'];
$next = $_POST['next'];
$storyID = $_POST['storyID'];

$sql=$conn->query("INSERT INTO drogi VALUES (NULL,'$stepID','$text','$next')");

$conn->close();
header("Location: ../admin/edit-story.php?id=$storyID");
print_r($_POST);
?>