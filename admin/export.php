<?php
$title="Internetowy kwestionariusz osobowości - Interaktywa opowieść";
$header="Pobierz wyniki";
include "header.php";


$formID=$_POST['ID'];
$sql=$conn->query("SELECT
                    formularze.ID_formularza,
                    form_wyniki.ID_wyniku,
                    pytania.localID,
                    pytania.tresc,
                    pytania.etykieta,
                    odpowiedzi.odpowiedz,
                    form_wyniki.data,
                    pytania.Typ,
                    formularze.nazwa_formularza
                    FROM formularze
                    INNER JOIN form_wyniki
                    ON formularze.ID_formularza = form_wyniki.ID_formularza
                    INNER JOIN pytania
                    ON formularze.ID_formularza = pytania.ID_formularza
                    INNER JOIN odpowiedzi
                    ON pytania.localID = odpowiedzi.localID
                    AND form_wyniki.ID_wyniku = odpowiedzi.ID_wyniku
                    WHERE formularze.ID_formularza = '$formID'
                    GROUP BY odpowiedzi.ID_odpowiedzi,formularze.nazwa_formularza");
?>

<body>
    <div class="container">
        <div id=login-panel>
        <table id="results" class="table mt-5 hidden">
        <thead>
        <tr>
            <th scope="col"><strong>ID Formularza</strong></th>
            <th scope="col"><strong>Kod wyniku</strong></th>
            <th scope="col"><strong>ID Pytania</strong></th>
            <th scope="col"><strong>Treść pytania</strong></th>
            <th scope="col"><strong>Etykieta</strong></th>
            <th scope="col"><strong>Wybór</strong></th>
            <th scope="col"><strong>Data</strong></th>
            <th scope="col"><strong>P/N</strong></th>          
        </tr>
        </thead>
        <tbody>
            <?php
                while($r=$sql->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$r['ID_formularza']."</td>";
                    echo "<td>".$r['ID_wyniku']."</td>";
                    echo "<td>".$r['localID']."</td>";
                    echo "<td>".$r['tresc']."</td>";
                    echo "<td>".$r['etykieta']."</td>";
                    echo "<td>".$r['odpowiedz']."</td>";
                    echo "<td>".$r['data']."</td>";
                    echo "<td>".$r['Typ']."</td>";
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