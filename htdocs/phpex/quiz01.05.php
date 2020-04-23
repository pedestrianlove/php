<?php
	function grading ($grade) {
		switch (floor ($grade/10)) {
			case 10: 
				return "A";
				break;
			case 9: 
				return "A";
				break;
			case 8:
				return "A";
				break;
			case 7:
				return "B";
				break;
			case 6:
				return "C";
				break;
			case 5:
				return "D";
				break;
			case 4:
				return "E";
				break;
			default:
				return "F";
				break;
		}
	}
	// generate data
	$grade = array ();
	for ($i = 0; $i < 57; $i++) {
		$grade[] = rand (0, 100);
	}
	
	// compute
	$sum = 0;
	$max_val = -1;
	$min_val = 101; 
	
	for ($i = 0; $i < 57; $i ++) {
		$sum += $grade[$i];
		if ($max_val < $grade[$i])
			$max_val = $grade[$i];
		if ($min_val > $grade[$i])
			$min_val = $grade [$i];
	}
	
	printf ("成績如下:<br />");
	printf ("最大值: %3d <br />", $max_val);
	printf ("最小值: %3d <br />", $min_val);	
	?>