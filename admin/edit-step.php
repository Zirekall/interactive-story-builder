<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Edytuj krok";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
      $stepID=$_POST['ID'];
      $sql=$conn->query("SELECT tresc FROM kroki WHERE id_kroku='$stepID'");
      $tresc=$sql->fetch_assoc();
    ?>


<body>
<script src="../CKEditor4/ckeditor.js"></script>
    <div class="container">
      <div class="text-center">
        <form method="post" action="../functions/edit-step.php">
            <input type="hidden" value="<?php echo $stepID ?>" name='stepID'>
            <h3>Edytuj treść</h3>
            <textarea name="text" id="text" rows="10" cols="80">
                <?php echo $tresc['tresc'] ?>
            </textarea>
            <script>
                CKEDITOR.replace('text',{
                    filebrowserUploadUrl: '../functions/upload.php'
                });
            </script>
            <input type="submit" value="Wyślij" class="btn btn-primary m-3">
        </form>
      </div>

      <div class="text-center">
        <table class="table center" style="max-width:600px;margin:auto;">
            <thead>
                <th>Nr scieżki</th>
                <th>Przypisany krok</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                    $sql=$conn->query("SELECT * FROM drogi WHERE id_kroku = '$stepID'");
                    $i=0;
                    while($s=$sql->fetch_assoc()){
                        echo '<tr>
                        <td>'.++$i.'</td>
                        <td>'.$s['nastepny'].'</td>
                        <td><form method="POST" action="edit-step.php">
                        <input type="hidden" name="ID" value="'.$s['id_kroku'].'"><input type="submit" name="wyslij" value="Edytuj" class="btn btn-primary"></form>
                        </td>
                        </tr>';
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
        <a type="button" class="btn btn-primary m-3" href="add-step.php?id=<?php echo $storyID ?>">Dodaj krok</a>
      </div>
    </div>


<?php include "../footer.php"?>