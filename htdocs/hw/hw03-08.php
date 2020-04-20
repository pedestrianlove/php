<?php
	// input
	if (isset($argv[1]))
		$string_input = $argv[1];
	else
		throw new Exception ("WATCH YOUR INPUT".PHP_EOL);

	// process
	$string_array = explode (",", $string_input);

	// output
	foreach ($string_array as $substring)
		printf ("%s".PHP_EOL, $substring);
?>
