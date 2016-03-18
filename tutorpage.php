<?php

if(!isset($_COOKIE["signin"]) && !isset($_POST["username"]))
	die("Please login:<br/><form action='' method='post'><table><tr><td>Username:</td><td><input type='text' name='username'/></td></tr><tr><td>Password:</td><td><input type='password' name='password'/></td></tr><tr><td></td><td><input type='submit' value='Submit'/></td></table></form>");
else if(isset($_POST["username"]))
{
	if($_POST["username"] == "kelly" && $_POST["password"] == "12345")
		setcookie("signin", "1");
}

$serverName = "lists.slsd.org";
$serverUsername = "qiand";
$serverPassword = "1755440";
$databaseName = "tutoringSignup";

$connection = new mysqli($serverName, $serverUsername, $serverPassword, $databaseName);

$studentTable = $connection->query("SELECT * FROM Requests ORDER BY Name");
// $studentTimesTable = $connection->query("SELECT * FROM RequestTimes");
// $studentSubjectsTable = $connection->query("SELECT * FROM RequestSubjects");

if(isset($_COOKIE["tutorID"]))
{
	$command = "INSERT INTO Sessions (Tutor_ID, Student_ID, Time, Subject)
	VALUES ('" . $_COOKIE["tutorID"] . "', " . $_COOKIE["studentID"] . ", 'Feature not finished' , 'TBA' )";
	$connection->query($command);
	unset($_COOKIE["studentID"]);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Student List</title>

<script>
function setTutorListCookie(studentID)
{
	document.cookie = "studentID=" + studentName;
	location.reload();
}
function tutorConfirm(tutorID)
{
	if(alert("Are you sure?"))
	{
		document.cookie = "tutorID=" + tutorName;
		location.reload();
	}
}
</script>

</head>

<body>

<h1>Tutors and Students</h1>

<?php /*
	
	$tutorTable = $connection->query("SELECT * FROM Tutors");

	while ($row = mysqli_fetch_assoc($tutorTable)) {
		echo $row['ID_number'] . $row['Name'] . $row['Email'] . $row['laptopNumber'].'\n';
	}
*/
?>

<table>
    <tr>
        <td>Name</td>
        <td>ID</td>
        <td>Email</td>
    </tr>
	<?php 
    
    while ($row = mysqli_fetch_assoc($studentTable)) {
 	   echo "<tr onclick=\"setTutorListCookie('" . $row["id"] . "')\"><td>" . $row["name"] . "</td><td>" . $row["id"] . "</td><td>" . $row["email"] . "</td></tr>";
    }
    
	
    if(isset($_COOKIE["studentID"]))
    {
        echo "</table><table><tr><td>Name</td><td>ID</td><td>Email</td></tr>";
        $studentTimesTable = $connection->query("SELECT Times FROM RequestTimes WHERE ID_number=" . $_COOKIE["studentID"]);
        $studentSubjectsTable = $connection->query("SELECT Times FROM RequestSubjects WHERE ID_number=" . $_COOKIE["studentID"]);
		
   		while ($timesRow = mysqli_fetch_assoc($studentTimesTable)) {
			$tomatch = $tomatch ."'" $timesRow["Time"] + "',";
		}
		$tomatch = substr($tomatch, 0, strlen($tomatch) -1);
			
		$timeMatches = "Select * FROM Tutors
						INNER JOIN (SELECT ID_Number, Count(*) AS Availability FROM TutorTimes WHERE Time IN (".$tomatch.") GROUP BY ID_number) counts
						ON counts.ID_number = Tutors.ID_number";

			
		while($row = mysqli_fetch_assoc($timeMatches) {
			echo "<tr onclick=\"tutorConfirm('" . $row["ID_number"] . "')\"><td>" . $row["name"] . "</td><td>" . $row["ID_number"] . "</td><td>" . $row["email"] . "</td></tr>";
		}
    }
    
    
    ?>
</table>
<br/>
<a href="currentSessions.php">Click here to view the current sessions</a>
</body>
</html>
