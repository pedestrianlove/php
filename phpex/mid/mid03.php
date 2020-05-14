<?php
	// generate data
	$grade = array(0,0,0,0,0,0,0,0,0,0,0);
	for ($std = 0; $std < 57; $std++) {
		$rand_grade = rand (0, 100);
		$index = $rand_grade /10;
		$grade[$index] ++;
	}

	// output data
	printf ("<table border=2>");
	
	// table header
	printf ("<tr>");
	printf ("<td>成績</td><td>學生人數</td>");
	printf ("</tr>");

	// table data
	for ($i = 9; $i >= 0; $i --) {
		printf ("<tr>");

		// range
		if ($i == 9)
			printf ("<td>%3d~%3d</td>",100, 90);
		else
			printf ("<td>%3d~%3d</td>",$i*10+9, $i*10);

		// grade distribution
		if ($i == 9)
			printf ("<td>%2d</td>",$grade[9] + $grade[10]);
		else
			printf ("<td>%2d</td>",$grade[$i]);
		
		printf ("</tr>");
	}
	printf ("</table>");

?>
