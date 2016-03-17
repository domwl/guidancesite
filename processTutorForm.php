<head>
<title>Confirmation Page</title>
</head>

<body>

<p>
<?php
	$servername = "localhost";
	$username = "qiand";
	$password = "1755440";
	$dbName = "tutoringSignup";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	
	
	$id =(int) $_POST["ID"]
	$name = $_POST["name"]
	$email = $_POST["email"]
	$isTutor = false; //Do post stuff
	
	
	// Check connection 	
	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);
	
	$conn->query("DELETE FROM ".($isTutor?"Tutors":"Requests")." WHERE ID_number=".$id);
	$conn->query("DELETE FROM ".($isTutor?"Tutor":"Request")."Times"."WHERE ID_number=".$id);
	$conn->query("DELETE FROM ".($isTutor?"Tutor":"Request")."Subjects"."WHERE ID_number=".$id);

	
	$conn->query("INSERT INTO");
	$conn->query("DELETE FROM ".($isTutor?"Tutor":"Request")."Times"."WHERE ID_number=".$id);
	$conn->query("DELETE FROM ".($isTutor?"Tutor":"Request")."Subjects"."WHERE ID_number=".$id);

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
</p>


</body>
</html>