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
include('check1.php');
include('check.php');
$treatment=$_POST['treatment'];
$type=$_POST['type'];
$hormone1=$_POST['hormone1'];
$hormone2=$_POST['hormone2'];
$kinintype=$_POST['kinintype'];
$id=$_POST['id'];
$sql3="SELECT * FROM upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";
$result3=mysql_query($sql3);
if (mysql_num_rows($result3) > 0) {
// get the minimum and maximum value of hormone1 so that user does not select value outside the range
$sql5="SELECT min(auxin) as minsize, max(auxin) as maxsize FROM upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";
$result5=mysql_query($sql5);
$row = mysql_fetch_assoc($result5);
$minsize = $row['minsize'];
$maxsize = $row['maxsize'];

$auxinmax = $maxsize;
$auxinmin = $minsize;

// check against what farmer entered
if($hormone1 < $minsize || $hormone1 > $maxsize){


echo "<center><font color='#000000'><br></br><br></br><h3>SORRY, THE CONCENTRATION VALUE <font color='#be345'>".$hormone1; echo "<font color='#000000'> WHICH YOU ENTERED MUST BE WITHIN THE RANGE   <font color='#be345'>     ".$minsize; echo "   <font color='#000000'>       AND              <font color='#be345'>    ".$maxsize;
echo "<center><br></br><h4><a href='/simulate.php'>CLICK TO TRY AGAIN</a></h4></center><br></br><br></br><br></br>";

exit;
} 


// get the minimum and maximum value of hormone2 so that user does not select value outside the range
$sql15="SELECT min(cytokinin) as minsize, max(cytokinin) as maxsize FROM upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";
$result15=mysql_query($sql15);
$row = mysql_fetch_assoc($result15);
$minsize = $row['minsize'];
$maxsize = $row['maxsize'];

$cytokininmax = $maxsize; 
$cytokininmin = $minsize;

// check against what farmer entered
if($hormone2 < $minsize || $hormone2 > $maxsize){

echo "<center><font color='#000000'><br></br><br></br><h3>SORRY, THE CONCENTRATION VALUE <font color='#be345'>".$hormone2; echo "<font color='#000000'> WHICH YOU ENTERED MUST BE WITHIN THE RANGE   <font color='#be345'>     ".$minsize; echo "   <font color='#000000'>       AND              <font color='#be345'>    ".$maxsize;
echo "<center><br></br><h4><a href='/simulate.php'>CLICK TO TRY AGAIN</a></h4></center><br></br><br></br><br></br>";

exit;
} 
}
else {
echo '<br></br><br></br><br></br><br></br>';
echo '<center><strong><font size="4" color="red">NO RECORD FOUND FOR SELECTED PARAMETERS!</font>';
echo '<br></br><br></br><br></br><br></br>';

exit;
}

// get the total number of records and make sure it matches
$results = mysql_query("select (COUNT(auxin)) as n1, (COUNT(auxin)) as n2 from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'"); 
while($rows=mysql_fetch_array($results))   
{
	 $n1=$rows['n1'];
	  $n2=$rows['n2'];
}

if($n1!=$n2){
echo "THE NUMBER OF UPLOADED INDEPENDENT VARIABLES DOES NOT MATCH. PLS VERIFY AND RE-UPLOAD";
exit;
}
// get the sum of x1, x2 and response
$result = mysql_query("select (sum(auxin)) as sumx1,(sum(cytokinin)) as sumx2, (sum(response)) as sumresponse from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'");  
while($rows=mysql_fetch_array($result))   
{
	 $sumx1=$rows['sumx1'];
	 $sumx2=$rows['sumx2'];
	 $sumresponse=$rows['sumresponse'];
	 $x1bar =$sumx1/$n1;
	 $x2bar =$sumx2/$n1;
	 $responsebar =$sumresponse/$n1;
}

// Get the sum of the x1*x2, x1*response, x2*response
$result1 = mysql_query("select sum(auxin * cytokinin) as sumx1x2, sum(auxin * response) as sumx1response, sum(cytokinin * response) as sumx2response from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'");  
while($rows=mysql_fetch_array($result1))   
{
	 $sumx1x2=$rows['sumx1x2'];
	 $sumx1response=$rows['sumx1response'];
	 $sumx2response=$rows['sumx2response'];
}

//Get the sum of x1 squared, x2 squared, response squared respectively
$result2 = mysql_query("select sum(auxin * auxin) as sumx1squared, sum(cytokinin * cytokinin) as sumx2squared, sum(response * response) as sumresponsesquared from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'");  
while($rows=mysql_fetch_array($result2))   
{
	 $sumx1squared=$rows['sumx1squared'];
	 $sumx2squared=$rows['sumx2squared'];
	 $sumresponsesquared=$rows['sumresponsesquared'];
}
$x1_x1barsum = 0;
$x2_x2barsum = 0;
$response_responsebarsum = 0;
 // get the standard deviation of x1, x2 and response
$result = mysql_query("select auxin,cytokinin,response from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' ");  
while($rows=mysql_fetch_array($result))   
{
	 $auxin=$rows['auxin'];
	 $x1_x1bar = $auxin - $x1bar;
	 $x1_x1barsum= $x1_x1barsum + pow($x1_x1bar,2);
	 
	 $cytokinin=$rows['cytokinin'];
	 $x2_x2bar = $cytokinin - $x2bar;
	 $x2_x2barsum= $x2_x2barsum + pow($x2_x2bar,2);
	 
	 $response=$rows['response'];
	 $response_responsebar = $response - $responsebar;
	 $response_responsebarsum= $response_responsebarsum + pow($response_responsebar,2);
}
$sdx1 = sqrt(($x1_x1barsum)/($n1-1));
$sdx2 = sqrt(($x2_x2barsum)/($n1-1));
$sdresponse = sqrt(($response_responsebarsum)/($n1-1));


// Do the math
$numerator= $sumx1x2 - ($sumx1*$sumx2)/$n1;
$denominator1 = $sumx1squared - ($sumx1*$sumx1)/$n1;
$denominator2 = $sumx2squared - ($sumx2*$sumx2)/$n1;
$denominator = sqrt($denominator1*$denominator2);
$correlationx1x2 = $numerator/$denominator;

$numerator= $sumx1response - ($sumx1*$sumresponse)/$n1;
$denominator1 = $sumx1squared - ($sumx1*$sumx1)/$n1;

$denominator2 = $sumresponsesquared - ($sumresponse*$sumresponse)/$n1;
$denominator = sqrt($denominator1*$denominator2);

$correlationx1response = $numerator/$denominator;

$numerator= $sumx2response - ($sumx2*$sumresponse)/$n1;
$denominator1 = $sumx2squared - ($sumx2*$sumx2)/$n1;
$denominator2 = $sumresponsesquared - ($sumresponse*$sumresponse)/$n1;
$denominator = sqrt($denominator1*$denominator2);
$correlationx2response = $numerator/$denominator;

$R1 = (pow($correlationx1response,2)+ pow($correlationx2response,2))- 2*($correlationx1response)*$correlationx2response*$correlationx1x2;
$R2 = 1-(pow($correlationx1x2,2));
$R = sqrt($R1/$R2);

$b1 = (($correlationx1response - ($correlationx2response*$correlationx1x2))/(1 - pow($correlationx1x2,2)));
$b1 = $b1 *($sdresponse/$sdx1);

$b2 = (($correlationx2response - ($correlationx1response*$correlationx1x2))/(1 - pow($correlationx1x2,2)));
$b2 = $b2 *($sdresponse/$sdx2);
$a = $responsebar - ($b1*$x1bar) -($b2*$x2bar);

$prediction = $a + ($b1*$hormone1) + ($b2*$hormone2);
$prediction = number_format($prediction, 2, '.', ',');

?>
	
  </table>

<div id="content">
<br>
<br>

<strong><font size="6" color="#be345"><?php echo "<br />PREDICTION RESULT"; echo "<br/>"?></font></b></td></font></strong> 
<br>
<strong><font size="5" color="#000000"><?php echo "THE ESTIMATED YIELD FOR AUXIN CONCENTRAION         <font color='#be345'>".$hormone1;echo "mg/L"; echo "<font color='#000000'>  and CYTOKININ CONCENTRATION  <font color='#be345'>".$hormone2;echo "mg/L"; echo "<font color='#000000'>  is   <font color='#be345'>".$prediction; ?></font></b></td></font></strong> 

  <br>
  <br>
   </table>
    </form>
<br></br><br></br>

</div> <!-- end #content -->


<?php include('includes/footer.php'); ?>

		</div> <!-- End #wrapper -->

	</body>

</html>
