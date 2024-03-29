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
      if (isset($_POST['title'])) {
        $title=$_POST['title'];
          $sql=$conn->query("UPDATE opowiesci SET Nazwa='$title' WHERE ID_opowiesci= '$storyID'");
          echo "<center>Tytuł został zmieniony</center>";
      }

      
?>

<body>

    <div class="container center">
        <form action="edit-story.php?id=<?php echo $storyID ?>" method="post">
            <input type="text" name="title" value="<?php echo $x['Nazwa'] ?>"
                class="form-control m-input col-lg-12 ml-auto mr-auto mb-2">
            <input type="submit" value="Edytuj tytuł" class="btn btn-primary mb-5">
        </form>
        <table class="table center" style="margin:auto;">
            <thead>
                <th>Nr części</th>
                <th>Poprzedni</th>
                <th>Opis części</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php
                        $sql=$conn->query("SELECT globalID,localID,label FROM czesci WHERE id_opowiesci = '$storyID'");
                        while($part=$sql->fetch_assoc()){
                            $globalID=$part['globalID'];
                            $sql2=$conn->query("SELECT poprzedni FROM sciezki WHERE globalID = '$globalID'");
                            echo '<tr>
                            <td>'.$part['localID'].'</td>';
                            if ($part['localID']==1) {
                                echo "<td>-</td>";
                            }
                            else{
                                echo "<td>";
                                while($previous=$sql2->fetch_assoc()){
                                    echo $previous['poprzedni'].",";
                                }
                                echo "</td>";
                            }
                            echo '<td>'.$part['label'].'
                            <td><form method="POST" action="edit-chapter.php">
                            <input type="hidden" name="ID" value="'.$part['globalID'].'"><input type="hidden" name="storyID" value="'.$storyID.'"><input type="submit" name="wyslij" value="Edytuj" class="btn btn-primary"></form>
                            </td>
                            <td><form method="POST" action="../functions/delete-chapter.php">
                            <input type="hidden" name="delete" value="'.$part['globalID'].'"><input type="hidden" name="storyID" value="'.$storyID.'"><input type="submit" name="wyslij" value="Usuń" class="btn btn-danger"></form>
                            </td>
                            </tr>';
                        }
                        $conn->close();
                    ?>
            </tbody>
        </table>
        <a type="button" class="btn btn-primary m-3" href="add-chapter.php?id=<?php echo $storyID ?>">Dodaj część</a>
    </div>

    <?php 
    include "../footer.php"
?>