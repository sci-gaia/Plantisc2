<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'tissue');
$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// username and password sent from form 
$names=$_POST['names']; 
$username=$_POST['username']; 
$password=$_POST['password']; 
$contact=$_POST['contact'];

if($names == '' || $username =='' || $password==''){
echo "<center><h4><a href='http://localhost/tissue/register.php'>Please Confirm Entries and Retry</a></h4></center>";
exit;
}


$sql2 = "SELECT count(userid) as id FROM user";  
$result=mysqli_query($connection,$sql2);
$row = mysqli_fetch_assoc($result);
$userid = $row['id'];
$userid = $userid + 1;

// To protect MySQL injection (more detail about MySQL injection)
$password = stripslashes($password);

$sql="SELECT * FROM user WHERE names='$names'";
$result=mysqli_query($connection,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
echo "<center><h4><a href='http://localhost/tissue/register.php'>User already in existence, Try another</a></h4></center>";

}
else {
$SQL = "INSERT INTO user (userid, names, username, password, contact) VALUES ('$userid','$names', '$username' , '$password', '$contact')";
mysqli_query($connection,$SQL);

echo "<center><h4><a href='http://localhost/tissue/index.php'>Registration was successful. Click to Continue</a></h4></center>";
}
?>

	
	

