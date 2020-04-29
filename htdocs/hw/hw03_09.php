<?php
	function decrypt ($char)
	{
		$alphabet = range('A', 'Z');
		$index = array_search ($char, $alphabet);
		$index = ($index+10)%26;
		
		return $alphabet[$index];
	}

	// INPUT
	if (isset ($argv[1]))
		$original_string = $argv[1];
	else
		throw new Exception ("CHECK YOUR INPUT".PHP_EOL);

	// PROCESS && OUTPUT
	$string_array = explode (" ", $original_string);
	foreach ($string_array as $string_element) {

		$char_array = str_split ($string_element);
		
		foreach ($char_array as $char) {
			printf ("%s", decrypt ($char));
		}
		printf (" ");
	}
	printf (PHP_EOL);
?>
