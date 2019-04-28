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
$pull = 'SELECT Name, EventName, Description, Link, Latitude, Longitude, Radius, Color, Question, Answer1, Answer2, Answer3, StartDate, EndDate FROM Location_Data';

//setting the pulled data to a variable
$retrieved = mysqli_query($conn,$pull);

//check data, if it didnt get any show error
if(!$retrieved){
       echo ('Could not get data: ' . mysqli_error());
}

//JSON variables
$myJSON = null;
$myObj = null;

//cycle thorugh data and set it to object that is converted to JSON
$data = array();
while($row = mysqli_fetch_array($retrieved, MYSQLI_BOTH)){
	//Check that project is active
	if((date("Y//m/d") > {$row['StartDate']}) && date("Y/m/d") < {$row['EndDate']}) {
		$myObj->name = $row['Name'];
		$myObj->description = $row['Description'];
		$myObj->link = $row['Link'];
		$myObj->type = $row['EventName'];
		$myObj->latitude = $row['Latitude'];
		$myObj->longitude = $row['Longitude'];
		$myObj->radius = $row['Radius'];
		$myObj->color = $row['Color'];
		$myObj->question = $row['Question'];
		$myObj->answer1 = $row['Answer1'];
		$myObj->answer2 = $row['Answer2'];
		$myObj->answer3 = $row['Answer3'];
		array_push($data, $myObj);
	}
}

//display JSON
echo json_encode($data);

//Close the sql connection to the server
mysqli_close($conn);

?>