<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Dodaj opowieść";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
    ?>


<body>
<script src="../CKEditor4/ckeditor.js"></script>
    <div class="container">
      <div class="text-center">
        <form method="post" action="../functions/add-story.php">
            <div class="row">
            <input type="text" name="tytul" class="form-control m-input col-lg-12 ml-auto mr-auto mb-5" placeholder="Tytuł opowieści" autocomplete="off" required>
                <div class="col-lg-6 float-left">
                    <h3>Dodaj lewą strone pierwszej części</h3>
                    <textarea name="left" id="text" rows="10" cols="80" required>
                        Treść lewej strony
                    </textarea>
                    <script>
                        CKEDITOR.replace('left',{
                            filebrowserUploadUrl: '../upload.php'
                        });
                    </script>
                </div>
                <div class="col-lg-6 float-right">
                    <h3>Dodaj prawą strone pierwszej części</h3>
                    <textarea name="right" id="text" rows="10" cols="80" required>
                        Treść prawej strony
                    </textarea>
                    <script>
                        CKEDITOR.replace('right',{
                            filebrowserUploadUrl: '../upload.php'
                        });
                    </script>
                </div>
                <input type="text" name="label" class="form-control m-input col-lg-11 ml-auto mr-auto mt-4" placeholder="Krótki podpis części" autocomplete="off">
                <input type="submit" value="Dodaj formularz" class="btn btn-primary float-right m-4">
            </div>
        </form>
      </div>
    </div>


<?php include "../footer.php"?>