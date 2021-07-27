<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Edycja formularza";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
      $adminID = $_SESSION['ID'];
      $formID = $_GET['id'];
      $sql=$conn->query("SELECT adminID, nazwa_formularza,listed,id_opowiesci FROM formularze WHERE ID_formularza = '$formID'");
      $x=$sql->fetch_assoc();
      if ($_SESSION['ID']!=$x['adminID']) {
          header("Location: index.php");
          exit();
      }


   
      
    ?>

<body>
    <div class="container">
        <div id="directlink" class="center">
        <?php echo "<h3>".$x['nazwa_formularza']."</h3>";?>
            <a class="btn btn-primary mt-5" href="../fill-up-form.php?id=<?php echo $_GET['id']?>" target="_blank">Przejdź do
                formularza</a>
            <button class="btn btn-primary mt-5" id="editbtn" onclick="toggleForm()">Edytuj formularz</a>
        </div>
        <div id="edit" class="" style="display:none">
            <h3 class="mt-5 center">Edytuj formularz</h3>
            <form method="post" action="../functions/edit-form.php">
                <input type="hidden" name="formID" value="<?php echo $formID?>">
                <input type="text" name="tytul" class="form-control m-input col-lg-12 ml-auto mr-auto mb-5"
                    placeholder="Tytuł formularza" value='<?php echo $x["nazwa_formularza"]?>' autocomplete="off"
                    required>

                

            <?php
                $sql=$conn->query("SELECT tresc,etykieta,Typ FROM pytania WHERE ID_formularza = '$formID'");

                while($q = $sql->fetch_assoc()){
                echo '
                <div id="inputFormRow">
                <div class="mb-3 btn col-lg-2 float-left">
                <select name="typ[]" required>
                    <option value="Pozytywne" '; if ($q['Typ']=="Pozytywne") {echo "selected";} echo'>Pozytywne</option>
                    <option value="Negatywne" '; if ($q['Typ']=="Negatywne") {echo "selected";} echo'>Negatywne</option>
                </select>
                </div>
                <div class="input-group mb-3 col-lg-6 float-left">
                <input type="text" name="pytanie[]" value="'.$q['tresc'].'" class="form-control m-input" placeholder="Treść pytania"
                    autocomplete="off" required>
                </div>
                <div class="input-group mb-3 col-lg-4 float-right">
                    <input type="text" name="etykieta[]" value="'.$q['etykieta'].'" class="form-control m-input" placeholder="Etykieta"
                    autocomplete="off">
                    <div class="input-group-append">
                        <button id="removeRow" type="button" class="btn btn-danger">Usuń pytanie</button>
                    </div>
                </div>
                </div>
                ';
                }
                
            ?>

                
                <div id="newRow"></div>
                <div class="text-center">
                    <label for="listed">Pokazać na liście testów?</label>
                    <select name="listed" class="mr-4">
                        <option value="1"<?php if ($x['listed']==1) {echo "selected";} ?>>Tak</option>
                        <option value="0"<?php if ($x['listed']==0) {echo "selected";} ?>>Nie</option>
                    </select>
                    <label for="storyID">Przypisz do opowiesci</label>
                    <select name="storyID">
                        <option value="">Nie przypisuj</option>
                        <?php
                           $sql=$conn->query("SELECT * FROM opowiesci WHERE adminID = '$adminID'");
                            while($s=$sql->fetch_assoc()){
                                echo '
                                <option value="'.$s['id_opowiesci'].'"'; if ($s['id_opowiesci']==$x['id_opowiesci']) {echo " selected>";}else{echo ">";} echo $s['Nazwa'].'</option>
                                ';
                            }
                        ?>
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