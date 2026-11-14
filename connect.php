<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd = "bd_carros";
    $charset = "utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES      => false,
    ];

    $dsn = "mysql:host=$host;dbname=$bd;charset=$charset";

    

  

    

    

        
