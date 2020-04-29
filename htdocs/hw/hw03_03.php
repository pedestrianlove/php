<?php
	for ($x = -6; $x <= 6; $x++) 
		for ($y = -10; $y <= 10; $y++) 
			if (2*$x-$y<3 && $x+3*$y>=1)
				printf ("( %2d, %2d)".PHP_EOL, $x, $y);
?>
