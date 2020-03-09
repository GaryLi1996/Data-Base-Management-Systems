<html>

<head>
  <title>GRK Clothing Warehouse</title>
  <h1>Add new shops</h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>

<?php

  //establish connection with data base
  $conn = mysqli_connect("localhost","root","gofyourselF2!#@","grk");
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 ?>

<body>
<h2>Add a new shop to the data base<h2>
  <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
    Store Name: <input type = "text" name = "sName">
    Location: <input type = "text" name = "location">
    <input type = "submit">
  </form>

<?php
  //error checking
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $result = mysqli_query($conn, "SELECT * FROM `shops` WHERE `shops`.location = '".$_POST["location"]."'");
    if($result->num_rows>0){

    }
    else{
      //add the store name and location to the data base
      $insert = mysqli_query($conn, "INSERT INTO `shops` VALUES ( '" .$_POST["location"]. "', NULL,NULL,NULL, '" . $_POST["sName"]. "')");
      echo "Added new shop to the data base (Some values may need to be edited, go to edit shops to edit)";

    }
  }


?>
<h3>Edit Shops <h3>
  <form method="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Location of the store to be updated: <input type = "text" name = "loc">
    Number of Employees at this Store: <input type="text" name = "num_employees">
    Profit: <input type = "text" name = "profit2">
    Revenue: <input type = "text" name = "revenue2">
    <input type = "submit">
  </form>
<?php
  //Error checking
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $result = mysqli_query($conn,"SELECT * FROM `shops` WHERE `shops`.location = '".$_POST["loc"]."'");
    if($result->num_rows == 0){
      echo " There is no shop at this location";
    }
    else{
      echo $_POST["num_employees"];
      echo $_POST["profit2"];
      echo $_POST["revenue2"];
      $insert = mysqli_query($conn,"UPDATE `shops` SET `shops`.number_of_employee = ".$_POST["num_employees"].", `shops`.profit = ".$_POST["profit2"]. ", `shops`.revenue = ".$_POST["revenue2"]." WHERE `shops`.location = '".$_POST["loc"]. "'");
      echo "updated store information";
    }
  }

?>

<h3> Update a shops inventory </h3>
<form method = "post" action "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Enter the location of the shop you want to update: <input type = "text" name = "loc2">
  Enter the product ID of the item you want to add: <input type = "text" name = "product_ID">
  <input type = "submit">
</form>

<?php

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Error checing
    $result = mysqli_query($conn,"SELECT * FROM `shops` WHERE `shops`.location = '".$_POST["loc2"]."'");
    if($result->num_rows == 0){
      echo "There are no shops at that location";
    }
    else {
      //add new product that
      $result = mysqli_query($conn,"INSERT INTO `have` VALUES ('" .$_POST["loc2"]."', '" .$_POST["product_ID"]."')");
    }
  }
?>

<h3>Return back to options menu<h3>
<form action = "option.php" method="post">
  <Button type = "submit">Return</Button>
</form>


</body>
