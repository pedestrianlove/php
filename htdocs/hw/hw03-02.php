<?php
	// INPUT
	if (isset ($argv[1]) && isset ($argv[2])) {
		$TYPE = $argv[1];
		$SIZE = $argv[2];
	}
	else
		throw new Exception ("CHECK YOUR INPUT".PHP_EOL);
	
	switch ($TYPE) {
		case 'a':
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if ($i == 0 ||$i == $SIZE || $i+$j==$SIZE)
						printf ("*");
					else
						printf (" ");
				}
				printf (PHP_EOL);
			}
			break;
		case 'b':
			$mid = floor ($SIZE/2);
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if (2*$j+$i==$SIZE || $SIZE+$i == 2*$j || ($i==$mid&& 2*$j > $SIZE-$i && 2*$j < $i-$SIZE))
						printf ("*");
					else
						printf (" ");
					
				}
				printf (PHP_EOL);
			}

			break;
		case 'c':
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if ($i==$j || $i+$j == $SIZE)
						printf ("*");
					else
						printf (" ");
				}
				printf (PHP_EOL);
			}

			break;
		case 'd':
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if ($j==2*$i || 2*$j+$i==2*$SIZE)
						printf ("*");
					else
						printf (" ");
				}
				printf (PHP_EOL);
			}
			break;
		case 'e':
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if ($j == 0 || $j == $SIZE || $i == $j)
						printf ("*");
					else
						printf (" ");
				}
				printf (PHP_EOL);
			}
			break;
		default:
			printf ("UNIDENTIFIED TYPE".PHP_EOL);

	}
	printf (PHP_EOL);

?>
