<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="tissue"; // Database name 
$tbl_name="user"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$names=$_POST['names']; 
$username=$_POST['username']; 
$password=$_POST['password']; 
$contact=$_POST['contact'];

if($names == '' || $username =='' || $password==''){
echo "<center><h4><a href='/register.php'>Please Confirm Entries and Retry</a></h4></center>";
exit;
}

$sqls="SELECT count(userid) as id FROM user";
$results=mysql_query($sqls);
$row = mysql_fetch_assoc($results);
$userid = $row['id'];
$userid = $userid + 1;

// To protect MySQL injection (more detail about MySQL injection)
$password = stripslashes($password);
$names = mysql_real_escape_string($names);
$username = mysql_real_escape_string($username);
$sql="SELECT * FROM $tbl_name WHERE names='$names'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
echo "<center><h4><a href='/register.php'>User already in existence, Try another</a></h4></center>";

}
else {
$SQL = "INSERT INTO user (userid, names, username, password, contact) VALUES ('$userid','$names', '$username' , '$password', '$contact')";
$result = mysql_query($SQL);

echo "<center><h4><a href='/index.php'>Registration was successful. Click to Continue</a></h4></center>";
}
?>

	
	

