<?php

//connection variables
$Server = "localhost:3306";
$User = "debian-sys-maint";
$Pass ="uVhufmCdwN29zZsq";
$Database = "Eugene_Geo_App";
$conn =  mysqli_connect($Server, $User, $Pass, $Database);

//check connection, if it isnt connected show error
if(!$conn){
       echo('Could not connect: ' . mysqli_error());
}

//What to pull from the sql server and from where
$pull = 'SELECT Username FROM Admins';
$pull2 = 'SELECT Password FROM Admins';

//setting the pulled data to a variable
$retrieved = mysqli_query($conn, $pull);
$retrieved2 = mysqli_query($conn, $pull2);

//check data, if it didnt get any show error
if(!$retrieved){
       echo ('Could not get data: ' . mysqli_error());
}

//Login variables
$user = null;
$pass = null;

//set data to array
private $user = mysqli_fetch_array($retrieved, MYSQL_BOTH);
private $pass = mysqli_fetch_array($retrieved2, MYSQL_BOTH);

//get the username & password user entered when they hit submit
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
	//check for username & password in database
	if (in_array($_POST['username'], $user) && in_array($_POST['password'], $pass)) {
		//check if the username and password are paired
		if(array_search($_POST['username'], $user) == array_search($_POST['password'], $pass)) {
			//send true
			$myJSON = json_encode(true);
			echo 'You have entered a valid username and password';
		} else {
			//set result to false
			$myJSON = json_encode(false);
			echo 'You have entered a invalid username and password';
		}
	} else {
		//set result to false
		$myJSON = json_encode(false);
		echo 'You have entered a invalid username and password';
	}
	//Send result
	echo $myJSON;
}

//Close the sql connection to the server
mysqli_close($conn);

?>