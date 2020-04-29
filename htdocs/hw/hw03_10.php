<?php
	// init array
	$rand_grade = [];

	// generate random grade && compute distribution
	for ($i = 0; $i < 10; $i++)
		$grade_dist[] = 0;
	for ($i = 0; $i < 57; $i++) {
		$grade = floor ( rand(0, 100)/10) ;
		if ($grade == 10)
			$grade_dist[9]++;
		else
			$grade_dist[$grade]++;
	}
	
	// output
	printf ("成績頻率分配表如下:".PHP_EOL);
	printf ("成  績\t學生人數".PHP_EOL);
	for ($i = 9; $i >=0; $i--) {
		if ($i == 9)
			printf ("%3d~%2d\t%d".PHP_EOL, 100, 90, $grade_dist[$i]);
		else
			printf ("%3d~%2d\t%d".PHP_EOL, $i*10+9, $i*10, $grade_dist[$i]);
	}
?>
