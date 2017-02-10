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

<link rel="stylesheet" type="text/css" href="style2.css" media="screen" />

<title>Tissue Culture Portal</title>

</head>

	<body>

		<div id="wrapper">

<?php 
include('includes/header.php'); 
include('includes/nav1.php');
include('config1.php'); 
include('check1.php');
?>

<div id="content">
  <align = "centre"><img src=" http://localhost/tissue/images1/predict.jpg" align="centre" />
</tr>
  <br>
  <br>
    
	
	<br>
	

  <strong><font size="5" color="#000000">SELECT THE EXPERIMENT PARAMETERS</font></strong> 
  <br>
  <br>

  
     <form action="predictcheck.php" method="post">
    
					    	<input type="hidden" name="id" value="<?php echo $id; ?>" />
							<table width="450" bgcolor="#ffffff" style="background-color: #f1f1f1">
							
				</br>
			 <td align="left"><strong><font size="3">
                    Select Treatment:
                </td>
                <td>
                    <select id="treatment" name="treatment">
                     <option value="">------------------ SELECT ------------------</option>
<?php 
$sql = "SELECT * FROM treatment order by treatment";  
$result=mysqli_query($connection,$sql);
while($rows=mysqli_fetch_array($result))
{ 
$treatment=$rows['treatment']; 
echo '<option value="'.$treatment.'">'.$treatment.'</option>'; 
}
 ?> 
	                   </select>
                </td>
            </tr>
                </td>
                    </tr>
            <tr>
			<tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
	<td align="left"><strong><font size="3">
                    Select Plant Attribute:
                </td>
                <td>
                    <select id="type" name="type">
                       <option value="">------------------ SELECT ------------------</option>
<?php 
$sql = "SELECT * FROM type order by type";  
$result=mysqli_query($connection,$sql);
while($rows=mysqli_fetch_array($result))
{ 
$type=$rows['type']; 
echo '<option value="'.$type.'">'.$type.'</option>'; 
}
 ?> 
	                   </select>
                </td>
            </tr>
                </td>
                    </tr>
            <tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>	
            <tr>
<td align="left"><strong><font size="3">
                    Select Cytokinin Type:
                </td>
                <td>
                    <select id="kinintype" name="kinintype">
                       <option value="">------------------ SELECT ------------------</option>
<?php 
$sql = "SELECT * FROM kinintype order by kinintype";  
$result=mysqli_query($connection,$sql);
while($rows=mysqli_fetch_array($result))
{ 
$kinintype=$rows['kinintype']; 
echo '<option value="'.$kinintype.'">'.$kinintype.'</option>'; 
}
 ?> 
	                   </select>
                </td>
            </tr>
                </td>
                    </tr>
            <tr>
			<tr></tr>

			
<td align="left"><strong><font size="3">
 Enter the Auxin Concentration:
                 <td><br></br>
                  <input name="hormone1" type="text" id="hormone1" size="32"  value="">
                </td>
            </tr>
			  <tr>
			  
			
	<td align="left"><strong><font size="3">
 Enter Cytokinin Concentration:
                 <td><br></br>
                  <input name="hormone2" type="text" id="hormone2" size="32"  value="">
                </td>
            </tr>
			  <tr>
			<tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
			<tr>				  
			
					   <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
					   <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
							
<tr><td bgcolor="#330033">&nbsp;</td>
										<td bgcolor="#330033"><input type="submit" value="Predict" /></td>
								</tr>
        </table>
					</form>	
<br></br><br></br>	<br></br><br></br>

</div> <!-- end #content -->


<?php include('includes/footer.php'); ?>

		</div> <!-- End #wrapper -->

	</body>

</html>
