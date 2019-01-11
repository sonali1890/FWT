<?php


$username = filter_input(INPUT_POST,'usrname');
$password=filter_input(INPUT_POST,'psw');
if(!empty($username))
{
	if(!empty($password))
	{
		$host="localhost";
		// $dbusername="root";
		// $dbpassword="";
		$dbname="login";


		$conn = new mysqli($host,$dbname);
		if(mysqli_connect_error())
		{
			die('connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
		}
		else
		{
			$sql = "insert into login(username,password) values ('$username','$password')";
			if($conn -> query($sql))
			{
				echo "new record is inserted sucessfully";
			}
			else
			{
				echo "Error: ".$sql."<br>".$conn->error;
			}
			$conn->close();
		}
	}
	else
	{
		echo"password should not be empty";
		die();
	}
}
else
{
	echo"Username should not be empty";
	die();
}
?>