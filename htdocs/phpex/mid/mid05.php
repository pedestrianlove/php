<?php
	$fp = $fopen ("../../../data/math172.txt", "r") or die ("Failed to open file.");
	printf ("<table border=2>");
	while ($userinfo = fscanf ($fp, "%s%s%s%s")) {
		list ($index[], $id[], $name[], $email[]) = $userinfo;	
		// output data
		printf ("<tr>");

		printf ("<td>%s</td>", $index);
		printf ("<td>%s</td>", $id);
		printf ("<td>%s</td>", $name);
		printf ("<td>%s</td>", $email);


		printf ("</tr>");
	}
	printf ("</table>");
	$fclose ($fp);
?>
