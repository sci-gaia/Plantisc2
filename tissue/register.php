<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

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
		<marquee><?php echo "PLEASE ENTER USER DETAILS";?></marquee></font></b> </td>

		
      </tr>
       <tr>
        <td>
		
	</tr>
	
  </table>
</br>
  <align = "centre"><img src=" http://localhost/tissue/images1/ulogin.jpg" align="centre" />
<form action="registercheck.php" method="post" form name="form1">
					    	<input type="hidden" name="names" value="names" />
							<table width="450" bgcolor="#ffffff" style="background-color: #f1f1f1">
								<tr><td align="left" bgcolor="#f1f1f1"><span class="style7"><strong>Full Names:</span></td>
								  <td bgcolor="#f1f1f1">
				</br>
                                  <input style="width: 300px" name="names" type="text" value="" size="20"/></td>
								</tr>
								</br>
								<tr><td align="left" bgcolor="#f1f1f1"><span class="style7"><strong>User Name:</span></td>
								  <td bgcolor="#f1f1f1">
				</br>
                                  <input style="width: 300px" name="username" type="text" value="" size="20"/></td>
								</tr>
								</br>
									<tr><td align="left" bgcolor="#f1f1f1"><span class="style7"><strong>Password:</span></td>
								  <td bgcolor="#f1f1f1">
						</br>

                                <input style="width: 300px" name="password" type="password" size="20"/></td>
								</tr>
												</br>
									<tr><td align="left" bgcolor="#f1f1f1"><span class="style7"><strong>Phone Number:</span></td>
								  <td bgcolor="#f1f1f1">
						</br>

                                <input style="width: 300px" name="contact" type="text" size="20"/></td>
								</tr>
								  </td>
								  </td>
 </tr>
		
<tr><td bgcolor="#330033">&nbsp;</td>
										<td bgcolor="#330033"><input type="submit" value="Register" /></td>
								</tr>
        </table>
					</form>	
<br></br><br></br>				
</div> <!-- end #content -->
<?php include('includes/footer.php'); ?>

		</div> <!-- End #wrapper -->
</body>

</html>
