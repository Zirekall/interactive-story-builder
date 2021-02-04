<?php
$title="Internetowy kwestionariusz osobowości - Interaktywa opowieść";
$header="Interaktywna opowieść";
include "header.php";

$userID=$_GET['id'];

$sql=$conn->query("SELECT ID_formularza FROM form_wyniki WHERE ID_wyniku = '$userID'");
$x=$sql->num_rows;

if($x!=1){  
    unset ($_SESSION['story']);
    header("Location: enter-code.php");
    $conn->close();
    exit();
}

$formID=$sql->fetch_assoc();
$formID=$formID['ID_formularza'];

$sql=$conn->query("SELECT ID_opowiesci FROM formularze WHERE ID_formularza='$formID'");
$storyID=$sql->fetch_assoc();
$storyID=$storyID['ID_opowiesci'];


if(!isset($_POST['part'])){

    if(isset($_SESSION["$userID"])){
        unset ($_SESSION["$userID"]);
    }
    
    $_SESSION["$userID"]=[1];
    

    $sql=$conn->query("SELECT Lewo,prawo FROM czesci WHERE ID_opowiesci='$storyID' AND localID='1'");
    
    $tresc=$sql->fetch_assoc();
    
}
// TO DO:
// - obsługa części innych niż 1
// - wyswietlanie przycisków
// - zapisywanie danych po każdej cześci
// - wymyślenie jak obsłużyć zakończenie historii
?>

<body>
    <div class="container">
        <div id="story-left" class="col-lg-5 float-left border rounded">
        <?php echo $tresc['Lewo'];?>        
        </div>
        <div id="story-right" class="col-lg-5 float-left border rounded">
        <?php echo $tresc['prawo'];?>        
        </div>
        <div class="col-lg-2 float-right">
        sdsds s dsds dssd s ds ds sd
        </div>
    </div>
</body>
</html>
