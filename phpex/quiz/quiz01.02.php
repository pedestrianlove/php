<?php
	header("Content-Type:text/html;charset=utf-8");
	printf ("<pre>");
	for ($i = 1; $i <= 100; $i++) {
		if ($i % 3==0 && $i %7 != 0) {
			printf ("<font color=\"red\" size=5> %3d </font>", $i);
		}
		elseif ($i %3!=0 && $i%7 == 0)
			printf ("<font color=\"blue\" size=5> %3d </font>",$i);
		else
			printf ("<font color=\"black\" size=5> %3d </font>",$i);
	}
	printf ("</pre>");
?>