<?php
    include "connect.php";
    $delete=$_POST['delete'];
    $storyID=$_POST['storyID'];

    $sql=$conn->query("DELETE FROM czesci WHERE globalID= '$delete'");
    
    $sql=$conn->query("SELECT globalID FROM czesci WHERE ID_opowiesci = '$storyID'");
    $i=0;
    while($new=$sql->fetch_assoc()){
        $change=$conn->query("UPDATE czesci SET localID=".++$i." WHERE globalID='".$new['globalID']."'");
    }
    $conn->close();
    header("Location: ../admin/edit-story.php?id=$storyID");
    exit();

?>