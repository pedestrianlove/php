<?php
	// HEADER
	header ("Content-Type:text/html; charset=utf-8");
	
	// INPUT
	$a = $_GET["a"];
	$b = $_GET["b"];

	// COMPUTE && OUTPUT
	if ($a < $b)
		printf ("%d 大於 %d <br />", $a, $b);
	else
		printf ("%d 小於 %d <br />", $a, $b);

?>
