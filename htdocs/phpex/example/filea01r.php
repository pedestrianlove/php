<?php
	// HEADER
	header("Content-Type:text/html;charset=Big5");
	
	// READ FILE
	echo "<pre>";
	readfile("http://math172.ddns.net/phpex/score.dat");
	echo "</pre>";
?>
