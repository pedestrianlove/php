<?php
	// header
	header("Content-Type:text/html;charset=utf8");
	
	// function
	function check_repeat ($array_check, $element) {
		for ($i = 0; $i < count ($array_check); $i ++) {
			if ($array_check[$i] == $element)
				return 1;
		}
		return 0;
	}

	// variables
	$size = $_GET["n"];

	// get the data
	$fp=fopen("../../data/math172u.txt","r") or die("檔案讀取失敗！");
	while($userinfo = fscanf($fp,"%s\t%s\t%s\n"))
        	 list ($num[],$name[],$email[]) = $userinfo;
   	fclose($fp);
   	
	// get rand id
	$rand_list = array ();
	while (count ($rand_list) < $size) {
		$tmp = rand(0, count($num)-1);
		if (array_search ($tmp, $rand_list) == false)  {
			$rand_list[] = $tmp;
		}
	}
	
	// output rand name
	echo "幸運的同學名單如下:<br />";
	for ($i = 0; $i < count ($rand_list); $i ++)  {
		$n = $rand_list[$i];
		printf ("%s %s %s<br />",  $num[$n],$name[$n],$email[$n]);
	}
?>
