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
        <div id="admin-froms" class="border rounded p-2 mb-4">
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
              <th scope="row"><a href="edit-form.php?id='.$formID.'">'.$wiersz['nazwa_formularza'].'</a></th>
              <td>'.$wiersz['data_utworzenia'].'</td>
              <td>'.$policzone['total'].'</td>
              <td><form action="results.php" method="post">
              <input type="hidden" name="ID" value="'.$wiersz['ID_formularza'].'"><input type="submit" name="results" value="Pobierz wyniki" class="btn btn-primary"></form></td>
              <td><form action="../functions/delete-form.php" method="post">
              <input type="hidden" name="ID" value="'.$wiersz['ID_formularza'].'"><input type="submit" name="results" value="Usuń" class="btn btn-danger"></form></td>
              </tr>';
              }
            ?>

          </tbody>
          </table>
          
          <a type="button" class="btn btn-primary m-3" href="add-form.php">Dodaj nowy</a>
        </div>    
        <div id="admin-froms" class="border rounded p-2">  
          <h3 class="mt-4">Lista twoich opowiesci</h3>
              
          <table class="table mt-5">
          <thead>
              <tr>
              <th scope="col" id="col-nazwa">Nazwa</th>
              <th scope="col">Liczba kroków</th>
              <th scopr="col">Data utworzenia</th>
              <th scopr="col"></th>
              </tr>
          </thead>
          <tbody id="admin-table">
            <?php
              $sql = "SELECT * FROM opowiesci WHERE adminID = '$ID'";
              $wyniki = $conn->query($sql);
              while($wiersz = $wyniki->fetch_assoc()){
              $storyID=$wiersz['id_opowiesci'];
              $x=$conn->query("SELECT COUNT(numer_kroku) AS liczba_Krokow FROM kroki WHERE id_opowiesci='$storyID'");
              $x=$x->fetch_assoc();
              echo '
              <tr>
              <th scope="row"><a href="edit-story.php?id='.$storyID.'">'.$wiersz['Nazwa'].'</a></th>
              <td>'.$x['liczba_Krokow'].'</td>
              <td>'.$wiersz['data_utworzenia'].'</td>
              <td><form action="../functions/delete-form.php" method="post">
              <input type="hidden" name="ID" value="'.$wiersz['id_opowiesci'].'"><input type="submit" name="results" value="Usuń" class="btn btn-danger"></form></td>
              </tr>';
              }
              $conn->close();
            ?>

          </tbody>
          </table>
          <a type="button" class="btn btn-primary m-3" href="add-story.php">Dodaj nową</a>
        </div>        
      </div>
    </div>



    

<?php include "../footer.php"?>