<?php
    @session_start();
    
    $title="Internetowy kwestionariusz osobowości - Panel admina";
    $header="Edycja opowieści";
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../login-panel.php');
        exit();
      }

      include "header.php";
      $storyID = $_GET['id'];
      $sql=$conn->query("SELECT adminID, Nazwa FROM opowiesci WHERE ID_opowiesci= '$storyID'");
      $x=$sql->fetch_assoc();
      if ($_SESSION['ID']!=$x['adminID']) {
          header("Location: index.php");
          exit();
      }
?>

<body>
    <div class="container center">
            <table class="table center" style="max-width:600px;margin:auto;">
                <thead>
                    <th>Nr kroku</th>
                    <th>Ilość dróg</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                        $sql=$conn->query("SELECT id_kroku,numer_kroku FROM kroki WHERE id_opowiesci = '$storyID'");
                        while($s=$sql->fetch_assoc()){
                            $stepID = $s['id_kroku'];
                            $routes = $conn->query("SELECT COUNT(id_drogi) AS liczba_drog FROM drogi WHERE id_kroku = '$stepID'");
                            $r=$routes->fetch_assoc();
                            echo '<tr>
                            <td>'.$s['numer_kroku'].'</td>
                            <td>'.$r['liczba_drog'].'</td>
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

<?php 
    include "../footer.php"
?>