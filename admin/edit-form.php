<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Panel admina";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
    ?>

<body>
    <div class="container">
        <div id=login-panel>
            <div id="directlink" class="center">
                <a class="btn btn-primary mt-5" href="../fill-up-form.php?id=<?php echo $_GET['id']?>">Przejdź do formularza</a>
            </div>
        </div>
    </div>
</body>
<?php include "../footer.php"?>