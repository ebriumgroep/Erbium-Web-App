<?php
	include 'dbConnect.php';
	$conn = connect_database();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	
	$databaseGranted = false;
	$wrongPassword = false;

	$active_username = $_POST["username"];
	$active_password = $_POST["password"];
	$active_clientid = "";
	$active_fullname = "";

	//Hashing
    $escapedPW = mysqli_real_escape_string($conn, $active_password);
//    $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
//    $saltedPW = $escapedPW.$salt;
//    $hashedPW = hash('sha256', $saltedPW);

    $sql = "SELECT * FROM client";
	$result = $conn->query($sql);

	//Check if the user is in the database
	if($result->num_rows > 0){
		while ($row = $result->fetch_assoc()) {
			if($row["username"] == $active_username){
			    $saltedPW = $escapedPW.$row["salt"];
                $hashedPW = hash('sha256', $saltedPW);

                if($row["password"] == $hashedPW){
					$active_clientid = $row['client_id'];
					$active_fullname = $row['full_name'];
					$databaseGranted = true;
					break;
				}
				else{
					$wrongPassword = true;
					break;
				}
			}
		}
	}

		
	if($databaseGranted){
		$conn->close();
		session_start();
        $_SESSION['sid'] = session_id();
		$_SESSION['username'] = $active_username;
		$_SESSION['clientId'] = $active_clientid;
		$_SESSION['fullname'] = $active_fullname;
		// header('Location: main.php');
		echo 0;
	}
	else if($wrongPassword){
		$conn->close();
		// header("refresh:0.5; url = signin.html");
		// echo "Password entered is wrong!";
		echo 1;
		// header('Location: signin.html');
	}
	else{
		$conn->close();
		// header("refresh:0.5; url = signin.html");
		echo 2;
		// header('Location: signin.html');
	}