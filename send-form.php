<?php
    @session_start();
    if(!isset($_POST['answer'])){
        header("Location: tests.php");
        exit();
    }


    $title="Internetowy kwestionariusz osobowości - Interaktywa opowieść";
    $header="Interaktywna opowieść";
    include "header.php";
    
    $resultID=uniqid();
    $formID=$_POST['ID'];
    if (!isset($_SESSION["$formID"])) {
        $_SESSION["$formID"]=$resultID;
    
        $result=0;
        $max=0;
        foreach ($_POST['answer'] as $key => $points) {
            $result=$result+$points;
        }

        foreach ($_POST['answer'] as $key => $odp) {
            $sql=$conn->query("INSERT INTO odpowiedzi VALUES (NULL,'$resultID','$odp');");
        }

        $sql=$conn->query("INSERT INTO form_wyniki VALUES ('$resultID','$result',CURRENT_TIMESTAMP,'$formID');");
        $conn->close();
    }

?>

<body>
    <div class="container">
        <div id=login-panel>
            <div class="text-center">
                <form>
                    <label for="code"><h2 class="mt-4">Twój kod dostępu do interaktywnej opowieści:<br><span style="color: red;"><?php echo $_SESSION["$formID"] ?></span></h2></label><br>
                    <h3>Skopiuj go i podaj go na <a href="enter-code.php" target="_blank">tej strone</a></h3>
                </form>
            </div>
        </div>
    </div>


<?php include "footer.php"?>