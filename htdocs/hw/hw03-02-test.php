<?php
	// Function
	function board_init ($size) {
		$board = array ();
		for ($i = 0; $i < $size; $i++) {
			$board[] = array();
			for ($j = 0; $j < $size; $j++)
				$board[$i][] = 0;
		}
		return $board;
	}
	function board_show ($board, $size) {
		for ($i = 0; $i < $size; $i++) {
			for ($j = 0; $j < $size; $j++)
				if ($board[$i][$j] == 1)
					printf ("*");
				else
					printf (" ");
			printf (PHP_EOL);
		}
	}

	function draw ($start_x, $start_y, $end_x, $end_y, $board) {
		$x_dir = ($end_x-$start_x);
		$y_dir = ($end_y-$start_y);
		if ($x_dir > 0)		$x_dir = 1;
		elseif ($x_dir==0)	$x_dir = 0;
		else			$x_dir = -1;

		while ($start_x != $end_x && $start_y != $end_y) {
			$board[$start_x][$start_y]= 1;
			$start_x += $x_dir;
			$start_y += $y_dir;
		}
		$board[end_x][end_y] = 1;
	}
	
	// INPUT
	if (isset ($argv[1]) && isset ($argv[2])) {
		$TYPE = $argv[1];
		$SIZE = $argv[2];
	}
	else
		throw new Exception ("CHECK YOUR INPUT".PHP_EOL);

	// RENDERING
	$BOARD = board_init ($SIZE);
	switch ($TYPE) {
		case 'a':
			$BOARD = draw (0,0,$SIZE,0, $BOARD);
			$BOARD = draw (0,$SIZE,$SIZE,0, $BOARD);
			$BOARD = draw (0,$SIZE,$SIZE,$SIZE, $BOARD);
			break;
		case 'b':
			$BOARD = draw (0,$SIZE,floor ($SIZE/2),0, $BOARD);
			$BOARD = draw ($SIZE,$SIZE,floor ($SIZE/2),0, $BOARD);
			$BOARD = draw (floor ($SIZE/4), floor ($SIZE/2), floor ($SIZE*0.75), floor ($SIZE/2), $BOARD);
			break;
		case 'c':
			$BOARD = draw (0,0,$SIZE,$SIZE, $BOARD);
			$BOARD = draw (0,$SIZE,$SIZE,0, $BOARD);
			break;
		case 'd':
			$BOARD = draw (0,0,floor ($SIZE/2),$SIZE, $BOARD);
			$BOARD = draw ($SIZE,0,floor ($SIZE/2),$SIZE, $BOARD);
			break;
		case 'e':
			$BOARD = draw (0,0,$SIZE,$SIZE, $BOARD);
			$BOARD = draw (0,0,0,$SIZE, $BOARD);
			$BOARD = draw ($SIZE,0,$SIZE,$SIZE, $BOARD);
			break;
		default:
			printf ("UNIDENTIFIED TYPE".PHP_EOL);

	}
	
	

	// OUTPUT
	board_show ($BOARD, $SIZE);
?>
