<?php
$title="Internetowy kwestionariusz osobowości - Interaktywa opowieść";
$header="Interaktywna opowieść";
include "header.php";

$userID=$_GET['id'];

$sql=$conn->query("SELECT ID_formularza FROM form_wyniki WHERE ID_wyniku = '$userID'");
$x=$sql->num_rows;
print_r($_POST);
if($x!=1){  
    unset ($_SESSION['story']);
    header("Location: enter-code.php");
    $conn->close();
    $_SESSION['storyerror']="Nieprawidłowy kod dostępu.";
    exit();
}

$sql=$conn->query("SELECT * FROM story_wyniki WHERE ID_wyniku = '$userID'");
$x=$sql->num_rows;
if($x!=0){  
    unset ($_SESSION['story']);
    header("Location: enter-code.php");
    $conn->close();
    $_SESSION['storyerror']="Ten kod został już wykorzystany.";
    exit();
}
$sql=$conn->query("SELECT * FROM form_wyniki WHERE ID_wyniku = '$userID'");
$formID=$sql->fetch_assoc();
$formID=$formID['ID_formularza'];

$sql=$conn->query("SELECT id_opowiesci FROM formularze WHERE ID_formularza='$formID'");
$storyID=$sql->fetch_assoc();
$storyID=$storyID['id_opowiesci'];

if($storyID==NULL){  
    unset ($_SESSION['story']);
    header("Location: enter-code.php");
    $conn->close();
    $_SESSION['storyerror']="Do tego formularza nie została przypisana żadna opowieść.";
    exit();
}
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

        $localID=$_POST['part'];
        $sql=$conn->query("SELECT * FROM czesci WHERE ID_opowiesci='$storyID' AND localID='$localID'");
        $chapter=$sql->fetch_assoc();
    
        $globalID=$chapter['globalID'];
        $localID=$chapter['localID'];

        array_push($_SESSION["$userID"][1],"$globalID");
        array_push($_SESSION["$userID"][2],"$localID");
        array_push($_SESSION["$userID"][3],date('Y-m-d H:i:s'));
    
}
$sql=$conn->query("SELECT globalID FROM sciezki WHERE poprzedni=$localID AND ID_opowiesci='$storyID'");
$nr=$sql->num_rows;
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

                if ($nr!=0) {
                while ($y=$sql->fetch_assoc()) {
                    $id=$y['globalID'];
                    
                    $sql2=$conn->query("SELECT label,localID FROM czesci WHERE globalID='$id'");
                    
                    $get_dane=$sql2->fetch_assoc();
                    echo $get_dane['localID'];
                    echo "
                    <div class='next'>
                    <form action='story.php?id=$userID' method='post'>
                    <input type='hidden' name='part' value='".$get_dane['localID']."'>
                    <input type='image' src='img/arrow.png'/><br>
                    ";
                    echo $get_dane['label'];
                    echo "</form></div>";
                }}
                else {
                    echo "
                    <div class='next'>
                    <form action='submit-story.php' method='post'>
                    <input type='hidden' name='userID' value='$userID'>
                    <input type='image' src='img/arrow.png'/><br>
                    <b>Zakończ i zapisz historie</b>
                    ";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
<?php include "footer.php"?>
