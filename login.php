<php?

//connection variables
$Server = "127.0.0.1";
$User = "";
$Pass ="";
$Database = "Admins";

$conn = mysqli_connect($Server);

//check connection, if it isnt connected show error
if(!$conn){
	die('Could not connect: ' . mysql_error());
}

//What to pull from the sql server and from where
$pull = 'SELECT Username FROM Admins';
$pull2 = 'SELECT Password FROM Admins';

//selecting the database
mysql_select_db($Database);

//setting the pulled data to a variable
$retrieved = mysql_query($pull, $conn);
$retrieved2 = mysql_query($pull2, $conn);

//check data, if it didnt get any show error
if(!$retrieved || !$retrieved2){
	die('Could not get data: ' . mysql_error());
}

$user = null;
$pass = null;

//set data to array
$user = mysql_fetch_array($retrieved, MYSQL_ASSOC);
$pass = mysql_fetch_array($retrieved2, MYSQL_ASSOC);

if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if (in_array($_POST['username'], $user) && 
                  in_array($_POST['password'], $pass)) {
			if(array_search($_POST['username'], $user) == array_search($_POST['password'], $pass))
                  		$myJSON = json_encode(true);
                  
                  		echo 'You have entered a valid username and password';
			} else {
				$myJSON = json_encode(false);

                  		echo 'You have entered a invalid username and password';
			}
			echo $myJSON;
		} else {
		  $myJSON = json_encode(false);

                  echo 'You have entered a invalid username and password';
		  echo $myJSON;
		}
            }

//Close the sql connection to the server
mysql_close($conn);

?>