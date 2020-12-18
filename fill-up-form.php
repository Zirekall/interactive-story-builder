<?php
@session_start();
$title = "Internetowy kwestionariusz osobowości - Formularze";
$header="Wypełnij formularz";
include "header.php";

if (!isset($_GET['id'])) {
    header("Location: tests.php");
}
$ID=$_GET['id'];

$checkid = @$conn->query("SELECT * FROM `formularze` WHERE `ID_formularza` = '$ID'");
$form=$checkid->fetch_assoc();
$x=$checkid->num_rows;

if ($x==0) {
    $_SESSION['check-id-error'] = "Błędne ID formularza.";
    header("Location: tests.php");
}
?>

<body>
    <div class="container">
        <div id="form">
            <h2 class="mt-4 center"><?php echo($form['nazwa_formularza'])?></h2>


            <?php
            $pytania=@$conn->query("SELECT tresc FROM pytania WHERE ID_formularza = '$ID'");
            while($wiersz = $pytania->fetch_assoc()){
                $tresc=$wiersz['tresc'];
                echo $tresc;
            }
            ?>


        </div>
    </div>
</body>