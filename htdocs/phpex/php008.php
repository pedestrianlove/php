<?php
	// HEADER
	header ("Content-Type:text/html; charset=utf-8");

	// INPUT
	$a = $_GET["a"];

	// COMPUTE && OUTPUT
	printf ("%d ", $a);
	if ($a % 2 != 0)
		printf ("不");
	printf ("是偶數<br />");

?>
