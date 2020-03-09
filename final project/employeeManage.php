<html>
<head>
  <title>GRK Clothing Warehouse</title>

  <h1>GRK Employee Manager<h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>

<h2> Delete an existing employee from the database<h2>

<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<select name="ssn">
<?php
$con=mysqli_connect("localhost","root","gofyourselF2!#@", "grk");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = mysqli_query($con, "SELECT * FROM employee");

while ($row = $sql->fetch_assoc()){
	echo '<option value="'.$row['ssn'].'">'.$row['ssn'].'</option>';
}
?>

</select>
<Button type="Delete" >Delete</Button>
</form>

<?php
$con=mysqli_connect("localhost","root","gofyourselF2!#@", "grk");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$ssn = $_POST['ssn'];
echo $ssn;
$sql = "DELETE FROM employee WHERE ssn =" .$ssn;

if ($con->query($sql) == TRUE) {
    echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $con->error;
}

//$result = $con->query($sql);

$con->close();
?>



<h2>Add a new Employee to the data base </h2>

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

<h3>Modify Employee</h3>

<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Ssn:<input type="text" name="Ssn">
First Name:<input type="text" name="Fname">
Last Name:<input type="text" name="Lname">
Salary:<input type="text" name="Salary">
Home Address:<input type="text" name="Address">
Hours:<input type="text" name="Hours1">
Type of Worker<select name="type">
	<option value="0"></option>
	<option value="IT">I.T.</option>
	<option value="Worker">Worker</option>
	<option value="Marketer">Marketer</option>
<input type="submit">
</form>

<?php
$con=mysqli_connect("localhost", "root", "gofyourselF2!#@", "grk");
//Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL: " .mysqli_connect_error();
}
$ssn = $_POST['Ssn'];
$fname = $_POST['Fname'];
$lname = $_POST['Lname'];
$salary = $_POST['Salary'];
$address = $_POST['Address'];
$hour = $_POST['Hours1'];
$type = $_POST['type'];
$sql = "UPDATE `employee` SET `employee`.fname= '".$fname."', `employee`.lname = '".$lname."',
			`employee`.salary ='".$salary."', `employee`.address='".$address."', `employee`.hours=".$hour.",
					`employee`.jobtype='".$type."' WHERE `employee`.ssn=" .$ssn;


if ($con->query($sql) == TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
$con->close();
?>
<h4>Return back to options menu</h4>
<form method="post" action="option.php">
  <Button type = "submit">Return</Button>
</form>

</body>
</html>
