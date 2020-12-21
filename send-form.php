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
        $max=$max+5;
    }
    
    $percent=$result/$max*100;

    if ($percent <= 25) {
        $label = "Do 25%";
    }

    if ($percent > 25 && $percent <= 50) {
        $label = "Od 25% do 50%";
    } 

    if ($percent > 50 && $percent <= 75) {
        $label = "Od 50% do 75%";
    }

    if ($percent > 75) {
        $label = "Ponad 75%";
    }
    
    $sql=$conn->query("INSERT INTO form_wyniki VALUES ('$resultID','$result','$label',CURRENT_TIMESTAMP,'$formID');");
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

</body>
<?php include "footer.php"?>