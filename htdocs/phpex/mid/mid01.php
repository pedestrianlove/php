<?php
	// input variable
	$m = $_GET ['m'];
	$n = $_GET ['n'];
	if ($m < $n)
		die ("Check your input, $m needs to be greater than $n");

	// output
	$flag = 1;
	printf ("<pre>");
	for ($i = $m; $i >= $n; $i--) {
		$val1 = $i%3;
		$val2 = $i%5;
		if ($val1 != 0 || $val2 != 0) {
			printf ("%3d \t", $i);
			$flag ++;
		}

		if ($flag %11 == 0) {
			printf ("\n");
			$flag = 1;
		}
	}
	printf ("</pre>");
?>
