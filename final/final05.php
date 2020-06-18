<?php
	// header
	header("Content-Type:text/html;charset=utf8");
	
	// init link
    	$sql_link = mysqli_connect("learn.math.nthu.edu.tw", "dbuser3", "Gtxs.0622", "finalDB")
		or die("無法建立資料連接<br /><br />" . mysqli_error());
	mysqli_query ($sql_link, "SET NAMES 'utf8'");

	
	// query
	$sql_command = "select * from book";
	$result = mysqli_query ($sql_link, $sql_command);
	

	// output result
	echo "Records of data =".mysqli_num_rows ($result).PHP_EOL;
	echo "<table border='3'>";
	echo "<tr>";
	echo "<td>book_no</td><td>book_name</td>";
	echo "</tr>";
	while ($row = mysqli_fetch_assoc ($result)) {
		echo "<tr>";
		echo "<td>".$row["book_no"]."</td>";
		echo "<td>".$row["book_name"]."</td>";
		echo "</tr>";
	}
	echo "</table>";




	
	
	// close connection
	mysqli_close ($sql_link);
?>
