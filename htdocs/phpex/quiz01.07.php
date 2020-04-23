<?php
	// function
	function gcd ($m,$n) {
		if ($n > $m)
			return gcd ($n, $m);
		if ($n == 0)
			return $m;
		else
			return gcd ($n, $m%$n);
	}
	
	// INPUT
	$m = $_GET["m"];
	$n = $_GET["n"];
	
	// PROCESS && OUTPUT
	$gcd = gcd ($m, $n);
	$lcm = ($m/$gcd)*$n;
	printf ("(GCD,LCM)=(%4d, %4d)".PHP_EOL, $gcd, $lcm);
?>