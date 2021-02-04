<?php

// $siema= array (
//     array('dfg45gdfs','gsdgd3r4',1,'2012-12-23'),
// );

// //array_push($siema['elo'],3,4,525);

// array_push($siema,array('2nomc','2siema',2,'222-23-3'));

// print_r($siema);

print_r($_GET);

?>

<body>
<form action="test1.php" method="get">
    <select name="lol[]" class="mt-3 " multiple>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
    </select>
    <input type="submit" value="nom">
    </form>
</body>