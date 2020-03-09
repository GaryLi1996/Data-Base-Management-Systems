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
  } ?>

  <!-- Should we have a drop down list or search bar? -->
  <!-- Need to return list of products available at the store -->
  <h3>Check inventory of a store<h3>
  <form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Search a Store: <input type "text" name = "store_name"><br>
    <!--<input type = "submit"> -->

    <select name = "action">
      <option value = ""> Sort by.. </option>
      <option value = "Lowest Quantity">qtySortLow</option>
	  <option value = "Highest Quantity">qtySortHigh</option>
      <option value = "Lowest Price">priceSortLow</option>
	  <option value = "Highest Price">priceSortHigh</option>
    </select>
    <input type = "submit">
  </form>


<?php

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    // need to check that the store exists in the data base
    $input = $_POST["store_name"];    //store the input in local variable
    $sortBy = $_POST["action"];		  //action to sort results by
    $result = mysqli_query($conn, "SELECT name FROM `shops` WHERE `shops`.name = '".$input."'"); //Returns store
    //check if there are no results for the search
    if($result->num_rows == 0){
      echo "There are no results for ".$input;
      echo "<br>Please make sure that there are no spelling errors (Case Sensitive)";
    }
    else{
      //save the name of the store in a local variable
      $row = mysqli_fetch_array($result);
      $store_name = $row["name"];

      echo "Returning results for ";
      echo $store_name;
      echo "<br>";


	  // ############################### NEED TO FIX BELOW ###############################
    // FIXES: now able to search a store and sort by values as well

	  // quantity, price
      //return the products that the store has
	  //Check if sorting has been selected
	  // Sort by descending quantity
	  if($sortBy == "Highest Quantity") {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id ORDER BY quantity DESC");
	  }
	  // Sort by ascending quantity
	  else if($sortBy == "Lowest Quantity") {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id ORDER BY quantity ASC");
	  }
	  // Sort by descending price
	  else if($sortBy == "Highest Price") {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id ORDER BY price DESC");
	  }
	  // Sort by ascending price
	  else if($sortBy == "Lowest Price") {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id ORDER BY price ASC");
	  }
	  // No Sorting
	  else {
		$result = mysqli_query($conn, "SELECT * FROM `items`,`shops`,`have` WHERE `shops`.name = '".$store_name. "'" . " AND `shops`.location = `have`.location AND `have`.product_id = `items`.product_id");
	  }

	  // ############################### NEED TO FIX ABOVE ###############################

      while($row = mysqli_fetch_array($result)){
        echo $row[0]. ": Price:   ". $row[2].". Quantity:   ". $row[3]. ". Store Address:   ". $row[4]. "<br>";
      }

    }
  }

?>
<h3>Return back to the options menu<h3>
<form method = "post" action = "option.php">
  <Button type = "submit">Return</Button>
</form>


</body>
</html>
