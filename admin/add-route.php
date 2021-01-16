<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Dodaj ścieżke";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
      $stepID=$_GET['id'];
      $sql=$conn->query("SELECT id_opowiesci FROM kroki WHERE id_kroku = '$stepID'");
      $storyID=$sql->fetch_assoc();
      $storyID=$storyID['id_opowiesci'];

      $sql=$conn->query("SELECT numer_kroku FROM kroki WHERE id_opowiesci='$storyID' AND id_kroku!='$stepID'");
    ?>


<body>
<script src="../CKEditor4/ckeditor.js"></script>
    <div class="container">
      <div class="text-center">
        <form method="post" action="../functions/add-route.php">
            <input type="hidden" value="<?php echo $storyID ?>" name='storyID'>
            <input type="hidden" value="<?php echo $stepID ?>" name='stepID'>
            <h3>Edytuj treść</h3>
            <textarea name="text" id="text" rows="10" cols="80">
                Wpisz treść ścieżki
            </textarea>
            <script>
                CKEDITOR.replace('text',{
                    filebrowserUploadUrl: '../functions/upload.php'
                });
            </script><br>
            <label for="next">Wybierz krok docelowy:</label>

            <select name="next" id="cars">
                <?php
                    while($list=$sql->fetch_assoc()){
                        echo "<option value='".$list['numer_kroku']."'>".$list['numer_kroku']."</option>";};
                    $conn->close();
                ?>
                <option value="0">Koniec</option>
            </select><br>

            <input type="submit" value="Wyślij" class="btn btn-primary m-3">
        </form>
      </div>
    </div>


<?php include "../footer.php"?>