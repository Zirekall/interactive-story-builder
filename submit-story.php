<?php
    @session_start();
    // if(!isset($_POST['userID'])){
    //     header("Location: enter-code.php");
    //     exit();
    // }

    $title="Internetowy kwestionariusz osobowości - Interaktywa opowieść";
    $header="Interaktywna opowieść";
    include "header.php";
    
    if (!isset($_POST['userID'])) {
        header("Location: enter-code.php");
        exit();
    }



    $userID=$_POST['userID'];
    $i=0;
    $storyID=$_SESSION["$userID"][0];
    foreach ($_SESSION["$userID"][2] as $key => $localID) {
        $globalID=$_SESSION["$userID"][1][$i];
        $timestamp=$_SESSION["$userID"][3][$i];
        $sql=$conn->query("INSERT INTO story_wyniki VALUES ('$userID','$storyID','$globalID',$localID,'$timestamp')");
        $i++;
    }
    unset($_SESSION['story']);
?>
<body>
    <div class="container text-center">
        <h2>Dziękujemy za wzięcie udziału w badaniach<br>
        <a href='index.php'>Powrót na strone główną</a></h2>
    </div>
<?php include "footer.php"?>