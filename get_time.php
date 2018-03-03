<?php 
	$con=mysqli_connect('localhost','root','','trackingbase');
	if (mysqli_connect_error()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else 
		echo "<br />Connect succesfull";

	if(isset($_GET["date_time"])){
	if($_GET["date_time"]){
	$datetime = $_GET["date_time"];
	echo "<br/>$datetime";

	mysqli_query($con, "INSERT INTO rawtime(date_time) VALUES ('$datetime')");
	$select = "SELECT * FROM rawtime ORDER BY id  DESC LIMIT 1";
	$data = mysqli_query($con,$select);
	while($row = mysqli_fetch_array($data)){
		$id = $row["id"];
		$date_time = $row["date_time"];
		echo "<br />$id";
		echo "<br />$date_time";

	}
 }
}

?>