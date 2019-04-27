<?php

//connection variables
$Server = "127.0.0.1";
$User = "";
$Pass ="";
$Database = "Quiz";

$conn = mysqli_connect($Server);

//check connection, if it isnt connected show error
if(!$conn){
	die('Could not connect: ' . mysql_error());
}

//What to pull from the sql server and from where
$pull = 'SELECT Questions, Answers, Answers2, Answers3 FROM Quiz';

//selecting the database
mysql_select_db($Database);

//setting the pulled data to a variable
$retrieved = mysql_query($pull, $conn);

//check data, if it didnt get any show error
if(!$retrieved){
	die('Could not get data: ' . mysql_error());
}

//JSON variables
$myJSON = null;
$myObj = null;

//cycle thorugh data and set it to object that is converted to JSON
while($row = mysql_fetch_array($retrieved, MYSQL_ASSOC)){
	$myObj->Question = {$row['Questions']};
	$myObj->Answer = {$row['Answers']};
	$myObj->Answer2 = {$row['Answers2']};
	$myObj->Answer3 = {$row['Answers3']};
	
	$myJSON .= json_encode($myObj);
}

//display JSON
echo $myJSON;

//Close the sql connection to the server
mysql_close($conn);

?>