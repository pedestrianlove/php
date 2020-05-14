<?php
	// HEADER
	header ("Content-Type:text/html; charset=utf-8");

	// INPUT
	$a = $_GET["a"];

	// COMPUTE && OUTPUT
	if ($a % 2 == 0)
		printf ("%d 是偶數 <br />", $a);
	else
		printf ("%d 是奇數 <br />", $a);

?>
