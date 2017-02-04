<?php
session_start();
$id = $_SESSION['userid'];

if(isset($_POST['save'])) {
    print "<pre>";
    print_r($_POST);
    print "</pre>";
}

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

<?php 
include('includes/header.php'); 
include('config1.php'); 
include('check.php');

$treatment=$_POST['treatment'];
$type=$_POST['type'];
$kinintype=$_POST['kinintype'];


?>
  <div id="content">
   </tr>
  <br>
 <?php

$sql3="SELECT auxin, auxinname, cytokinin, cytokininname, response FROM output WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";
$result3=mysql_query($sql3);
if (mysql_num_rows($result3) == 0) {
 echo "<h1><align = 'left'>NO RECORD FOUND FOR USER</a></h3>"; 
 exit;
 }
 ?>
  <strong><center><font size="5" color="#000000">SIMULATION DETAILS </font></center></strong>
<table>

	

 
<br> 
  <?php 
  $sn = 1;
  
  
$result5 = mysql_query("select max(response) as yield from output WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'");  
while($rows=mysql_fetch_array($result5))   
{
	 $yield=$rows['yield'];
}
$msg = '**';
echo "<table border='1'>
<tr bgcolor='#ffffff' width='1000' font color='#000000' font size='2'>
<th bgcolor='#bee3c2'>S/No</th>
<th bgcolor='#bee3c2'>Auxin Concentration</th>
<th bgcolor='#bee3c2'>Auxin Name</th>
<th bgcolor='#bee3c2'>Cytokinin Concentration</th>
<th bgcolor='#bee3c2'>Cytokinin Name</th>
<th bgcolor='#bee3c2'>Attribute</th>
<th bgcolor='#bee3c2'>Treatment</th>
<th bgcolor='#bee3c2'>Response</th>
</tr>";

$sql3=mysql_query("SELECT auxin, auxinname, cytokinin, cytokininname, type, treatment, response FROM output WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'");
while($row = mysql_fetch_array($sql3))
  {
  echo "<tr>";
    echo "<td>" . $sn. "</td>";
	echo "<td>" . $row['auxin'] . "</td>";
    echo "<td>" . $row['auxinname'] . "</td>";
	 echo "<td>" . $row['cytokinin'] . "</td>";
	  echo "<td>" . $row['cytokininname'] . "</td>";
	   echo "<td>" . $row['type'] . "</td>";
	   echo "<td>" . $row['treatment']. "</td>";
	    echo "<td>" . $row['response'] . "</td>";
	if($row['response']==$yield){
	echo"<td bgcolor='#bee3c2'>".$msg. "</td>";
	}	
		
	$sn = $sn + 1;
   echo "</tr>";
  }
  echo "</table>";
  

  ?>
  </table>

</div> <!-- end #content -->
<br></br>
	<SCRIPT LANGUAGE="JavaScript"> 
if (window.print) {
document.write('<form><input type=button name=print value="Print Result" onClick="window.print()"></form>');
}
</script
<?php include('includes/footer.php'); ?>

		</div> <!-- End #wrapper -->

	</body>


</html>








