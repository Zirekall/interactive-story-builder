<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Edycja formularza";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
      $formID = $_GET['id'];
      $sql=$conn->query("SELECT adminID, nazwa_formularza FROM formularze WHERE ID_formularza = '$formID'");
      $x=$sql->fetch_assoc();
      if ($_SESSION['ID']!=$x['adminID']) {
          header("Location: index.php");
          exit();
      }
      $sql=$conn->query("SELECT tresc,etykieta FROM pytania WHERE ID_formularza = '$formID'");
      $q=$sql->fetch_assoc();
    ?>

<body>
    <div class="container">
        <div id="directlink" class="center">
            <a class="btn btn-primary mt-5" href="../fill-up-form.php?id=<?php echo $_GET['id']?>" target="_blank">Przejdź do
                formularza</a>
            <button class="btn btn-primary mt-5" id="editbtn" onclick="toggleForm()">Edytuj formularz</a>
        </div>
        <div id="edit" style="display:none">
            <h3 class="mt-5 center">Edytuj formularz</h3>
            <form method="post" action="../functions/edit-form.php">
                <input type="hidden" name="formID" value="<?php echo $formID?>">
                <input type="text" name="tytul" class="form-control m-input col-lg-12 ml-auto mr-auto mb-5"
                    placeholder="Tytuł formularza" value='<?php echo $x["nazwa_formularza"]?>' autocomplete="off"
                    required>

                <div id="inputFormRow">

            <?php
                $sql=$conn->query("SELECT tresc,etykieta FROM pytania WHERE ID_formularza = '$formID'");

                while($q = $sql->fetch_assoc()){
                echo '
                <div class="input-group mb-3 col-lg-7 float-left">
                <input type="text" name="pytanie[]" value="'.$q['tresc'].'" class="form-control m-input" placeholder="Treść pytania"
                    autocomplete="off" required>
                </div>
                <div class="input-group mb-3 col-lg-5 float-right">
                    <input type="text" name="etykieta[]" value="'.$q['etykieta'].'" class="form-control m-input" placeholder="Etykieta"
                    autocomplete="off">
                    <div class="input-group-append">
                        <button id="removeRow" type="button" class="btn btn-danger">Usuń pytanie</button>
                    </div>
                </div>
                
                ';
                }
                $conn->close();
            ?>

                </div>
                <div id="newRow"></div>
                <div class="text-center">
                    <label for="listed">Pokazać na liście testów?</label>
                    <select name="listed">
                        <option value="1">Tak</option>
                        <option value="0">Nie</option>
                    </select>
                    <button id="addRow" type="button" class="btn btn-info float-left ml-3">Dodaj Pytanie</button>
                    <input type="submit" value="Wyślij" class="btn btn-primary float-right mr-3">
                </div>
            </div>
            </form>
        </div>
    </div>

<?php 
    include "../footer.php"
?>