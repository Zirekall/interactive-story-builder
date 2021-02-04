<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Dodaj krok";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
      $storyID=$_GET['id'];
      $sql=$conn->query("SELECT localID FROM czesci WHERE id_opowiesci='$storyID'");
    ?>


<body>
    <script src="../CKEditor4/ckeditor.js"></script>
    <div class="container text-center">
        <form method="post" action="../functions/add-chapter.php">
            <input type="hidden" value="<?php echo $_GET['id']?>" name='storyID'>
            <div class="col-lg-6 float-left">
                <h3>Dodaj lewą strone</h3>
                <textarea name="left" id="text" rows="10" cols="80" required>
                    Treść lewej strony
                </textarea>
                <script>
                CKEDITOR.replace('left', {
                    filebrowserUploadUrl: '../upload.php'
                });
                </script>
            </div>
            <div class="col-lg-6 float-right">
                <h3>Dodaj prawą strone</h3>
                <textarea name="right" id="text" rows="10" cols="80" required>
                    Treść prawej strony
                </textarea>
                <script>
                CKEDITOR.replace('right', {
                    filebrowserUploadUrl: '../upload.php'
                });
                </script>
            </div>
            <div>
                <label for="next">Wybierz krok poprzedni:</label>

                <select name="previous[]" id="previous" size="2" class="mt-3" multiple>
                    <?php
                        while($list=$sql->fetch_assoc()){
                            echo "<option class='text-center' value='".$list['localID']."'>".$list['localID']."</option>";};
                        $conn->close();
                    ?>
                </select><br>

            </div>
            <input type="text" name="label" class="form-control m-input col-lg-11 ml-auto mr-auto mt-2"
                placeholder="Krótki podpis części" autocomplete="off">

            <input type="submit" value="Dodaj część" class="btn btn-primary float-right m-4">
        </form>
    </div>


    <?php include "../footer.php"?>