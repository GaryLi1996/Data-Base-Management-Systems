<html>
<head>
  <title>GRK Clothing Warehouse</title>
  <h1>Add Employee</h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>

<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Snn:<input type="text" name="ssn">
First name:<input type="text" name="fname">
Last name:<input type="text" name="lname">
Salary:<input type="text" name="salary">
Home address:<input type="text" name="address">
Hours<input type="text" name="hour">
Type of Worker<select name="type">
	<option value="0"></option>
	<option value="IT">I.T.</option>
	<option value="Worker">Worker</option>
	<option value="Marketer">Marketer</option>
<input type="submit">
</form>
</html>

<?php
$con=mysqli_connect("localhost","root","gofyourselF2!#@", "grk");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$ssn = $_POST["ssn"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$salary = $_POST["salary"];
$address = $_POST["address"];
$hour = $_POST["hour"];
$work = $_POST["type"];

$sql = "INSERT INTO employee (ssn, fname, lname, salary, address, hours, jobtype)
		VALUES (".$ssn.",'".$fname."','".$lname."', '".$salary."','".$address."',".$hour.",'".$work."')";

$result = $con->query($sql);


$con ->close();
?>
