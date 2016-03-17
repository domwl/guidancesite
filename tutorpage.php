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

<h1>sssdsadasdasdsas</h1>

<table>
<td>
<tr>Name</tr><tr>ID</tr><tr>Email</tr>
</td>
<?php

while ($row = mysqli_fetch_assoc($studentTable))
{
	echo "<td onclick=\"setTutorListCookie('" . $row["id"] . "')\"><tr>" . $row["name"] . "</tr><tr>" . $row["id"] . "</tr><tr>" . $row["email"] . "</tr></td>";
}

if(isset($_COOKIE["studentID"])
{
	$studentTimesTable = $connection->query("SELECT Times FROM RequestTimes WHERE ID_number=" . $_COOKIE["studentID"]);
	while ($row = mysqli_fetch_assoc($tutorTable))
	{
		$tutorsTimesTable = $connection->query("SELECT Times FROM RequestTimes WHERE ID_number=" . $row["id"]);
		while($sRow = $studentTimesTable->fetch_assoc())
			while($tRow = $tutorsTimesTable->fetch_assoc())
				if($sRow["Time"] == $tRow["Time"])
					echo "<td onclick=\"tutorConfirm('" . $row["id"] . "')\"><tr>" . $row["name"] . "</tr><tr>" . $row["id"] . "</tr><tr>" . $row["email"] . "</tr></td>";
	}
}

?>
</table>

</body>
</html>
