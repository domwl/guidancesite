<head>
<title>Current Sessions</title>
</head>

<body>
	<table>
    	<tr><td>Tutor ID</td><td>Student ID</td><td>Times</td><td>Subjects</td></tr>";
    <?php
	
		$serverName = "lists.slsd.org";
		$serverUsername = "qiand";
		$serverPassword = "1755440";
		$databaseName = "tutoringSignup";
		
		$connection = new mysqli($serverName, $serverUsername, $serverPassword, $databaseName);

	
	    $session = $connection->query("SELECT * FROM Sessions");		
		while($row = mysqli_fetch_assoc($session)))
		{
			echo "<tr><td>" . $session["Tutor_ID"] . "</td><td>" . $session["Student_ID"] . "</td><td>" . $sessionTimes["Time"] . "</td><td>" . $sessionSubjects["Subject"] . "</td></tr>";
		}
    ?>
</body>
</html>