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
                <div class="col-lg-12">
                    <input type="text" name="tytul" class="form-control m-input col-lg-12 ml-auto mr-auto mb-5" placeholder="Tytuł opowieści" autocomplete="off" required>
                    <h3>Dodaj pierwszy krok</h3>
                    <textarea name="step1" id="text" rows="10" cols="80" required>
                        Treść pierwszego kroku
                    </textarea>
                    <script>
                        CKEDITOR.replace('text',{
                            filebrowserUploadUrl: '../functions/upload.php'
                        });
                    </script>


                    <input type="submit" value="Dodaj formularz" class="btn btn-primary float-right m-3">
                </div>
            </div>
        </form>
      </div>
    </div>


<?php include "../footer.php"?>