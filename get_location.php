<?php
	$con=mysqli_connect('localhost','root','','trackingbase');
	if (mysqli_connect_error()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$active_row_number = 1;
	if (isset($_GET["newxsrequest"])){
		if ($_GET["newxsrequest"]=="1"){
			$result = mysqli_query($con,"SELECT row_number FROM maintable1 ORDER BY row_number DESC LIMIT 1");
			while($row = mysqli_fetch_array($result)) {
				$active_row_number = $row['row_number'];
			}
			$result = mysqli_query($con,"UPDATE tmp_storage SET active_row_number_from_bs=$active_row_number WHERE order_number='1'");
		}
		else if ($_GET["newxsrequest"]=="2"){
			$result = mysqli_query($con,"SELECT active_row_number_from_bs FROM tmp_storage WHERE order_number='1'");
			while($row = mysqli_fetch_array($result)) {
				$active_row_number = $row['active_row_number_from_bs'];
			}
		}
		if ($_GET["latest_value"]=="x"){
			$result = mysqli_query($con,"SELECT * FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo  $row['x'];
			}
		}
		if ($_GET["latest_value"]=="y"){
			$result = mysqli_query($con,"SELECT y FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo $row['y'];
			}
		}
		if ($_GET["latest_value"]=="date_time"){
			$result = mysqli_query($con,"SELECT date_time FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo $row['date_time'];
			}
		}
		if ($_GET["latest_value"]=="pms1p0"){
			$result = mysqli_query($con,"SELECT pms1p0 FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo $row['pms1p0'];
			}
		}
			if ($_GET["latest_value"]=="pms2p5"){
			$result = mysqli_query($con,"SELECT pms2p5 FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo $row['pms2p5'];
			}
		}
			if ($_GET["latest_value"]=="pms10"){
			$result = mysqli_query($con,"SELECT pms10 FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo $row['pms10'];
			}
		}
			if ($_GET["latest_value"]=="so2"){
			$result = mysqli_query($con,"SELECT so2 FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo $row['so2'];
			}
		}
			if ($_GET["latest_value"]=="no2"){
			$result = mysqli_query($con,"SELECT no2 FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo $row['no2'];
			}
		}
			if ($_GET["latest_value"]=="co"){
			$result = mysqli_query($con,"SELECT co FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo $row['co'];
			}
		}
			if ($_GET["latest_value"]=="battery"){
			$result = mysqli_query($con,"SELECT battery FROM maintable1 WHERE row_number = '$active_row_number'");
			while($row = mysqli_fetch_array($result)) {
				echo $row['battery'];
			}
		}

	}
	if (isset($_GET["raw_var"]) || isset($_GET["date_time"]) || isset($_GET["pms1p0"]) || isset($_GET["pms2p5"]) || isset($_GET["pms10"]) || isset($_GET["so2"]) || isset($_GET["no2"]) ||isset($_GET["co"]) || isset($_GET["battery"])){
		if ($_GET["raw_var"]){
			$raw_var = $_GET["raw_var"];
			$datetime = $_GET["date_time"];
			$pms1p0 = $_GET["pms1p0"];
			$pms2p5 = $_GET["pms2p5"];
			$pms10 = $_GET["pms10"];
			$so2 = $_GET["so2"];
			$no2 = $_GET["no2"];
			$co = $_GET["co"];
			$battery = $_GET["battery"];
			mysqli_query($con,"INSERT INTO rawdata1 (crd, date_time, pms1p0, pms2p5, pms10, so2, no2, co, battery) VALUES ('$raw_var', '$datetime', '$pms1p0', '$pms2p5', '$pms10', '$so2', '$no2', '$co', '$battery')");
			$xi = 0;
			$xiflag = 0;
			while ($xi != '26'){
				if ((substr( $raw_var , $xi , 1 )) == "y" ){
					$xiflag = 1;
				}
				$xi = $xi + 1;
			}
			if ($xiflag == '0'){
				if ((substr( $raw_var , 11 , 1 )) == "N" ){
					$x_pos_r = (substr( $raw_var , 0 , 2 ))+((substr( $raw_var , 2 , 2 ))/60)+((substr( $raw_var , 5 , 5 ))/6000000);
				}
				else if ((substr( $raw_var , 11 , 1 )) == "S" ){
					$x_pos_r = (substr( $raw_var , 0 , 2 ))+((substr( $raw_var , 2 , 2 ))/60)+((substr( $raw_var , 5 , 5 ))/6000000);
					$x_pos_r = $x_pos_r-($x_pos_r*2);
				}
				if ((substr( $raw_var , 25 , 1 )) == "E" ){
					$y_pos_r = (substr( $raw_var , 13 , 3 ))+((substr( $raw_var , 16 , 2 ))/60)+((substr( $raw_var , 19 , 5 ))/6000000);
				}
				else if ((substr( $raw_var , 25 , 1 )) == "W" ){
					$y_pos_r = (substr( $raw_var , 13 , 3 ))+((substr( $raw_var , 16 , 2 ))/60)+((substr( $raw_var , 19 , 5 ))/6000000);
					$y_pos_r = $y_pos_r-($y_pos_r*2);
				}
				mysqli_query($con,"INSERT INTO maintable1 (x, y, date_time, pms1p0, pms2p5, pms10, so2, no2, co, battery) VALUES ('$x_pos_r', '$y_pos_r', '$datetime', '$pms1p0', '$pms2p5', '$pms10', '$so2', '$no2', '$co', '$battery')");
			}
			echo "GDpOK";
		}
	}
	mysqli_close($con);
?>