 <?php 
 /*
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
*/

$connect = mysqli_connect("localhost","root","");
$selection = mysqli_select_db($connect,"trackingbase");
mysqli_query($connect,"SET NAMES 'utf8'");

?>
