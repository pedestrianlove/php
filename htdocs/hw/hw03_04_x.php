<?php
	// function area
	function type_a ()
	{
		$sum = 0;
		for ($i = 1; $i <= 31; $i+=2)
			$sum += $i;
		printf ("%d".PHP_EOL, $sum);
	}
	function type_b ($size)
	{
		$base = 0.06;
		$sum = $base*((1-pow($base, $size))/(1-$base));
		printf ("%f".PHP_EOL, $sum);
	}
	function type_c ($size)
	{
		$sum = 1;
		for ($i = 2; $i <= $size; $i++) {
			$sum *= (($i-1)/$i);
		}
		printf ("%f".PHP_EOL, $sum);
	}

	// input variable
	$type = $argv[1];
	if (isset($argv[2]))
		$size = $argv[2];
	else
		throw new Exception ("Check your input".PHP_EOF);

	// FLOW
	switch ($type) {
		case 'a':
			type_a ();
			break;
		case 'b':
			type_b ($size);
			break;
		case 'c':
			type_c ($size);
			break;
		default:
			printf ("ERROR INPUT".PHP_EOL);
	}
?>
