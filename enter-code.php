<?php
$title="Internetowy kwestionariusz osobowości - Interaktywa opowieść";
$header="Interaktywna opowieść";
include "header.php";

if(isset($_POST['code'])){
    $code=$_POST['code'];
    $sql=$conn->query("SELECT * FROM form_wyniki WHERE ID_wyniku='$code'");
    $x=$sql->num_rows;
    print_r($x);
    if($x==1){  
        echo "siema";
        $_SESSION['story']=$code;
        header("Location: story.php?id=".$code);
        exit();
    }
}

if (isset($_SESSION['story'])) {
    header("Location: story.php?id=".$_SESSION['story']);
}
?>

<body>
    <div class="container">
        <div id=login-panel>
            <div class="text-center">
                <form action="enter-code.php" method="post">
                    <label for="code"><h3 class="mt-4">Podaj kod dostępu</h3></label><br>
                    <input name="code" type="text"><br>
                    <input class="mt-3"type="submit" value="Wyślij">
                </form>
            </div>
        </div>
    </div>


<?php include "footer.php"?>