<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html >

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

<?php 
include('includes/header.php'); 
include('includes/nav.php');
?>
<center><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="330033">
      <tr>
        <td>
		<p align="center"><b><font face="Times New Roman" color="#ffffff">
		<marquee><?php echo "PLEASE ENTER YOUR LOGIN DETAILS";?></marquee></font></b> </td>

		
      </tr>
       <tr>
        <td>
		
	</tr>
	
  </table>
</br>
  <align = "centre"><img src=" http://localhost/tissue/images1/ulogin.jpg" align="centre" />
<form action="userlogincheck.php" method="post" form name="form1">
					    	<input type="hidden" name="names" value="names" />
							<table width="350" bgcolor="#ffffff" style="background-color: #f1f1f1">
								<tr><td align="left" bgcolor="#f1f1f1"><span class="style7"><strong>Enter Username:</span></td>
								  <td bgcolor="#f1f1f1">
				</br>
                                  <input style="width: 150px" name="myusername" type="text" value="" size="20"/></td>
								</tr>
								</br>
								<tr><td align="left" bgcolor="#f1f1f1"><span class="style7"><strong>Enter Password:</span></td>
								  <td bgcolor="#f1f1f1">
						</br>

                                <input style="width: 150px" name="password" type="password" size="20"/></td>
								</tr>
								  </td>
 </tr>
			
			  <tr>
			<tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
			<tr></tr><tr></tr>
		
            <tr>
                <tr>
			 <td><strong><font size="3">
               	   <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
					   <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
							
<tr><td bgcolor="330033">&nbsp;</td>
										<td bgcolor="330033"><input type="submit" value="Login" /></td>
								</tr>
        </table>
					</form>	
<br></br><br></br>				

<?php include('includes/footer.php'); ?>

		</div> <!-- End #wrapper -->
</body>
</html>
