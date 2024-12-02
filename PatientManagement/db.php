<?php

$ini = parse_ini_file(__DIR__ . '/dbconfig.ini');

try {
    
    $pdo = new PDO(
        "mysql:host=" . $ini['servername'] . 
        ";port=" . $ini['port'] . 
        ";dbname=" . $ini['dbname'], 
        $ini['username'], 
        $ini['password']
    );

    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 

} catch (PDOException $e) {
    // error message if connectiion fails
    die("Database connection failed: " . $e->getMessage());
}
