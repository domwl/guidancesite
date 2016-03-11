<head>
<title>Confirmation Page</title>
</head>

<body>

<p>
<?php
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$dbName = "tutoringSignup";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	
	echo $_POST["name"] . "<br/>";
	echo $_POST["email"] . "<br/>";
	
	// Check connection 	
	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);
	echo "Connected successfully";
	
	$result = $conn->query("SELECT * FROM tutors");
	if ($result->num_rows > 0)
   		while($row = $result->fetch_assoc())
        	echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br/>";
	else
		echo "0 results";
	$conn->close();

?>
</p>


</body>
</html>