<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Edytuj ścieżke";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
      $routeID=$_POST['ID'];

      $sql=$conn->query("SELECT tresc,id_kroku FROM drogi WHERE id_drogi='$routeID'");
      $route=$sql->fetch_assoc();
      $stepID=$route['id_kroku'];

      $sql=$conn->query("SELECT id_opowiesci FROM kroki WHERE id_kroku = '$stepID'");
      $storyID=$sql->fetch_assoc();
      $storyID=$storyID['id_opowiesci'];

      $sql=$conn->query("SELECT numer_kroku FROM kroki WHERE id_opowiesci='$storyID' AND id_kroku!='$stepID'");
    ?>


<body>
<script src="../CKEditor4/ckeditor.js"></script>
    <div class="container">
      <div class="text-center">
        <form method="post" action="../functions/edit-route.php">
            <input type="hidden" value="<?php echo $routeID ?>" name='routeID'>
            <input type="hidden" value="<?php echo $storyID ?>" name='storyID'>
            <h3>Edytuj treść</h3>
            <textarea name="text" id="text" rows="10" cols="80">
                <?php echo $route['tresc'] ?>
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
                
            </select><br>

            <input type="submit" value="Wyślij" class="btn btn-primary m-3">
        </form>
      </div>
    </div>


<?php include "../footer.php"?>