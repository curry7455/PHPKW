<?php

require_once "./checking.php";
require_once "./savings.php";


$checkingAccount = new CheckingAccount('C123', 1000, '12-20-2019');
$savingsAccount = new SavingsAccount('S123', 5000, '03-20-2020');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM Main Page</title>
</head>
<body>
    <h1>Welcome to the ATM</h1>
    <p>Select an option below:</p>
    
    <a href="atm.php">Go to ATM</a>
</body>
</html>
