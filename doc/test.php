<?php
	$handle = @fopen("100_YouTube_Previews.txt", "r"); //read line one by one
	
	$sql = mysqli_connect("localhost", "root", "");
	mysqli_select_db($sql, "marketing_wizard");
	while (!feof($handle)) // Loop til end of file.
	{
	    $buffer = fgets($handle, 4096); // Read a line.
	    $values=explode(",",$buffer);//Separate string by the means of |
	    $query = mysqli_query($sql,"INSERT INTO `template_videos` ( `name`,`url`) VALUES ('".$values[0]."','".$values[1]."')");
	}
	/*$sql = mysql_connect("localhost", "root", "");
	if (!$sql) {
	    die("Could not connect: " . mysql_error());
	}
	
	$result = mysql_query("LOAD DATA INFILE '$myFile'" .
	                      " INTO TABLE test FIELDS TERMINATED BY '|'");
	if (!$result) {
	    die("Could not load. " . mysql_error());
	}*/
?>