<html>

<head>
  <title>GRK Clothing Warehouse</title>
  <h1>GRK Search Manager</h1>

  <style>
    body{
      padding-top: 0px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>



<body>


  <?php
    //connect to the data base
    $conn=mysqli_connect("localhost","root","gofyourselF2!#@","grk");
    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
  ?>

  <h3> Enter the item that you want to search for: </h3>
  <form method = "post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Search for a Particular Item: <input type = "text" name = "the_item"><br>
    <input type = "submit">
  </form>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //need to check that the item exists in the data base
    $input = $_POST["the_item"];
    $result = mysqli_query($conn, "SELECT * FROM `items` WHERE `items`.name = '" .$input. "'");

    if($result->num_rows == 0){
      echo "There are no results for ".$input;
      echo "<br>Please make sure that there are no spelling errors (Case Sensitive)";
    }
    else{
      //save the name of the item in a local variable
      $row = mysqli_fetch_array($result);
      $item_name = $row["name"];

      echo "Returning results for ";
      echo $input;
      echo "<br>";

      //return the stores that have this item
      $result = mysqli_query($conn, "SELECT `shops`.name, `shops`.location FROM `shops`,`have`,`items` WHERE `items`.name = '".$input."' AND `items`.product_id = `have`.product_id AND `have`.location = `shops`.location");

      while($row = mysqli_fetch_array($result)){
        echo "Store Name: ".$row[0]. ", Address:   ". $row[1]."<br>";
      }

    }
  }

 ?>

 <h3>Return back to the options menu</h3>
 <form method = "post" action = "option.php">
   <Button type = "submit">Return </Button>
 </form>

</body>

</html>
