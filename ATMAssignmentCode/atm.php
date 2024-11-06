<?php
require_once "./checking.php";
require_once "./savings.php";

// Functions for handling POST
function handleTransaction($account, $type, $amount) {
	if ($type === 'withdraw') {
		if ($account->withdrawal($amount)) {
			echo "Withdrawal of $$amount successful.";
		} else {
			echo "Insufficient funds for withdrawal.";
		}
	} elseif ($type === 'deposit') {
		$account->deposit($amount);
		echo "Deposit of $$amount successful.";
	}
}

// Initialize accounts for interface ex
$checking = new CheckingAccount('C123', 1000, '12-20-2019');
$savings = new SavingsAccount('S123', 5000, '03-20-2020');

// Button actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['withdrawChecking'])) {
		handleTransaction($checking, 'withdraw', (float)$_POST['checkingWithdrawAmount']);
	} elseif (isset($_POST['depositChecking'])) {
		handleTransaction($checking, 'deposit', (float)$_POST['checkingDepositAmount']);
	} elseif (isset($_POST['withdrawSavings'])) {
		handleTransaction($savings, 'withdraw', (float)$_POST['savingsWithdrawAmount']);
	} elseif (isset($_POST['depositSavings'])) {
		handleTransaction($savings, 'deposit', (float)$_POST['savingsDepositAmount']);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <style type="text/css">
        body {
            margin-left: 120px;
            margin-top: 50px;
        }
       .wrapper {
            display: grid;
            grid-template-columns: 300px 300px;
        }
        .account {
            border: 1px solid black;
            padding: 10px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
           font-weight: bold;
        }
        input[type=text] {width: 80px;}
        .error {color: red;}
        .accountInner {
            margin-left:10px;margin-top:10px;
        }
    </style>
</head>
<body>

    <form method="post">
        <h1>ATM</h1>
        <div class="wrapper">
            <div class="account">
                <h3>Checking Account</h3>
                <p>Balance: $<?= number_format($checking->getBalance(), 2) ?></p>
                <div class="accountInner">
                    <input type="text" name="checkingWithdrawAmount" placeholder="Amount" />
                    <input type="submit" name="withdrawChecking" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="text" name="checkingDepositAmount" placeholder="Amount" />
                    <input type="submit" name="depositChecking" value="Deposit" /><br />
                </div>
            </div>

            <div class="account">
                <h3>Savings Account</h3>
                <p>Balance: $<?= number_format($savings->getBalance(), 2) ?></p>
                <div class="accountInner">
                    <input type="text" name="savingsWithdrawAmount" placeholder="Amount" />
                    <input type="submit" name="withdrawSavings" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="text" name="savingsDepositAmount" placeholder="Amount" />
                    <input type="submit" name="depositSavings" value="Deposit" /><br />
                </div>
            </div>
        </div>
    </form>
</body>
</html>
