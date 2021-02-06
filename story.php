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
    $_SESSION['storyerror']="Nieprawidłowy kod dostępu.";
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
    $sql=$conn->query("SELECT * FROM czesci WHERE ID_opowiesci='$storyID' AND localID='1'");
    $chapter=$sql->fetch_assoc();

    $globalID=$chapter['globalID'];
    $localID=$chapter['localID'];

    $_SESSION["$userID"]=array (
        $storyID,
        array("$globalID"),
        array("$localID"),
        array(date('Y-m-d H:i:s'))
    );

    }
    else {

        array_push($_SESSION["$userID"][1],"$globalID");
        array_push($_SESSION["$userID"][2],"$localID");
        array_push($_SESSION["$userID"][3],date('Y-m-d H:i:s'));
    
}

$sql=$conn->query("SELECT globalID FROM sciezki WHERE poprzedni=$localID AND ID_opowiesci='$storyID'");
$y=$sql->fetch_assoc();
$y=$y['globalID'];
$sql=$conn->query("SELECT label FROM czesci WHERE globalID='$y'");


// TO DO:
// - obsługa części innych niż 1
// - wyswietlanie przycisków
// - zapisywanie danych po każdej cześci
// - wymyślenie jak obsłużyć zakończenie historii
?>

<body>
    <div class="container">
        <div class="row">
            <div id="story-left" class="col-lg-5 float-left border rounded">
            <?php echo $chapter['Lewo'];?>        
            </div>
            <div id="story-right" class="col-lg-5 float-left border rounded">
            <?php echo $chapter['prawo'];?>        
            </div>
            <div id="story-label" class="col-lg-2 float-right">
                <?php 
                while ($get_dane=$sql->fetch_assoc()) {
                    echo $get_dane['label']."</br>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
<?php include "footer.php"?>
