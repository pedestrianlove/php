<?php
	// variables
	if (isset ($argv[1]))
		$decimal = $argv[1];
	else
		throw new Exception ('CHECK YOUR INPUT'.PHP_EOL);

	// FLOW
	printf ("%s".PHP_EOL, decbin ($decimal));
?>
