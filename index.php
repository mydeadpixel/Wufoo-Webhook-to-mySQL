<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$con=mysqli_connect("localhost","yourUsername","yourPassword","yourDatabaseName");
 
	if (mysqli_connect_errno()) {
		echo "database connection failed";
	}


	if ($_POST['HandshakeKey'] == "wufooHandshakeKey") {
		$name = mysqli_real_escape_string($con, $_POST['Field1']);
		$miles = mysqli_real_escape_string($con, $_POST['Field2']);
		$EntryId = mysqli_real_escape_string($con, $_POST['EntryId']);

		$stmt = $con->prepare("INSERT INTO totalMilesDB (name, miles, EntryId)VALUES (?,?,?)");
		$stmt->bind_param("sss", $name, $miles, $EntryId);
		if (!$stmt->execute()) { die('Error: ' . mysqli_error($con)); }
		mysqli_close($con);
	}

	else {
		echo 'Ah ah ah, you didnt say teh magic word!';
	}
}

?>
