<head>
<title>Confirmation Page</title>
</head>

<body>

<?php
	$servername = "lists.slsd.org";
	$username = "qiand";
	$password = "1755440";
	$dbName = "tutoringSignup"; 
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbName);	
	
	$id =(int) $_POST["ID"];
	$name = $_POST["name"];
	$email = $_POST["email"];	
	$isTutor = $_POST["person"]=="tutor"?"Tutor":"Request";
	
	$tmpTimes = $_POST["time"];
	$tmpSubjects = $_POST["subject"];

	$times = array();
	$subjects = array();
	
	$count = 0;
	for($i = 0; $i < count($tmpTimes); $i++) {
		if($tmpTimes[$i] == "true") {	
			$times[$count] = $timeKey[$i];
		}
	}
	
	$count = 0;
	for($j = 0; $j < count($tmpSubjects); $j++) {
		if($tmpSubjects[$j] == "true") {	
			$subjects[$count] = $j;
		}
	}


	
	
	// Check connection 	
	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);
	
	$conn->query("DELETE FROM ".($isTutor)."s"." WHERE ID_number=".$id);
	
	$conn->query("DELETE FROM ".($isTutor)."Times"." WHERE ID_number=".$id);
	$conn->query("DELETE FROM ".($isTutor)."Subjects"." WHERE ID_number=".$id);
 
 
	$conn->query("INSERT INTO ".($isTutor)."s"." (ID_number, Name, Email, laptopName) VALUES (".$id.", '".$name."' , '" . $email . "')");
	
	echo "INSERT INTO ".($isTutor)."s"." (ID_number, Name, Email, laptopName) VALUES (".$id.", '".$name."' , '" . $email . "') <br/>";

	for($i = 0; $i < count($times); $i++) {		
		echo "INSERT INTO ".($isTutor)."Times"." (ID_number, Time) VALUES ('".$id. "', '" .$times[$i] . "') <br/>";
		$conn->query("INSERT INTO ".($isTutor)."Times"." (ID_number, Time) VALUES ('".$id. "', '" .$times[$i] . "')");
	}
	
	for($i = 0; $i < count($subjects); $i++) {
		echo "INSERT INTO ".($isTutor)."Subjects"." (ID_number, Time) VALUES ('".$id. "', '" .$subjects[$i] . "') <br/>";

		$conn->query("INSERT INTO ".($isTutor)."Subjects"." (ID_number, Subject) VALUES ('".$id."', '".$subjects[$i]."')");
	}


	echo("Succesful sign up");

	/*
	$result = $conn->query("SELECT * FROM tutors");
	if ($result->num_rows > 0)
   		while($row = $result->fetch_assoc())
        	echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br/>";
	else
		echo "0 results";
	$conn->close();
	*/
?>



</body>
</html>
