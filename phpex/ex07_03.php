<?php
	function fib ($index) {
		if ($index == 1)
			return 1;
		if ($index == 2)
			return 2;
		return fib ($index-1) + fib ($index-2);
	}

	$n = $_GET['n'];
	printf ("Fibonacci數列的第%d項為：%d".PHP_EOL, $n, fib ($n));
?>
