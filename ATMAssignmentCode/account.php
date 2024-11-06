<?php

abstract class Account 
{
	protected $accountId;
	protected $balance;
	protected $startDate;
	
	// Constructor 
	public function __construct($id, $bal, $startDt) 
	{
		$this->accountId = $id;
		$this->balance = $bal;
		$this->startDate = $startDt;
	} 
	
	// Deposit method adds amount to the balance
	public function deposit($amount) 
	{
		$this->balance += $amount;
	} 

	// Abstract withdrawal method, must be implemented in child classes
	abstract public function withdrawal($amount);
	
	// Getter for start date
	public function getStartDate() 
	{
		return $this->startDate;
	} 

	// Getter for balance
	public function getBalance() 
	{
		return $this->balance;
	} 

	// Getter for account ID
	public function getAccountId() 
	{
		return $this->accountId;
	} 

	// Display AccountID, Balance, and StartDate in a nice format
	protected function getAccountDetails()
	{
		return "Account ID: {$this->accountId}<br>Balance: $" . number_format($this->balance, 2) . "<br>Account Opened: {$this->startDate}<br>";
	} 
}
?>
