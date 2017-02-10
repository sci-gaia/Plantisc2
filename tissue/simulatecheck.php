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
$treatment=$_POST['treatment'];
$type=$_POST['type'];
$hormone1=$_POST['hormone1'];
$hormone2=$_POST['hormone2'];
$kinintype=$_POST['kinintype'];

$sql = "SELECT * FROM upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result=mysqli_query($connection,$sql);
if (mysqli_num_rows($result) > 0) {
// get the minimum and maximum value of hormone1 
$sql0 = "SELECT min(auxin) as minsize, max(auxin) as maxsize FROM upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result0=mysqli_query($connection,$sql0);
$row = mysqli_fetch_assoc($result0);
$minsize = $row['minsize'];
$maxsize = $row['maxsize'];

$auxinmax = $maxsize;
$auxinmin = $minsize;

// get the minimum and maximum value of hormone2 
$sql1 = "SELECT min(cytokinin) as minsize, max(cytokinin) as maxsize FROM upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result1=mysqli_query($connection,$sql1);
$row = mysqli_fetch_assoc($result1);
$minsize = $row['minsize'];
$maxsize = $row['maxsize'];

$cytokininmax = $maxsize; 
$cytokininmin = $minsize;
}
else {
echo '<br></br><br></br><br></br><br></br>';
echo '<center><strong><font size="4" color="red">NO RECORD FOUND FOR SELECTED PARAMETERS!</font>';
echo '<br></br><br></br><br></br><br></br>';

exit;
}
// get the total number of records and make sure it matches
$sql2 = "select (COUNT(auxin)) as n1, (COUNT(auxin)) as n2 from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype' ";  
$result2=mysqli_query($connection,$sql2);
while($rows=mysqli_fetch_array($result2))  
{
	 $n1=$rows['n1'];
	  $n2=$rows['n2'];
}

if($n1!=$n2){
echo "THE NUMBER OF UPLOADED INDEPENDENT VARIABLES DOES NOT MATCH. PLS VERIFY AND RE-UPLOAD";
exit;
}
// get the sum of x1, x2 and response
$sql3 = "select (sum(auxin)) as sumx1,(sum(cytokinin)) as sumx2, (sum(response)) as sumresponse from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result3=mysqli_query($connection,$sql3);
while($rows=mysqli_fetch_array($result3))   
{
	 $sumx1=$rows['sumx1'];
	 $sumx2=$rows['sumx2'];
	 $sumresponse=$rows['sumresponse'];
	 $x1bar =$sumx1/$n1;
	 $x2bar =$sumx2/$n1;
	 $responsebar =$sumresponse/$n1;
}

// Get the sum of the x1*x2, x1*response, x2*response
$sql4 = "select sum(auxin * cytokinin) as sumx1x2, sum(auxin * response) as sumx1response, sum(cytokinin * response) as sumx2response from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result4=mysqli_query($connection,$sql4);
while($rows=mysqli_fetch_array($result4)) 
{
	 $sumx1x2=$rows['sumx1x2'];
	 $sumx1response=$rows['sumx1response'];
	 $sumx2response=$rows['sumx2response'];
}

//Get the sum of x1 squared, x2 squared, response squared respectively
$sql5 = "select sum(auxin * auxin) as sumx1squared, sum(cytokinin * cytokinin) as sumx2squared, sum(response * response) as sumresponsesquared from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result5=mysqli_query($connection,$sql5);
while($rows=mysqli_fetch_array($result5))
{
	 $sumx1squared=$rows['sumx1squared'];
	 $sumx2squared=$rows['sumx2squared'];
	 $sumresponsesquared=$rows['sumresponsesquared'];
}
$x1_x1barsum = 0;
$x2_x2barsum = 0;
$response_responsebarsum = 0;
 // get the standard deviation of x1, x2 and response
$sql6 = "select auxin,cytokinin,response from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result6=mysqli_query($connection,$sql6);
while($rows=mysqli_fetch_array($result6))  
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
$R = number_format($R, 2, '.', ',');
$b1 = (($correlationx1response - ($correlationx2response*$correlationx1x2))/(1 - pow($correlationx1x2,2)));
$b1 = $b1 *($sdresponse/$sdx1);

$b2 = (($correlationx2response - ($correlationx1response*$correlationx1x2))/(1 - pow($correlationx1x2,2)));
$b2 = $b2 *($sdresponse/$sdx2);
$a = $responsebar - ($b1*$x1bar) -($b2*$x2bar);

$auxinarray = array();
$cytokininarray = array();
$index = 0;


$x = $auxinmin;
while($x<=$auxinmax)
{
if($auxinmax >1 && $auxinmax <100){
$increment = 1;
}
if($auxinmax >= 0 && $auxinmax <= 1 ){
$increment = 0.1;
}
	$auxinarray[$index] = $auxinmin;
	$auxinmin = $auxinmin + $increment;
	$x = $x + $increment;
	$index++;
}
$auxinindex = $index;
$index = 0;
$x = $cytokininmin;

while($x<=$cytokininmax)
{
if($cytokininmax >1 && $cytokininmax <100){
$increment = 1;
}
if($cytokininmax >= 0 && $cytokininmax <= 1 ){
$increment = 0.1;
}
	$cytokininarray[$index] = $cytokininmin;
	$cytokininmin = $cytokininmin + $increment;
	$x = $x + $increment;
	$index++;
}
$cytokininindex = $index;
$testarray = array();

$sql7 = "select auxinname, cytokininname, treatment, type from upload WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result7=mysqli_query($connection,$sql7);
while($rows=mysqli_fetch_array($result7))   
{
	 $auxinname=$rows['auxinname'];
	 $treatment=$rows['treatment'];
	 $type=$rows['type'];
	 $cytokininname=$rows['cytokininname'];
}



$sql10 = "DELETE FROM output where userid='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result3=mysqli_query($connection,$sql10);

for($i=0;$i<=$auxinindex;$i++){
for($j=0;$j<=$cytokininindex-1;$j++){
$prediction = $a + ($b1*$auxinarray[$i]) + ($b2*$cytokininarray[$j]);
$prediction = number_format($prediction, 2, '.', ',');
$query1 = "insert into output(userid, auxin, auxinname, cytokinin, cytokininname, response, treatment, type) values('".$id."', '".$auxinarray[$i]."','".$auxinname."','".$cytokininarray[$j]."','".$cytokininname."','".$prediction."','".$treatment."','".$type."')";
mysqli_query($connection,$query1); 
}
}

$sql11 = "DELETE FROM output where userid='$id' and cytokinin='' or auxin=''";  
$result11=mysqli_query($connection,$sql11);

$sql8 = "select max(response) as yield from output WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype'";  
$result8=mysqli_query($connection,$sql8);
while($rows=mysqli_fetch_array($result8))  
{
	 $yield=$rows['yield'];
}

$sql9 = "select auxin, cytokinin from output WHERE userid ='$id' and treatment='$treatment' and type='$type' and cytokininname='$kinintype' and response ='$yield'";  
$result9=mysqli_query($connection,$sql9);
$auxin = $row['auxin'];
$cytokinin = $row['cytokinin'];
?>
	
  </table>

<div id="content">
<br>
<br>
  <strong><font size="6" color="#be345"><?php echo "<br />SIMULATION RESULT"; echo "<br/>"?></font></b></td></font></strong> 
  <strong><font size="5" color="#000000"><?php echo "<br />The Correlation Coefficient factor of the data is <font color='#be345'> ", $R;?></font></b></td></font></strong> 
  <strong><font size="5" color="#000000"><?php echo "<br />The best response Yield is <font color='#be345'> ", $yield;?></font></b></td></font></strong> 

<td><strong><font size="5" color="#000000"><?php echo "<br/>The best Auxin Concentration Mixture is <font color='#be345'>  ", $auxin;echo 'mg/L';?></font></b></td></font></strong></td>   
<td><strong><font size="5" color="#000000"><?php echo "<br/>The best Cytokinin Concentration Mixture is  <font color='#be345'>", $cytokinin;echo 'mg/L';?></font></b></td></font></strong></td>   

  <br>
  <br>
   </table>
    </form>
<br></br><br></br>	<br></br><br></br>

</div> <!-- end #content -->


<?php include('includes/footer.php'); ?>

		</div> <!-- End #wrapper -->

	</body>

</html>
