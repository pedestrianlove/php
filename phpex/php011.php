<?php
	// HEADER
	header ("Content-Type:text/html; charset=utf-8");

	// INPUT
	$n = $_GET["n"];

	// COMPUTE && OUTPUT
	$flag = 1;

	printf ("<pre>");
	for ($i = 1; $i <= $n; $i++) {
		printf ("%4d&nbsp", $i);
		$flag++;
		if ($flag % 10 == 1) {
			printf ("<br />");
			$flag=1;
		}
		
	}
	printf ("</pre>");
?>
