<?php
	$username = $_POST['username1'];
	$password = $_POST['psw1'];
	$email = $_POST['email'];

	if(!empty($username) || !empty($password) || !empty($email))
	{
			$host="localhost";
			$dbUsername = "root";
			$dbpassword = "";
			$dbname = "signup_database"

			$conn = new mysqli($host, $dbUsername , $dbpassword,$dbname);

			if(mysqli_connect_error())
			{
				die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error())
			}
			else
			{
				$select = "SELECT email from sign_up_table where email=? Limit 1";
				$Insert = "INSERT into sign_up_table(username,password,email) values (? , ? , ?)";

				$stmt = $conn -> prepare($select);
				$stmt -> bind_param("s",$email);
				$stmt -> execute();
				$stmt -> bind_result($email);
				$stmt ->store_result();
				$rnum = $stmt->num_rows;


				if($rnum ==0)
				{
					$stmt-> close();
					$stmt -> bind_param("sssiiii",$username,$password,$email);
					$stmt -> execute();
					echo "new Record added successfully";
				}
				else
				{
					echo "this email is already in use";
				}
				$stmt -> close();
				$conn -> close();
			}
	}
	else
	{
		echo "All fields are required";
		die();
	}
?>
