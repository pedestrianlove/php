<form method="post" action="hw04.php">
輸入待排序數列：
<INPUT TYPE="TEXT" NAME="arr" SIZE="300"><br />
<p><INPUT type="submit" value="送出" name="send">
<INPUT type="reset" value="重新輸入"></p>
</form>
<?php
	header("Content-Type:text/html;charset=utf-8");
	// Utility
	function printArray(&$arr) 
	{ 
    		for ($i = 0; $i < sizeof ($arr); $i++) 
        		echo $arr[$i]." "; 
    		echo "<br />"; 
	} 
	function swap(&$x,&$y){
        	$tmp = $x;
		$x = $y;
		$y = $tmp;
   	}
	function merge ($arr1, $arr2) {
		$arr = array ();
		$index_arr1 = 0;
		$index_arr2 = 0;
		while ($index_arr1+$index_arr2 < sizeof ($arr1)+sizeof ($arr2)) {
			if ($arr1[$index_arr1] <= $arr2[$index_arr2])
				$arr[] = $arr1[$index_arr1++];
			else
				$arr[] = $arr2[$index_arr2++];
		}
		return $arr;
	}
    
	// Sorting Algorithms
    	function insertion_sort(&$arr){
    		$counter = 0;
		$arr_sorted = array ($arr[0]);
		for ($i = 1; $i < sizeof ($arr); $i++) {
			for ($j = 0; $j < $i; $j ++) {
				if ($arr[$i] > $arr_sorted[$j]) {
					array_splice( $arr_sorted, $j+1, 0, array($arr[$i]) );
					echo "第".++$counter."輪: ";
					printArray ($arr);
				      	break;	
				}
			}
		}
	}
    
    	function bubble_sort(&$arr){
		$counter = 0;
        	for ($i = 0; $i < sizeof ($arr); $i ++) {
			for ($j = 0; $j < sizeof ($arr)-$i-1; $j ++) {
				if ($arr[$j] > $arr[$j+1]) {
					swap ($arr[$j], $arr[$j+1]);
					echo "第".++$counter."輪: ";
					printArray ($arr);
				}
			}
		}
    	}
    
    	function merge_sort(&$arr,$front,$end){
    		$mid = floor (($front+$end)/2);
		if ($front < $end) {
			
			// divide
			$front_arr = merge_sort ($arr, $front, $mid);
			$end_arr = merge_sort ($arr, $mid+1, $end);

			// merge
			$result = merge ($front_arr, $end_arr);
			print_Array ($result);
			return $result;
	
		}
		print_Array (array ($arr[$front]));
		return array ($arr[$front]);
	}

    
    if($_POST['send']){
        $arr = explode(",",$_POST['arr']);
        $arr1 = $arr;
        $arr2 = $arr;
        
	echo "Insertion sort </br>";
        insertion_sort($arr1);
	echo "<br/>Bubble sort <br/>";
        bubble_sort($arr2);
        echo "<br/>Merge sort <br/>";
        merge_sort($arr,0,count($arr)-1);
    }
?>
