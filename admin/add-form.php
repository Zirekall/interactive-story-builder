<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Dodaj formularz";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
      $adminID=$_SESSION['ID'];
    ?>


<body>
  
    <div class="container">
      <div class="text-center">
        <form method="post" action="../functions/add-form.php">
            <div class="row">
                <div class="col-lg-12">
                    <input type="text" name="tytul" class="form-control m-input col-lg-12 ml-auto mr-auto mb-5" placeholder="Tytuł formularza" autocomplete="off" required>
                    <div id="inputFormRow">
                        <div class="input-group mb-3 col-lg-7 float-left">
                            <input type="text" name="pytanie[]" class="form-control m-input" placeholder="Treść pytania" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3 col-lg-5 float-right">
                            <input type="text" name="etykieta[]" class="form-control m-input" placeholder="Etykieta" autocomplete="off">
                            <div class="input-group-append">                
                                <button id="removeRow" type="button" class="btn btn-danger">Usuń pytanie</button>
                            </div>
                        </div>
                    </div>

                    <div id="newRow"></div>
                    <label for="listed">Pokazać na liście testów?</label>
                    <select name="listed">
                        <option value="1">Tak</option>
                        <option value="0">Nie</option>
                    </select>
                    <label for="storyID">Przypisz do opowiesci</label>
                    <select name="storyID">
                        <option value="">Nie przypisuj</option>
                        <?php
                           $sql=$conn->query("SELECT * FROM opowiesci WHERE adminID = '$adminID'");
                            while($s=$sql->fetch_assoc()){
                                echo '
                                <option value="'.$s['id_opowiesci'].'">'.$s['Nazwa'].'</option>
                                ';
                            }
                        ?>
                    <button id="addRow" type="button" class="btn btn-info float-left ml-3">Dodaj Pytanie</button>
                    <input type="submit" value="Dodaj formularz" class="btn btn-primary float-right mr-3">
                </div>
            </div>
        </form>
      </div>
    </div>


<?php include "../footer.php"?>