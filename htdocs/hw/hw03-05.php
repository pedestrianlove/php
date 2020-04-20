<?php
	// function area
	function gcd($m, $n)
	{
		if ($m*$n == 0)
			if ($m == 0)
				return $n;
			else
				return $m;
		if ($m < $n)
			return gcd ($n, $m);
		else
			return gcd ($n, $m%$n);
	}

	// variables
	if (isset ($argv[1]) && isset ($argv[2])) {
		$m = $argv[1];
		$n = $argv[2];
	}
	else
		throw new Exception('CHECK YOUR INPUT'.PHP_EOL);

	// FLOW
	$gcd = gcd ($m, $n);
	$lcm = $gcd*($m/$gcd)*($n/$gcd);
	printf ("(GCD, LCM) = (%4d, %4d)".PHP_EOL, $gcd, $lcm);
?>
