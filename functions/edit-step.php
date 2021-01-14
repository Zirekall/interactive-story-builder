<?php
@session_start();
require_once "../functions/connect.php";
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../login-panel.php');
    exit();
}
$stepID = $_POST['stepID'];
$text = $_POST['text'];

$sql=$conn->query("UPDATE kroki SET tresc='$text' WHERE id_kroku='$stepID'");

$conn->close();
header("Location: ../admin/edit-story.php?id=$storyID");
print_r($_POST);
?>