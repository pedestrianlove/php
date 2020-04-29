<?php
	// FUNCTION AREA
	function Celsius2Fahrenheit ($celsius)
	{
		return $celsius*(9/5)+32;
	}
	
	// FLOW
	for ($i = -10; $i <= 10; $i++) 
		printf ("%.2f <br />".PHP_EOL, Celsius2Fahrenheit ($i));
?>
