<?php
class DateHandler {

	static function dateInPeriod($date, $startDate, $endDate) {
		return $date >= $startDate && $date <= $endDate;
	}

}
?>