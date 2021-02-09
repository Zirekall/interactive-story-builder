<?php
$title="Internetowy kwestionariusz osobowości - Interaktywa opowieść";
$header="Pobierz wyniki";
include "header.php";


$storyID=$_POST['ID'];
$sql=$conn->query("SELECT * FROM story_wyniki WHERE ID_opowiesci = '$storyID'");
?>

<body>
    <div class="container">
        <div id=login-panel>
        <table id="results" class="table mt-5 hidden">
        <thead>
        <tr>
            <th scope="col"><strong>ID Opowieści</strong></th>
            <th scope="col"><strong>ID Użytkownika</strong></th>
            <th scope="col"><strong>Globalne ID części</strong></th>
            <th scope="col"><strong>Lokalne ID części</strong></th>
            <th scope="col"><strong>Data wyświetlenia części</strong></th>     
        </tr>
        </thead>
        <tbody>
            <?php
                while($r=$sql->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$r['ID_opowiesci']."</td>";
                    echo "<td>".$r['ID_wyniku']."</td>";
                    echo "<td>".$r['GlobalID']."</td>";
                    echo "<td>".$r['LocalID']."</td>";
                    echo "<td>".$r['Timestamp']."</td>";
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
                name:"Wyniki opowieści",
                filename:"Wyniki_Opowiesci",
                fileext:".csv"
            });
            window.location.href = "index.php";
        });
    </script>
<?php include "../footer.php";?>