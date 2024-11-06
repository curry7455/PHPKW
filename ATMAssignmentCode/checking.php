<?php
require_once "./account.php";

class CheckingAccount extends Account 
{
	const OVERDRAW_LIMIT = -200;

	// Withdrawal method for CheckingAccount with overdraft protection
	public function withdrawal($amount) 
	{
		if ($this->balance - $amount >= self::OVERDRAW_LIMIT) {
			$this->balance -= $amount;
			return true;
		} else {
			return false;
		}
	} 

	// Output "Checking Account" and call Account's getAccountDetails
	public function getAccountDetails() 
	{
		$accountDetails = "<h2>Checking Account</h2>";
		$accountDetails .= parent::getAccountDetails();
		return $accountDetails;
	}
}

// TESTING INFO - DON'T FORGET!!!
// $checking = new CheckingAccount('C123', 1000, '12-20-2019');
// $checking->withdrawal(200);
// $checking->deposit(500);
// echo $checking->getAccountDetails();
// echo $checking->getStartDate();
?>
