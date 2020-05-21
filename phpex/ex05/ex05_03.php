<?php
	header ("Content-Type:text/html;charset=utf8");
	
	// read the file
	$fc = file_get_contents ("http://math172.ddns.net/phpex/math172.txt") or die ("無法讀取檔案");

	// convert the encoding to utf-8
	$fc = mb_convert_encoding ($fc, "utf-8", "big5");	

	// make dir
	if (mkdir ("../../data"))
		echo "成功建立資料夾 <br />";
	else
		echo "未成功建立資料夾 <br />";
	
	// output to file
	file_put_contents ("../../data/math172.txt", $fc) or die ("無法寫入檔案");
	echo "成功寫入檔案! <br />";

?>
