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
include('includes/sidepic1.php');
//$servername = "localhost";
//$username = "root";
//$password = "";

// Create connection
//$conn = new mysqli($servername, $username, $password);
// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}

// Create database

//$sql = "CREATE DATABASE tissue";
//if ($conn->query($sql) === TRUE) {
//   	include('config1.php');

//} else {
//$sql00 = "DROP DATABASE tissue";
//include('config1.php');
//}

//$conn->close();

?>



<div id="content">
</br>
<h2>Tedious Laboratory experiments</h2>

<p>

Plant tissue culture is still in its empirical stage, involving a lot of trials and error.</p>

<p>

This portal provides a 70% accurate means of simulating the desired concentration mixture .

<p><p><p><p><p>

</br>
</p>
</br>
<h2>Cost Efficiency</h2>

<p>
Due to the number of trials required for Plant tissue culture experiments, the cost of infrastructure and material resources are also high.
</p>
<p>
This portal reduces the experimental cost to a large extent.
</p>
<br></br>
<h2>Experiment Time management</h2>

<p>
The experiment is time and material intensive, running into several months of laboratory efforts to
build hormonal combinations that will be best for mass propagation of a particular plant specie.
<p>

</p>
<br></br>
<h2>Prediction of Culture mixture</h2>

<p>
This portal simply simulates and predicts the desired hormonal combinations using the provided input data. A two variable multi-Regression was used for the prediction.
<p>
The simulation time is dependent on the user's input data.
</p>

</div> <!-- end #content -->

<?php include('includes/footer.php'); ?>


		</div> <!-- End #wrapper -->
</body>

</html>
