<form method="post" action="hw04.php">
輸入待排序數列：
<INPUT TYPE="TEXT" NAME="arr" SIZE="300"><br />
<p><INPUT type="submit" value="送出" name="send">
<INPUT type="reset" value="重新輸入"></p>
</form>
<?php
/*
   程式檔名：hw04.php
   程式設計：課程帳號   姓名
   設計日期：2020-05-21
   程式版本：1.0
*/
header("Content-Type:text/html;charset=utf-8");
    function swap(&$x,&$y){
        $tmp = $x;
	$x = $y;
	$y = $tmp;
    }
    
    function insertion_sort($arr){
        //your code here
    }
    
    function bubble_sort($arr){
        //your code here
    }
    
    function merge_sort(&$arr,$front,$end){
        //your code here
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
