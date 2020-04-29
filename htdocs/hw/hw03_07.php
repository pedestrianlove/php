<?php
	// GET INPUT
	if (isset($argv[1]) && isset($argv[2])) {
		$base = $argv[1];
		$rate = (float)$argv[2];
	}
	else
		throw new Exception ("CHECK YOUR INPUT".PHP_EOL);
	
	// OUTPUT		
	printf ("本金 %d 元，年利率 %d%%, 其輸出如下：".PHP_EOL, $base, $rate, '%');
	
	$rate = ($rate/100) + 1;
	$rate_bk = $rate;
	printf ("年份\t本利和".PHP_EOL);
	for ($i = 1;; $rate*=$rate_bk, $i++) {
		printf ("%d\t%f".PHP_EOL, $i, $base*$rate);
		if ($rate >= 2)
			break;
	}
?>
