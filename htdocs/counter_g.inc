<?php
/*
  程式檔名：counter_g.inc
  程式功能：圖形版計數器
  程式限制：需文字檔（可寫入）count.txt與圖檔目錄 7seg 配合
  下載網址：http://www.digitmania.holowww.com/newfonts.html
  程式設計：H.T.Wang
  設計日期：2003-10-12
  程式版本： 1.0
*/
if (file_exists("count.txt")){
	$ff=fopen("count.txt","r") ;
	$c=fgets($ff) ;
	$c++;
	fclose($ff) ;
}else{
	$c=1 ;
}
$ff=fopen("count.txt","w");
fputs($ff,$c) ;
fclose($ff) ;
?>
<?php
for ($i=0; $i<strlen($c);$i++){
  		$st=substr($c,$i,1);
//		echo "$st";
 		printf("<img src='7seg/%s.gif'>",$st);
	}
?>