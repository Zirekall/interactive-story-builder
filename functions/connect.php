<?php

    define("DBURL", "localhost");
    define("DBUSERNAME", "root");
    define("DBPASSWORD", "");
    define("DBNAME","inzynier");
    
    $conn = new mysqli(DBURL, DBUSERNAME, DBPASSWORD, DBNAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	
	$conn->query('SET character_set_connection=utf8');
	$conn->query('SET character_set_client=utf8');
    $conn->query('SET character_set_results=utf8');
    
    

?>