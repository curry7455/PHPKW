<?php
require_once "./account.php";

class SavingsAccount extends Account 
{
	// Withdrawal method for SavingsAccount without overdraft
	public function withdrawal($amount) 
	{
		if ($this->balance >= $amount) {
			$this->balance -= $amount;
			return true;
		} else {
			return false;
		}
	} 

	// Output "Savings Account" and call Account's getAccountDetails
	public function getAccountDetails() 
	{
		$accountDetails = "<h2>Savings Account</h2>";
		$accountDetails .= parent::getAccountDetails();
		return $accountDetails;
	}
}

// TESTING INFO- DON'T FORGET!!!!
// $savings = new SavingsAccount('S123', 5000, '03-20-2020');
// echo $savings->getAccountDetails();
?>
