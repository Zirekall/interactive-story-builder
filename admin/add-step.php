<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Dodaj krok";
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
        <form method="post" action="../functions/add-step.php">
            <input type="hidden" value="<?php echo $_GET['id']?>" name='storyID'>
            <div class="row">
                <div class="col-lg-12">
                    <textarea name="text" id="text" rows="10" cols="80">
                        Dodaj treść kroku.
                    </textarea>
                    <script>
                        CKEDITOR.replace('text');
                    </script>


                    <input type="submit" value="Wyślij" class="btn btn-primary m-3">
                </div>
            </div>
        </form>
      </div>
    </div>


<?php include "../footer.php"?>