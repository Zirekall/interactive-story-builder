<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Edytuj krok";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
      $storyID=$_POST['storyID'];
      $chapterID=$_POST['ID'];
      $sql=$conn->query("SELECT localID,lewo,prawo,label FROM czesci WHERE globalID='$chapterID'");
      $chapterData=$sql->fetch_assoc();
      $sql=$conn->query("SELECT localID FROM czesci WHERE id_opowiesci='$storyID' AND globalID!='$chapterID'");

    ?>


<body>
<script src="../CKEditor4/ckeditor.js"></script>
    <div class="container">
      <div class="text-center">
        <form method="post" action="../functions/edit-chapter.php">
        <input type="hidden" value="<?php echo $chapterID ?>" name='ID'>
        <input type="hidden" value="<?php echo $storyID ?>" name='storyID'>
            <div class="col-lg-6 float-left">
                <h3>Edytuj lewą strone</h3>
                <textarea name="left" id="text" rows="10" cols="80" required>
                    <?php echo $chapterData['lewo']; ?>
                </textarea>
                <script>
                    CKEDITOR.replace('left',{
                        filebrowserUploadUrl: '../functions/upload.php'
                    });
                </script>
            </div>
            <div class="col-lg-6 float-right">
                <h3>Edytuj prawą strone</h3>
                <textarea name="right" id="text" rows="10" cols="80" required>
                <?php echo $chapterData['prawo']; ?>
                </textarea>
                <script>
                    CKEDITOR.replace('right',{
                        filebrowserUploadUrl: '../functions/upload.php'
                    });
                </script>
            </div>
            <?php if ($chapterData['localID']!=1) {
                echo "
                <label for='next'>Wybierz krok poprzedni:</label>

                <select name='previous' class='mt-3'>";
                while($list=$sql->fetch_assoc()){
                    echo "<option value='".$list['localID']."'>".$list['localID']."</option>";};
                $conn->close();

                echo "</select>";
            }
            ?>

            <input type="text" name="label" class="form-control col-lg-11 ml-auto mr-auto mt-2" placeholder="Krótki podpis części" autocomplete="off" value="<?php echo $chapterData['label'];?>">

            <input type="submit" value="Edytuj część" class="btn btn-primary float-right m-4">
        </form>
      </div>
    </div>


<?php include "../footer.php"?>