<?php
/*
  程式檔名：counter_t.inc
  程式功能：文字版計數器
  程式限制：需文字檔（可寫入）count.txt 配合
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
echo $c ;
?>