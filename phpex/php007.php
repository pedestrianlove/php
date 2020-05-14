<?php

	// Variables
	$a = $_GET["a"];
	$b = $_GET["b"];
	
	// COMPUTE
	$c = $a + $b;
	
	// OUTPUT
	printf ("<hr />");
	printf ("%d + %d = %d", $a, $b, $c);
	printf ("<hr />");

?>