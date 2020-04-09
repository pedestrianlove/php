<?php
	// HEADER
   	header("Content-Type:text/html;charset=utf-8");
   
	// SETUP ARRAY
	$c=array('black','red','blue','green','wheat','yellow','white');
   
	// OUTPUT
	echo "<center>";
   	for($i=1;$i<7;$i++)
     		echo "<p><font color=$c[$i] size=$i>歡迎進入「網頁程式設計」的世界!</font></p>";
   	echo "</center>";

?>
