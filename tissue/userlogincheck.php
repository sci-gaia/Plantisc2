<?php
session_start();
?>
<?php
$host="localhost"; // Host name 
// $username="root"; // Mysql username
// $password=""; // Mysql password
$username="tissue"; // Mysql username
$password="tissue"; // Mysql password
$db_name="tissue"; // Database name
$tbl_name="user"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form
$myusername=$_POST['myusername'];
$password=$_POST['password'];
$password = stripslashes($password);
$myusername = strtoupper(stripslashes($myusername));
// To protect MySQL injection (more detail about MySQL injection)
$myusername = mysql_real_escape_string($myusername);
$password = mysql_real_escape_string($password);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$password'";
$result=mysql_query($sql);

$result = mysql_query("select userid from user WHERE username='$myusername' and password='$password'");
while($rows=mysql_fetch_array($result))
{
	 $userid=$rows['userid'];
}

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['userid'] = $userid;
header("Location: /homepage.php");
}
else {
echo "<center><h4><a href='/userlogin.php'>Wrong Password. Retry</a></h4></center>";
}
?>
