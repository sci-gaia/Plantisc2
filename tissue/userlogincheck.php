<?php
session_start();
?>
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'tissue');
$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
// username and password sent from form 
$myusername=$_POST['myusername']; 
$password=$_POST['password']; 
$password = stripslashes($password);
$myusername = strtoupper(stripslashes($myusername));
// To protect MySQL injection (more detail about MySQL injection)
//$myusername = mysqli_real_escape_string($myusername);
//$password = mysqli_real_escape_string($password);
$sql = "select userid from user WHERE username='$myusername' and password='$password'";  
$result=mysqli_query($connection,$sql);
while($rows=mysqli_fetch_array($result))   
{
	 $userid=$rows['userid'];
}
// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['userid'] = $userid;
header("Location: http://localhost/tissue/homepage.php");
}
else {
echo "<center><h4><a href='http://localhost/tissue/userlogin.php'>Wrong Password. Retry</a></h4></center>";
}
?>

	
	

