<html>
<head>
  <title>GRK Clothing Warehouse</title>
  <h1>Changing quantity</h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>
</html>
<?php
$con=mysqli_connect("localhost","root","gofyourselF2!#@", "grk");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM items");

echo "<table border='3'>
<tr>
<th>Name</th>
<th>Quantity</th>
</tr>";

while($row = mysqli_fetch_array($result))
{

	echo "<tr>";
	echo "<td>" . $row['name'] . "</td>";
	echo "<td>" . $row['quantity'] . "</td>";
	echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>

<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Quantity change:
<select name= "id">
  <option value="0">Name</option>
  <option value="1">Green T-Shirt</option>
  <option value="2">Green Pants</option>
  <option value="3">Purple Shorts</option>
  <option value="4">Heart Shape Underpants</option>
  <option value="5">Pink Baseball Cap</option>
  <option value="6">Striped Sock</option>
  <option value="7">Black Graphic Shirt</option>
  <option value="8">Grey Basic T-Shirt</option>
  <option value="9">Grey Pants</option>
  <option value="10">Red Socks</option>
  <option value="11">Black Underpants</option>
  <option value="12">Blue Top Hat</option>
</select>
<input type= "text" name="quantity">
<input type="submit">
</form>
<?php
$con=mysqli_connect("localhost","root","gofyourselF2!#@", "grk");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$input = $_POST["id"];
$quantity = $_POST["quantity"];
$sql = "UPDATE items SET quantity =" .$quantity. " WHERE product_id = '".$input."'";


$result = $con->query($sql);

$con->close();
?>

<h3>Return to options menu</h3>
<form method="post" action="option.php">
  <Button type = "submit">Return</Button>
</form>
