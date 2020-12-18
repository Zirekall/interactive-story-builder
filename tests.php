<?php
$title = "Internetowy kwestionariusz osobowości - Formularze";
$header="Formularze";
include "header.php";
?>

<body>
    <div class="container">
        <div id="tests">
            <div class="text-center">
                <h3 class="mt-4">Wybierz formularz, który cię interesuje.</h3>

                <table class="table mt-5">
                <thead>
                    <tr>
                    <th scope="col" id="col-nazwa">Nazwa</th>
                    <th scope="col">Data utworzenia</th>
                    <th scope="col">Ilość pytań</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM formularze WHERE listed = 1";
                        $wyniki = $conn->query($sql);

                        while($wiersz = $wyniki->fetch_assoc()){
                        $formID=$wiersz['ID_formularza'];
                        $pytania=$conn->query("SELECT COUNT(ID_pytania) AS total FROM pytania WHERE ID_formularza = '$formID'");
                        $policzone=$pytania->fetch_assoc();
                        echo '
                        <tr>
                        <th scope="row"><a href="fill-up-form.php?id='.$formID.'">'.$wiersz['nazwa_formularza'].'</a></th>
                        <td>'.$wiersz['data_utworzenia'].'</td>
                        <td>'.$policzone['total'].'</td>
                        </tr>';
                        }
                        $conn->close();
                    ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>

</body>