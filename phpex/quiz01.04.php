 <?php
 		header("Content-Type:text/html;charset=utf-8");
 		printf ("<pre>");
 		for ($i =1; $i <= 1000; $i++) {
 			$sum =0;
 			for ($j=1; $j < $i; $j++) {
	 			if ($i % $j == 0)
	 				$sum += $j;
 			}
 			if ($sum == $i)
 				printf ("%4d <br />", $i);
 		}
 		printf ("</pre>");
 ?>