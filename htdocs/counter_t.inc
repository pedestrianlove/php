<?php
/*
  �{���ɦW�Gcounter_t.inc
  �{���\��G��r���p�ƾ�
  �{������G�ݤ�r�ɡ]�i�g�J�^count.txt �t�X
  �{���]�p�GH.T.Wang
  �]�p����G2003-10-12
  �{�������G 1.0
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