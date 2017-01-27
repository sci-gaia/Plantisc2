<?php
session_start();
$id = $_SESSION['userid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<meta name="author" content="" />

<link rel="stylesheet" type="text/css" href="style.css" media="screen" />

<title>Tissue Culture Portal</title>

</head>

	<body>

		<div id="wrapper">  
  <table border="1" width="100%">

</br>
</br>
<font color="#000000" font size="4">
		 
<tr> 
<br>
 <th bgcolor="#bee3c2"></th> 
		</tr>
		</table>

<?php

include('check.php'); 
$treatment=$_POST['treatment']; 
$type=$_POST['type']; 
$kinintype=$_POST['kinintype']; 
$count = 0; 

$SQL10 = "DELETE FROM upload where userid='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";
$result = mysql_query($SQL10);
$SQL11 = "DELETE FROM output where userid='$id' and treatment='$treatment' and type='$type'";
$result = mysql_query($SQL11);
ini_set("display_errors",1);
require_once 'excel_reader2.php';
require_once 'check1.php';

$sqls="SELECT max(fileid) as fileid FROM upload";
$results=mysql_query($sqls);
$row = mysql_fetch_assoc($results);
$fileid = $row['fileid'];
$fileid = $fileid + 1;


$sql0="SELECT contact FROM user where userid='$id'";
$results=mysql_query($sql0);
$row = mysql_fetch_assoc($results);
$contact = $row['contact'];

$data = new Spreadsheet_Excel_Reader("C:\Tissue\Data.xls");

$html="<table border='1' width='100%' >";
for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
{ 
if(count($data->sheets[$i][cells])>0) // checking sheet not empty
{
for($j=4;$j<=count($data->sheets[$i][cells]);$j++) // loop used to get each row of the sheet
{ 
$html.="<tr>";
for($k=1;$k<=count($data->sheets[$i][cells][$j]);$k++) // This loop is created to get data in a table format.
{
$html.="<td>";
$html.=$data->sheets[$i][cells][$j][$k];
$html.="</td>";
}
$auxin = strtoupper(mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][1]));
$auxinname = strtoupper(mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][2]));
$cytokinin = strtoupper(mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][3]));
$response = strtoupper(mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][4]));
if($auxin==""){
break;
}

$query1 = "insert into upload(userid, auxin, auxinname, cytokinin, cytokininname, response, treatment, type, fileid, contact) values('".$id."', '".$auxin."','".$auxinname."','".$cytokinin."','".$kinintype."','".$response."','".$treatment."','".$type."','".$fileid."','".$contact."')";
mysqli_query($connection,$query1);

$count = $count + 1;
}
$html.="</tr>";
}
}
$html.="</table>";
echo $html;

$SQL101 = "DELETE FROM upload where userid= ''";
$result = mysql_query($SQL101);


echo "<center><h1>UPLOAD SUCCESSFUL</a></h4></center>"; 
?>
</tr>
</table>
</div> <!-- End #wrapper -->

	</body>

</html>