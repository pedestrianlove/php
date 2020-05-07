<?php
	// generate and output data
	printf ("<pre>");
	printf ("\t\t\t報表1: 投票狀況<br />");
	printf ("----------------------------------------------------------<br />");
	$distribution = array(0,0,0,0,0,0,0);
	$flag = 1;
	for ($std = 0; $std < 57; $std++) {
		$rand_vote = rand (0, 6);
		$distribution[$rand_vote] ++;
		printf ("%d \t", $rand_vote);
		$flag++;
		if ($flag %9 == 0) {
			printf ("\n");
			$flag = 1;
		}
	}
	printf ("</pre>");
	printf ("<hr>");

	// rearrange and output data
	printf ("<pre>");
	printf ("\t\t報表2: 投票結果<br />");
	printf ("------------------------------------------<br />");
	for ($i = 1; $i <= 6; $i ++) {
		printf ("%d號候選人\t:%23d票".PHP_EOL, $i, $distribution[$i]);
	}
	printf ("廢票數\t\t:%23d票".PHP_EOL, $distribution[0]);

	printf ("</pre>");
	
?>
