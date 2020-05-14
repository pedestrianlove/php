<?php

	if (file_exists("count.txt")){
		$ff=fopen("count.txt","r") ;
		$c=fgets($ff) ;
		$c++;
		fclose($ff) ;
	}
	else
		$c=1 ;

	$ff=fopen("count.txt","w");

	fputs($ff,$c) ;

	fclose($ff) ;

	for ($i=0; $i<strlen($c);$i++){
  		$st=substr($c,$i,1);
 		printf("<img src='counter/%s.gif'>",$st);
	}
?>
