<?php

/* create a connection to the database with the listed credentials*/
$pipeline = mysql_pconnect( 'localhost','cartym','password123');

$success = mysql_select_db( 'cartym', $pipeline); //The second parameter is optional. It will use the last connection that was created

//if the connection fails, print why
if (!$success){
	echo "Sorry. No connection for the following reason:\n";
	echo "\tError number: " . mysql_errno() . "\n";
	echo "\tError string: " . mysql_error() . "\n";
	exit; //or die; or die('This is done');
}

/*This is a string query that will be passed to the database
  *The * says to choose everything from the given table*/
$query = "SELECT * from student";

/* pass the above query to the database 
 * returns */
$data = mysql_query($query);

/* associative string array with data in ONE row from the returned query */
while( $row = mysql_fetch_array($data)){
	/* Hint: you'll have to change the code on line 30.
	 * Remember: $row is an array. How are it's values indexed?
	 */
	
	print_r($row);
}

mysql_close();
?>