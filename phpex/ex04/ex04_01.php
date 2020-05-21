<?php
	// HEADER
	header ("Content-Type:text/html; charset=utf-8");

	// FETCH THE FILE
	$fr=file("http://math172.ddns.net/phpex/score.dat") or die("檔案無法讀取！");
   
	// SAVE TO ARRAY
	echo "<pre>";
	foreach($fr as $k=>$v){
        	$f=explode('\n',$v);
        	printf("<b>%03d</b>\t%s\n",$k+1,$f[0]);
   	}
/*
	// PRINT OUT AGAIN
	printf ("********************************************<br />");
	foreach ($f as $value) {
		printf ("%d<br />", $value);
	}
*/
   	echo "</pre>";

?>
