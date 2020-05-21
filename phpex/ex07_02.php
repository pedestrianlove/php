<?php
	function day_conv ($day) {
		switch ($day) {
			case 0: return "天";
			case 1: return "一";
			case 2: return "二";
			case 3: return "三";
			case 4: return "四";
			case 5: return "五";
			case 6: return "六";
			default: return "錯";
		}
	}

	date_default_timezone_set ('Asia/Taipei');
	
	echo date ("Y-m-d ");
	echo "<font color=\"blue\">星期", day_conv (date ("N")), "</font>";
	echo date (" H:i:s").PHP_EOL;
?>
