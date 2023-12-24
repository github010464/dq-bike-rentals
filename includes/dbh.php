<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "dq";

    //data source
    $dsn = "mysql:host=$hostname;dbname=$database";

    //create a PDO instance
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
 ?>
