<?php
$connect=mysqli_connect('localhost','root','','maps');
if(!$connect){
	echo "Không kết nối được với sever";
}
else{
	mysqli_set_charset($connect,"utf8");
}

// Opens a connection to a MySQL server
mysqli_query($connect,"SET NAMES 'utf8'");

$result = mysqli_query($connect,"SELECT lat, lng, intensity FROM heatmap");

echo "[</br";
$delimiter = "";
while ( $row = mysqli_fetch_assoc($result) )
{
    $lat = $row["lat"];
    $lng = $row["lng"];
    $wt = $row["intensity"];
    echo "$delimiter  { \"location\" : [$lat, $lng], \"weight\" : $wt }";
    $delimiter = ",</br>";
}
echo "</br>]";

?>