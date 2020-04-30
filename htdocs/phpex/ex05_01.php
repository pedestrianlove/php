<?php
	header ("Content-Type:text/html;charset=utf8");
	
	// read the file
	$fc = file_get_contents ("http://math172.ddns.net/phpex/math172.txt") or die ("無法讀取檔案");


	// convert the encoding to utf-8
	$fc = mb_convert_encoding ($fc, "utf-8", "big5");	

	// output
	echo "<pre>";
	echo $fc;
	echo "</pre>"

?>
