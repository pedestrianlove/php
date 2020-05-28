<?php
	// headers
	header ("Content-Type:text/html; charset=utf-8");

	// init link
    	$sql_link = mysqli_connect("localhost", "root", "math.315", "tryDB")
		or die("無法建立資料連接<br /><br />" . mysqli_error());
	mysqli_query ($sql_link, "SET NAMES 'utf8'");

	
	// query
	$sql_command = "select * from person1";
	$result = mysqli_query ($sql_link, $sql_command);
	

	// output result
	echo "<table border='3'>";
	while ($row = mysqli_fetch_assoc ($result)) {
		echo "<tr>";
		echo "<td>".$row["id"]."</td>";
		echo "<td>".$row["name"]."</td>";
		echo "<td>".$row["phone"]."</td>";
		echo "<td>".$row["address"]."</td>";
		echo "<td>".$row["birthday"]."</td>";
		echo "</tr>";
	}
	echo "</table>";




	
	
	// close connection
	mysqli_close ($sql_link);
?>
