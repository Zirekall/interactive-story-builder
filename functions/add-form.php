<?php
@session_start();
require_once "../functions/connect.php";
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../login-panel.php');
    exit();
}
$formID = uniqid();
$userID = $_SESSION['ID'];
$name = $_POST['tytul'];
$questions = $_POST['pytanie'];
$label = $_POST['etykieta'];
$listed = $_POST['listed'];
$x = count($questions);


if($query = $conn->query("INSERT INTO formularze VALUES ('$formID', '$userID','$name', NOW(), '$listed')")){
} else {
    throw new Exception(mysqli_connect_errno());
}

for ($i=0; $i < $x; $i++) { 
    if($query = $conn->query("INSERT INTO pytania VALUES (NULL, '$formID','$questions[$i]', '$label[$i]')")){
    } else {
        throw new Exception(mysqli_connect_errno());
    }
}
$conn->close();
header('Location: ../admin/index.php');

?>