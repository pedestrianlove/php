<form method="post" action="hw04.php">
輸入待排序數列：
<INPUT TYPE="TEXT" NAME="arr" SIZE="300"><br />
<p><INPUT type="submit" value="送出" name="send">
<INPUT type="reset" value="重新輸入"></p>
</form>
<?php
	header("Content-Type:text/html;charset=utf-8");
	// Utility
	$merge_counter = 0;
	function printArray(&$arr, &$time) 
	{ 
		echo "第".++$time."輪: ";
    		for ($i = 0; $i < sizeof ($arr); $i++) 
        		echo " ".$arr[$i]." "; 
    		echo "<br />".PHP_EOL; 
	} 
	function swap(&$x,&$y){
        	$tmp = $x;
		$x = $y;
		$y = $tmp;
   	}
	function merge ($arr1, $arr2) {
		// init array
		$arr = array ();
		$index_arr1 = 0;
		$index_arr2 = 0;

		// merge 2 array
		while ($index_arr1 < sizeof ($arr1) and $index_arr2 < sizeof ($arr2)) {
			if ($arr1[$index_arr1] < $arr2[$index_arr2]) 
				$arr[] = $arr1[$index_arr1++];
			else
				$arr[] = $arr2[$index_arr2++];
		}
		while ($index_arr1 < sizeof ($arr1))
			$arr[] = $arr1[$index_arr1++];
		while ($index_arr2 < sizeof ($arr2))
			$arr[] = $arr2[$index_arr2++];
		
		// return the merged array
		return $arr;
	}
	function insert (&$arr, $insert_position, $element) {
		array_splice( $arr, $insert_position, 0, $element );	
	}
    
	// Sorting Algorithms
    	function insertion_sort(&$arr){
    		$counter = 0;
		$inner_index;
		$arr_sorted = array ();
		for ($outer_index = 0; $outer_index < sizeof ($arr); $outer_index++) {
			$inner_index = 0;
			// traverse untill arr > sorted
			while ( isset ($arr_sorted[$inner_index]) and 
					$arr [$outer_index] > $arr_sorted[$inner_index] ) 
				$inner_index ++;
				
			insert ( $arr_sorted, $inner_index, $arr[$outer_index]);
			printArray ($arr_sorted, $counter);
		}
	}
    
    	function bubble_sort(&$arr){
		$counter = 0;
        	for ($i = 0; $i < sizeof ($arr); $i ++) {
			for ($j = 0; $j < sizeof ($arr)-$i-1; $j ++) {
				if ($arr[$j] > $arr[$j+1]) {
					swap ($arr[$j], $arr[$j+1]);
					printArray ($arr, $counter);
				}
			}
		}
    	}
    
    	function merge_sort(&$arr,$front,$end){
    		global $merge_counter;
		$mid = $front + floor (($end-$front)/2);
		if ($front < $end) {
			
			// divide
			$front_arr = merge_sort ($arr, $front, $mid);
			$end_arr = merge_sort ($arr, $mid+1, $end);

			// merge
			$result = merge ($front_arr, $end_arr);
			PrintArray ($result, $merge_counter);
			return $result;
	
		}
		else {
			$result = array ($arr[$front]);
			printArray ($result, $merge_counter);
			return $result;
		}
	}

    
    if($_POST['send']){
	$str = $_POST['arr'];
        $arr = explode(",",$str);
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
