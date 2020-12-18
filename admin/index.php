<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Panel admina";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
    ?>


<body>
  
    <div class="container">
      <div class="text-center">
        <h3 class="mt-4">Lista twoich formularzy</h3>
      
        <table class="table mt-5">
        <thead>
            <tr>
            <th scope="col" id="col-nazwa">Nazwa</th>
            <th scope="col">Data utworzenia</th>
            <th scope="col">Liczba pytań</th>
            <th scopr="col"></th>
            <th scopr="col"></th>
            </tr>
        </thead>
        <tbody id="admin-table">
          <?php
            $ID=$_SESSION['ID'];
            $sql = "SELECT * FROM formularze WHERE adminID = '$ID'";
            $wyniki = $conn->query($sql);

            while($wiersz = $wyniki->fetch_assoc()){
            $formID=$wiersz['ID_formularza'];
            $pytania=$conn->query("SELECT COUNT(ID_pytania) AS total FROM pytania WHERE ID_formularza = '$formID'");
            $policzone=$pytania->fetch_assoc();
            echo '
            <tr>
            <th scope="row"><a href="edit.php">'.$wiersz['nazwa_formularza'].'</a></th>
            <td>'.$wiersz['data_utworzenia'].'</td>
            <td>'.$policzone['total'].'</td>
            <td><form action="results.php" method="post">
            <input type="text" name="ID" value="'.$wiersz['ID_formularza'].'" style="display:none"><input type="submit" name="results" value="Wyniki" class="btn btn-primary"></td></form>
            <td><form action="../functions/delete-form.php" method="post">
            <input type="text" name="ID" value="'.$wiersz['ID_formularza'].'" style="display:none"><input type="submit" name="results" value="Usuń" class="btn btn-danger"></td></form>
            </tr>';
            }
            $conn->close();
          ?>

        </tbody>
        </table>
      
        <a type="button" class="btn btn-primary mt-3" href="add-form.php">Dodaj nowy</a>
      </div>
    </div>



    
</body>