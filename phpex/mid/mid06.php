<?php
	// variables
	$performance = array (15,10,20,17,3,8,10,15,12);
	$sum = 0;

	// output
	printf ("<pre>");
	printf ("銷售員業績統計表".PHP_EOL);
	for ($i = 0; $i < 9; $i ++) {
		printf ("%d 號 銷售員 : <img src=\"mid06.gif\" width=\"%d\" height=\"10\">%d".PHP_EOL, $i+1, $performance[$i]*10, $performance[$i]);
		$sum += $performance[$i];
	}
	printf (PHP_EOL);
	printf ("銷售總量: %d".PHP_EOL, $sum);
	printf ("</pre>");
?>
