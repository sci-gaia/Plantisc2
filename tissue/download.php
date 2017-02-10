<?php
session_start();
$userid = $_SESSION['userid'];
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
<center><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="330033">
      <tr>
        <td>
		<p align="center"><b><font face="Times New Roman" color="#ffffff">
		<marquee><?php echo " CLICK TO DOWNLOAD THE DESIRED FILE.";?></marquee></font></b></td>

      </tr>
       <tr>
        <td>
		
	</tr>
	 
   </table>
<br></br>

<align = "centre"><img src=" http://localhost/tissue/images1/upload.jpg" align="centre" />
 <br></br>

<?php
ini_set('display_errors', E_ALL);
include "check1.php";
$sn = 1;
$sql = "SELECT distinct fileid, auxinname, cytokininname, treatment, type, contact FROM upload order by fileid asc";
$result=mysqli_query($connection,$sql); 
$rows = mysqli_num_rows($result);

echo "<table>\n";
echo " <tr>\n";
echo "  <td>ID</td>\n";
echo "  <td>Auxin</td>\n";
echo "  <td>Cytokinin</td>\n";
echo "  <td>Treatment</td>\n";
echo "  <td>Attribute</td>\n";
echo "  <td>Contact</td>\n";

echo "  <td> </td>\n";
echo " </tr>\n";

while ($rows = mysqli_fetch_object($result))
  {
  echo " <tr>\n";
  echo "  <td>$rows->fileid</td>\n";
  echo "  <td>$rows->auxinname</td>\n";
  echo "  <td>$rows->cytokininname</td>\n";
  echo "  <td>$rows->treatment</td>\n";
  echo "  <td>$rows->type</td>\n";
   echo "  <td>$rows->contact</td>\n";
	
  echo "  <td>( <a href='downloadcheck.php?fileid=$rows->fileid'>Download</a> )</td>\n";
  $sn = $sn + 1;
  echo " </tr>\n";

  }

mysqli_free_result($result);
?>
		
</div> <!-- end #content -->