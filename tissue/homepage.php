<?php
session_start();
?>
<?php
$userid = $_SESSION['userid'];
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="tissue"; // Database name 
$tbl_name="user"; // Table name


mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$sql="SELECT names FROM $tbl_name WHERE userid='$userid'";
$result=mysql_query($sql);
$row = mysql_fetch_assoc($result);
$names = $row['names'];
$names = strtoupper(stripslashes($names));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<meta name="author" content="" />

<link rel="stylesheet" type="text/css" href="style2.css" media="screen" />

<title>Tissue Culture Portal</title>

</head>

	<body>

<div id="wrapper">

<?php include('includes/header.php'); ?>
<?php include('includes/nav1.php'); ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="330033">
      <tr>
        <td>
		<p align="center"><b><font face="Times New Roman" color="#ffffff">
		<marquee><?php echo "WELCOME         ".$names; echo ",          YOU HAVE SUCCESSFULLY LOGGED IN.";?></marquee></font></b></td>

      </tr>
       <tr>
        <td>
		
	</tr>
	 
   </table>

<div id="content">

<align = "centre"><img src="images1/content.jpg" align="centre" />	
</div> <!-- end #content -->
<?php include('includes/footer.php'); ?>
</div> <!-- End #wrapper -->
</body>

</html>
