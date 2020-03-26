<?php
	// HEADER
	header ("Content-Type:text/html; charset=utf-8");

	// INPUT
	$n = $_GET["n"];

	// COMPUTE && OUTPUT
	$flag = 1;
	for ($i = 0; $i < n; $i++, $flag++) {
		printf ("%d &nbsp;", $i);
		if ($flag % 10 == 0)
			printf ("<br />");
	}
?>
