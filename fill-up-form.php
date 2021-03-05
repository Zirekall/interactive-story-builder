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
            <h2 class="mt-4 mb-4 center"><?php echo($form['nazwa_formularza'])?></h2>
            <form action="send-form.php" method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID?>">
            <?php
            $pytania=@$conn->query("SELECT tresc FROM pytania WHERE ID_formularza = '$ID'");
            $i=0;
            while($wiersz = $pytania->fetch_assoc()){
                $tresc=$wiersz['tresc'];
                
                echo "<div class='question p-3 rounded border border-dark'>";
                echo $tresc;
                echo "</div>";
                echo "<table id='form-table' class='table form-table'>";
                echo "<tbody>";
                echo "<tr>";
                echo "<th>Nie zgadzam się</th>";
                echo "<th><input type='radio' name='answer[". ++$i ."]' value='1' class='form-check-input' required><label for='answer[]'>1</label class='form-check-label'></th>";
                echo "<th><input type='radio' name='answer[". $i ."]' value='2' class='form-check-input'><label for='answer[]'>2</label class='form-check-label'></th>";
                echo "<th><input type='radio' name='answer[". $i ."]' value='3' class='form-check-input'><label for='answer[]'>3</label class='form-check-label'></th>";
                echo "<th><input type='radio' name='answer[". $i ."]' value='4' class='form-check-input'><label for='answer[]'>4</label class='form-check-label'></th>";
                echo "<th><input type='radio' name='answer[". $i ."]' value='5' class='form-check-input'><label for='answer[]'>5</label class='form-check-label'></th>";
                echo "<th>Zgadzam się</th>";
                echo "</tr>";
                echo "<tbody>";
                echo "</table>";
                
                
            };
            $conn->close();
            ?>
            <input class="btn btn-success" type='submit' value='wyslij'>
            </form>

        </div>
    </div>

<?php include "footer.php"?>