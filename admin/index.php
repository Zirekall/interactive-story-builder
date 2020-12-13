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
      <div class="text-center">
        <h3 class="mt-4">Lista twoich formularzy</h3>

        <table class="table mt-5">
        <thead>
            <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Data utworzenia</th>
            <th scope="col">Działanie</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row"><a href="google.pl">Siema SiemaSiemaSiemaSiemaSiemaSiema SiemaSiema SiemaSiema SiemaSiemaSiemaSiema</a></th>
            <td>01-01-2020</td>
            <td>42</td>
            </tr>
        </tbody>
        </table>
      
        <a type="button" class="btn btn-primary mt-3" href="add-form.php">Dodaj nowy</a>
      </div>
    </div>



    
</body>