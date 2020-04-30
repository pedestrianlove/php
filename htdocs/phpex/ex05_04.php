<?php
	header("Content-Type:text/html;charset=utf8");
   	
	// input
	$fp=fopen("../../data/math172.txt","r") or die("檔案讀取失敗！");
	while($userinfo = fscanf($fp,"%s\t%s\t%s\n"))
        	 list ($num[],$name[],$email[]) = $userinfo;
   	fclose($fp);
   
	// output
   	echo "<h4>math172 同學名單如下：</h4><table border=2>";
   	for($i=0;$i<count($num);$i++){
      	printf("<tr><td>%03d</td><td>%s</td><td><font color=blue>%s</font></td><td>%s</td></tr>",($i+1),$num[$i],$name[$i],$email[$i]);
   	}
   	echo "</table>";
?>
