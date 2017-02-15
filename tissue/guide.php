<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<meta name="author" content="" />

<link rel="stylesheet" type="text/css" href="style1.css" media="screen" />

<title>Tissue Culture Portal</title>

</head>

	<body>

		<div id="wrapper">

<?php include('includes/header.php'); ?>
<?php include('includes/nav.php'); 
?>
<?php include('includes/sidepic1.php'); ?>
<div id="content">
</br>
<h2>Guide on how to use the site</h2>

<p><font color = "#000000">

This site predicts Plant tissue culture concentration. The user can either use existing data from the repository or can upload his own data. 
<p>
The user can download existing data after successful registeration and login. 
</p>
<p>
The user can also upload his data using a specified excel template called 'data.xls' which is also available at login. <font color ="#727b84"><a href="/data.xls" ><font color="#727b84">Click to Download Template</font></a>
</p>
<p><font color = "#000000">
The user is expected to edit the template, save it in a pre created folder called 'Tissue' in root directory of 'C' drive. 
</p>
<p>
The path to the template is C:/tissue/data.xls. If the user chooses to use existing data, then the downloaded data must be placed in the same data.xls template and uploaded before the user can make use of it.
<p><p><p><p><p>

<p>
Once data is available, the user proceeds to make prediction, simulate and print results based on the auxin and cytokinin type. 
</p>
<p>
An Export of completed simulation is also provided for the user for further ststistical analysis.  
</p>
<p>
Immediately data is uploaded, the regression equation is obtained for the data and used to perform a simulation on the range of the uploaded data.
<p><p><p><p><p>
<p>
The simulation covers all the concentration combinations which are not included in the range thereby calculating a prediction for the response yield.</p>
<p><p><p><p><p>
</br>
</p>
</br>

</div> <!-- end #content -->

<?php include('includes/footer.php'); ?>


		</div> <!-- End #wrapper -->
</body>

</html>
