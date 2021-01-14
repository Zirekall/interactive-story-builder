<?php
$title="Internetowy kwestionariusz osobowości - Interaktywa opowieść";
$header="Pobierz wyniki";
include "header.php";


$formID=$_POST['ID'];
$questions=$conn->query("SELECT tresc FROM pytania WHERE ID_formularza = '$formID'");
$answers=$conn->query("SELECT * FROM odpowiedzi ");
$results=$conn->query("SELECT * FROM form_wyniki WHERE ID_formularza = '$formID'");
?>

<body>
    <div class="container">
        <div id=login-panel>
        <table id="results" class="table mt-5 hidden">
        <thead>
        <tr>
            <th scope="col" id="col-nazwa">ID</th>
            <?php
                while($q=$questions->fetch_assoc()){
                    echo "<th scope='col'>".$q['tresc']."</th>";
                }
            ?>
            <th scope="col">Wynik</th>
            <th scope="col">Data</th>
        </tr>
        </thead>
        <tbody>
            <?php
                while($r=$results->fetch_assoc()){
                    $resultID=$r['ID_wyniku'];
                    echo "<tr>";
                    echo "<td>".$resultID."</td>";
                    $answers=$conn->query("SELECT * FROM odpowiedzi WHERE ID_wyniku='$resultID'");
                    while($a=$answers->fetch_assoc()){
                        echo "<td>".$a['odpowiedz']."</td>";
                    }
                    echo "<td>".$r['punkty']."</td>";
                    echo "<td>".$r['data']."</td>";
                    echo "</tr>";
                }
                $conn->close();
            ?>
        </tbody>
        </table>
        </div>
    </div>

    <script src="../functions/jquery.table2excel.js"></script>
    <script>
        $(document).ready(function(){
            $("#results").table2excel({
                name:"Wyniki formularza",
                filename:"Wyniki_Formularza",
                fileext:".csv"
            });
            window.location.href = "index.php";
        });
    </script>
<?php include "../footer.php";?>