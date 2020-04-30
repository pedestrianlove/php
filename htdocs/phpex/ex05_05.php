<?php
	header("Content-Type:text/html;charset=utf8");
   	
	// input
	$file_str = file_get_contents("http://math172.ddns.net/phpex/score.dat") or die("檔案讀取失敗！");
	$score = explode (PHP_EOL, $file_str);
   
	// output
	// list out the grade
	$flag = 1;
   	for($i=0 ; $i<count($score) ; $i++,$flag++) {
		printf ("%3d &#9;", $score[$i]);
		if ($flag%10 == 0)
			printf ("<br />".PHP_EOL);
	}
	printf ("<br /><hr>".PHP_EOL);
	
	// give the avg
	$sum = 0;
	foreach ($score as $score_val)
		$sum += $score_val;
	$AVG = $sum/count ($score);
	
	// compute std
	$var = 0;
	foreach ($score as $score_val)
		$var += pow ($score_val-$AVG, 2);
	$var = $var / count ($score);
	$STD = sqrt ($var);

	// output
	printf ("AVG=%.3f &#9; STD=%.3f", $AVG, $STD);
?>
