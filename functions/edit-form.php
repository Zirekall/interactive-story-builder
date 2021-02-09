<?php
@session_start();
require_once "../functions/connect.php";
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../login-panel.php');
    exit();
}
$formID=$_POST['formID'];
$query = $conn->query("DELETE FROM pytania WHERE ID_formularza ='$formID'");

$userID = $_SESSION['ID'];
$name = $_POST['tytul'];
$type = $_POST['typ'];
$questions = $_POST['pytanie'];
$label = $_POST['etykieta'];
$listed = $_POST['listed'];
$storyID = $_POST['storyID'];
$x = count($questions);


$query = $conn->query("UPDATE formularze SET nazwa_formularza = '$name', id_opowiesci = '$storyID', listed=$listed WHERE ID_formularza = '$formID'");


for ($i=0; $i < $x; $i++) { 
    if($query = $conn->query("INSERT INTO pytania VALUES (NULL,".++$j.", '$formID','$questions[$i]', '$label[$i]','$type[$i]')")){
    } else {
        throw new Exception(mysqli_connect_errno());
    }
}
$conn->close();
header('Location: ../admin/index.php');

?>