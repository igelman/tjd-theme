<?php

require_once "../classes/date-handler-class.php";

class TestDateHandler extends PHPUnit_Framework_TestCase {
	protected function setUp() {
		$this->today = date_create('today');
		$this->nextWeek = date_create('next week');
		$this->tomorrow = date_create('tomorrow');
		$this->yesterday = date_create('yesterday');
		
		$this->nov152013 = date_create("20131115");
		$this->nov202013 = date_create("20131120");
		$this->nov012013 = date_create("20131101");
		
		//$this->dateHandler = new DateHandler();
	}
	
	public function testInPeriodIsTomorrowBetweenTodayAndNextWeek() {
		$this->assertTrue( dateHandler::dateInPeriod($this->tomorrow, $this->today, $this->nextWeek) , "tomorrow is between today and next week");
		$this->assertFalse( dateHandler::dateInPeriod($this->yesterday, $this->today, $this->nextWeek), "yesterday is NOT between today and next week");
	}
	
	public function testInPeriodIsNov15BetweenNov1AndNov20() {
		$this->assertTrue( dateHandler::dateInPeriod($this->nov152013, $this->nov012013, $this->nov202013), "Nov 15 is between Nov 1 and Nov 20");
	}
}

?>

