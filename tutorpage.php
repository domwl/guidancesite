<?php

if(!isset($_COOKIE["signin"]) && !isset($_POST["username"]))
	die("Please login:<br/><form action='' method='post'><table><tr><td>Username:</td><td><input type='text' name='username'/></td></tr><tr><td>Password:</td><td><input type='password' name='password'/></td></tr></table></form>");
else if(isset($_POST["username"]))
{
	if($_POST["username"] == "kelly" && $_POST["password"] == "12345")
		setcookie("signin", "1");
}

$serverName = "localhost";
$serverUsername = "username";
$serverPassword = "password";
$databaseName = "tutoringSignup";

$connection = new mysqli($serverName, $serverUsername, $serverPassword, $databaseName);

$studentTable = $connection->query("SELECT * FROM Requests");
// $studentTimesTable = $connection->query("SELECT * FROM RequestTimes");
// $studentSubjectsTable = $connection->query("SELECT * FROM RequestSubjects");

if(isset($_COOKIE["tutorID"]))
{
	$command = "INSERT INTO Sessions (tutorID, studentID, times, subjects)
	VALUES ('" . $_COOKIE["tutorID"] . "', " . $_COOKIE["studentID"] . ", , )";
	$connection->query($command);
	unset($_COOKIE["studentID"]);
}
else if(isset($_COOKIE["studentID"])
{
	$tutorTable = $connection->query("SELECT * FROM Tutors");
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

<table>
<tr>
<td>Name</td><td>ID</td><td>Email</td>
</tr>
<?php

while ($row = mysqli_fetch_assoc($studentTable))
{
	echo "<tr onclick=\"setTutorListCookie('" . $row["id"] . "')\"><td>" . $row["name"] . "</td><td>" . $row["id"] . "</td><td>" . $row["email"] . "</td></tr>";
}

if(isset($_COOKIE["studentID"])
{
	echo "</table><table><tr><td>Name</td><td>ID</td><td>Email</td></tr>";
	$studentTimesTable = $connection->query("SELECT Times FROM RequestTimes WHERE ID_number=" . $_COOKIE["studentID"]);
	$studentSubjectsTable = $connection->query("SELECT Times FROM RequestSubjects WHERE ID_number=" . $_COOKIE["studentID"]);
	while ($row = mysqli_fetch_assoc($tutorTable))
	{
		$tutorsTimesTable = $connection->query("SELECT Times FROM RequestTimes WHERE ID_number=" . $row["id"]);
		$tutorsSubjectsTable = $connection->query("SELECT Times FROM RequestSubjects WHERE ID_number=" . $row["id"]);
		while($sTRow = $studentTimesTable->fetch_assoc())
			while($tTRow = $tutorsTimesTable->fetch_assoc())
				while($sSRow = $studentSubjectsTable->fetch_assoc())
					while($tSRow = $tutorsSubjectsTable->fetch_assoc())
						if($sTRow["Time"] == $tTRow["Time"] && $sSRow["Subject"] && $tSRow["Subject"])
							echo "<tr onclick=\"tutorConfirm('" . $row["id"] . "')\"><td>" . $row["name"] . "</td><td>" . $row["id"] . "</td><td>" . $row["email"] . "</td></tr>";
	}
}

$session = $connection->query("SELECT * FROM Sessions");
$sessionTimes = $connection->query("SELECT Times FROM Sessions");
$sessionSubjects = $connection->query("SELECT Subjects FROM Sessions");

echo "</table><table><tr><td>Tutor ID</td><td>Student ID</td><td>Times</td><td>Subjects</td></tr>";

while($row = $session->fetch_assoc() && $tRow = $sessionTimes->fetch_assoc() && $sRow = $sessionSubjects->fetch_assoc())
{
	echo "<tr><td>" . $session["Tutor_ID"] . "</td><td>" . $session["StudentID"] . "</td><td>" . $sessionTimes["Times"] . "</td><td>" . $sessionSubjects["Subjects"] . "</td></tr>";
}

?>
</table>

</body>
</html>
